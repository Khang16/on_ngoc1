function SectionOpeningCourseSchedule() {
  const allTabWrappers = document.querySelectorAll(".tab-wrapper");
  if (allTabWrappers && allTabWrappers.length) {
    allTabWrappers.forEach((tabWrapper) => {
      const onlineTab = tabWrapper.querySelector(".tab-item--online");
      const offlineTab = tabWrapper.querySelector(".tab-item--offline");
      if (!onlineTab || !offlineTab) return;

      const parent = tabWrapper.closest(".opening-course-schedule__item");
      const onlineTable = parent.querySelector(".course-table-wrapper--online");
      const offlineTable = parent.querySelector(".course-table-wrapper--offline");
      const courseOnlineTitle = parent.querySelector('.course-title--online');
      const courseOfflineTitle = parent.querySelector('.course-title--offline');
      function handleClickTab(clickedTab) {
        if (clickedTab === "online") {
          onlineTab.classList.add("active");
          offlineTab.classList.remove("active");

          onlineTable?.classList.add("active");
          offlineTable?.classList.remove("active");
		  
		  courseOnlineTitle?.classList.add("active");
		  courseOfflineTitle?.classList.remove("active");
        } else {
          offlineTab.classList.add("active");
          onlineTab.classList.remove("active");

          offlineTable?.classList.add("active");
          onlineTable?.classList.remove("active");
		  
		  courseOnlineTitle?.classList.remove("active");
		  courseOfflineTitle?.classList.add("active");
        }
      }
      onlineTab.addEventListener("click", () => handleClickTab("online"));
      offlineTab.addEventListener("click", () => handleClickTab("offline"));
    });
  }
  const isMobileDevice = window.innerWidth < 640;
  if(!isMobileDevice) {
	document.querySelectorAll(".course-table tr[data-count]").forEach((rowEl) => {
		const cells = rowEl.querySelectorAll("td:not([rowspan])");
		if (!cells.length) return;
		const highlightRow = (bgColor) => {
        cells.forEach((cell) => {
          cell.style.background = bgColor
          cell.style.transition = 'background-color 0.3s ease'
        })
      }
		// Dùng mouseenter thay vì mousemove để tránh gọi liên tục
		rowEl.addEventListener("mouseenter", () => highlightRow("#d8c7fe"));
		rowEl.addEventListener("mouseleave", () => highlightRow("#f3faff"));
	});	  
  }
}

function PopupDiscount() {
  const isMobileDevice = window.innerWidth < 640;
  const popupDiscountEl = document.querySelector(".popup-discount");
  if (!popupDiscountEl) return;
  setTimeout(() => {
    popupDiscountEl.classList.add("active");
    document.body.style.overflow = "hidden";
  }, 3000);

  const popupDiscountCloseBtnEl = document.querySelector(".popup-close-btn");
  popupDiscountCloseBtnEl.addEventListener("click", () => {
    if (popupDiscountEl.classList.contains("active")) {
      popupDiscountEl.classList.remove("active");
	  const drawerEl = document.querySelector('.course-detail-drawer');
      if(!drawerEl?.classList.contains('active')) {
		  document.body.style.overflow = "";
	  }
    }
  });
}

