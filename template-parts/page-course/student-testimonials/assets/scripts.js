export const studentTestimonials = () => {
    const swiper = new Swiper(".testimonial-slider__swiper", {
        slidesPerView: "auto",
        spaceBetween:
            window.innerWidth > 639.98 ? remToPixels(2) : remToPixels(1.38),
        loop: true,
        speed: 5000,
        autoplay: {
            delay: 0,
        },
    });

    // Additional hover controls for individual slides
    const slides = document.querySelectorAll(".testimonial-slider__slide");

    slides.forEach((slide) => {
        // Desktop
        slide.addEventListener("mouseenter", () => {
            swiper.autoplay.stop();
        });

        slide.addEventListener("mouseleave", () => {
            swiper.autoplay.start();
        });

        // Mobile
        slide.addEventListener("touchstart", () => {
            swiper.autoplay.stop();
        });
        slide.addEventListener("touchend", () => {
            swiper.autoplay.start();
        });
    });

    // Pause autoplay when page is not visible
    document.addEventListener("visibilitychange", () => {
        if (document.hidden) {
            swiper.autoplay.stop();
        } else {
            swiper.autoplay.start();
        }
    });
};
