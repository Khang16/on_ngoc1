<?php $courseB = get_field('contact_form') ?? get_field('contact_form', 531);
$course = get_field('contact_form_course_select', 531);
// Chuyển đổi mảng $course thành JSON và lưu vào biến JavaScript
$course_data_json = json_encode(array_map(function ($item) {
    // Đảm bảo $item là object và có các thuộc tính mong muốn trước khi truy cập
    if (is_object($item) && property_exists($item, 'ID') && property_exists($item, 'post_title') && property_exists($item, 'post_excerpt')) {
        return [
            'ID' => $item->ID,
            'post_title' => $item->post_title,
            'post_excerpt' => $item->post_excerpt
        ];
    }
    return null; // Trả về null nếu không đúng định dạng
}, $course));
// Lọc bỏ các giá trị null nếu có
$course_data_json = json_encode(array_filter(json_decode($course_data_json)));
?>
<?php echo do_shortcode('[contact-form-7 id="45da82d" title="Contact Form"]'); ?>
<div class="form__seperator"></div>
<?php // print_r($course); // Bỏ hoặc comment dòng này sau khi debug xong 
?>

<button class="main-banner__button custom__submit">
    <span class="main-banner__button-text">Gửi yêu cầu</span>
    <span class="main-banner__button-icon"><img width="43" height="44"
            src="/wp-content/uploads/2025/05/Frame-1618872316-white.svg" class="attachment-thumbnail size-thumbnail"
            alt="" decoding="async"></span>
</button>

<script>
    const courseData = <?php echo $course_data_json; ?>;
</script>

<template id="customSelectTemplate">
    <div class="custom-select" id="courseSelect">
        <div class="select-button" id="selectButton">
            <span class="select-text select-placeholder">Chọn khóa học...</span>
            <div class="select-arrow">
                <?php echo wp_get_attachment_image(540, 'full', false, array('class' => '')) ?>
            </div>
        </div>
        <div class="select-dropdown" id="selectDropdown">
        </div>
    </div>
</template>