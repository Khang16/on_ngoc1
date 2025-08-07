<?php
$title =  get_queried_object()->name;
$description =  get_queried_object()->description;
$categories_extends_banner = get_field('categories_extends_banner', 'term_' . get_queried_object_id());
$background = $categories_extends_banner['background'];
if (IS_MOBILE) {
    $background = $categories_extends_banner['background_mb'];
}
?>

<section class="course-banner">
    <?php if (!IS_MOBILE) : ?>
    <?= wp_get_attachment_image(1164, 'full', false, [
            'class' => 'course-banner__bg'
        ]) ?>
    <?= wp_get_attachment_image(1165, 'full', false, [
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
        </div>
    </div>
    <div class="course-banner__image">
        <?php if (IS_MOBILE) : ?>
        <?= wp_get_attachment_image(1110, 'full', false, [
                'class' => 'course-banner__bg-layer-1'
            ]) ?>
        <?php endif; ?>
        <?= wp_get_attachment_image($background, 'full', false, [
            'class' => 'course-banner__image__img'
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