<?php
/**
 * Template hiển thị một item trong grid danh sách bài viết Try
 */

// Lấy thông tin bài viết hiện tại
$post_id = get_the_ID();
$title = get_the_title();
$permalink = get_the_permalink();
$excerpt = get_the_excerpt();
$date = get_the_date('d/m/Y');
$thumbnail = get_the_post_thumbnail_url($post_id, 'medium');

// Lấy category của bài viết từ taxonomy "try-categories"
$categories = get_the_terms($post_id, 'try-categories');
$category_name = '';
if ($categories && !is_wp_error($categories)) {
    $category_name = $categories[0]->name;
}

// Fallback thumbnail nếu không có
$fallback_img_id = 985; // ID of the fallback image
if (!$thumbnail) {
    $thumbnail = wp_get_attachment_image_url($fallback_img_id, 'medium');
}
?>

<div class="video-card">
    <a href="<?= esc_url($permalink) ?>" class="video-card__thumb">
        <img alt="<?= esc_attr($title) ?>" src="<?= esc_url($thumbnail) ?>" class="video-card__thumb-img" />
        <span class="video-card__badge">
            <?= esc_html($category_name) ?>
        </span>
    </a>
    <div class="video-card__content">
        <span class="video-card__label">
            TRY
        </span>
        <h3 class="video-card__title">
            <a href="<?= esc_url($permalink) ?>"><?= esc_html($title) ?></a>
        </h3>
        <?php if ($excerpt) : ?>
        <p class="video-card__desc"><?= esc_html($excerpt) ?></p>
        <?php endif; ?>
        <div class="video-card__meta">
            <span class="video-card__date">
                <?= wp_get_attachment_image(2276, 'full', false, array('class' => 'video-card__date-icon')) ?>
                <span class="video-card__date-text"><?= esc_html($date) ?></span>
            </span>
            <a href="<?= esc_url($permalink) ?>" class="video-card__cta">
                <span class="video-card__cta-text">Chi tiết bài viết</span>
                <span class="video-card__cta-icon">
                    <?= wp_get_attachment_image(1147, 'full', false) ?>
                </span>
            </a>
        </div>
    </div>
</div>