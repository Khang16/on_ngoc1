export default function faqs() {
    const faqItems = document.querySelectorAll(".faq-item");

    faqItems.forEach((item) => {
        const question = item.querySelector(".faq-question");
        const answer = item.querySelector(".faq-answer");
        const answerContent = item.querySelector(".faq-answer-content");
        const icon = item.querySelector(".faq-icon");

        // Khởi tạo trạng thái maxHeight đúng khi load trang
        if (item.classList.contains("expanded")) {
            answer.style.maxHeight = answerContent.scrollHeight + "px";
            icon.classList.add("icon-minus");
            icon.classList.remove("icon-plus");
        } else {
            answer.style.maxHeight = "0";
            icon.classList.add("icon-plus");
            icon.classList.remove("icon-minus");
        }

        question.addEventListener("click", function () {
            const isExpanded = item.classList.contains("expanded");
            // Đóng tất cả item khác
            faqItems.forEach((otherItem) => {
                if (otherItem !== item) {
                    otherItem.classList.remove("expanded");
                    otherItem
                        .querySelector(".faq-icon")
                        .classList.add("icon-plus");
                    otherItem
                        .querySelector(".faq-icon")
                        .classList.remove("icon-minus");
                    otherItem.querySelector(".faq-answer").style.maxHeight =
                        "0";
                }
            });
            if (isExpanded) {
                item.classList.remove("expanded");
                icon.classList.add("icon-plus");
                icon.classList.remove("icon-minus");
                answer.style.maxHeight = "0";
            } else {
                item.classList.add("expanded");
                icon.classList.add("icon-minus");
                icon.classList.remove("icon-plus");
                // Đặt max-height đúng bằng chiều cao thực tế của content
                answer.style.maxHeight = answerContent.scrollHeight + "px";
            }
        });
    });
}
