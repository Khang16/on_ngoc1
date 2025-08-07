export const outstandingContentSection = () => {
	const progressBars = document.querySelectorAll(".outstanding-swiper__autoplay-progress-item__bar-inner");
	const items = document.querySelectorAll(".outstanding-swiper__autoplay-progress-item");
	const progressBarMobileInnerEl = document.querySelector(".outstanding-swiper-autoplay-progress-mobile__inner");
	const isMobileDevice = window.innerWidth < 640;
	const swiper = new Swiper(".outstanding-swiper", {
		effect: "fade",
		slidesPerView: 1,
		pagination: isMobileDevice
		? {
			el: ".outstanding-swiper-pagination",
			clickable: true,
		}
		: {},
		loop: true,
		autoplay: {
			delay: 7500,
			disableOnInteraction: false,
		},
		speed: 750,
		on: {
			init: function () {
				updateAutoplayProgress(this.realIndex, this.params.autoplay.delay);
			},
			slideChange: function () {
				if (isMobileDevice) return;
				updateAutoplayProgress(this.realIndex, this.params.autoplay.delay);
			},
			autoplayTimeLeft(s, time, progress) {
				if (!isMobileDevice || !progressBarMobileInnerEl) return;
				const percentage = (1 - progress) * 100;
				progressBarMobileInnerEl.style.width = `${percentage}%`;
			},
		},
	});

	function updateAutoplayProgress(index, delay) {
		// Reset progress
		progressBars.forEach((bar) => {
			bar.style.transition = "none";
			bar.style.width = "0%";
		});
		items.forEach((item) => item.classList.remove("active"));

		// Animate correct progress bar
		const activeBar = progressBars[index];
		const activeItem = items[index];

		if (activeBar && activeItem) {
			activeItem.classList.add("active");

			// Reflow & animate
			void activeBar.offsetWidth;
			activeBar.style.transition = `width ${delay}ms linear`;
			activeBar.style.width = "100%";
		}
	}
};
