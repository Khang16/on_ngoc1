export function sectionAboutUs() {
    const player = new Plyr("#player", {
        autoplay: true,
        muted: true,
        loop: {
            active: true,
        },
        controls: [], // Ẩn toàn bộ controls
        hideControls: true, // Ẩn controls khi không tương tác (dự phòng)
    });

    Fancybox.bind("[data-fancybox]", {
        //
    });
}
