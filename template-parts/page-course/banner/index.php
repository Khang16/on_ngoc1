<?php
$title = is_tax() ? get_queried_object()->name : get_the_title();
$description = is_tax() ? get_queried_object()->description : get_the_excerpt();
$single_course_banner = get_field('single_course_banner', is_tax() ? 'term_' . get_queried_object_id() : get_the_ID());
$background = "";
$link = "";
$student_gallery = "";
$student_count = "";
if ($single_course_banner) {
    $background = IS_MOBILE ? $single_course_banner['background_mb'] : $single_course_banner['background'];
    $link = $single_course_banner['link'];
    $student_gallery = $single_course_banner['student_gallery'];
    $student_count = $single_course_banner['student_count'];
    if ($single_course_banner['title']) {
        $title = $single_course_banner['title'];
    }
    if ($single_course_banner['description']) {
        $description = $single_course_banner['description'];
    }
}
$link = !empty($single_course_banner['link']) ? $single_course_banner['link'] : [];
$link_title = !empty($link['title']) ? $link['title'] : '';
$link_url = !empty($link['url']) ? $link['url'] : '';
$link_target = !empty($link['target']) ? $link['target'] : '_self';
?>

<section class="course-banner">
    <?php if (!IS_MOBILE) : ?>
    <?= wp_get_attachment_image(1108, 'full', false, [
            'class' => 'course-banner__bg'
        ]) ?>
    <?= wp_get_attachment_image(1109, 'full', false, [
            'class' => 'course-banner__bg-layer-1'
        ]) ?>
    <?= wp_get_attachment_image(1111, 'full', false, [
            'class' => 'course-banner__bg-layer-2'
        ]) ?>
    <?php endif; ?>
    <div class="course-banner__container">
        <div class="course-banner__content">
            <?php if (function_exists('rank_math_the_breadcrumbs') && !IS_MOBILE) rank_math_the_breadcrumbs(); ?>
            <h1 class="course-banner__title">
                <?= $title; ?>
            </h1>
            <p class="course-banner__description">
                <?= $description; ?>
            </p>
            <?php if (!empty($link_url) && !empty($link_title)) : ?>
            <a href="<?= esc_url($link_url); ?>" target="<?= esc_attr($link_target); ?>" class="main-banner__button">
                <span class="main-banner__button-text">Liên hệ tư vấn</span>
                <span class="main-banner__button-icon"><?= wp_get_attachment_image(87) ?></span>
            </a>
            <?php endif; ?>
            <div class="course-banner__students">
                <div class="course-banner__students__images">
                    <?php foreach ($student_gallery as $item): ?>
                    <?= wp_get_attachment_image($item, 'full', false, [
                            'class' => 'course-banner__students__item'
                        ]) ?>
                    <?php endforeach; ?>
                </div>
                <div class="course-banner__students__count">
                    <p><span><?= $student_count; ?></span> học viên</p>
                    <p>Đã theo học khoá học này</p>
                </div>
            </div>
        </div>
    </div>
    <div class="course-banner__image">
        <?php if (IS_MOBILE) : ?>
        <?= wp_get_attachment_image(1110, 'full', false, [
                'class' => 'course-banner__bg-layer-1'
            ]) ?>
        <?php endif; ?>
        <?= wp_get_attachment_image($background, 'full', false, [
            'class' => 'course-banner__image__img no-aos-mobile',
            'data-aos' => 'fade-up',
            'data-aos-duration' => '800',
        ]) ?>
        <?php if (IS_MOBILE) : ?>
        <?= wp_get_attachment_image(1098, 'full', false, [
                'class' => 'course-banner__bg-layer-3'
            ]) ?>
        <?php endif; ?>
    </div>
    <?php if (function_exists('rank_math_the_breadcrumbs') && IS_MOBILE) rank_math_the_breadcrumbs(); ?>
    <?php if (!IS_MOBILE) : ?>
    <?= wp_get_attachment_image(1112, 'full', false, [
            'class' => 'course-banner__bg-layer-3'
        ]) ?>
    <?php endif; ?>
    <?php if (IS_MOBILE) : ?>
    <div class="course-banner__icon">
        <?= wp_get_attachment_image(1116, 'full') ?>
    </div>
    <?php endif; ?>
</section>