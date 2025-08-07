class HandleHeaderToggleOnScroll {
    constructor() {
        this.header = document.querySelector(".header");
        this.lastScrollTop = 0;
    }

    init() {
        this.handleScroll();
        this.setInitState();
    }
    setInitState() {
        const scrollTop =
            window.pageYOffset || document.documentElement.scrollTop;
        if (scrollTop <= 0) {
            this.header.classList.add("header--transparent");
        } else {
            this.header.classList.remove("header--transparent");
        }
    }
    handleScroll() {
        window.addEventListener("scroll", () => {
            const vh = Math.max(
                document.documentElement.clientHeight || 0,
                window.innerHeight || 0
            );
            const scrollTop =
                window.pageYOffset || document.documentElement.scrollTop;
            const headerHeight = this.header.offsetHeight;
            const headerTop = this.header.getBoundingClientRect().top;
            // Kiểm tra nếu header còn trong viewport => remove "header--color", ngược lại thì add

            const isSingleTour =
                document.body.classList.contains("single-tours");

            if (!isSingleTour) {
                const seventyPercentVH = vh * 0.7;
                if (scrollTop <= seventyPercentVH) {
                    this.header.classList.remove("header--color");
                } else {
                    this.header.classList.add("header--color");
                }
            } else {
                this.header.classList.add("header--color");
            }

            if (document.documentElement.scrollTop <= 0) {
                this.header.classList.add("header--transparent");
            } else {
                this.header.classList.remove("header--transparent");
            }
            // Ẩn header khi scroll xuống và đã vượt quá viewport
            if (scrollTop > this.lastScrollTop && scrollTop > vh) {
                this.header.classList.add("hide");
            } else if (
                scrollTop < this.lastScrollTop ||
                scrollTop < headerHeight
            ) {
                this.header.classList.remove("hide");
            }

            this.lastScrollTop = scrollTop;
        });
    }
}

function getClosestParent(el, selector) {
    while (el && el !== document) {
        if (el.matches(selector)) return el;
        el = el.parentElement;
    }
    return null;
}

function resetAllSubmenus() {
    // Lấy tất cả menu items có class active
    const activeMenuItems = document.querySelectorAll(
        ".header-mobile__menu-item.active, .header-mobile__submenu-item.active"
    );

    // Remove class active từ tất cả menu items
    activeMenuItems.forEach((item) => {
        item.classList.remove("active");
    });
}

const handleHeaderToggleOnScroll = new HandleHeaderToggleOnScroll();
handleHeaderToggleOnScroll.init();

const headerMbToggleChildren = document.querySelectorAll(
    ".header-mobile__menu-item--has-sub > a,.header-mobile__submenu-item--has-sub > a"
);
const headerMbPrevious = document.querySelectorAll(
    ".header-mobile__submenu-nav-prev,.header-mobile__sub-submenu-list-prev"
);
const toggleMenu = document.querySelector(".header-mobile__toggle");
const headerPopup = document.querySelector(".header-mobile__nav");

if (toggleMenu) {
    toggleMenu.addEventListener("click", (e) => {
        e.preventDefault();
        headerPopup.classList.toggle("active");
        toggleMenu.classList.toggle("active");
        if (headerPopup.classList.contains("active")) {
            document.body.style.overflow = "hidden";
        } else {
            document.body.style.overflow = null;
            // Reset tất cả submenu về trạng thái ban đầu khi đóng menu
            resetAllSubmenus();
        }
    });
}

if (headerMbToggleChildren) {
    headerMbToggleChildren.forEach((item) => {
        item.addEventListener("click", (e) => {
            e.preventDefault();
            e.stopPropagation();
            item.parentElement.classList.add("active");
        });
    });
}

if (headerMbPrevious) {
    headerMbPrevious.forEach((item) => {
        item.addEventListener("click", (e) => {
            e.preventDefault();
            e.stopPropagation();
            const parent = getClosestParent(item, ".active");
            console.log(parent);
            if (parent) {
                parent.classList.remove("active");
            }
        });
    });
}

