function remToPx(rem) {
  const rootFontSize = parseFloat(getComputedStyle(document.documentElement).fontSize)
  return rem * rootFontSize
}

function addHoverEffect(swiper, selector, normalSpeed = 2000, slowSpeed = 6000) {
  const container = document.querySelector(selector)
  if (container) {
    container.addEventListener('mouseenter', () => {
      swiper.autoplay.stop()
      swiper.params.speed = slowSpeed
      swiper.update() // Force update swiper
      swiper.autoplay.start()
      console.log(`Swiper speed changed to ${slowSpeed}ms on hover for ${selector}`)
    })

    container.addEventListener('mouseleave', () => {
      swiper.autoplay.stop()
      swiper.params.speed = normalSpeed
      swiper.update() // Force update swiper
      swiper.autoplay.start()
      console.log(`Swiper speed changed back to ${normalSpeed}ms on mouse leave for ${selector}`)
    })
  }
}

export default function sectionAppreciateInit() {
  const swiper1 = new Swiper('.marquue__container-1', {
    slidesPerView: 'auto',
    spaceBetween: remToPx(1.3125),
    loop: true,
    speed: 2000,
    direction: 'vertical',
    freeMode: true,
    pagination: false,
    navigation: false,
    autoplay: {
      delay: 0,
      pauseOnMouseEnter: false,
      disableOnInteraction: false,
    },
  })
  const swiper2 = new Swiper('.marquue__container-2', {
    slidesPerView: 'auto',
    spaceBetween: remToPx(1.3125),
    loop: true,
    speed: 2000,
    direction: 'vertical',
    freeMode: true,
    pagination: false,
    navigation: false,
    autoplay: {
      delay: 0,
      pauseOnMouseEnter: false,
      disableOnInteraction: false,
      reverseDirection: true,
    },
  })
  const swiper3 = new Swiper('.marquue__container-3', {
    slidesPerView: 'auto',
    spaceBetween: remToPx(1.3125),
    loop: true,
    speed: 2000,
    direction: 'vertical',
    freeMode: true,
    pagination: false,
    navigation: false,
    autoplay: {
      delay: 0,
      pauseOnMouseEnter: false,
      disableOnInteraction: false,
    },
  })

  addHoverEffect(swiper1, '.marquue__container-1')
  addHoverEffect(swiper2, '.marquue__container-2')
  addHoverEffect(swiper3, '.marquue__container-3')

  // mobile
  new Swiper('.marquue__container-mb-1', {
    slidesPerView: 'auto',
    spaceBetween: remToPx(1.375),
    loop: true,
    speed: 10000,
    direction: 'horizontal',
    freeMode: true,
    pagination: false,
    navigation: false,
    autoplay: {
      delay: 0,
      pauseOnMouseEnter: true,
      disableOnInteraction: false,
    },
  })
  new Swiper('.marquue__container-mb-2', {
    slidesPerView: 'auto',
    spaceBetween: remToPx(1.375),
    loop: true,
    speed: 10000,
    direction: 'horizontal',
    freeMode: true,
    pagination: false,
    navigation: false,
    autoplay: {
      delay: 0,
      pauseOnMouseEnter: true,
      disableOnInteraction: false,
      reverseDirection: true,
    },
  })
}
