export const footerForm = () => {
    function submitFormContact() {
        const submitInputCF7 = document.querySelector(
            ".wpcf7-form-control.wpcf7-submit.has-spinner"
        );
        const customSubmit = document.querySelector(".custom__submit");
        const contactForm = document.querySelector(".wpcf7-form");

        if (customSubmit && submitInputCF7 && contactForm) {
            const handleFormEvent = () => {
                customSubmit.classList.remove("loading");
                customSubmit.style.pointerEvents = "auto";
            };

            customSubmit.addEventListener("click", (event) => {
                event.preventDefault();
                submitInputCF7.click();
                customSubmit.classList.add("loading");
                customSubmit.style.pointerEvents = "none";
            });

            contactForm.addEventListener(
                "wpcf7mailsent",
                handleFormEvent,
                false
            );
            contactForm.addEventListener(
                "wpcf7mailfailed",
                handleFormEvent,
                false
            );
            contactForm.addEventListener(
                "wpcf7invalid",
                handleFormEvent,
                false
            );
            contactForm.addEventListener("wpcf7reset", handleFormEvent, false);
        }
    }

    submitFormContact();

    class CustomSelectBox {
        constructor(element) {
            this.element = element;
            this.selectButton = element.querySelector("#selectButton");
            this.selectDropdown = element.querySelector("#selectDropdown");
            this.selectText = element.querySelector(".select-text");
            this.selectedValue = null;
            this.selectedTitle = null;

            this.init();
        }

        init() {
            this.bindEvents();
            // Lấy option được đánh dấu là 'selected' trong HTML ban đầu
            let initialSelectedOption = this.selectDropdown.querySelector(
                ".select-option.selected"
            );

            // Nếu không có option nào được đánh dấu là 'selected', chọn option đầu tiên
            if (!initialSelectedOption) {
                initialSelectedOption =
                    this.selectDropdown.querySelector(".select-option");
            }

            // Nếu có option đầu tiên (hoặc option được chọn ban đầu), hãy chọn nó
            if (initialSelectedOption) {
                this.selectOption(initialSelectedOption);
            }
        }

        bindEvents() {
            this.selectButton.addEventListener("click", (e) => {
                e.preventDefault();
                this.toggleDropdown();
            });

            this.selectDropdown.addEventListener("click", (e) => {
                const option = e.target.closest(".select-option");
                if (option) {
                    e.preventDefault();
                    this.selectOption(option);
                }
            });

            document.addEventListener("click", (e) => {
                if (!this.element.contains(e.target)) {
                    this.closeDropdown();
                }
            });
        }

        toggleDropdown() {
            const isOpen = this.selectDropdown.classList.contains("show");
            if (isOpen) {
                this.closeDropdown();
            } else {
                this.openDropdown();
            }
        }

        openDropdown() {
            document
                .querySelectorAll(".custom-select .select-dropdown.show")
                .forEach((dropdown) => {
                    dropdown.classList.remove("show");
                    dropdown.previousElementSibling.classList.remove("active");
                });

            this.selectDropdown.classList.add("show");
            this.selectButton.classList.add("active");
        }

        closeDropdown() {
            this.selectDropdown.classList.remove("show");
            this.selectButton.classList.remove("active");
        }

        selectOption(option) {
            this.selectDropdown
                .querySelectorAll(".select-option")
                .forEach((opt) => {
                    opt.classList.remove("selected");
                });

            option.classList.add("selected");

            this.selectedValue = option.dataset.value;
            this.selectedTitle = option.dataset.title;

            this.selectText.textContent = this.selectedTitle;
            this.selectText.classList.remove("select-placeholder");

            this.closeDropdown();

            const event = new CustomEvent("selectionChanged", {
                detail: {
                    id: this.selectedValue,
                    title: this.selectedTitle,
                },
            });
            this.element.dispatchEvent(event);

            const cf7CourseSelect = document.querySelector(
                'input[name="your-course"]'
            );

            console.log(this.selectedTitle);
            if (cf7CourseSelect) {
                cf7CourseSelect.value = this.selectedTitle;

                const changeEvent = new Event("change", {
                    bubbles: true,
                });
                cf7CourseSelect.dispatchEvent(changeEvent);
            }
        }

        getSelectedValue() {
            return {
                id: this.selectedValue,
                title: this.selectedTitle,
            };
        }
    }

    const customSelectTemplate = document.getElementById(
        "customSelectTemplate"
    );
    const inpService = document.querySelector(".inp__service");

    if (
        customSelectTemplate &&
        inpService &&
        typeof courseData !== "undefined"
    ) {
        const customSelectClone = customSelectTemplate.content.cloneNode(true);
        const selectDropdown =
            customSelectClone.querySelector("#selectDropdown");

        if (selectDropdown && courseData.length > 0) {
            courseData.forEach((item) => {
                const optionDiv = document.createElement("div");
                optionDiv.classList.add("select-option");
                optionDiv.dataset.value = item.ID;
                optionDiv.dataset.title = item.post_title;

                const titleDiv = document.createElement("div");
                titleDiv.classList.add("option-title");
                titleDiv.textContent = item.post_title;

                optionDiv.appendChild(titleDiv);
                selectDropdown.appendChild(optionDiv);
            });
        }

        inpService.insertAdjacentElement(
            "beforeend",
            customSelectClone.firstElementChild
        );

        const selectElement = document.getElementById("courseSelect");
        if (selectElement) {
            new CustomSelectBox(selectElement);
        }
    }
};
