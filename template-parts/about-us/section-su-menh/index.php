<?php
$mission = get_field('mission');
$title = $mission['title'];
$description = $mission['description'];
$list = $mission['list'];
$_BG_PC = 1945;
$_BG_MB = 1947;
$_ICON = 1081;
?>

<section class="mission-about" id="mission-about">
    <?= wp_get_attachment_image(wp_is_mobile() ? $_BG_MB : $_BG_PC, 'full', false, array('class' => 'mission__bg')) ?>
    <div class="mission__main" data-aos="zoom-in-left">
        <h2 class="text-pc-36-b text-mb-22-b color-text-title-main mission__title"><?= $title ?></h2>
        <p class="text-pc-18-bo text-mb-14-bo mission__description"><?= $description ?></p>
    </div>
    <div class="mission__category">
        <?php foreach ($list as $index => $item): ?>
            <div class="mission__category__item">
                <div class="mission__category__wrap">
                    <?= wp_get_attachment_image($item['image'], 'full', false, array('class' => 'mission__item--img')) ?>
                    <?= wp_get_attachment_image($_ICON, 'full', false, array('class' => 'mission__icon')) ?>
                    <p class="mission__item--text"><?= $item['text'] ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>