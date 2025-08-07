export default function section1000StudentsInit() {
  gsap.set('.section-1000-students > .image-container > img:nth-child(1)', { y: 500, opacity: 0 })
  gsap.set('.section-1000-students > .image-container > img:nth-child(2)', { y: 550, opacity: 0 })
  gsap.set('.section-1000-students > .image-container > img:nth-child(3)', { y: 400, opacity: 0 })
  gsap.set('.section-1000-students > .image-container > img:nth-child(4)', { y: 600, opacity: 0 })
  gsap.set('.section-1000-students > .image-container > img:nth-child(5)', { y: 300, opacity: 0 })
  gsap.set('.section-1000-students > .image-container > img:nth-child(6)', { y: 350, opacity: 0 })
  gsap.set('.section-1000-students > .image-container > img:nth-child(7)', { y: 500, opacity: 0 })
  gsap.set('.section-1000-students > .image-container > img:nth-child(8)', { y: 600, opacity: 0 })
  gsap.set('.section-1000-students > .image-container > .dot:nth-child(9)', { y: 400, opacity: 0 })
  gsap.set('.section-1000-students > .image-container > .dot:nth-child(10)', { y: 400, opacity: 0 })
  gsap.set('.section-1000-students > .image-container > .dot:nth-child(11)', { y: 400, opacity: 0 })
  gsap.set('.section-1000-students > .image-container > .dot:nth-child(12)', { y: 500, opacity: 0 })
  gsap.set('.section-1000-students > .image-container > .dot:nth-child(13)', { y: 600, opacity: 0 })
  gsap.set('.section-1000-students > .image-container > .content-intro', { y: 600, opacity: 0 })

  gsap.to('.section-1000-students > .image-container > *', {
    scrollTrigger: {
      trigger: '.section-1000-students',
      start: 'top center',
      once: true,
      toggleActions: 'play none none none',
    },
    opacity: 1,
    y: 0,
    duration: 1.3,
    ease: 'power3.inOut',
  })
}
