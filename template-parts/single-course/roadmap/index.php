<?php
$total_number_of_lessons = get_field('single_course_information_general_total_number_of_lessons');
$total_hours_of_study = get_field('single_course_information_general_total_hours_of_study');


$single_course_roadmap = get_field('single_course_roadmap');
$overview_line_1 = $single_course_roadmap['overview_line_1'];
$overview_line_2 = $single_course_roadmap['overview_line_2'];
$start_the_course = $single_course_roadmap['start_the_course'];
$results_achieved = $single_course_roadmap['results_achieved'];
$details_of  = $single_course_roadmap['details_of'];
$roadmap = $single_course_roadmap['roadmap'];
?>

<section id="roadmap">
    <picture class="roadmap__bg">
        <source media="(max-width: 639px)" srcset="<?= wp_get_attachment_image_url(934, 'full', false) ?>" />
        <?= wp_get_attachment_image(935, 'full', false) ?>
    </picture>
    <picture class="roadmap__bg__building">
        <source media="(max-width: 639px)" srcset="<?= wp_get_attachment_image_url(932, 'full', false) ?>" />
        <?= wp_get_attachment_image(933, 'full', false, [
            'data-aos-delay' => '100',
            'data-aos' => 'fade-up'
        ]) ?>
    </picture>
    <picture class="roadmap__bg__subtract">
        <source media="(max-width: 639px)" srcset="<?= wp_get_attachment_image_url(936, 'full', false) ?>" />
        <?= wp_get_attachment_image(937, 'full', false) ?>
    </picture>
    <div class="container">
        <h2 class="roadmap__title text-pc-36-b text-mb-22-b">
            Tổng quan lộ trình học
        </h2>
        <p class="roadmap__description text-pc-18-bo text-mb-12-bo">
            Khoá học Online - Offline được thiết kế riêng biệt với những ưu điểm
            riêng để mang đến hiệu quả tốt nhất
        </p>
        <!-- ROADMAP COURSE -->
        <div class="roadmap__wrapper__course">
            <div class="roadmap__box roadmap__box__left">
                <div class="roadmap__box__header">
                    <?= wp_get_attachment_image(927, 'full', false) ?>
                    <span class="roadmap__box__label"> Khoá học: </span>
                </div>
                <p class="roadmap__box__description">
                    <?= get_the_title(); ?>
                </p>
            </div>
            <div class="roadmap__box roadmap__box__right">
                <div class="roadmap__box__header">
                    <?= wp_get_attachment_image(929, 'full', false) ?>
                    <span class="roadmap__box__label"> Tổng số giờ học: </span>
                    <span class="header__content"><?= $total_hours_of_study; ?></span>
                </div>
                <div class="roadmap__box__footer">
                    <?= wp_get_attachment_image(927, 'full', false) ?>
                    <span class="roadmap__box__label"> Tổng số buổi học: </span>
                    <span class="footer__content"><?= $total_number_of_lessons; ?></span>
                </div>
            </div>
        </div>
        <!-- ROADMAP LIST -->
        <div class="roadmap__list">
            <h4 class="roadmap__list__title">
                <?= $overview_line_1; ?>
            </h4>
            <p class="roadmap__list__description">
                <?= $overview_line_2; ?>
            </p>
            <div class="roadmap__list__wrapper">
                <div class="roadmap__card">
                    <div class="roadmap__card__inset">
                        <div class="roadmap__card__header">
                            <?= wp_get_attachment_image(938, 'full', false) ?>
                            <span>Bắt đầu khoá học:</span>
                        </div>
                        <ul class="roadmap__card__list">
                            <?php foreach ($start_the_course as $item) : ?>
                            <li>
                                <?= wp_get_attachment_image(928, 'full', false) ?>
                                <span>
                                    <?= $item['content']; ?>
                                </span>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <div class="roadmap__card">
                    <div class="roadmap__card__inset">
                        <div class="roadmap__card__header">
                            <?= wp_get_attachment_image(939, 'full', false) ?>
                            <span>Kết quả đạt được:</span>
                        </div>
                        <ul class="roadmap__card__list">
                            <?php foreach ($results_achieved as $item) : ?>
                            <li>
                                <?= wp_get_attachment_image(928, 'full', false) ?>
                                <span>
                                    <?= $item['content']; ?>
                                </span>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="roadmap__tab__container">
                <div class="roadmap__tab__wrapper">
                    <!-- Tab Headers -->
                    <div class="tab-header">
                        <button class="tab-btn active" data-tab="tab1">
                            <span class="tab-text">Khởi đầu</span>
                            <?= wp_get_attachment_image(938, 'full', false, [
                                'class' => 'tab-icon'
                            ]) ?>
                        </button>
                        <button class="tab-btn" data-tab="tab2">
                            <span class="tab-text">Mục tiêu</span>
                            <?= wp_get_attachment_image(939, 'full', false, [
                                'class' => 'tab-icon'
                            ]) ?>
                        </button>
                        <div class="tab-indicator"></div>
                    </div>

                    <!-- Tab Content -->
                    <div class="tab-content-container">
                        <div class="tab-content active" id="tab1">
                            <ul class="content-list">
                                <?php foreach ($start_the_course as $item) : ?>
                                <li>
                                    <?= wp_get_attachment_image(928, 'full', false) ?>
                                    <?= $item['content']; ?>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>

                        <div class="tab-content" id="tab2">
                            <ul class="content-list">
                                <?php foreach ($results_achieved as $item) : ?>
                                <li>
                                    <?= wp_get_attachment_image(928, 'full', false) ?>
                                    <?= $item['content']; ?>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <span class="roadmap__lessons">
                <?= $details_of; ?>
            </span>

            <div class="roadmap__accordion">
                <picture class="roadmap__line">
                    <source media="(max-width: 639px)"
                        srcset="<?= wp_get_attachment_image_url(931, 'full', false) ?>" />
                    <?= wp_get_attachment_image(930, 'full', false) ?>
                </picture>

                <?php foreach ($roadmap as $key => $item) : ?>
                <div class="accordion-item">
                    <div class="accordion-header">
                        <div class="accordion-title">
                            <h3>
                                <?= $item['title']; ?>
                            </h3>
                            <span class="meta"><?= $item['lessons']; ?> - <?= $item['tests']; ?></span>
                        </div>
                        <div class="accordion-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="10" viewBox="0 0 15 10"
                                fill="none">
                                <path
                                    d="M6.43737 9.34336C7.02331 9.9293 7.97487 9.9293 8.56081 9.34336L14.5608 3.34336C14.9921 2.91211 15.1186 2.26992 14.8843 1.70742C14.6499 1.14492 14.1061 0.779297 13.4967 0.779297L1.49675 0.783985C0.892063 0.783985 0.343625 1.14961 0.10925 1.71211C-0.125125 2.27461 0.00612514 2.9168 0.432688 3.34805L6.43269 9.34805L6.43737 9.34336Z"
                                    fill="#5B378F" />
                            </svg>
                        </div>
                        <?php
                            $image_id = 940;
                            if ($key == 0) {
                                $image_id = 938;
                            } else if ($key == count($roadmap) - 1) {
                                $image_id = 939;
                            }
                            ?>
                        <?= wp_get_attachment_image($image_id, 'full', false, [
                                'class' => 'accordion-img'
                            ]) ?>
                    </div>
                    <div class="accordion-content">
                        <div class="accordion-content-inner text-pc-14-r">
                            <?= $item['content']; ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>