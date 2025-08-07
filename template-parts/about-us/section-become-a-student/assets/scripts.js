document.addEventListener("DOMContentLoaded", function () {
	const buttons = document.querySelectorAll(".tab-button");
	const panels = document.querySelectorAll(".tab-panel");
	const images = document.querySelectorAll(".main-image");

	function isMobile() {
		return window.innerWidth <= 639.98;
	}

	function activateImages(tabId) {
		images.forEach((img) => img.classList.remove("active"));

		if (isMobile()) {
			const mobileImages = document.querySelectorAll(`.mobile-image[data-tab="${tabId}"]`);
			mobileImages.forEach(img => {
				img.classList.add("active");
			});
		} else {
			const desktopImages = document.querySelectorAll(`.desktop-image[data-tab="${tabId}"]`);
			desktopImages.forEach(img => {
				img.classList.add("active");
			});
		}
	}

	buttons.forEach((button) => {
		button.addEventListener("click", function () {
			const tabId = this.getAttribute("data-tab");

			buttons.forEach((b) => b.classList.remove("active"));
			panels.forEach((p) => p.classList.remove("active"));

			this.classList.add("active");
			const targetPanel = document.getElementById(tabId);
			if (targetPanel) {
				targetPanel.classList.add("active");
			}

			activateImages(tabId);
		});
	});

	window.addEventListener('resize', function() {
		const activeButton = document.querySelector('.tab-button.active');
		if (activeButton) {
			const tabId = activeButton.getAttribute('data-tab');
			activateImages(tabId);
		}
	});

	const activeButton = document.querySelector('.tab-button.active');
	if (activeButton) {
		const tabId = activeButton.getAttribute('data-tab');
		activateImages(tabId);
	}
	Fancybox.bind("[data-fancybox]", {
        //
    });
});