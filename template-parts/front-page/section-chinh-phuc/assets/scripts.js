export function targetHome() {
    sectionCourses();

    new Swiper(".marquue__container.right", {
        slidesPerView: "auto",
        spaceBetween: remToPx(2),
        loop: true,
        speed: 10000,
        direction: "horizontal",
        freeMode: true,
        zoom: true,
        keyboard: true,
        pagination: false,
        navigation: false,
        autoplay: {
            delay: 0,
            pauseOnMouseEnter: true,
            disableOnInteraction: false,
        },
    });
    new Swiper(".marquue__container.left", {
        slidesPerView: "auto",
        spaceBetween: remToPx(2),
        loop: true,
        speed: 10000,
        direction: "horizontal",
        freeMode: true,
        zoom: true,
        keyboard: true,
        pagination: false,
        navigation: false,
        autoplay: {
            delay: 0,
            pauseOnMouseEnter: true,
            disableOnInteraction: false,
            reverseDirection: true,
        },
    });
}

function remToPx(rem) {
    return (
        rem * parseFloat(getComputedStyle(document.documentElement).fontSize)
    );
}

function sectionCourses() {
    let extraConfig = {};
    const customizedSwiper = new Swiper(".swiper__course", {
        slidesPerView: 1.2,
        spaceBetween: 18,
        pagination: {
            el: "#target .pagination__course",
            clickable: true,
        },
        loop: true,
        breakpoints: {
            640: {
                slidesPerView: 2.22,
                spaceBetween: 30,
            },
        },
        navigation: {
            nextEl: ".btn__next__course",
            prevEl: ".btn__prev__course",
        },
    });
    new HandleFetchCourse(customizedSwiper);
}

class HandleFetchCourse {
    constructor(swiper) {
        this.swiper = swiper;
        this.cateTaxonomy = null;
        this.template = document.getElementById("course__card-template");
        this.navList = document.querySelector(".tab__container .list__tab");
        this.navs = Array.from(document.querySelectorAll("#target .tab__item"));
        this.endpoint = "/wp-json/api/v1/get-course-by-category";
        this.init();
    }
    init() {
        this.navs.forEach((nav) => {
            nav.addEventListener("click", () => {
                this.navs.forEach((el) => el.classList.remove("active"));
                nav.classList.add("active");
                this.cateTaxonomy = nav.getAttribute("tax-slug");
                this.fetchData(nav);
            });
        });

        // 			document.addEventListener("click", (e) => {
        // 				if (
        // 					!this.navList.contains(e.target) &&
        // 					!this.selectBtn.contains(e.target)
        // 				) {
        // 					this.selectBtn.classList.remove("active");
        // 				}
        // 			});
    }
    async fetchData(nav) {
        try {
            this.swiper.wrapperEl.classList.add("loading");
            const response = await fetch(
                `${this.endpoint}?category=${this.cateTaxonomy}`
            );
            const data = await response.json();
            this.swiper.removeAllSlides();
            this.updateContent.bind(this)(data);
            this.swiper.update();
        } catch (error) {
            console.log(error);
        } finally {
            this.swiper.wrapperEl.classList.remove("loading");
        }
    }
    updateContent(data) {
        if (!data) {
            this.swiper.wrapperEl.innerHTML = "No data";
            return;
        }
        data.forEach(
            ({
                title,
                slug,
                thumbnail,
                excerpt,
                destine,
                discount_note,
                discount_title,
                image_thumb,
                level,
                target,
            }) => {
                const clone = this.template.content.cloneNode(true);
                const card = clone.querySelector(".course-card");
                const div = document.createElement("div");
                div.classList.add("swiper-slide");

                const cardTitle = clone.querySelector(".course-title");
                const cardDesc = clone.querySelector(".course-desc");
                const cardLink = clone.querySelector(".learn-more");

                const discountTitle = clone.querySelector(".discount-tag p");
                const discountNote = clone.querySelector(".discount-tag span");
                const targetE = clone.querySelector(
                    ".cour-info-item:nth-child(1) p span"
                );
                const destineE = clone.querySelector(
                    ".cour-info-item:nth-child(2) p span"
                );
                const levelE = clone.querySelector(
                    ".cour-info-item:nth-child(3) p span"
                );
                const imageThumb = clone.querySelector(".student-image");

                discountTitle.textContent = discount_title || "";
                discountNote.textContent = discount_note || "";
                targetE.textContent = target || "";
                destineE.textContent = destine || "";
                levelE.textContent = level || "";
                imageThumb.src =
                    image_thumb || "/wp-content/uploads/2025/07/hsk111.png";

                cardTitle.textContent = title;
                cardDesc.textContent = excerpt;
                cardLink.href = slug;
                div.appendChild(card);
                this.swiper.appendSlide(div);
            }
        );
    }
}
