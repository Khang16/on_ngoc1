export function bannerHome() {
    new Swiper(".main-banner__swiper", {
        effect: "fade",
        slidesPerView: 1,
        spaceBetween: 0,
        navigation: {
            nextEl: ".main-banner__next",
            prevEl: ".main-banner__prev",
        },
        pagination: {
            el: ".main-banner__pagination",
            clickable: true,
        },
    });
}
