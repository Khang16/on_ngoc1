export const specializedVocabulary = () => {
  class SpecializedVocabulary {
    constructor() {
      const currentUrl = window.location.href;
      const urlParams = new URLSearchParams(new URL(currentUrl).search);
      const orderby = urlParams.get("orderby");
      const order = urlParams.get("order");
      const search = urlParams.get("search");
      const category = urlParams.get("category");
      this.isMobileDevice = window.innerWidth < 640; // Kiểm tra nếu là thiết bị di động
      this.filterByTypeEl = document.querySelector(".news-event__filter-type");
      this.page = urlParams.get("page") || 1;
      this.total = 999;
      this.orderby = orderby || "date";
      this.order = order || "DESC";
      this.container = document.querySelector(".grid-items__grid:not(.grid-items__grid--loading)");
      if (!this.container) return;
      this.dropdownOrderbyFilterEl = document.querySelector(".news-event__filter-type");
      this.applyFilterBtn = document.querySelector(".news-event__filter-type-select-apply-btn");
      this.skeletonContainer = document.querySelector(".grid-items__grid--loading");
      this.searchInput = document.querySelector(".grid-items__search-container input");
      this.orderbyFilters = document.querySelectorAll("input[name='orderby']");
      this.categoryFilterItems = document.querySelectorAll(".grid-items__tags input[type='checkbox']");
      this.paginationWrapper = document.querySelector(".pagination");
      this.pagination = document.querySelector(".pagination__list");
      this.paginationPrev = document.querySelector(".pagination__nav--prev");
      this.paginationNext = document.querySelector(".pagination__nav--next");
      this.mainContainer = document.querySelector(".grid-items");
      this.postCount = document.querySelector(".news-grid__filter-categories-count b");
      this.limit = this.container.getAttribute("limit") || 9;
      this.templateItem = document.getElementById("video-card-template")?.content;
      this.categoryFilterFixedContainerMobileEl = document.querySelector(".category-search-fixed");
      this.categoryParentSlug = this.mainContainer.dataset.category;
      this.endpoint = `/wp-json/custom/v1/extends/${this.categoryParentSlug}`;
      console.log("SpecializedVocabulary initialized with endpoint:", this.endpoint); // Debug

      // Lấy URL hiện tại

      this.apiParams = {
        page: this.page,
        limit: 9,
        order: this.orderby + "-" + this.order,
        search: search,
        category: category,
      };

      this.events();
    }

    events() {
      this.toggleDropdown();
      this.categoryFilterEvent();
      this.toggleCategoryFilterMobileEvent();
      this.applyCategoryFilterMobileEvent();
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
    toggleCategoryFilterMobileEvent() {
      if (!this.container || !this.categoryFilterFixedContainerMobileEl) return;
      // Observer để theo dõi element có đang hiển thị trên màn hình không
      const observer = new IntersectionObserver(
        (entries) => {
          entries.forEach((entry) => {
            if (!entry.isIntersecting) {
              this.categoryFilterFixedContainerMobileEl.classList.remove("active");
            } else {
              this.categoryFilterFixedContainerMobileEl.classList.add("active");
            }
          });
        },
        {
          threshold: 0.1,
        }
      );

      observer.observe(this.container);
    }
    categoryFilterEvent() {
      if (!this.categoryFilterItems) return;
      this.categoryFilterItems.forEach((element) => {
        element.addEventListener("change", () => {
          const selectedCategories = Array.from(this.categoryFilterItems)
            .filter((item) => item.checked)
            .map((item) => item.value);
          // Gán chuỗi slug phân cách bằng dấu phẩy
          this.apiParams.category = selectedCategories?.join(",");
          if (this.isMobileDevice) return;
          this.page = 1;
          this.updateURL();
          this.request();
        });
      });
    }
    applyCategoryFilterMobileEvent() {
      const applyButtonEl = document.querySelector(".category-filter__btn-apply");
      if (!applyButtonEl) return;
      applyButtonEl.addEventListener("click", () => {
        this.page = 1;
        this.updateURL();
        this.request();
      });
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
        let tax = "";
        this.apiParams.page = this.page;
        this.apiParams.limit = this.limit;

        const excludeParams = ["orderby", "order", "s", "search", "category"];
        const excludeParamsForTax = ["page", "limit", "s", "search"];

        Object.keys(this.apiParams).forEach((key) => {
          if (this.apiParams[key] !== undefined && this.apiParams[key] !== "") {
            if (!excludeParams.includes(key)) {
              url += `${key}=${this.apiParams[key]}&`;
            }
          }
        });
        if (this.apiParams["search"]) {
          url += `s=${this.apiParams["search"]}&`;
        }
        if (this.apiParams["category"]) {
          url += `category=${this.apiParams["category"]}&`;
        }

        if (this.apiParams["order"]) {
          const str = this.apiParams["order"];
          const arr = str.split("-");
          const orderby = arr[0] || "date";
          const order = arr[1];
          url += `orderby=${orderby}&order=${order}&`;
        }
        url += ``;

        if (this.prevUrl && this.prevUrl === url) return;
        this.prevUrl = url;
        console.log(url);
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
      if (data?.length === 0) {
        const noResults = document.createElement('div')
        noResults.className = 'search-no-results'
        noResults.innerHTML = `
          <img src="/wp-content/uploads/2025/08/frame_2147260414.webp" alt="">
            <img src="/wp-content/uploads/2025/08/vuesax_twotone_search_normal.webp" alt="">
            <p>
                Không tìm thấy kết quả
            </p>
        `
        this.container.appendChild(noResults)
        return;
      }
      data.forEach(({ link, title, thumbnail, categoryParent, categoryChild, excerpt, date }) => {
        const template = this.templateItem.cloneNode(true);
        const titleEl = template.querySelector(".video-card__title");
        const thumbnailEl = template.querySelector(".video-card__thumb img");
        const excerptEl = template.querySelector(".video-card__desc");
        const dateEl = template.querySelector(".video-card__date-text");
        const badgeEl = template.querySelector(".video-card__badge");
        const videoLabelEl = template.querySelector(".video-card__label");
        const linkEl = template.querySelector(".video-card");
        if (titleEl) {
          titleEl.innerHTML = title;
        }
        if (linkEl) {
          linkEl.href = link;
        }
        if (thumbnailEl && thumbnail) {
          thumbnailEl.src = thumbnail;
          thumbnailEl.alt = title;
        }
        if (badgeEl) {
          badgeEl.textContent = categoryChild ? categoryChild.name : categoryParent.name;
        }
        if (videoLabelEl) {
          videoLabelEl.textContent = categoryParent.name;
        }
        if (excerptEl) {
          excerptEl.textContent = excerpt;
        }
        if (dateEl) {
          const textNode = document.createTextNode(date);
          dateEl.appendChild(textNode);
        }
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
          <button ${i === "…" ? "style='pointer-events: none;'" : ""} data-page="${i}" class="pagination__item ${
            current === i ? "active" : ""
          }">
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
      const excludeParams = ["product-types", "limit", "orderby", "order"];
      Object.keys(this.apiParams).forEach((key) => {
        if (this.apiParams[key] !== undefined && this.apiParams[key] !== "" && !excludeParams.includes(key)) {
          currentURL.searchParams.set(key, this.apiParams[key]);
        } else {
          currentURL.searchParams.delete(key);
        }
      });

      if (this.apiParams["category"]) {
        currentURL.searchParams.set("category", this.apiParams["category"]);
      } else {
        currentURL.searchParams.delete("category");
      }

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
  new SpecializedVocabulary();
};
