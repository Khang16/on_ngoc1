export default function StudyScheduleInit() {
  function remToPx(rem) {
    return rem * parseFloat(getComputedStyle(document.documentElement).fontSize)
  }

  const thumbSlide = new Swiper('.study-schedule-slide-thumb', {
    spaceBetween: remToPx(6),
    slidesPerView: 1,
    speed: 500,
    grabCursor: true,
    breakpoints: {
      640: {
        spaceBetween: remToPx(11.6875),
      },
    },
    on: {
      click: function () {
        const clickedIndex = this.clickedIndex
        if (clickedIndex !== undefined) {
          this.slideTo(clickedIndex)
          const mainSlide = document.querySelector('.study-schedule__slide').swiper
          mainSlide.slideTo(clickedIndex)
        }
      },
    },
  })

  const mainSlide = new Swiper('.study-schedule__slide', {
    navigation: {
      nextEl: '.study-schedule-button-next',
      prevEl: '.study-schedule-button-prev',
    },
    pagination: {
      el: '.study-schedule-pagination',
      type: 'fraction',
    },
    slidesPerView: 1,
    grabCursor: true,
    speed: 500,
    effect: 'creative',
    creativeEffect: {
      prev: {
        translate: ['-150%', 0, -2000],
      },
      next: {
        translate: ['150%', 0, -2000],
      },
    },
  })

  // Đồng bộ hóa khi thay đổi slide ở mainSlide
  mainSlide.on('slideChange', () => {
    thumbSlide.slideTo(mainSlide.activeIndex)
  })

  // Đồng bộ hóa khi thay đổi slide ở thumbSlide
  thumbSlide.on('slideChange', () => {
    mainSlide.slideTo(thumbSlide.activeIndex)
  })

  class LevelSelector {
    constructor(currentSelector, targetSelector) {
      this.currentLevels = document.querySelectorAll(currentSelector)
      this.targetLevels = document.querySelectorAll(targetSelector)
      this.slideThumb = document.querySelector('.study-schedule-slide-thumb .swiper-wrapper')
      this.mainSlide = document.querySelector('.study-schedule__slide .swiper-wrapper')
      this.currentLevel = 0
      this.targetLevel = 1
      this.currentLine = null
      this.init()
    }

    init() {
      document
        .querySelector(`.for-current-level .level-item[data-level="${this.currentLevel}"]`)
        .classList.add('active')
      document.querySelector(`.for-target-level .level-item[data-level="${this.targetLevel}"]`).classList.add('active')

      // update text for trigger
      const currentTriggerText = document.querySelector('.current-level .lever-item-trigger span')
      if (currentTriggerText) {
        const currentItem = document.querySelector(`.for-current-level .level-item[data-level="${this.currentLevel}"]`)
        if (currentItem) {
          currentTriggerText.textContent = currentItem.textContent
        }
      }
      const targetTriggerText = document.querySelector('.target-level .lever-item-trigger span')
      if (targetTriggerText) {
        const targetItem = document.querySelector(`.for-target-level .level-item[data-level="${this.targetLevel}"]`)
        if (targetItem) {
          targetTriggerText.textContent = targetItem.textContent
        }
      }

      // btn trigger mobile
      const currentTrigger = document.querySelector('.current-level .lever-item-trigger')
      const targetTrigger = document.querySelector('.target-level .lever-item-trigger')
      if (currentTrigger) {
        currentTrigger.addEventListener('click', () => {
          document.querySelector('.for-current-level').classList.toggle('active')
          // Đóng cái còn lại
          document.querySelector('.for-target-level').classList.remove('active')
        })
      }

      if (targetTrigger) {
        targetTrigger.addEventListener('click', () => {
          document.querySelector('.for-target-level').classList.toggle('active')
          // Đóng cái còn lại
          document.querySelector('.for-current-level').classList.remove('active')
        })
      }
      // click outside to close
      document.addEventListener('click', (event) => {
        const currentLevelContainer = document.querySelector('.for-current-level')
        const targetLevelContainer = document.querySelector('.for-target-level')
        const currentTrigger = document.querySelector('.current-level .lever-item-trigger')
        const targetTrigger = document.querySelector('.target-level .lever-item-trigger')
        if (
          currentLevelContainer &&
          targetLevelContainer &&
          !currentLevelContainer.contains(event.target) &&
          !targetLevelContainer.contains(event.target) &&
          (!currentTrigger || !currentTrigger.contains(event.target)) &&
          (!targetTrigger || !targetTrigger.contains(event.target))
        ) {
          currentLevelContainer.classList.remove('active')
          targetLevelContainer.classList.remove('active')
        }
      })

      this.currentLevels.forEach((item) => {
        item.addEventListener('click', () => this.handleCurrentClick(item))
      })
      this.targetLevels.forEach((item) => {
        item.addEventListener('click', () => this.handleTargetClick(item))
      })
      this.updateLine()
      this.handleRenderSlide()

      // Xử lý resize window
      window.addEventListener('resize', () => {
        const cursorFollow = document.querySelector('.cursor-follow')
        if (window.innerWidth <= 640 && cursorFollow) {
          cursorFollow.style.opacity = '0'
        }
      })
    }

    handleCurrentClick(item) {
      this.currentLevels.forEach((el) => el.classList.remove('active'))
      item.classList.add('active')
      const level = Number(item.getAttribute('data-level'))
      this.currentLevel = level
      this.targetLevels.forEach((el) => {
        const elLevel = Number(el.getAttribute('data-level'))
        if (elLevel <= level) {
          if (el.classList.contains('active')) {
            el.classList.remove('active')
            const nextLevel = elLevel + 1
            const nextItem = document.querySelector(`.for-target-level .level-item[data-level="${nextLevel}"]`)
            if (nextItem) {
              nextItem.classList.add('active')
              this.targetLevel = nextLevel

              // update text for trigger
              const targetTriggerText = document.querySelector('.target-level .lever-item-trigger span')
              if (targetTriggerText) {
                const targetItem = document.querySelector(
                  `.for-target-level .level-item[data-level="${this.targetLevel}"]`
                )
                if (targetItem) {
                  targetTriggerText.textContent = targetItem.textContent
                }
              }
            }
          }
          el.classList.add('disabled')
        } else {
          el.classList.remove('disabled')
        }
      })
      this.handleRenderSlide()
      this.updateLine()

      // update text for trigger
      const currentTriggerText = document.querySelector('.current-level .lever-item-trigger span')
      if (currentTriggerText) {
        const currentItem = document.querySelector(`.for-current-level .level-item[data-level="${this.currentLevel}"]`)
        if (currentItem) {
          currentTriggerText.textContent = currentItem.textContent
        }
      }

      // close popup
      const currentLevelContainer = document.querySelector('.for-current-level')
      if (currentLevelContainer) {
        currentLevelContainer.classList.remove('active')
      }
    }

    handleTargetClick(item) {
      if (!item.classList.contains('disabled')) {
        this.targetLevels.forEach((el) => el.classList.remove('active'))
        item.classList.add('active')
        const level = Number(item.getAttribute('data-level'))
        this.targetLevel = level
        this.handleRenderSlide()
        this.updateLine()

        // update text for trigger
        const targetTriggerText = document.querySelector('.target-level .lever-item-trigger span')
        if (targetTriggerText) {
          const targetItem = document.querySelector(`.for-target-level .level-item[data-level="${this.targetLevel}"]`)
          if (targetItem) {
            targetTriggerText.textContent = targetItem.textContent
          }
        }

        // close popup
        const targetLevelContainer = document.querySelector('.for-target-level')
        if (targetLevelContainer) {
          targetLevelContainer.classList.remove('active')
        }
      }
    }

    handleRenderSlide() {
      // Render slide thumb
      const numSlide = this.targetLevel - this.currentLevel
      this.slideThumb.innerHTML = ''
      if (numSlide === 1) {
        this.slideThumb.innerHTML = `
        <div class="swiper-slide">
          <img src="https://onngocbeuvinvi.edu.vn/wp-content/uploads/2025/07/icon-chang-end.webp" alt="" srcset="">
        </div>
        `
      } else if (numSlide == 2) {
        this.slideThumb.innerHTML = `
        <div class="swiper-slide">
          <img src="https://onngocbeuvinvi.edu.vn/wp-content/uploads/2025/07/icon-chang-start.webp" alt="" srcset="">
        </div>
        <div class="swiper-slide">
          <img src="https://onngocbeuvinvi.edu.vn/wp-content/uploads/2025/07/icon-chang-end.webp" alt="" srcset="">
        </div>
        `
      } else if (numSlide > 2) {
        this.slideThumb.innerHTML = `
        <div class="swiper-slide">
          <img src="https://onngocbeuvinvi.edu.vn/wp-content/uploads/2025/07/icon-chang-start.webp" alt="" srcset="">
        </div>
        ${'<div class="swiper-slide"><img src="https://onngocbeuvinvi.edu.vn/wp-content/uploads/2025/07/icon-chang.webp" alt="" srcset=""></div>'.repeat(numSlide - 2)}
        <div class="swiper-slide">
          <img src="https://onngocbeuvinvi.edu.vn/wp-content/uploads/2025/07/icon-chang-end.webp" alt="" srcset="">
        </div>
        `
      }

      // Render main slide
      this.mainSlide.innerHTML = ''
      studyScheduleData.courses.forEach((course, index) => {
        if (index >= this.currentLevel && index < this.targetLevel) {
          const slideItem = document.createElement('div')
          slideItem.classList.add('swiper-slide')
          // Xác định tiêu đề cho từng slide
          let title = ''
          if (index === this.currentLevel) {
            title = 'Bắt đầu'
          } else if (index === this.targetLevel - 1) {
            title = 'Kết thúc'
          } else {
            title = `Chặng ${index - this.currentLevel + 1}`
          }
          if (window.innerWidth <= 640) {
            slideItem.innerHTML = `
            <div class="study-schedule__slide-item">
              <div class="study-schedule__slide-item-title">${title}</div>
              <div class="study-schedule__slide-item-name">${course.name}</div>
              <div class="study-schedule__slide-item-content">
              ${course.description}
              </div>
              <a href="${course.link}" class="study-schedule__slide-item-link">
                Xem chi tiết khoá học
                </a>
                </div>
                `
          } else {
            slideItem.innerHTML = `
            <a href="${course.link}" class="study-schedule__slide-item">
              <div class="study-schedule__slide-item-title">${title}</div>
              <div class="study-schedule__slide-item-name">${course.name}</div>
              <div class="study-schedule__slide-item-content">
                ${course.description}
              </div>
            </a>
            `
          }
          this.mainSlide.appendChild(slideItem)
        }
      })

      // khởi tạo lại swiper
      thumbSlide.update()
      mainSlide.update()

      // Thêm cursor follow cho màn hình lớn hơn 640px
      if (window.innerWidth > 640) {
        this.initCursorFollow()
      }
    }

    initCursorFollow() {
      // Tạo cursor follow element
      let cursorFollow = document.querySelector('.cursor-follow')
      if (!cursorFollow) {
        cursorFollow = document.createElement('div')
        cursorFollow.className = 'cursor-follow'
        cursorFollow.innerHTML = '<span>chi tiết</span>'
        cursorFollow.style.cssText = `
          position: fixed;
          width: 5rem;
          height: 5rem;
          background: rgba(255, 255, 255, 0.75);
          border-radius: 50%;
          display: flex;
          align-items: center;
          justify-content: center;
          font-size: 0.875rem;
          color: #333;
          pointer-events: none;
          z-index: 9999;
          opacity: 0;
          transform: translate(-50%, -50%) scale(0.5);
          transition: opacity 0.3s ease-in-out, transform 0.5s ease-in-out;
        `
        document.body.appendChild(cursorFollow)
      }

      // Xóa event listeners cũ
      const slideItems = document.querySelectorAll('.study-schedule__slide-item')
      slideItems.forEach((item) => {
        item.removeEventListener('mouseenter', this.handleMouseEnter)
        item.removeEventListener('mouseleave', this.handleMouseLeave)
        item.removeEventListener('mousemove', this.handleMouseMove)
      })

      // Thêm event listeners mới
      slideItems.forEach((item) => {
        item.addEventListener('mouseenter', this.handleMouseEnter.bind(this))
        item.addEventListener('mouseleave', this.handleMouseLeave.bind(this))
        item.addEventListener('mousemove', this.handleMouseMove.bind(this))
      })
    }

    handleMouseEnter = () => {
      const cursorFollow = document.querySelector('.cursor-follow')
      if (cursorFollow) {
        cursorFollow.style.opacity = '1'
        cursorFollow.style.transform = 'translate(-50%, -50%) scale(1)'
      }
    }

    handleMouseLeave = () => {
      const cursorFollow = document.querySelector('.cursor-follow')
      if (cursorFollow) {
        cursorFollow.style.opacity = '0'
        cursorFollow.style.transform = 'translate(-50%, -50%) scale(0.1)'
      }
    }

    handleMouseMove = (e) => {
      const cursorFollow = document.querySelector('.cursor-follow')
      if (cursorFollow) {
        cursorFollow.style.left = e.clientX + 'px'
        cursorFollow.style.top = e.clientY + 'px'
      }
    }
    updateLine = () => {
      if (window.innerWidth < 640) return
      const selectedLeft = document.querySelector('.for-current-level .level-item.active')
      const selectedRight = document.querySelector('.for-target-level .level-item.active')

      if (this.currentLine) this.currentLine.remove()
      this.currentLine = new LeaderLine(selectedLeft, selectedRight, {
        color: '#fff',
        path: 'fluid', // đường cong mềm mại hơn 'arc'
        dash: { animation: true, len: 8, gap: 6, sync: true }, // nét đứt
        startPlug: 'disc', // đầu tròn
        endPlug: 'disc', // cuối tròn
        size: 2, // độ dày đường
        plugSize: 2.2, // to hơn mặc định
        gradient: false, // không cần gradient
      })
    }
  }

  // Khởi tạo class cho selector
  new LevelSelector('.for-current-level .level-item', '.for-target-level .level-item')
}
