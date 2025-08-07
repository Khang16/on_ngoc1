export default function specialFeature() {
  const isMobileDevice = window.innerWidth < 640
  gsap.registerPlugin(ScrollTrigger)

  const itemsContainer = document.querySelector('.special-feature__features')
  const items = document.querySelectorAll('.special-feature__features .feature-item')

  gsap.set(items, { scale: 0, opacity: 0 }) // Ẩn ban đầu

  if (isMobileDevice) {
    const itemsArray = Array.from(items)
    const lastItem = itemsArray[itemsArray.length - 1]
    const itemsExceptLast = itemsArray.slice(0, -1)

    gsap.to(itemsExceptLast, {
      scrollTrigger: {
        trigger: itemsContainer,
        start: 'top 80%',
        once: true,
        toggleActions: 'play none none none',
      },
      scale: 1,
      opacity: 1,
      duration: 0.5,
      stagger: 0.3,
      ease: 'back.out(1.7)',
    })

    gsap.to(lastItem, {
      scrollTrigger: {
        trigger: itemsContainer,
        start: 'top 80%',
        once: true,
        toggleActions: 'play none none none',
      },
      scale: 1,
      opacity: 1,
      duration: 0.5,
      delay: 0.3 * 1,
      ease: 'back.out(1.7)',
    })
  } else {
    gsap.to(items, {
      scrollTrigger: {
        trigger: itemsContainer,
        start: 'top 80%',
      },
      scale: 1,
      opacity: 1,
      duration: 0.5,
      stagger: 0.3,
      ease: 'back.out(1.7)',
    })
  }
}
