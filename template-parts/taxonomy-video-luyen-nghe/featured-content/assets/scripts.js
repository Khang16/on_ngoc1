// Load YouTube Player API
function loadYouTubeAPI() {
    if (window.YT) return Promise.resolve();
    return new Promise((resolve) => {
        const tag = document.createElement("script");
        tag.src = "https://www.youtube.com/iframe_api";
        const firstScriptTag = document.getElementsByTagName("script")[0];
        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
        window.onYouTubeIframeAPIReady = resolve;
    });
}

export const featuredContent = () => {
    loadYouTubeAPI().then(() => {
        initializeFeaturedContent();
    });
};

function initializeFeaturedContent() {
    const elements = {
        videoWrapper: document.querySelector(
            ".featured-content__video-wrapper"
        ),
        videoTrigger: document.getElementById("video-trigger"),
        videoInfo: document.querySelector(".featured-content__video-info"),
        tabButtons: document.querySelectorAll(".tab-button"),
        relatedVideoList: document.getElementById("related-video-list"),
        latestVideoList: document.getElementById("latest-video-list"),
    };
    if (!elements.videoWrapper || !elements.videoTrigger) return;
    const originalVideoData = getOriginalVideoData(elements.videoWrapper);
    const playlistState = {
        currentTab: "related",
        currentVideoIndex: 0,
        videos: [],
        isPlaying: false,
        autoplayNext: true,
    };
    window.playlistState = playlistState;
    initializeVideoPlayer(elements, originalVideoData);
    initializeTabSwitching(elements, playlistState);
    initializeVideoItemClicks(elements, playlistState);
}

function getOriginalVideoData(videoWrapper) {
    return {
        link: videoWrapper.getAttribute("data-link"),
        title: videoWrapper
            .querySelector(".featured-content__video-title")
            ?.textContent?.trim(),
        excerpt: videoWrapper
            .querySelector(".featured-content__video-desc")
            ?.textContent?.trim(),
        avatar: videoWrapper.querySelector(".featured-content__avatar")?.src,
        poster: videoWrapper.querySelector(".featured-content__poster")?.src,
    };
}

