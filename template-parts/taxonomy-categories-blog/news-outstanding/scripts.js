export const newsOutstanding = () => {
  const outstandingListSwiper = new Swiper(".news-outstanding__outstanding-list__swiper", {
    slidesPerView: 1,
    effect: "fade",
    spaceBetween: 0,
    loop: true,
    autoplay: {
      delay: 5000,
      disableOnInteraction: false,
    },
    speed: 750,
    pagination: {
      clickable: true,
      el: ".news-outstanding__outstanding-list__swiper-pagination",
    },
  });
};