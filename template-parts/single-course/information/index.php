<?php
$single_course_information = get_field("single_course_information");

$general = $single_course_information['general'] ?? '';
$total_number_of_lessons = $general['total_number_of_lessons'] ?? '';
$total_hours_of_study = $general['total_hours_of_study'] ?? '';
$number_of_students = $general['number_of_students'] ?? '';
$input = $general['input'] ?? '';
$form = $general['form'] ?? '';
$youtube_link = $general['youtube_link'] ?? '';
$youtube_thumbnail = $general['youtube_thumbnail'] ?? '';
$benefits = $single_course_information['benefits'] ?? '';
?>
<section class="information">
    <div class="information__container">
        <h2 class="information__header">
            Thông tin khoá học
        </h2>
        <div class="information__content">
            <div class="information__box information__box--1">
                <h3>Thông tin chung</h3>
                <ul>
                    <li>
                        <?= wp_get_attachment_image(927, 'full', false, array('class' => 'information__icon')) ?>
                        Tổng số buổi học:
                        <span>
                            <?= $total_number_of_lessons ?>
                        </span>
                    </li>
                    <li>
                        <?= wp_get_attachment_image(929, 'full', false, array('class' => 'information__icon')) ?>
                        Tổng số giờ học:
                        <span>
                            <?= $total_hours_of_study ?>
                        </span>
                    </li>
                    <li>
                        <?= wp_get_attachment_image(1126, 'full', false, array('class' => 'information__icon')) ?>
                        Sĩ số:
                        <span>
                            <?= $number_of_students ?>
                        </span>
                    </li>
                    <li>
                        <?= wp_get_attachment_image(1126, 'full', false, array('class' => 'information__icon')) ?>
                        Đầu vào:
                        <span>
                            <?= $input ?>
                        </span>
                    </li>
                    <li>
                        <?= wp_get_attachment_image(1126, 'full', false, array('class' => 'information__icon')) ?>
                        Hình thức:
                        <span>
                            <?= $form ?>
                        </span>
                    </li>
                </ul>
                <a href="<?= $youtube_link ?>" data-fancybox class="information__video">
                    <div class="information__video-thumbnail">
                        <?= wp_get_attachment_image($youtube_thumbnail, 'full') ?>
                    </div>
                    <div class="information__video-play">
                        <?= wp_get_attachment_image(1129, 'full') ?>
                    </div>
                    <div class="information__video-content" data-src="<?= $youtube_link ?>">
                    </div>
                </a>
            </div>
            <div class="information__box information__box--2">
                <h3>Thông tin chi tiết</h3>
                <ul>
                    <?php foreach ($benefits as $benefit) : ?>
                    <li>
                        <?= wp_get_attachment_image(928, 'full', false, array('class' => 'information__icon')) ?>
                        <span>
                            <?= $benefit['content'] ?>
                        </span>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
    <?php if (IS_MOBILE) {
        echo wp_get_attachment_image(818, 'full', false, array('class' => 'information__mobile-image'));
    } ?>
</section>