<?php
$team = get_field('team');
$text = $team['text'];
$list = $team['list'];
$_BG_PC = 2291;
$_BG_MB = 2298;
$_PEN = 2281;
$_CIRCLE = 665;
$_CIRCULAR = 815;
$_LOGO = 840;
$_CIRCLE_BG =2441;
?>

<section class="team-about" id="team-about">
    <?= wp_get_attachment_image(wp_is_mobile() ? $_BG_MB : $_BG_PC, 'full', false, ['class' => 'team__bg']) ?>
    <div class="team__items">
        <p class=" text-pc-18-bo text-mb-14-bo team__text"><?= $text ?></p>
        <div class="team__items_wrap" >
            <div class="team__item_1">
                <?= wp_get_attachment_image($list['image_1']['ID'], 'full', false, ['class' => 'team--img-1']) ?>
            </div>

            <div class="team__item_2">
                <?= wp_get_attachment_image($list['image_2']['ID'], 'full', false, ['class' => 'team--img-2']) ?>
            </div>

            <div class="team__item_3">
                <?= wp_get_attachment_image($list['image_3']['ID'], 'full', false, ['class' => 'team--img-3']) ?>
            </div>

            <div class="team__item_4">
                <?= wp_get_attachment_image($list['image_4']['ID'], 'full', false, ['class' => 'team--img-4']) ?>
            </div>
            <?= wp_get_attachment_image($_PEN, 'full', false, ['class' => 'team__pen']) ?>
            <?= wp_get_attachment_image($_CIRCLE, 'full', false, ['class' => 'team__circle']) ?>
            <?= wp_get_attachment_image($_LOGO, 'full', false, ['class' => 'team__logo']) ?>

            <div class="circular-text-wrap">
                   <div id="circular-text" class="circular-text" data-text="ÔN NGỌC BEU ÔN NGỌC BEU ÔN NGỌC BEU"
                    data-spin-duration="20" data-hover="speedUp"></div>
                <?= wp_get_attachment_image($_CIRCULAR, 'full', false, ['class' => 'team__circular']) ?>
            </div>
        </div>
    </div>
</section>