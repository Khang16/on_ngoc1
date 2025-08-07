export const demand = () => {
    const tabs = document.querySelectorAll(".demand__tab__item");
    const cards = document.querySelectorAll(".demand__card");
    tabs.forEach((tab, index) => {
        tab.addEventListener("click", () => {
            tabs.forEach((tab) => tab.classList.remove("active"));
            tab.classList.add("active");
            cards.forEach((card) => card.classList.remove("active"));
            cards[index].classList.add("active");
        });
    });
    const indicator = document.querySelector(".demand__tab__indicator");
    tabs.forEach((tab, index) => {
        tab.addEventListener("click", () => {
            indicator.style.left = `${index * 6.25 + 0.25}rem`;
        });
    });

    const onlineForm = document.getElementById("online-form");
    const offlineForm = document.getElementById("offline-form");

    // Add phone input validation on change
    const phoneInputs = document.querySelectorAll('input[name="phone"]');
    phoneInputs.forEach((input) => {
        input.addEventListener("input", handlePhoneInput);
        input.addEventListener("blur", handlePhoneBlur);
    });

    onlineForm.addEventListener("submit", (e) => {
        e.preventDefault();
        sendForm(e.target);
    });
    offlineForm.addEventListener("submit", (e) => {
        e.preventDefault();
        sendForm(e.target);
    });
};

async function sendForm(form) {
    const demandForm = document.getElementById("demand-form");
    const submitButton = form.querySelector('button[type="submit"]');
    const originalButtonText = submitButton.innerHTML;

    // Prevent spam submit by disabling button
    if (submitButton.disabled) {
        return;
    }

    // Show loading state
    setLoadingState(submitButton, true);

    const phone = form.phone.value.trim();

    // Validate phone number is required
    if (!phone) {
        showError(form.phone, "Số điện thoại là bắt buộc");
        setLoadingState(submitButton, false, originalButtonText);
        return;
    }

    // Validate Vietnamese phone number format
    if (!isValidVietnamesePhone(phone)) {
        showError(form.phone, "Số điện thoại không đúng định dạng Việt Nam");
        setLoadingState(submitButton, false, originalButtonText);
        return;
    }

    // Clear any previous errors
    clearError(form.phone);

    const formData = new FormData(demandForm);
    formData.append("phone", form.phone.value);
    formData.append("course", form.course.value);
    formData.append("type", form.type.value);
    formData.append("link", form.link.value);
    const data = Object.fromEntries(formData);
    const response = new CF7Request(data);

    try {
        const res = await response.send({
            id: 2335,
            unitTag: "3dab448",
        });
        if (res.status === "mail_sent") {
            showSuccess(form.phone, "Đã gửi thành công");
            // Reset form after success
            form.reset();
        } else {
            showError(form.phone, "Gửi thất bại");
        }
    } catch (error) {
        console.log(error);
        showError(form.phone, "Có lỗi xảy ra, vui lòng thử lại");
    } finally {
        // Reset loading state
        setLoadingState(submitButton, false, originalButtonText);
    }
}

// Set loading state for submit button
function setLoadingState(button, isLoading, originalText = null) {
    if (isLoading) {
        button.disabled = true;
        button.innerHTML = `
            <span>Đang gửi...</span>
            <div class="demand__form__btn__icon">
                <div class="loading-spinner"></div>
                <svg xmlns="http://www.w3.org/2000/svg" width="43" height="44" viewBox="0 0 43 44" fill="none" style="display: none;">
                    <path d="M19.457 17.6582L23.8847 22.1356L19.457 26.5135" stroke="white" stroke-width="1.5" stroke-linecap="round" />
                </svg>
            </div>
        `;
    } else {
        button.disabled = false;
        if (originalText) {
            button.innerHTML = originalText;
        }
    }
}

// Validate Vietnamese phone number
function isValidVietnamesePhone(phone) {
    // Remove all non-digit characters
    const cleanPhone = phone.replace(/\D/g, "");

    // Vietnamese phone number patterns:
    // - 03x, 05x, 07x, 08x, 09x (mobile)
    // - 02x (landline)
    // - 84 + 9 digits (international format)
    const patterns = [
        /^(03|05|07|08|09)\d{8}$/, // Mobile numbers
        /^02\d{8,9}$/, // Landline numbers
        /^84[35789]\d{8}$/, // International format
    ];

    return patterns.some((pattern) => pattern.test(cleanPhone));
}

// Show error message
function showError(input, message) {
    // Remove existing error and success messages
    clearMessages(input);

    // Add error class
    input.classList.add("error");

    // Create error message element
    const errorDiv = document.createElement("div");
    errorDiv.className = "error-message";
    errorDiv.textContent = message;
    errorDiv.style.color = "#ff4444";
    errorDiv.style.fontSize = "0.875rem";
    errorDiv.style.marginTop = "-0.75rem";
    errorDiv.style.marginBottom = "0.5rem";
    errorDiv.style.paddingLeft = "1.06rem";

    // Insert after the form element (outside form)
    const form = input.closest("form");
    form.parentNode.insertBefore(errorDiv, form.nextSibling);
}

// Show success message
function showSuccess(input, message) {
    // Remove existing error and success messages
    clearMessages(input);

    // Add success class
    input.classList.add("success");

    // Create success message element
    const successDiv = document.createElement("div");
    successDiv.className = "success-message";
    successDiv.textContent = message;
    successDiv.style.color = "#007bff";
    successDiv.style.fontSize = "0.875rem";
    successDiv.style.marginTop = "-0.75rem";
    successDiv.style.marginBottom = "0.5rem";
    successDiv.style.paddingLeft = "1.06rem";

    // Insert after the form element (outside form)
    const form = input.closest("form");
    form.parentNode.insertBefore(successDiv, form.nextSibling);
}

// Clear all messages (error and success)
function clearMessages(input) {
    input.classList.remove("error", "success");

    // Remove all existing error and success messages from the form's parent
    const form = input.closest("form");
    const formParent = form.parentNode;
    const existingMessages = formParent.querySelectorAll(
        ".error-message, .success-message"
    );
    existingMessages.forEach((message) => message.remove());
}

// Clear error message (keep for backward compatibility)
function clearError(input) {
    clearMessages(input);
}

// Handle phone input changes
function handlePhoneInput(e) {
    const input = e.target;
    const phone = input.value.trim();

    // Clear error if input is empty (allow user to type)
    if (!phone) {
        clearError(input);
        return;
    }

    // Validate on input change
    if (isValidVietnamesePhone(phone)) {
        // Clear messages and remove error class when valid
        clearMessages(input);
    } else {
        showError(input, "Số điện thoại không đúng định dạng");
    }
}

// Handle phone input blur (when user leaves the field)
function handlePhoneBlur(e) {
    const input = e.target;
    const phone = input.value.trim();

    if (!phone) {
        showError(input, "Số điện thoại là bắt buộc");
    }
}
