<?php
$page_course_student_testimonials = get_field('page_course_student_testimonials');
$title = $page_course_student_testimonials['title'];
$student_testimonials = $page_course_student_testimonials['student_testimonials'];
?>
<section class="testimonial-slider">
    <h2 class="testimonial-slider__heading"><?= $title; ?></h2>

    <?php if (!IS_MOBILE): ?>
    <div style="--swiper-wrapper-transition-timing-function: linear;" class="swiper testimonial-slider__swiper">
        <div class="swiper-wrapper">
            <?php foreach ($student_testimonials as $post) :
                    setup_postdata($post);
                    $avatar = get_field('avatar_mem');
                    $name = get_the_title();
                    $content = get_field('content_rv');
                    $social_img = get_field('social_img');
                    $social_logo = get_field('social_logo');
                    $role_mem = get_field('role_mem');
                    $link_to_post = get_field('link_to_post');
                    $link_to_post_url = "";
                    $link_to_post_target = "";
                    if ($link_to_post) {
                        $link_to_post_url = $link_to_post['url'] ?? "";
                        $link_to_post_target = $link_to_post['target'] ?? "";
                    }
                ?>
            <div class="swiper-slide testimonial-slider__slide">
                <div class="testimonial-slider__card">
                    <?= wp_get_attachment_image(866, 'full', false, [
                                'class' => 'testimonial-slider__quote-icon',
                            ]) ?>
                    <div class="testimonial-slider__info">
                        <?= wp_get_attachment_image($avatar, 'medium', false, [
                                    'class' => 'testimonial-slider__avatar',
                                    'alt' => $name,
                                ]) ?>
                        <div class="testimonial-slider__meta">
                            <p class="testimonial-slider__name"><?= $name; ?></p>
                            <p class="testimonial-slider__role"><?= $role_mem; ?></p>
                        </div>
                        <a class="testimonial-slider__social-link" href="<?= get_field('facebook_mem'); ?>"
                            target="_blank">
                            <?= wp_get_attachment_image($social_img, 'medium', false, [
                                        'class' => 'testimonial-slider__social-avatar',
                                    ]) ?>
                            <span class="testimonial-slider__social-icon">
                                <?= wp_get_attachment_image($social_logo, 'full', false) ?>
                            </span>
                        </a>
                    </div>
                    <p class="testimonial-slider__text">
                        <?= $content; ?>
                    </p>
                </div>
                <a href="<?= $link_to_post_url; ?>" class="testimonial-slider__link"
                    target="<?= $link_to_post_target; ?>">
                    <span> Tìm hiểu thêm</span>
                    <?= wp_get_attachment_image(867, 'full', false) ?>
                </a>
            </div>
            <?php
                endforeach;
                wp_reset_postdata();
                ?>
        </div>
    </div>
    <?php else:
        $student_testimonials_count = count($student_testimonials) / 2;
        $student_testimonials_line_1 = array_slice($student_testimonials, 0, $student_testimonials_count);
        $student_testimonials_line_2 = array_slice($student_testimonials, $student_testimonials_count, $student_testimonials_count);
    ?>
    <div style="--swiper-wrapper-transition-timing-function: linear;" class="swiper testimonial-slider__swiper">
        <div class="swiper-wrapper">
            <?php foreach ($student_testimonials_line_1 as $post) :
                    setup_postdata($post);
                    $avatar = get_field('avatar_mem');
                    $name = get_the_title();
                    $content = get_field('content_rv');
                    $social_img = get_field('social_img');
                    $social_logo = get_field('social_logo');
                    $role_mem = get_field('role_mem');
                    $link_to_post = get_field('link_to_post');
                    $link_to_post_url = "";
                    $link_to_post_target = "";
                    if ($link_to_post) {
                        $link_to_post_url = $link_to_post['url'] ?? "";
                        $link_to_post_target = $link_to_post['target'] ?? "";
                    }
                ?>
            <div class="swiper-slide testimonial-slider__slide">
                <div class="testimonial-slider__card">
                    <?= wp_get_attachment_image(866, 'full', false, [
                                'class' => 'testimonial-slider__quote-icon',
                            ]) ?>
                    <div class="testimonial-slider__info">
                        <?= wp_get_attachment_image($avatar, 'medium', false, [
                                    'class' => 'testimonial-slider__avatar',
                                    'alt' => $name,
                                ]) ?>
                        <div class="testimonial-slider__meta">
                            <p class="testimonial-slider__name"><?= $name; ?></p>
                            <p class="testimonial-slider__role"><?= $role_mem; ?></p>
                        </div>
                        <a class="testimonial-slider__social-link" href="<?= get_field('facebook_mem'); ?>"
                            target="_blank">
                            <?= wp_get_attachment_image($social_img, 'medium', false, [
                                        'class' => 'testimonial-slider__social-avatar',
                                    ]) ?>
                            <span class="testimonial-slider__social-icon">
                                <?= wp_get_attachment_image($social_logo, 'full', false) ?>
                            </span>
                        </a>
                    </div>
                    <p class="testimonial-slider__text">
                        <?= $content; ?>
                    </p>
                </div>
                <a href="<?= $link_to_post_url; ?>" class="testimonial-slider__link"
                    target="<?= $link_to_post_target; ?>">
                    <span> Tìm hiểu thêm</span>
                    <?= wp_get_attachment_image(867, 'full', false) ?>
                </a>
            </div>
            <?php
                endforeach;
                wp_reset_postdata();
                ?>
        </div>
    </div>
    <div dir="rtl" style="--swiper-wrapper-transition-timing-function: linear;"
        class="swiper testimonial-slider__swiper">
        <div class="swiper-wrapper">
            <?php foreach ($student_testimonials_line_2 as $post) :
                    setup_postdata($post);
                    $avatar = get_field('avatar_mem');
                    $name = get_the_title();
                    $content = get_field('content_rv');
                    $social_img = get_field('social_img');
                    $social_logo = get_field('social_logo');
                    $role_mem = get_field('role_mem');
                    $link_to_post = get_field('link_to_post');
                    $link_to_post_url = "";
                    $link_to_post_target = "";
                    if ($link_to_post) {
                        $link_to_post_url = $link_to_post['url'] ?? "";
                        $link_to_post_target = $link_to_post['target'] ?? "";
                    }
                ?>
            <div class="swiper-slide testimonial-slider__slide">
                <div class="testimonial-slider__card">
                    <?= wp_get_attachment_image(866, 'full', false, [
                                'class' => 'testimonial-slider__quote-icon',
                            ]) ?>
                    <div class="testimonial-slider__info">
                        <?= wp_get_attachment_image($avatar, 'medium', false, [
                                    'class' => 'testimonial-slider__avatar',
                                    'alt' => $name,
                                ]) ?>
                        <div class="testimonial-slider__meta">
                            <p class="testimonial-slider__name"><?= $name; ?></p>
                            <p class="testimonial-slider__role"><?= $role_mem; ?></p>
                        </div>
                        <a class="testimonial-slider__social-link" href="<?= get_field('facebook_mem'); ?>"
                            target="_blank">
                            <?= wp_get_attachment_image($social_img, 'medium', false, [
                                        'class' => 'testimonial-slider__social-avatar',
                                    ]) ?>
                            <span class="testimonial-slider__social-icon">
                                <?= wp_get_attachment_image($social_logo, 'full', false) ?>
                            </span>
                        </a>
                    </div>
                    <p class="testimonial-slider__text">
                        <?= $content; ?>
                    </p>
                </div>
                <a href="<?= $link_to_post_url; ?>" class="testimonial-slider__link"
                    target="<?= $link_to_post_target; ?>">
                    <span> Tìm hiểu thêm</span>
                    <?= wp_get_attachment_image(867, 'full', false) ?>
                </a>
            </div>
            <?php
                endforeach;
                wp_reset_postdata();
                ?>
        </div>
    </div>
    <?php endif; ?>
</section>