export function teacherAbout() {
  new Swiper(".teacher-swiper", {
    loop: true,
    // slidesPerView: 3,
    centeredSlides: true,
    pagination: {
      el: ".pagination__course",
      clickable: true,
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    breakpoints: {
      0: {
         slidesPerView: 1.25, // Mặc định mobile <640px
      },
      640: {
        slidesPerView: 3, // Từ 640px trở lên hiển thị 3 slide
      },
    },
    on: {
      init: function () {
        // Khi khởi tạo: chỉ item đầu (active) hiển thị
        toggleInfo(this);
      },
      slideChangeTransitionEnd: function () {
        // Khi chuyển slide: chỉ hiện info ở item mới
        toggleInfo(this);
      },
    },
  });

  function toggleInfo(swiperInstance) {
    document.querySelectorAll(".teacher__item").forEach((slide) => {
      const name = slide.querySelector(".teacher__item--name");
      const position = slide.querySelector(".teacher__item--position");
      if (name && position) {
        name.classList.remove("visible");
        position.classList.remove("visible");
      }
    });

    const activeSlide = swiperInstance.slides[swiperInstance.activeIndex];
    if (activeSlide) {
      const name = activeSlide.querySelector(".teacher__item--name");
      const position = activeSlide.querySelector(".teacher__item--position");
      if (name && position) {
        name.classList.add("visible");
        position.classList.add("visible");
      }
    }
  }
}

export function initializeTeacherPopup() {
    const CERT_ICON_URL = "https://onngocbeuvinvi.edu.vn/wp-content/uploads/2025/07/Award-Ribbon-Star-1-Streamline-Ultimate.png";
    const items = document.querySelectorAll(".teacher__item");
    const popup = document.getElementById("teacher-popup");
    const popupClose = document.querySelector(".popup-close");

    const popupImageWrapper = document.getElementById("popup-image");
    const popupName = document.getElementById("popup-name");
    const popupHSK = document.getElementById("popup-hsk");
    const popupListen = document.getElementById("popup-listen");
    const popupRead = document.getElementById("popup-read");
    const popupWrite = document.getElementById("popup-write");
    const popupCerts = document.getElementById("popup-certificates");
	console.log("items", items)
    items.forEach(item => {
        item.addEventListener("click", function () {
			console.log("item", item)
            const name = this.dataset.name || "";
            const imageHTML = this.dataset.imageHtml || "";
            const hsk = this.dataset.hsk || "";
            const listen = this.dataset.listen || "";
            const read = this.dataset.read || "";
            const write = this.dataset.write || "";

            popupName.textContent = name;
            popupImageWrapper.innerHTML = imageHTML;
            popupHSK.textContent = hsk;
            popupListen.textContent = listen;
            popupRead.textContent = read;
            popupWrite.textContent = write;

            const certs = JSON.parse(this.dataset.certificates || "[]");
            popupCerts.innerHTML = "";
            certs.forEach(cert => {
                const certWrapper = document.createElement("div");
                certWrapper.classList.add("popup-cert-item");
                certWrapper.innerHTML = `
                    <div class="popup-cert-item-text">
                        <img src="${CERT_ICON_URL}" alt="icon" class="cert-icon" />
                        <span class="popup-cert-text">${cert}</span>
                    </div>
                    <hr class="popup-hr">
                `;
                popupCerts.appendChild(certWrapper);
            });

            popup.classList.remove("hidden");
            document.body.style.overflow = "hidden";
        });
    });

    popupClose.addEventListener("click", function () {
        popup.classList.add("hidden");
        document.body.style.overflow = "";
    });

    popup.addEventListener("click", function (e) {
        if (e.target === popup) {
            popup.classList.add("hidden");
        }
    });
}

console.log(initializeTeacherPopup())