function extractYouTubeId(url) {
    if (!url) return null;
    const patterns = [
        /(?:youtube\.com\/watch\?v=|youtu\.be\/|youtube\.com\/embed\/)([^&\n?#]+)/,
        /youtube\.com\/v\/([^&\n?#]+)/,
    ];
    for (const pattern of patterns) {
        const match = url.match(pattern);
        if (match) return match[1];
    }
    return null;
}

function createYouTubeIframe(videoId, playlistState) {
    const iframe = document.createElement("iframe");
    iframe.className = "featured-content__video-iframe";
    iframe.src = `https://www.youtube.com/embed/${videoId}?autoplay=1&rel=0&enablejsapi=1&origin=${window.location.origin}`;
    iframe.allowFullscreen = true;
    iframe.allow =
        "accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture";
    iframe.title = "YouTube video player";
    iframe.onload = function () {
        new YT.Player(iframe, {
            events: {
                onStateChange: function (event) {
                    if (
                        event.data === YT.PlayerState.ENDED &&
                        playlistState.autoplayNext
                    ) {
                        setTimeout(() => {
                            playNextVideo(playlistState);
                        }, 1000);
                    }
                },
            },
        });
    };
    return iframe;
}

var playButton = document
    .querySelector(".featured-content__play-button")
    .cloneNode(true);
var playCaption = document
    .querySelector(".featured-content__play-caption")
    .cloneNode(true);

function createVideoTrigger(thumbnail, originalPoster) {
    const videoTrigger = document.createElement("div");
    videoTrigger.className = "featured-content__video-thumb";
    videoTrigger.id = "video-trigger";
    const poster = document.createElement("img");
    poster.className = "featured-content__poster";
    poster.src = thumbnail || originalPoster;
    poster.style.cssText =
        "width: 100%; height: 100%; object-fit: cover; pointer-events: none;";

    videoTrigger.append(poster, playButton, playCaption);
    return videoTrigger;
}

function updateMainVideo(
    videoWrapper,
    videoInfo,
    videoData,
    originalVideoData
) {
    videoWrapper.setAttribute("data-link", videoData.link);
    const videoTrigger = videoWrapper.querySelector("#video-trigger");
    if (videoTrigger) {
        const poster = videoTrigger.querySelector(".featured-content__poster");
        if (poster && videoData.thumbnail) {
            poster.style.opacity = "0";
            setTimeout(() => {
                poster.srcset = "";
                poster.sizes = "";
                poster.src = videoData.thumbnail;
                poster.style.opacity = "1";
            }, 150);
        }
    }
    if (videoInfo) updateVideoInfoElements(videoInfo, videoData);
    const existingIframe = videoWrapper.querySelector(
        ".featured-content__video-iframe"
    );
    if (existingIframe) {
        const newVideoTrigger = createVideoTrigger(
            videoData.thumbnail,
            originalVideoData.poster
        );
        newVideoTrigger.addEventListener("click", handleVideoClick);
        existingIframe.parentNode.replaceChild(newVideoTrigger, existingIframe);
    }
}

function updateVideoInfoElements(videoInfo, videoData) {
    const elements = {
        link: videoInfo,
        avatar: videoInfo.querySelector(".featured-content__avatar"),
        title: videoInfo.querySelector(".featured-content__video-title"),
        excerpt: videoInfo.querySelector(".featured-content__video-desc"),
    };
    const updateWithFade = (element, newValue, property = "textContent") => {
        if (!element) return;
        element.style.opacity = "0";
        setTimeout(() => {
            element.srcset = "";
            element.sizes = "";
            if (property === "src") element.src = newValue;
            else element.textContent = newValue;
            element.style.opacity = "1";
        }, 150);
    };

    if (elements.link) {
        elements.link.href = videoData.link;
    }
    if (elements.avatar && videoData.thumbnail)
        updateWithFade(elements.avatar, videoData.thumbnail, "src");
    if (elements.title && videoData.title)
        updateWithFade(elements.title, videoData.title);
    if (elements.excerpt && videoData.excerpt)
        updateWithFade(elements.excerpt, videoData.excerpt);
}

function handleVideoClick(event) {
    const videoWrapper = event.currentTarget.closest(
        ".featured-content__video-wrapper"
    );
    const youtubeLink = videoWrapper.getAttribute("data-link");
    const videoId = extractYouTubeId(youtubeLink);
    if (!videoId) {
        alert("Không thể phát video. Vui lòng kiểm tra lại link YouTube.");
        return;
    }
    const iframe = createYouTubeIframe(videoId, window.playlistState);
    event.currentTarget.parentNode.replaceChild(iframe, event.currentTarget);
}

function initializeVideoPlayer(elements, originalVideoData) {
    elements.videoTrigger.addEventListener("click", handleVideoClick);
}

function initializeTabSwitching(elements, playlistState) {
    if (
        !elements.tabButtons.length ||
        !elements.relatedVideoList ||
        !elements.latestVideoList
    )
        return;
    const originalRelatedVideoItems = Array.from(
        elements.relatedVideoList.children
    );
    const originalLatestVideoItems = Array.from(
        elements.latestVideoList.children
    );
    elements.tabButtons.forEach((button) => {
        button.addEventListener("click", () => {
            elements.tabButtons.forEach((btn) =>
                btn.classList.remove("active")
            );
            button.classList.add("active");
            playlistState.currentTab = button.getAttribute("data-tab");
            playlistState.currentVideoIndex = 0;
            playlistState.videos =
                playlistState.currentTab === "related"
                    ? originalRelatedVideoItems
                    : originalLatestVideoItems;
            playlistState.isPlaying = false;
            renderTabContent(
                elements.relatedVideoList,
                elements.latestVideoList,
                playlistState.currentTab,
                originalRelatedVideoItems,
                originalLatestVideoItems
            );
        });
    });
}

function renderTabContent(
    relatedVideoList,
    latestVideoList,
    tabType,
    originalRelatedVideoItems,
    originalLatestVideoItems
) {
    relatedVideoList.style.display = "none";
    latestVideoList.style.display = "none";
    if (tabType === "related") {
        relatedVideoList.style.display = "block";
        relatedVideoList.innerHTML = "";
        if (originalRelatedVideoItems.length > 0) {
            originalRelatedVideoItems.forEach((item) => {
                relatedVideoList.appendChild(item.cloneNode(true));
            });
        } else {
            relatedVideoList.innerHTML =
                '<li class="featured-content__no-videos">Không có video liên quan</li>';
        }
    } else if (tabType === "latest") {
        latestVideoList.style.display = "block";
        latestVideoList.innerHTML = "";
        if (originalLatestVideoItems.length > 0) {
            originalLatestVideoItems.forEach((item) => {
                latestVideoList.appendChild(item.cloneNode(true));
            });
        } else {
            latestVideoList.innerHTML =
                '<li class="featured-content__no-videos">Không có video mới nhất</li>';
        }
    }
    attachVideoItemClickEvents(window.playlistState);
}

function initializeVideoItemClicks(elements, playlistState) {
    attachVideoItemClickEvents(playlistState);
}

function attachVideoItemClickEvents(playlistState) {
    const videoItems = document.querySelectorAll(
        ".featured-content__video-item"
    );
    playlistState.videos = Array.from(videoItems);
    videoItems.forEach((item) => {
        item.removeEventListener("click", (e) =>
            handleVideoItemClick(e, playlistState)
        );
        item.addEventListener("click", (e) =>
            handleVideoItemClick(e, playlistState)
        );
    });
    updatePlaylistInfo(playlistState);
}

function extractVideoDataFromElement(element) {
    return {
        link: element.getAttribute("data-link"),
        id: element.getAttribute("data-id"),
        title: element.getAttribute("data-title"),
        duration: element.getAttribute("data-duration"),
        category: element.getAttribute("data-category"),
        thumbnail: element.getAttribute("data-thumbnail"),
        excerpt: element.getAttribute("data-excerpt"),
    };
}

function updateMainVideoFromSidebar(videoData) {
    const videoWrapper = document.querySelector(
        ".featured-content__video-wrapper"
    );
    const videoInfo = document.querySelector(".featured-content__video-info");
    const originalVideoData = getOriginalVideoData(videoWrapper);
    updateMainVideo(videoWrapper, videoInfo, videoData, originalVideoData);
}

function highlightSelectedVideo(selectedItem) {
    document
        .querySelectorAll(".featured-content__video-item")
        .forEach((item) => {
            item.classList.remove("selected");
        });
    selectedItem.classList.add("selected");
}

// --- Playlist controls ---
function playPreviousVideo(playlistState) {
    if (playlistState.videos.length === 0) return;
    const prevIndex = playlistState.currentVideoIndex - 1;
    if (prevIndex < 0) {
        return;
    } else {
        playlistState.currentVideoIndex = prevIndex;
    }
    playVideoByIndex(playlistState);
}

function playNextVideo(playlistState) {
    if (playlistState.videos.length === 0) return;
    const nextIndex = playlistState.currentVideoIndex + 1;
    if (nextIndex >= playlistState.videos.length) {
        return;
    } else {
        playlistState.currentVideoIndex = nextIndex;
    }
    playVideoByIndex(playlistState);
}

function togglePlayPause(playlistState) {
    const playPauseBtn = document.querySelector(".play-pause-btn span");
    if (playlistState.isPlaying) {
        playlistState.isPlaying = false;
        if (playPauseBtn) playPauseBtn.textContent = "▶";
        const iframe = document.querySelector(
            ".featured-content__video-iframe"
        );
        if (iframe) {
            const videoWrapper = document.querySelector(
                ".featured-content__video-wrapper"
            );
            const newVideoTrigger = createVideoTrigger(
                playlistState.videos[
                    playlistState.currentVideoIndex
                ]?.getAttribute("data-thumbnail"),
                getOriginalVideoData(videoWrapper).poster
            );
            newVideoTrigger.addEventListener("click", handleVideoClick);
            iframe.parentNode.replaceChild(newVideoTrigger, iframe);
        }
    } else {
        playlistState.isPlaying = true;
        if (playPauseBtn) playPauseBtn.textContent = "⏸";
        playVideoByIndex(playlistState);
    }
}

function toggleAutoplay(playlistState, autoplayBtn) {
    playlistState.autoplayNext = !playlistState.autoplayNext;
    autoplayBtn.classList.toggle("active", playlistState.autoplayNext);
}

function playVideoByIndex(playlistState) {
    if (playlistState.videos.length === 0) return;
    const videoItem = playlistState.videos[playlistState.currentVideoIndex];
    if (!videoItem) return;
    const videoData = extractVideoDataFromElement(videoItem);
    updateMainVideoFromSidebar(videoData);
    highlightSelectedVideo(videoItem);
    const videoWrapper = document.querySelector(
        ".featured-content__video-wrapper"
    );
    const youtubeLink = videoWrapper.getAttribute("data-link");
    const videoId = extractYouTubeId(youtubeLink);
    if (videoId) {
        const iframe = createYouTubeIframe(videoId, playlistState);
        const videoTrigger = document.getElementById("video-trigger");
        if (videoTrigger) {
            videoTrigger.parentNode.replaceChild(iframe, videoTrigger);
        }
    }
    updatePlaylistInfo(playlistState);
}

function updatePlaylistInfo(playlistState) {
    const currentVideoSpan = document.querySelector(".current-video");
    const totalVideosSpan = document.querySelector(".total-videos");
    if (currentVideoSpan && totalVideosSpan) {
        currentVideoSpan.textContent =
            playlistState.videos.length > 0
                ? playlistState.currentVideoIndex + 1
                : 0;
        totalVideosSpan.textContent = playlistState.videos.length;
    }
}

function handleVideoItemClick(e, playlistState) {
    e.preventDefault();
    const videoData = extractVideoDataFromElement(e.currentTarget);
    if (videoData.link) {
        const videoItems = document.querySelectorAll(
            ".featured-content__video-item"
        );
        playlistState.currentVideoIndex = Array.from(videoItems).indexOf(
            e.currentTarget
        );
        updateMainVideoFromSidebar(videoData);
        highlightSelectedVideo(e.currentTarget);
        playlistState.isPlaying = true;
        const playPauseBtn = document.querySelector(".play-pause-btn span");
        if (playPauseBtn) playPauseBtn.textContent = "⏸";
        updatePlaylistInfo(playlistState);
    }
}
