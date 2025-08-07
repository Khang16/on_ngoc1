<?php
$page_course_why_choose_us = get_field('page_course_why_choose_us');
$title = $page_course_why_choose_us['title'];
$why_choose_us = $page_course_why_choose_us['why_choose_us'];
$main_image = $page_course_why_choose_us['main_image'];
$background_image = $page_course_why_choose_us['background_image'];
$desktop = $background_image['desktop'];
$mobile = $background_image['mobile'];
?>

<section class="reasons">
    <?= wp_get_attachment_image(818, 'full', false, [
        'class' => 'reasons__background-image',
    ]) ?>
    <div class="reasons__container">
        <?php if (IS_MOBILE) : ?>
        <h2 class="reasons__title">
            <?= $title ?>
        </h2>
        <?php endif; ?>
        <div class="reasons__content">
            <?php if (!IS_MOBILE) : ?>
            <h2 class="reasons__title no-aos-mobile" data-aos="fade-up" data-aos-duration="800">
                <?= $title ?>
            </h2>
            <?php endif; ?>
            <?php if ($why_choose_us) : ?>
            <ul class="reasons__list">
                <?php foreach ($why_choose_us as $index => $item) :
                        $icon = $item['icon'];
                        $title = $item['title'];
                        $description = $item['description'];
                    ?>
                <li class="reasons__item" data-aos="fade-up" data-aos-duration="800"
                    data-aos-delay="<?= $index * 100 ?>" <?= !IS_MOBILE ? 'data-aos-anchor=".reasons__title"' : '' ?>>
                    <div class="reasons__icon">
                        <?= wp_get_attachment_image($icon, 'full', false, [
                                    'class' => 'reasons__icon-img',
                                ]) ?>
                    </div>
                    <div class="reasons__text">
                        <h4 class="reasons__item-title">
                            <?= $title ?>
                        </h4>
                        <p class="reasons__item-desc">
                            <?= $description ?>
                        </p>
                    </div>
                </li>
                <?php endforeach; ?>
            </ul>
            <?php endif; ?>
        </div>
        <div class="reasons__image">
            <div class="reasons__image-wrapper">
                <?= wp_get_attachment_image($main_image, 'full', false, [
                    'class' => 'reasons__main-image no-aos-mobile',
                    'data-aos' => 'fade-up',
                    'data-aos-duration' => '800',
                    'data-aos-delay' => $index * 100 + 300,
                ]) ?>
                <div class="reasons__badge">
                    <?= wp_get_attachment_image(817, 'full', false, [
                        'class' => 'reasons__badge-img',
                    ]) ?>
                    <?= wp_get_attachment_image(815, 'full', false, [
                        'class' => 'reasons__badge-icon',
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</section>