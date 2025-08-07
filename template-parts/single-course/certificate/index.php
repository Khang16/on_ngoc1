<?php
$option_certificate = get_field('option_certificate', 'option');
$title = $option_certificate['title'];
$description = $option_certificate['description'];
$certificate = $option_certificate['certificate'];
?>
<section id="certificate">
    <?= wp_get_attachment_image(1059, 'full', false, [
        'class' => 'certificate__bg'
    ]) ?>
    <div class="container">
        <div class="certificate__content">
            <div class="certificate__content__title">
                <div class="certificate__title__icon">
                    <?= wp_get_attachment_image(1052, 'full', false, [
                        'class' => 'icon__certificate',
                        'data-aos-delay' => '1000',
                        'data-aos' => 'fade-up'
                    ]) ?>
                    <?= wp_get_attachment_image(1058, 'full', false, [
                        'class' => 'icon__under',
                    ]) ?>
                </div>
                <h2 class="certificate__title__text text-pc-36-b text-mb-22-b">
                    <?= $title; ?>
                </h2>
            </div>
            <p class="certificate__content__description text-pc-18-bo text-mb-12-bo">
                <?= $description; ?>
            </p>
        </div>
        <div class="certificate__img">
            <?= wp_get_attachment_image(1060, 'full', false, [
                'class' => 'certificate__img__shadow',
                'data-aos-delay' => '100',
                'data-aos' => 'zoom-in'
            ]) ?>

            <?= wp_get_attachment_image(1055, 'full', false, [
                'class' => 'certificate__violet__large',
                'data-aos-delay' => '500',
                'data-aos' => 'zoom-in'
            ]) ?>

            <?= wp_get_attachment_image(1056, 'full', false, [
                'class' => 'certificate__violet__medium',
                'data-aos-delay' => '500',
                'data-aos' => 'zoom-in'
            ]) ?>

            <?= wp_get_attachment_image(1057, 'full', false, [
                'class' => 'certificate__violet__small',
                'data-aos-delay' => '500',
                'data-aos' => 'zoom-in'
            ]) ?>

            <?= wp_get_attachment_image(1053, 'full', false, [
                'class' => 'certificate__green__large',
                'data-aos-delay' => '500',
                'data-aos' => 'zoom-in'
            ]) ?>

            <?= wp_get_attachment_image(1054, 'full', false, [
                'class' => 'certificate__green__medium'
            ]) ?>

            <div class="certificate__img__certificate">
                <div data-aos-delay="800" data-aos="flip-right">
                    <?= wp_get_attachment_image($certificate, 'full') ?>
                </div>
            </div>
        </div>
    </div>
</section>