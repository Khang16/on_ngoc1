let youtubeApiLoaded = false;
let player = null;

export default function setupCourseInformationVideo() {
	Fancybox.bind("[data-fancybox]", {});
//     const playButtons = document.querySelectorAll(".information__video-play");

//     playButtons.forEach((playButton) => {
//         if (playButton.dataset.listenerAttached === "true") return;

//         playButton.addEventListener("click", function handlePlayButtonClick() {
//             const videoBox = playButton.closest(".information__video");
//             const videoContainer = videoBox.querySelector(
//                 ".information__video-content"
//             );
//             const videoThumbnail = videoBox.querySelector(
//                 ".information__video-thumbnail"
//             );

//             // Nếu đã play hoặc đang loading hoặc đã có player thì không làm gì nữa
//             if (
//                 videoContainer.querySelector(".video-loading-spinner") ||
//                 videoContainer.querySelector("#youtube-player") ||
//                 videoContainer.dataset.played === "true"
//             )
//                 return;

//             videoContainer.dataset.played = "true";

//             if (playButton) playButton.style.display = "none";
//             if (videoThumbnail) videoThumbnail.style.display = "none";

//             showLoading(videoContainer);

//             const youtubeUrl = videoContainer.getAttribute("data-src");
//             const videoId = extractYoutubeId(youtubeUrl);
//             if (!videoId) {
//                 hideLoading(videoContainer);
//                 videoContainer.dataset.played = "false";
//                 if (playButton) playButton.style.display = "flex";
//                 if (videoThumbnail) videoThumbnail.style.display = "block";
//                 return;
//             }

//             // Tạo div chứa player, KHÔNG xóa innerHTML
//             let playerDiv = document.createElement("div");
//             playerDiv.id = "youtube-player";
//             playerDiv.style.width = "100%";
//             playerDiv.style.height = "100%";
//             videoContainer.appendChild(playerDiv);

//             // Load API nếu chưa có
//             if (!youtubeApiLoaded) {
//                 let tag = document.createElement("script");
//                 tag.src = "https://www.youtube.com/iframe_api";
//                 let firstScriptTag = document.getElementsByTagName("script")[0];
//                 firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
//                 youtubeApiLoaded = true;
//             }

//             // Gán hàm callback toàn cục cho API
//             window.onYouTubeIframeAPIReady = function () {
//                 player = new YT.Player("youtube-player", {
//                     height: "100%",
//                     width: "100%",
//                     videoId: videoId,
//                     playerVars: {
//                         playsinline: 1,
//                         autoplay: 1,
//                     },
//                     events: {
//                         onReady: function (event) {
//                             hideLoading(videoContainer);
//                             event.target.playVideo();
//                         },
//                         // Có thể thêm onStateChange nếu muốn
//                     },
//                 });
//             };

//             // Nếu API đã load rồi, gọi lại hàm tạo player
//             if (window.YT && window.YT.Player) {
//                 window.onYouTubeIframeAPIReady();
//             }
//         });

//         playButton.dataset.listenerAttached = "true";
//     });

//     function extractYoutubeId(url) {
//         if (!url) return null;
//         url = url.replace(/^@/, "");
//         const match = url.match(/[?&]v=([^&]+)/);
//         return match ? match[1] : null;
//     }

//     function showLoading(container) {
//         let spinner = document.createElement("div");
//         spinner.className = "video-loading-spinner";
//         spinner.style.cssText =
//             "display:flex;align-items:center;justify-content:center;height:100%;width:100%;background:rgba(255,255,255,0.7);position:absolute;top:0;left:0;z-index:2;";
//         spinner.innerHTML =
//             '<div style="width:40px;height:40px;border:4px solid #ccc;border-top:4px solid #5b378f;border-radius:50%;animation:spin 1s linear infinite;"></div>';
//         container.appendChild(spinner);

//         if (!document.getElementById("video-spinner-style")) {
//             const style = document.createElement("style");
//             style.id = "video-spinner-style";
//             style.innerHTML = `
//                 @keyframes spin {
//                     0% { transform: rotate(0deg);}
//                     100% { transform: rotate(360deg);}
//                 }
//             `;
//             document.head.appendChild(style);
//         }
//     }

//     function hideLoading(container) {
//         const spinner = container.querySelector(".video-loading-spinner");
//         if (spinner) spinner.remove();
//     }
}
