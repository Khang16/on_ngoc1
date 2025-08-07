// export default function CourseDetailDrawer () {
// 	class CourseSchedule {
// 	  constructor() {
// 		this.allDetailCourseBtn = document.querySelectorAll(".detail-course-btn");
// 		this.detailCourseContainer = document.querySelector(".detail-course-container");
// 		this.courseDetailDrawerEl = document.querySelector(".course-detail-drawer");
// 		this.courseDetailDrawerContentEl = document.querySelector(".course-detail-drawer__content");
// 		this.courseDetailDrawerOverlayEl = document.querySelector(".course-detail-drawer__overlay");
// 		this.registerButtonEl = document.querySelector(".course-detail-drawer__content-class__register-now");
// 		this.startY = 0;
// 		this.currentY = 0;
// 		this.isDragging = false;
// 		this.events();
// 	  }
// 	  init() {}
// 	  updateDetailCourse({ id, name, quantityMember, openingSchedule, studySchedule, studyTime, linkRegister }) {
// 		const courseDetail = document.querySelector(".course-detail-drawer__content");
// 		const courseNameEl = courseDetail.querySelector(".course-detail-drawer__content-class__name");
// 		const courseIdEl = courseDetail.querySelector(".course-detail-drawer__content-class__id span");
// 		const courseOpeningEl = courseDetail.querySelector(".course-detail-drawer__content-class__opening-schedule span");
// 		const courseMemberEl = courseDetail.querySelector(".course-detail-drawer__content-class__quantity-member span");
// 		const courseTimeEl = courseDetail.querySelector(".course-detail-drawer__content-class__time span");
// 		const courseScheduleEl = courseDetail.querySelector(".course-detail-drawer__content-class__schedule-content span");
// 		const courseRegisterEl = courseDetail.querySelector(".course-detail-drawer__content-class__register-now");

// 		if (courseNameEl) courseNameEl.textContent = name;
// 		if (courseIdEl) courseIdEl.textContent = id;
// 		if (courseOpeningEl) courseOpeningEl.textContent = openingSchedule;
// 		if (courseMemberEl) courseMemberEl.textContent = quantityMember;
// 		if (courseTimeEl) courseTimeEl.textContent = studyTime;
// 		if (courseScheduleEl) courseScheduleEl.textContent = studySchedule;
// 		if (courseRegisterEl) courseNameEl.href = linkRegister;
// 	  }
// 	  events() {
// 		if (this.allDetailCourseBtn && this.courseDetailDrawerEl) {
// 		  this.allDetailCourseBtn.forEach((detailBtn) => {
// 			detailBtn.addEventListener("click", () => {
// 			  document.body.style.overflow = "hidden";
// 			  this.courseDetailDrawerEl.classList.add("active");
// 			  this.courseDetailDrawerContentEl.style.transform = "translateY(0)";
// 			  this.updateDetailCourse(detailBtn.dataset);
// 			});
// 		  });
// 		}
// 		if (this.courseDetailDrawerOverlayEl && this.courseDetailDrawerEl) {
// 		  this.courseDetailDrawerOverlayEl.addEventListener("click", () => {
// 			this.courseDetailDrawerEl.classList.remove("active");
// 			this.courseDetailDrawerContentEl.style.transform = "translateY(100%)";
// 			document.body.style.overflow = "";
// 		  });
// 		}
// 		if (this.registerButtonEl && this.courseDetailDrawerEl) {
// 		  this.registerButtonEl.addEventListener("click", () => {
// 			this.courseDetailDrawerEl.classList.remove("active");
// 			this.courseDetailDrawerContentEl.style.transform = "translateY(100%)";
// 			document.body.style.overflow = "";
// 		  });
// 		}
// 		if (this.courseDetailDrawerContentEl && this.courseDetailDrawerEl) {
// 		  this.courseDetailDrawerContentEl.addEventListener("touchstart", (e) => {
// 			this.startY = e.touches[0].clientY;
// 			this.isDragging = true;
// 		  });
// 		  this.courseDetailDrawerContentEl.addEventListener("touchmove", (e) => {
// 			if (!this.isDragging) return;
// 			this.currentY = e.touches[0].clientY;
// 			const diffY = this.currentY - this.startY;

// 			if (diffY > 0) {
// 			  this.courseDetailDrawerContentEl.style.transform = `translateY(${diffY}px)`;
// 			}
// 		  });

// 		  this.courseDetailDrawerContentEl.addEventListener("touchend", () => {
// 			this.isDragging = false;
// 			const diffY = this.currentY - this.startY;

// 			if (diffY > 100) {
// 			  // Nếu kéo xuống hơn 100px thì đóng drawer
// 			  this.courseDetailDrawerEl.classList.remove("active");
// 			  this.courseDetailDrawerContentEl.style.transform = `translateY(100%)`;
// 			} else {
// 			  // Quay lại vị trí ban đầu
// 			  this.courseDetailDrawerContentEl.style.transform = `translateY(0)`;
// 			}
// 		  });
// 		}
// 	  }
// 	}

// 	const courseSchedule = new CourseSchedule();
// }