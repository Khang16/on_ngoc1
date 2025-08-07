// JavaScript cải tiến - Scroll trực tiếp không dùng link, bỏ theo dõi vị trí
document.addEventListener('DOMContentLoaded', function () {
  const tocItems = document.querySelectorAll('.toc-item')
  const tocPopup = document.querySelector('.toc-popup-mb')
  const triggerToc = document.querySelector('.trigger-toc')

  // Xử lý click scroll
  tocItems.forEach((item) => {
    item.addEventListener('click', function () {
      const targetAnchor = this.getAttribute('data-target')
      const targetHeading = document.querySelector(`[data-toc-target="${targetAnchor}"]`)

      if (targetHeading) {
        // Smooth scroll tới heading
        const offsetTop = targetHeading.offsetTop
        window.scrollTo({
          top: offsetTop,
          behavior: 'smooth',
        })
      }

      // Ẩn popup và trigger sau khi click
      if (tocPopup) {
        tocPopup.classList.remove('show')
      }
    })
  })

  if (triggerToc && tocPopup) {
    // Hiển thị popup khi click vào trigger
    triggerToc.addEventListener('click', function () {
      tocPopup.classList.toggle('show')
      this.classList.toggle('show')
    })

    // Ẩn popup khi click ra ngoài
    document.addEventListener('click', function (event) {
      if (!tocPopup.contains(event.target) && !triggerToc.contains(event.target)) {
        tocPopup.classList.remove('show')
        triggerToc.classList.remove('show')
      }
    })
  }

  // handle share button click (only mobile)
  if (window.innerWidth <= 640) {
    const shareButtons = document.querySelectorAll('.blog-share')

    shareButtons.forEach((button) => {
      button.addEventListener('click', async function () {
        try {
          await navigator.share({
            url: window.location.href,
          })
        } catch (error) {
          console.error('Error sharing:', error)
        }
      })
    })
  }

  // get all table tag and add a div tag wrap it
  document.querySelectorAll('table').forEach((table) => {
    const wrapper = document.createElement('div')
    wrapper.classList.add('table-responsive')
    table.parentNode.insertBefore(wrapper, table)
    wrapper.appendChild(table)
  })
})
