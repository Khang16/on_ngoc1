<?php
$page_course_beu_gallery = get_field('page_course_beu_gallery');
$title = $page_course_beu_gallery['title'];
$description = $page_course_beu_gallery['description'];
$beu_gallery = $page_course_beu_gallery['beu_gallery'];
?>
<section class="beu-gallery">
    <div class="beu-gallery__container">
        <div class="beu-gallery__content">
            <h2 class="beu-gallery__title"><?= $title; ?></h2>
            <p class="beu-gallery__description">
                <?= $description; ?>
            </p>
        </div>
        <div class="beu-gallery__images">
            <?php
            $aos_effects = ['fade-right', 'fade-up', 'zoom-in', 'zoom-in', 'fade-left', 'fade-left', 'fade-left', 'zoom-in-up'];
            foreach ($beu_gallery as $index => $image) :
                $effect = $aos_effects[$index % count($aos_effects)];
            ?>
            <div class="beu-gallery__image no-aos-mobile" data-aos="<?= $effect ?>" data-aos-delay="<?= $index * 100 ?>"
                data-aos-duration="800">
                <?= wp_get_attachment_image($image, 'full'); ?>
            </div>
            <?php endforeach; ?>
            <div data-aos="zoom-in" data-aos-delay="200" data-aos-duration="600"
                class="beu-gallery__image-decor beu-gallery__image-decor-1 no-aos-mobile">
                <?= wp_get_attachment_image(827, 'full', false); ?>
            </div>
            <div data-aos="zoom-in" data-aos-delay="200" data-aos-duration="600"
                class="beu-gallery__image-decor beu-gallery__image-decor-2 no-aos-mobile">
                <?= wp_get_attachment_image(828, 'full', false); ?>
            </div>
            <div data-aos="zoom-in" data-aos-delay="200" data-aos-duration="600"
                class="beu-gallery__image-decor beu-gallery__image-decor-3 no-aos-mobile">
                <?= wp_get_attachment_image(841, 'full', false, array('class' => 'beu-gallery__image-decor-3-1')); ?>
                <?= wp_get_attachment_image(815, 'full', false, array('class' => 'beu-gallery__image-decor-3-2')); ?>
            </div>
            <div class="beu-gallery__image-decor beu-gallery__image-decor-4">
                <?= wp_get_attachment_image(839, 'full', false); ?>
            </div>
            <div class="beu-gallery__image-decor beu-gallery__image-decor-5">
                <?= wp_get_attachment_image(829, 'full', false); ?>
            </div>
        </div>
    </div>
</section>