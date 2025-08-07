export const roadmap = () => {
    new SmoothAccordion();
    new SmoothTabs();

    // Add some entrance animations
    gsap.from(".accordion-item", {
        y: 50,
        opacity: 0,
        duration: 0.8,
        stagger: 0.1,
        ease: "power2.out",
        delay: 0.2,
    });

    const tabButtons = document.querySelectorAll(".tab-btn");
};

class SmoothAccordion {
    constructor() {
        this.accordionItems = document.querySelectorAll(".accordion-item");
        this.init();
    }

    init() {
        // Set initial state - all items closed
        this.accordionItems.forEach((item) => {
            const content = item.querySelector(".accordion-content");
            gsap.set(content, { height: 0 });
        });

        // Add click event listeners
        this.accordionItems.forEach((item) => {
            const header = item.querySelector(".accordion-header");
            header.addEventListener("click", () => this.toggleItem(item));
        });
    }

    toggleItem(clickedItem) {
        const header = clickedItem.querySelector(".accordion-header");
        const content = clickedItem.querySelector(".accordion-content");
        const isActive = header.classList.contains("active");

        if (isActive) {
            // Close the clicked item
            this.closeItem(clickedItem);
        } else {
            // Close all other items first
            this.accordionItems.forEach((item) => {
                if (item !== clickedItem) {
                    this.closeItem(item);
                }
            });

            // Open the clicked item
            this.openItem(clickedItem);
        }
    }

    openItem(item) {
        const header = item.querySelector(".accordion-header");
        const content = item.querySelector(".accordion-content");
        const contentInner = content.querySelector(".accordion-content-inner");

        item.classList.add("active");
        header.classList.add("active");

        // Animate the opening
        gsap.to(content, {
            height: "auto",
            duration: 0.6,
            ease: "power2.out",
        });

        // Fade in the content
        gsap.fromTo(
            contentInner,
            { opacity: 0, y: -20 },
            {
                opacity: 1,
                y: 0,
                duration: 0.4,
                delay: 0.2,
                ease: "power2.out",
            }
        );
    }

    closeItem(item) {
        const header = item.querySelector(".accordion-header");
        const content = item.querySelector(".accordion-content");
        const contentInner = content.querySelector(".accordion-content-inner");

        item.classList.remove("active");
        header.classList.remove("active");

        // Fade out the content first
        gsap.to(contentInner, {
            opacity: 0,
            y: -10,
            duration: 0.2,
            ease: "power2.in",
        });

        // Then animate the closing
        gsap.to(content, {
            height: 0,
            duration: 0.5,
            delay: 0.1,
            ease: "power2.in",
        });
    }
}

class SmoothTabs {
    constructor() {
        this.tabButtons = document.querySelectorAll(".tab-btn");
        this.tabContents = document.querySelectorAll(".tab-content");
        this.tabIndicator = document.querySelector(".tab-indicator");
        this.currentTab = 0;

        this.init();
    }

    init() {
        // Set initial state
        this.updateIndicatorPosition(0);
        this.animateContentIn(0);

        // Add event listeners
        this.tabButtons.forEach((btn, index) => {
            btn.addEventListener("click", () => this.switchTab(index));
        });

        // Add keyboard navigation
        document.addEventListener("keydown", (e) => {
            if (e.key === "ArrowLeft" || e.key === "ArrowRight") {
                e.preventDefault();
                const direction = e.key === "ArrowLeft" ? -1 : 1;
                const newIndex =
                    (this.currentTab + direction + this.tabButtons.length) %
                    this.tabButtons.length;
                this.switchTab(newIndex);
            }
        });
    }

    switchTab(index) {
        if (index === this.currentTab) return;

        const oldIndex = this.currentTab;
        this.currentTab = index;

        // Update button states
        this.tabButtons[oldIndex].classList.remove("active");
        this.tabButtons[index].classList.add("active");

        // Animate indicator
        this.updateIndicatorPosition(index);

        // Animate content transition
        this.animateContentTransition(oldIndex, index);
    }

    updateIndicatorPosition(index) {
        const button = this.tabButtons[index];
        const buttonRect = button.getBoundingClientRect();
        const containerRect = button.parentElement.getBoundingClientRect();

        const leftPosition = button.offsetLeft;

        gsap.to(this.tabIndicator, {
            x: leftPosition,
            duration: 0.4,
            ease: "power3.out",
        });
    }

    animateContentTransition(oldIndex, newIndex) {
        const oldContent = this.tabContents[oldIndex];
        const newContent = this.tabContents[newIndex];

        // Create timeline for smooth transition
        const tl = gsap.timeline();

        // Animate out old content
        tl.to(oldContent.querySelectorAll("li"), {
            opacity: 0,
            x: -30,
            duration: 0.3,
            stagger: 0.05,
            ease: "power2.in",
        })
            .to(
                oldContent,
                {
                    opacity: 0,
                    y: -20,
                    duration: 0.3,
                    ease: "power2.in",
                    onComplete: () => {
                        oldContent.classList.remove("active");
                        newContent.classList.add("active");
                    },
                },
                "-=0.1"
            )

            // Animate in new content
            .fromTo(
                newContent,
                {
                    opacity: 0,
                    y: 20,
                },
                {
                    opacity: 1,
                    y: 0,
                    duration: 0.4,
                    ease: "power2.out",
                }
            )
            .fromTo(
                newContent.querySelectorAll("li"),
                {
                    opacity: 0,
                    x: 30,
                },
                {
                    opacity: 1,
                    x: 0,
                    duration: 0.4,
                    stagger: 0.08,
                    ease: "power2.out",
                },
                "-=0.2"
            );
    }

    animateContentIn(index) {
        const content = this.tabContents[index];
        const items = content.querySelectorAll("li");

        gsap.set(items, { opacity: 0, x: -20 });

        gsap.to(items, {
            opacity: 1,
            x: 0,
            duration: 0.4,
            stagger: 0.1,
            ease: "power2.out",
            delay: 0.3,
        });
    }
}