// popup search
document.addEventListener("DOMContentLoaded", () => {
    const searchTrigger = document.querySelector("#trigger-search-header");
    const searchPopup = document.querySelector(".popup-search");
    const closeSearch = document.querySelector(".close-popup-search");

    if (searchTrigger && searchPopup && closeSearch) {
        searchTrigger.addEventListener("click", (e) => {
            e.preventDefault();
            searchPopup.classList.add("active");
            document.documentElement.style.overflow = "hidden";
        });

        closeSearch.addEventListener("click", (e) => {
            e.preventDefault();
            searchPopup.classList.remove("active");
            document.documentElement.style.overflow = null;
        });

        // Đóng popup khi click ra ngoài
        document.addEventListener("click", (e) => {
            if (
                !searchPopup.contains(e.target) &&
                !searchTrigger.contains(e.target)
            ) {
                searchPopup.classList.remove("active");
                document.documentElement.style.overflow = null;
            }
        });
    }

    class SearchHandler {
        constructor() {
            this.input = document.querySelector(".popup-search__input > input");
            this.submit = document.querySelector("#submit-search-header");
            this.init();
        }

        init() {
            if (this.input && this.submit) {
                this.input.addEventListener("input", () => {
                    this.submit.href =
                        "/?s=" + encodeURIComponent(this.input.value);
                });

                // enter key event for search input
                this.input.addEventListener("keydown", (event) => {
                    if (event.key === "Enter") {
                        event.preventDefault();
                        this.submit.click();
                    }
                });
                this.generateRecommendList();
            }

            const mostSearches = document.querySelectorAll('.recommend-list-most-searched .recommend-item')
              mostSearches.forEach((item) => {
                item.addEventListener('click', (e) => {
                  e.stopPropagation()
                  if (this.input) {
                    this.input.value = item.textContent.trim()
                    this.input.dispatchEvent(new Event('input'))
                    this.submit.click()
                  }
                })
              })
        }

        generateRecommendList() {
            const recommendListContainer = document.querySelector(
                ".recommend-list-history"
            );
            if (recommendListContainer) {
                const history =
                    JSON.parse(localStorage.getItem("search-history")) || [];
                recommendListContainer.innerHTML = history
                    .map(
                        (
                            item,
                            idx
                        ) => `<div class="recommend-item" data-index="${idx}">
      <span class="recommend-text">${item}</span>
      <svg class="recommend-remove" xmlns="http://www.w3.org/2000/svg" width="14" height="15" viewBox="0 0 14 15" fill="none">
      <path d="M3.73464 11.7819L2.91797 10.9652L6.18464 7.69857L2.91797 4.4319L3.73464 3.61523L7.0013 6.8819L10.268 3.61523L11.0846 4.4319L7.81797 7.69857L11.0846 10.9652L10.268 11.7819L7.0013 8.51523L3.73464 11.7819Z" fill="#6B7280" />
      </svg>
    </div>`
                    )
                    .join("");

                // Add event listeners for remove and select
                recommendListContainer
                    .querySelectorAll(".recommend-remove")
                    .forEach((svg, idx) => {
                        svg.addEventListener("click", (e) => {
                            e.stopPropagation();
                            const history =
                                JSON.parse(
                                    localStorage.getItem("search-history")
                                ) || [];
                            history.splice(idx, 1);
                            localStorage.setItem(
                                "search-history",
                                JSON.stringify(history)
                            );
                            this.generateRecommendList();
                        });
                    });

                recommendListContainer
                    .querySelectorAll(".recommend-text")
                    .forEach((span, idx) => {
                        span.addEventListener("click", (e) => {
                            e.stopPropagation();
                            if (this.input) {
                                this.input.value = span.textContent.trim();
                                this.input.dispatchEvent(new Event("input"));
                                this.submit.click();
                            }
                        });
                    });
            }
        }
    }
    window._SearchHandler = new SearchHandler();
});
