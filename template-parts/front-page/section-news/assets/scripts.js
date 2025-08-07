export function sectionNews() {
	class HandleFetchNews {
		constructor() {
			this.skeletonTemplate = document.getElementById("news__skeleton-template");
			this.container1 = document.querySelector('.news__container');
			this.container2 = document.querySelector('.other__news');
			this.cateTaxonomy = null;
			this.template = document.getElementById("new__card-template");
			this.template2 = document.getElementById("new__card-template2");
			this.navList = document.querySelector("#hot__news .list__tab");
			this.navs = Array.from(document.querySelectorAll("#hot__news .tab__item"));
			this.endpoint = "/wp-json/api/v1/get-news-by-category";
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
		}
		showSkeleton() {
		  this.container1.innerHTML = "";
// 		  this.container2.innerHTML = "";
		  for (let i = 0; i < 3; i++) {
			const skeleton = this.skeletonTemplate.content.cloneNode(true);
			this.container1.appendChild(skeleton);
		  }

// 		  for (let i = 0; i < 4; i++) {
// 			const skeleton = this.skeletonTemplate.content.cloneNode(true);
// 			this.container2.appendChild(skeleton);
// 		  }
		}

		async fetchData(nav) {
			try {
				this.showSkeleton();
				const response = await fetch(`${this.endpoint}?category=${this.cateTaxonomy}`);
				const data = await response.json();
				this.updateContent(data)
			} catch (error) {
				console.log(error);
			}
		}

		updateContent(data) {
			if (!data || !Array.isArray(data)) {
				this.container1.innerHTML = "No data";
// 				this.container2.innerHTML = "";
				return;
			}

			this.container1.innerHTML = "";
// 			this.container2.innerHTML = "";

			data.forEach(({ title, slug, thumbnail, date }, index) => {
				if (index < 3) {
					// Template cho 3 item đầu
					const clone = this.template.content.cloneNode(true);
					const card = clone.querySelector(".new__item");

					card.querySelector(".new__title").textContent = title;
					card.querySelector(".new__date p").textContent = date;
					card.querySelector(".new__link").href = slug;
					card.querySelector(".new__title").href = slug;
					card.querySelector(".new__thumb > a").href = slug;

					this.container1.appendChild(card);
				} 
// 				else {
// 					// Template cho các item tiếp theo
// 					const clone2 = this.template2.content.cloneNode(true);
// 					const card2 = clone2.querySelector(".other__new__item");

// 					const titleEl = card2.querySelector(".title");
// 					const titleElImage = card2.querySelector(".image__link");
// 					titleEl.textContent = title;
// 					titleEl.href = slug;
// 					titleElImage.href = slug;

// 					const div2 = document.createElement("div");
// 					div2.appendChild(card2);
// 					this.container2.appendChild(div2);
// 				}
			});
		}

	}

	const fetchnew = new HandleFetchNews();
}
