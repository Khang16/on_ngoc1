<?php
$page_course_hall_of_fame = get_field('page_course_hall_of_fame');
$title = $page_course_hall_of_fame['title'];
$description = $page_course_hall_of_fame['description'];
$line_1 = $page_course_hall_of_fame['line_1'];
$line_2 = $page_course_hall_of_fame['line_2'];
$line_3 = $page_course_hall_of_fame['line_3'];
$line_4 = $page_course_hall_of_fame['line_4'];
?>

<section class="achievement-board">
    <?php if (!IS_MOBILE) : ?>
    <?= wp_get_attachment_image(858, 'full', false, [
            'class' => 'achievement-gradient-top',
        ]) ?>
    <?php endif; ?>
    <?php if (IS_MOBILE) : ?>
    <?= wp_get_attachment_image(861, 'full', false, [
            'class' => 'achievement-board__mobile-bg-image',
        ]) ?>
    <?php endif; ?>
    <!-- Your provided SVG with invisible circular paths for animation -->
    <svg class="achievement-board__svg" xmlns="http://www.w3.org/2000/svg" width="1600" height="900"
        viewBox="0 0 1600 846" fill="none">
        <g clip-path="url(#clip0_3524_23415)">
            <!-- Visible circles from your design -->
            <circle cx="799.816" cy="731.943" r="314" stroke="white" stroke-width="2" />
            <circle cx="799.816" cy="731.943" r="409" stroke="white" stroke-width="2" />
            <circle opacity="0.6" cx="799.816" cy="731.943" r="511" stroke="white" stroke-width="2" />
            <circle opacity="0.4" cx="799.816" cy="731.943" r="611" stroke="white" stroke-width="2" />
            <circle opacity="0.1" cx="799.816" cy="731.943" r="701" stroke="white" stroke-width="2" />

            <!-- White dots from your design -->
            <circle cx="987.816" cy="149.943" r="8" fill="white" />
            <circle cx="1037.32" cy="527.443" r="9.5" fill="white" />
            <circle cx="556.816" cy="281.943" r="9" fill="white" />
            <circle cx="1207.82" cy="424.943" r="7" fill="white" />
            <circle cx="271.816" cy="422.943" r="5" fill="white" />
            <circle cx="366.816" cy="180.943" r="4" fill="white" />
            <circle cx="1322.82" cy="264.943" r="4" fill="white" />

            <!-- Invisible paths for avatar animation -->
            <circle id="orbit1" cx="799.816" cy="731.943" r="314" stroke="none" fill="none" />
            <path id="orbit1-path" d="M 1113.816 731.943 a 314 314 0 1 1 -628 0 a 314 314 0 1 1 628 0" fill="none"
                stroke="none" />
            <circle id="orbit2" cx="799.816" cy="731.943" r="409" stroke="none" fill="none" />
            <path id="orbit2-path" d="M 1208.816 731.943 a 409 409 0 1 1 -818 0 a 409 409 0 1 1 818 0" fill="none"
                stroke="none" />
            <circle id="orbit3" cx="799.816" cy="731.943" r="511" stroke="none" fill="none" />
            <path id="orbit3-path" d="M 1310.816 731.943 a 511 511 0 1 1 -1022 0 a 511 511 0 1 1 1022 0" fill="none"
                stroke="none" />
            <circle id="orbit4" cx="799.816" cy="731.943" r="611" stroke="none" fill="none" />
            <path id="orbit4-path" d="M 1410.816 731.943 a 611 611 0 1 1 -1222 0 a 611 611 0 1 1 1222 0" fill="none"
                stroke="none" />
            <circle id="orbit5" cx="799.816" cy="731.943" r="701" stroke="none" fill="none" />
            <path id="orbit5-path" d="M 1500.816 731.943 a 701 701 0 1 1 -1402 0 a 701 701 0 1 1 1402 0" fill="none"
                stroke="none" />
        </g>
        <defs>
            <clipPath id="clip0_3524_23415">
                <rect width="1600" height="846" fill="white" />
            </clipPath>
        </defs>
        <!-- Avatars SVG -->
        <?php foreach ($line_1 as $i => $item) : ?>
        <image class="achievement-board__avatar achievement-board__avatar--large achievement-board__avatar--orange"
            href="<?= wp_get_attachment_image_url($item, 'medium') ?>" data-orbit="orbit5"
            data-start="<?= $i / count($line_1) ?>" width="80" height="80" />
        <?php endforeach; ?>

        <?php foreach ($line_2 as $i => $item) : ?>
        <image class="achievement-board__avatar achievement-board__avatar--blue"
            href="<?= wp_get_attachment_image_url($item, 'medium') ?>" data-orbit="orbit4"
            data-start="<?= $i / count($line_2) ?>" width="75" height="75" />
        <?php endforeach; ?>
        <?php foreach ($line_3 as $i => $item) : ?>
        <image class="achievement-board__avatar achievement-board__avatar--purple"
            href="<?= wp_get_attachment_image_url($item, 'medium') ?>" data-orbit="orbit3"
            data-start="<?= $i / count($line_3) ?>" width="70" height="70" />
        <?php endforeach; ?>
        <?php foreach ($line_4 as $i => $item) : ?>
        <image class="achievement-board__avatar achievement-board__avatar--small achievement-board__avatar--orange"
            href="<?= wp_get_attachment_image_url($item, 'medium') ?>" data-orbit="orbit2"
            data-start="<?= $i / count($line_4) ?>" width="65" height="65" />
        <?php endforeach; ?>
    </svg>

    <div class="achievement-board__content">
        <h2 class="achievement-board__title">
            <?= $title ?>
        </h2>
        <p class="achievement-board__desc">
            <?= $description ?>
        </p>
    </div>
    <?= wp_get_attachment_image(IS_MOBILE ? 859 : 857, 'full', false, [
        'class' => 'achievement-gradient-bottom',
    ]) ?>
</section>