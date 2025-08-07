<?
$results = get_field('results');
$title = $results['title'];
$description = $results['description'];
$list = $results['list'];
$_BG_PC = 2282;
$_BG_MB = 2299;
?>

<section class="results-about">
    <?= wp_get_attachment_image(wp_is_mobile() ? $_BG_MB : $_BG_PC, 'full', false, ['class' => 'results__bg']) ?>
    <div class="results__main">
        <h2 class="text-pc-36-b text-mb-22-b color-text-title-main results__title" ><?= $title ?>
        </h2>
        <p class="text-pc-18-bo text-mb-14-bo results__description" ><?= $description ?></p>
        <div class="results__body">
            <div class="results__circle-1"></div>
            <div class="results__circle-2"></div>
            <div class="results__circle-3"></div>
            <?= wp_get_attachment_image($list['image_3']['ID'], 'full', false, ['class' => 'results_bg_img']) ?>
            <div class="results__item_1">
                <?= wp_get_attachment_image($list['image_2']['ID'], 'full', false, ['class' => 'results--img-1']) ?>
            </div>
            <div class="results__item_2">
                <?= wp_get_attachment_image($list['image_1']['ID'], 'full', false, ['class' => 'results--img-2']) ?>
            </div>
        </div>
    </div>
</section>