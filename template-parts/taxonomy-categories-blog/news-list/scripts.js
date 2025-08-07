export const newsList = () => {
  class News {
    constructor() {
      const currentUrl = window.location.href;
      const urlParams = new URLSearchParams(new URL(currentUrl).search);
      const orderby = urlParams.get("orderby");
      const order = urlParams.get("order");
      const search = urlParams.get("search");
      this.isMobileDevice = window.innerWidth < 640; // Kiểm tra nếu là thiết bị di động
      this.filterByTypeEl = document.querySelector(".news-event__filter-type");
      this.page = urlParams.get("page") || 1;
      this.total = 999;
      this.orderby = orderby || "date";
      this.order = order || "DESC";
      this.container = document.querySelector(".news-event__list:not(.news-event__list--loading)");
      if (!this.container) return;
	    this.categorySlug = document.getElementById("news-list-container").dataset.categorySlug;
      console.log("categorySlug", this.categorySlug);
      this.endpoint = `/wp-json/api/v1/news/${this.categorySlug}`;
      this.dropdownOrderbyFilterEl = document.querySelector(".news-event__filter-type");
      this.applyFilterBtn = document.querySelector(".news-event__filter-type-select-apply-btn");
      this.skeletonContainer = document.querySelector(".news-event__list--loading");
      this.searchInput = document.querySelector(".news-event__filter-search input");
      this.orderbyFilters = document.querySelectorAll("input[name='orderby']");
      this.paginationWrapper = document.querySelector(".pagination");
      this.pagination = document.querySelector(".pagination__list");
      this.paginationPrev = document.querySelector(".pagination__nav--prev");
      this.paginationNext = document.querySelector(".pagination__nav--next");
      this.mainContainer = document.querySelector(".news-event");
      this.postCount = document.querySelector(".news-grid__filter-categories-count b");
      this.limit = this.container.getAttribute("limit") || 9;
      this.templateItem = document.getElementById("news-event-item-template")?.content;
      // Lấy URL hiện tại

      this.apiParams = {
        page: this.page,
        limit: this.limit,
        order: this.orderby + "-" + this.order,
        search: search,
      };

      this.events();
    }

    events() {
      this.toggleDropdown();
      this.sortEvent();
      this.paginationEvent();
      this.paginationPrevEvent();
      this.paginationNextEvent();
      this.searchEvent();
    }
    toggleDropdown() {
      if (this.filterByTypeEl) {
        // Toggle khi click vào chính nó
        this.filterByTypeEl.addEventListener("click", (e) => {
          if (this.isMobileDevice) return;
          this.filterByTypeEl.classList.toggle("active");
        });
        // Click outside => đóng
        document.addEventListener("click", (e) => {
          if (!this.filterByTypeEl.contains(e.target)) {
            this.filterByTypeEl.classList.remove("active");
          }
        });
      }
    }
    searchEvent() {
      if (!this.searchInput) return;
      this.searchInput.addEventListener(
        "input",
        this.debounce((e) => {
          this.apiParams.search = e.target.value;
          this.page = 1;
          this.updateURL();
          this.request();
        }, 300)
      );
    }

    debounce(func, wait) {
      let timeout;
      return function (...args) {
        clearTimeout(timeout);
        timeout = setTimeout(() => func.apply(this, args), wait);
      };
    }

    sortEvent() {
      if (!this.orderbyFilters) return;
      this.orderbyFilters.forEach((element) => {
        element.addEventListener("change", (e) => {
          this.apiParams.order = e.detail?.value || e.target.value;
          if (this.isMobileDevice) return;
          const currentSelectedOptionEl = document.querySelector(".news-event__filter-type-value");
          const nextSelectedOptionEl = element.parentElement.querySelector(".news-event__filter-type-select-value");
          if (currentSelectedOptionEl && nextSelectedOptionEl) {
            currentSelectedOptionEl.textContent = nextSelectedOptionEl.textContent;
          }
          if (this.dropdownOrderbyFilterEl) {
            this.dropdownOrderbyFilterEl.classList.remove("active");
          }
          this.page = 1; // Reset to first page on sort change
          this.updateURL();
          this.request();
        });
      });
      if (!this.applyFilterBtn) return;
      this.applyFilterBtn.addEventListener("click", () => {
        if (!this.isMobileDevice) return;
        this.page = 1; // Reset to first page on sort change
        this.updateURL();
        this.request();
      });
    }

    paginationPrevEvent() {
      if (!this.paginationPrev) return;
      this.paginationPrev.addEventListener("click", (e) => {
        e.preventDefault();
        if (parseInt(this.page) <= 1) return;
        this.page = parseInt(this.page) - 1;
        this.updateURL();
        this.request();
      });
    }
    paginationNextEvent() {
      if (!this.paginationNext) return;
      this.paginationNext.addEventListener("click", (e) => {
        e.preventDefault();
        if (parseInt(this.page) >= this.total) return;
        this.page = parseInt(this.page) + 1;
        this.updateURL();
        this.request();
      });
    }
    paginationEvent() {
      if (!this.pagination) return;
      const paginationItems = this.pagination.querySelectorAll(".pagination__item");
      if (!paginationItems) return;

      paginationItems.forEach((element) => {
        element.addEventListener("click", (e) => {
          e.preventDefault();
          this.page = e.target.dataset.page;
          this.updateURL();
          this.request();
        });
      });
    }

    async request(isLoadMore = false) {
      try {
        this.skeletonContainer.classList.add("is-loading");
        window.scrollTo({
          top: this.mainContainer.offsetTop - 150,
          behavior: "smooth",
        });
        let url = `${this.endpoint}?`;
        let tax = "category";
        this.apiParams.page = this.page;
        this.apiParams.limit = this.limit;

        const excludeParams = ["orderby", "order", "s", "search"];
        const excludeParamsForTax = ["page", "limit", "s", "search"];
        Object.keys(this.apiParams).forEach((key) => {
          if (this.apiParams[key] !== undefined && this.apiParams[key] !== "") {
            if (!excludeParams.includes(key)) {
              url += `${key}=${this.apiParams[key]}&`;
            }
          }
        });
        if (this.apiParams["search"]) {
          url += `search=${this.apiParams["search"]}&`;
        }

        if (this.apiParams["order"]) {
          const str = this.apiParams["order"];
          const arr = str.split("-");
          const orderby = arr[0] || "date";
          const order = arr[1];
          url += `orderby=${orderby}&order=${order}&`;
        }
        url += `category=${this.categorySlug}`;

        if (this.prevUrl && this.prevUrl === url) return;
        this.prevUrl = url;
        const response = await fetch(url);
        const { data, page, totalPages, total } = await response.json();
        this.total = totalPages;
        this.page = page;
        this.popupSort?.close();
        this.popupCategories?.close();
        if (this.postCount) {
          this.postCount.textContent = total;
        }
        isLoadMore ? this.template(data, true) : this.template(data, false);
        if (this.pagination) this.pagination.innerHTML = this.createPagination();
        this.paginationEvent();
      } catch (e) {
        console.error(e);
      } finally {
        this.skeletonContainer.classList.remove("is-loading");
      }
    }

    template(data, isLoadMore = false) {
      if (!isLoadMore) {
        this.container.innerHTML = "";
      }
      if (data.length === 0) {
        const noNews = document.createElement("div");
        noNews.classList.add("no_news");
        noNews.textContent = "Không tìm thấy bài viết phù hợp.";
        this.container.appendChild(noNews);
        return;
      }
      data.forEach(({ link, title, thumbnail, category, excerpt, date }) => {
        const template = this.templateItem.cloneNode(true);
        const linkEl = template.querySelector(".news-event__item-link");
        const titleEl = template.querySelector(".news-event__item-title");
        const thumbnailEl = template.querySelector(".news-event__item-thumbnail img");
        const excerptEl = template.querySelector(".news-event__item-excerpt");
        const dateEl = template.querySelector(".news-event__item-date-text");
		const categoryEl = template.querySelector(".news-event__item-category");

        linkEl.href = link;
        titleEl.innerHTML = title;
		if (categoryEl) {
			if (category) {
				categoryEl.innerText = category;
			} else {
				categoryEl.remove();
			}
		}
        if (thumbnail) {
          thumbnailEl.src = thumbnail;
          thumbnailEl.alt = title;
        }

        excerptEl.textContent = excerpt;

        const textNode = document.createTextNode(date);
        dateEl.appendChild(textNode);

        this.container.appendChild(template);
      });
    }

    createPagination() {
      if (this.total <= 1) {
        this.paginationWrapper.style.display = "none";
        return "";
      }
      const { current, items } = this.paginate({
        current: this.page,
        max: this.total,
      });
      this.paginationWrapper.style.display = null;
      return items
        .map(
          (i) => `
                        <button ${
                          i === "…" ? "style='pointer-events: none;'" : ""
                        } data-page="${i}" class="pagination__item ${current === i ? "active" : ""}">
                        ${i}
                        </button>
                   `
        )
        .join("");
    }

    paginate({ current, max }) {
      const items = [1];
      if (current > 3) items.push("…");

      const range = 2;
      const start = Math.max(2, current - range);
      const end = Math.min(max - 1, current + range);

      for (let i = start; i <= end; i++) {
        items.push(i);
      }

      if (end < max - 1) items.push("…");
      if (max > 1) items.push(max);

      return { current, items };
    }

    updateCategoryInURL(newCategory) {
      const currentURL = new URL(window.location);
      currentURL.searchParams.set("category", newCategory);
      window.history.replaceState({}, "", currentURL);
    }

    updateURL() {
      const currentURL = new URL(window.location);
      const excludeParams = ["product-types", "limit", " orderby", "order"];
      Object.keys(this.apiParams).forEach((key) => {
        if (this.apiParams[key] !== undefined && this.apiParams[key] !== "" && !excludeParams.includes(key)) {
          currentURL.searchParams.set(key, this.apiParams[key]);
        } else {
          currentURL.searchParams.delete(key);
        }
      });

      if (this.apiParams["order"]) {
        const str = this.apiParams["order"];
        const arr = str.split("-");
        const orderby = arr[0] || "date";
        const order = arr[1];
        currentURL.searchParams.set("order", order);
        currentURL.searchParams.set("orderby", orderby);
      } else {
        currentURL.searchParams.delete("order");
        currentURL.searchParams.delete("orderby");
      }
      if (this.apiParams["search"]) {
        currentURL.searchParams.set("search", this.apiParams["search"]);
      } else {
        currentURL.searchParams.delete("search");
      }
      if (this.page != 1) {
        currentURL.searchParams.set("page", this.page);
      } else {
        currentURL.searchParams.delete("page");
      }
      window.history.replaceState({}, "", currentURL);
    }
  }
  new News();
};
