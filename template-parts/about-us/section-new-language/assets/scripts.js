document.addEventListener("DOMContentLoaded", function () {
  const newLanguageSection = document.querySelector(".new-language-section");

  if (!newLanguageSection) return;

  initializeAnimations();

  initializeCounterAnimations();

  function initializeAnimations() {
    const observer = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            entry.target.classList.add("animate-in");
          }
        });
      },
      {
        threshold: 0.1,
        rootMargin: "0px 0px -50px 0px",
      }
    );

    observer.observe(newLanguageSection);
  }

  function initializeCounterAnimations() {
    const statNumbers = document.querySelectorAll(".stat-number");

    const countObserver = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            animateCounter(entry.target);
            countObserver.unobserve(entry.target);
          }
        });
      },
      {
        threshold: 0.5,
      }
    );

    statNumbers.forEach((stat) => {
      countObserver.observe(stat);
    });
  }

  function animateCounter(element) {
    const numberElement = element.childNodes[0];
    if (!numberElement || !numberElement.textContent) return;

    const finalNumber = parseInt(numberElement.textContent.replace(/\D/g, ""));
    if (isNaN(finalNumber)) return;

    const duration = 2000; 
    const increment = finalNumber / (duration / 16); 
    let current = 0;

    const timer = setInterval(() => {
      current += increment;
      if (current >= finalNumber) {
        current = finalNumber;
        clearInterval(timer);
      }

      let displayNumber = Math.floor(current);

      numberElement.textContent = displayNumber;
    }, 16);
  }

});