class CourseSchedule {
  constructor() {
    this.allDetailCourseBtn = document.querySelectorAll(".detail-course-btn");
    this.detailCourseContainer = document.querySelector(".detail-course-container");
    this.courseDetailDrawerEl = document.querySelector(".course-detail-drawer");
    this.courseDetailDrawerContentEl = document.querySelector(".course-detail-drawer__content");
    this.courseDetailDrawerOverlayEl = document.querySelector(".course-detail-drawer__overlay");
    this.registerButtonEl = document.querySelector(".course-detail-drawer__content-class__register-now");
    this.startY = 0;
    this.currentY = 0;
    this.isDragging = false;
    this.events();
    this.init();
  }
  init() {}
  updateDetailCourse({ id, name, quantityMember, openingSchedule, studySchedule, studyTime, linkRegister }) {
    const courseDetail = document.querySelector(".course-detail-drawer__content");
    const courseNameEl = courseDetail.querySelector(".course-detail-drawer__content-class__name");
    const courseIdEl = courseDetail.querySelector(".course-detail-drawer__content-class__id span");
    const courseOpeningEl = courseDetail.querySelector(".course-detail-drawer__content-class__opening-schedule span");
    const courseMemberEl = courseDetail.querySelector(".course-detail-drawer__content-class__quantity-member span");
    const courseTimeEl = courseDetail.querySelector(".course-detail-drawer__content-class__time span");
    const courseScheduleEl = courseDetail.querySelector(".course-detail-drawer__content-class__schedule-content span");
    const courseRegisterEl = courseDetail.querySelector(".course-detail-drawer__content-class__register-now");

    if (courseNameEl) courseNameEl.textContent = name;
    if (courseIdEl) courseIdEl.textContent = id;
    if (courseOpeningEl) courseOpeningEl.textContent = openingSchedule;
    if (courseMemberEl) courseMemberEl.textContent = quantityMember;
    if (courseTimeEl) courseTimeEl.textContent = studyTime;
    if (courseScheduleEl) courseScheduleEl.textContent = studySchedule;
    if (courseRegisterEl) courseRegisterEl.href = linkRegister;
  }
  events() {
    if (this.allDetailCourseBtn && this.courseDetailDrawerEl) {
      this.allDetailCourseBtn.forEach((detailBtn) => {
        detailBtn.addEventListener("click", () => {
          document.body.style.overflow = "hidden";
          this.courseDetailDrawerEl.classList.add("active");
          this.courseDetailDrawerContentEl.style.transform = "translateY(0)";
          this.updateDetailCourse(detailBtn.dataset);
        });
      });
    }
    if (this.courseDetailDrawerOverlayEl && this.courseDetailDrawerEl) {
      this.courseDetailDrawerOverlayEl.addEventListener("click", () => {
        this.courseDetailDrawerEl.classList.remove("active");
        this.courseDetailDrawerContentEl.style.transform = "translateY(100%)";
        document.body.style.overflow = "";
      });
    }
    if (this.registerButtonEl && this.courseDetailDrawerEl) {
      this.registerButtonEl.addEventListener("click", () => {
        this.courseDetailDrawerEl.classList.remove("active");
        this.courseDetailDrawerContentEl.style.transform = "translateY(100%)";
        document.body.style.overflow = "";
      });
    }
    if (this.courseDetailDrawerContentEl && this.courseDetailDrawerEl) {
      this.courseDetailDrawerContentEl.addEventListener("touchstart", (e) => {
        this.startY = e.touches[0].clientY;
        this.isDragging = true;
      });
      this.courseDetailDrawerContentEl.addEventListener("touchmove", (e) => {
        if (!this.isDragging) return;
        this.currentY = e.touches[0].clientY;
        const diffY = this.currentY - this.startY;

        if (diffY > 0) {
          this.courseDetailDrawerContentEl.style.transform = `translateY(${diffY}px)`;
		  this.courseDetailDrawerContentEl.style.transition = 'unset'
        }
      });

      this.courseDetailDrawerContentEl.addEventListener("touchend", () => {
        this.isDragging = false;
        const diffY = this.currentY - this.startY;
		this.courseDetailDrawerContentEl.style.transition = 'all 800ms cubic-bezier(0.67, 0.01, 0.2, 0.97)';
        if (diffY > 100) {
          // Nếu kéo xuống hơn 100px thì đóng drawer
          this.courseDetailDrawerEl.classList.remove("active");
          this.courseDetailDrawerContentEl.style.transform = `translateY(100%)`;
		  document.body.style.overflow = "";
        } else {
          // Quay lại vị trí ban đầu
          this.courseDetailDrawerContentEl.style.transform = `translateY(0)`;
        }
      });
    }
  }
}

document.addEventListener("DOMContentLoaded", () => {
  SectionOpeningCourseSchedule();
  PopupDiscount();
  new CourseSchedule();
});