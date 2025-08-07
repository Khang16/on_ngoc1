// export default function SectionOpeningCourseSchedule() {
//   const allTabWrappers = document.querySelectorAll(".tab-wrapper");
//   if (allTabWrappers && allTabWrappers.length) {
//     allTabWrappers.forEach((tabWrapper) => {
//       const onlineTab = tabWrapper.querySelector(".tab-item--online");
//       const offlineTab = tabWrapper.querySelector(".tab-item--offline");
//       if (!onlineTab || !offlineTab) return;
//       const parent = tabWrapper.closest(".opening-course-schedule__item");
//       const onlineTable = parent.querySelector(".course-table-wrapper--online");
//       const offlineTable = parent.querySelector(".course-table-wrapper--offline");

//       function handleClickTab(clickedTab) {
//         if (clickedTab === "online") {
//           onlineTab.classList.add("active");
//           offlineTab.classList.remove("active");
//           onlineTable?.classList.add("active");
//           offlineTable?.classList.remove("active");
//         } else {
//           offlineTab.classList.add("active");
//           onlineTab.classList.remove("active");
//           offlineTable?.classList.add("active");
//           onlineTable?.classList.remove("active");
//         }
//       }
//       onlineTab.addEventListener("click", () => handleClickTab("online"));
//       offlineTab.addEventListener("click", () => handleClickTab("offline"));
//     });
//   }

//   document.querySelectorAll(".course-table tr[data-count]").forEach((rowEl) => {
//     const cells = rowEl.querySelectorAll("td:not([rowspan])");
//     if (!cells.length) return;
//     const highlightRow = (bgColor) => {
//       cells.forEach((cell) => (cell.style.background = bgColor));
//     };
//     // Dùng mouseenter thay vì mousemove để tránh gọi liên tục
//     rowEl.addEventListener("mouseenter", () => highlightRow("#DCF0FF"));
//     rowEl.addEventListener("mouseleave", () => highlightRow("transparent"));
//   });
// }
