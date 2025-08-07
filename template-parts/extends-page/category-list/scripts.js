export const categorySection = () => {
	const isMobileDevice = window.innerWidth < 640;
	const extendsCategoryItems = document.querySelectorAll(".extends-category-swiper");
	const prevSlideBtn = document.querySelectorAll(".extends-category-swiper__btn-nav-prev");
	const nextSlideBtn = document.querySelectorAll(".extends-category-swiper__btn-nav-next");
	if (!isMobileDevice) {
		extendsCategoryItems.forEach((swiperEl, index) => {
			const swiperWrapper = swiperEl.querySelector(".swiper-wrapper");
			let slideItems = swiperWrapper.querySelectorAll(".swiper-slide");

			// Clone thêm cho đủ 10 item nếu chưa đủ
			if (slideItems.length < 10) {
				const clonesNeeded = 10 - slideItems.length;
				for (let i = 0; i < clonesNeeded; i++) {
					const clone = slideItems[i % slideItems.length].cloneNode(true);
					swiperWrapper.appendChild(clone);
				}
			}
			new Swiper(swiperEl, {
				slidesPerView: "auto",
				spaceBetween: remToPixels(1.5),
				loop: true,
				navigation: {
					nextEl: nextSlideBtn[index],
					prevEl: prevSlideBtn[index],
				},
				scrollbar: {
					el: ".extends-category-scrollbar",
					hide: false,
				},
			});
		});
	}
};
