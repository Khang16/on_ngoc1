<?php
$data = get_field('section_appreciate');
?>

<section class="section-appreciate">
    <h2>
        <?= esc_html($data['title']); ?>
    </h2>
    <?php if (!IS_MOBILE) : ?>
    <div class="section-appreciate__content">
        <?php if (!empty($data['items'])) : ?>
        <div class="marquue__container marquue__container-1 swiper">
            <div class="swiper-wrapper">
                <?php foreach ($data['items'] as $post) : setup_postdata($post); ?>
                <div class="review__item swiper-slide">
                    <img src="/wp-content/uploads/2025/07/Vector.svg" alt="" class="rate__icon">

                    <div class="img-wrapper">
                        <?php
                                    $social_img = get_field('social_img', $post->ID);
                                    if ($social_img) :
                                        echo wp_get_attachment_image($social_img, 'full', false, ['class' => 'social_img']);
                                    endif;
                                    ?>
                        <?php
                                    $social_logo = get_field('social_logo', $post->ID);
                                    if ($social_logo) :
                                        echo wp_get_attachment_image($social_logo, 'full', false, ['class' => 'social_logo']);
                                    endif;
                                    ?>
                    </div>

                    <div class="review__header">
                        <?php
                                    $avatar = get_field('avatar_mem', $post->ID);
                                    if ($avatar) :
                                        echo wp_get_attachment_image($avatar, 'full', false, ['class' => 'avatar']);
                                    endif;
                                    ?>
                        <div class="review__header__info">
                            <p class="name"><?php echo get_the_title($post->ID); ?></p>
                            <p class="role"><?php the_field('role_mem', $post->ID); ?></p>
                        </div>
                    </div>

                    <p class="content">
                        <?php the_field('content_rv', $post->ID); ?>
                    </p>

                    <div class="learn-more-wrapper">
                        <a class="learn-more" href="#">
                            <span>Tìm hiểu thêm</span>
                            <div class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="7" height="12" viewBox="0 0 7 12"
                                    fill="none">
                                    <path d="M1.45703 1.63086L5.8847 6.10825L1.45703 10.4862" stroke="white"
                                        stroke-width="1.5" stroke-linecap="round" />
                                </svg>
                            </div>
                        </a>
                    </div>
                </div>
                <?php endforeach;
                        wp_reset_postdata(); ?>
            </div>
        </div>
        <?php endif; ?>
        <?php if (!empty($data['items'])) : ?>
        <div class="marquue__container marquue__container-2 swiper">
            <div class="swiper-wrapper">
                <?php foreach ($data['items'] as $post) : setup_postdata($post); ?>
                <div class="review__item swiper-slide">
                    <img src="/wp-content/uploads/2025/07/Vector.svg" alt="" class="rate__icon">

                    <div class="img-wrapper">
                        <?php
                                    $social_img = get_field('social_img', $post->ID);
                                    if ($social_img) :
                                        echo wp_get_attachment_image($social_img, 'full', false, ['class' => 'social_img']);
                                    endif;
                                    ?>
                        <?php
                                    $social_logo = get_field('social_logo', $post->ID);
                                    if ($social_logo) :
                                        echo wp_get_attachment_image($social_logo, 'full', false, ['class' => 'social_logo']);
                                    endif;
                                    ?>
                    </div>

                    <div class="review__header">
                        <?php
                                    $avatar = get_field('avatar_mem', $post->ID);
                                    if ($avatar) :
                                        echo wp_get_attachment_image($avatar, 'full', false, ['class' => 'avatar']);
                                    endif;
                                    ?>
                        <div class="review__header__info">
                            <p class="name"><?php echo get_the_title($post->ID); ?></p>
                            <p class="role"><?php the_field('role_mem', $post->ID); ?></p>
                        </div>
                    </div>

                    <p class="content">
                        <?php the_field('content_rv', $post->ID); ?>
                    </p>

                    <div class="learn-more-wrapper">
                        <a class="learn-more" href="#">
                            <span>Tìm hiểu thêm</span>
                            <div class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="7" height="12" viewBox="0 0 7 12"
                                    fill="none">
                                    <path d="M1.45703 1.63086L5.8847 6.10825L1.45703 10.4862" stroke="white"
                                        stroke-width="1.5" stroke-linecap="round" />
                                </svg>
                            </div>
                        </a>
                    </div>
                </div>
                <?php endforeach;
                        wp_reset_postdata(); ?>
            </div>
        </div>
        <?php endif; ?>
        <?php if (!empty($data['items'])) : ?>
        <div class="marquue__container marquue__container-3 swiper">
            <div class="swiper-wrapper">
                <?php foreach ($data['items'] as $post) : setup_postdata($post); ?>
                <div class="review__item swiper-slide">
                    <img src="/wp-content/uploads/2025/07/Vector.svg" alt="" class="rate__icon">

                    <div class="img-wrapper">
                        <?php
                                    $social_img = get_field('social_img', $post->ID);
                                    if ($social_img) :
                                        echo wp_get_attachment_image($social_img, 'full', false, ['class' => 'social_img']);
                                    endif;
                                    ?>
                        <?php
                                    $social_logo = get_field('social_logo', $post->ID);
                                    if ($social_logo) :
                                        echo wp_get_attachment_image($social_logo, 'full', false, ['class' => 'social_logo']);
                                    endif;
                                    ?>
                    </div>

                    <div class="review__header">
                        <?php
                                    $avatar = get_field('avatar_mem', $post->ID);
                                    if ($avatar) :
                                        echo wp_get_attachment_image($avatar, 'full', false, ['class' => 'avatar']);
                                    endif;
                                    ?>
                        <div class="review__header__info">
                            <p class="name"><?php echo get_the_title($post->ID); ?></p>
                            <p class="role"><?php the_field('role_mem', $post->ID); ?></p>
                        </div>
                    </div>

                    <p class="content">
                        <?php the_field('content_rv', $post->ID); ?>
                    </p>

                    <div class="learn-more-wrapper">
                        <a class="learn-more" href="#">
                            <span>Tìm hiểu thêm</span>
                            <div class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="7" height="12" viewBox="0 0 7 12"
                                    fill="none">
                                    <path d="M1.45703 1.63086L5.8847 6.10825L1.45703 10.4862" stroke="white"
                                        stroke-width="1.5" stroke-linecap="round" />
                                </svg>
                            </div>
                        </a>
                    </div>
                </div>
                <?php endforeach;
                        wp_reset_postdata(); ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
    <?= wp_get_attachment_image(2420, 'full', false, ['class' => 'section-appreciate__deco']); ?>
    <?php else: ?>
    <div class="section-appreciate__content-mb">
        <?php if (!empty($data['items'])) : ?>
        <div class="marquue__container marquue__container-mb-1 swiper">
            <div class="swiper-wrapper">
                <?php foreach ($data['items'] as $post) : setup_postdata($post); ?>
                <div class="review__item swiper-slide">
                    <img src="/wp-content/uploads/2025/07/Vector.svg" alt="" class="rate__icon">

                    <div class="img-wrapper">
                        <?php
                                    $social_img = get_field('social_img', $post->ID);
                                    if ($social_img) :
                                        echo wp_get_attachment_image($social_img, 'full', false, ['class' => 'social_img']);
                                    endif;
                                    ?>
                        <?php
                                    $social_logo = get_field('social_logo', $post->ID);
                                    if ($social_logo) :
                                        echo wp_get_attachment_image($social_logo, 'full', false, ['class' => 'social_logo']);
                                    endif;
                                    ?>
                    </div>

                    <div class="review__header">
                        <?php
                                    $avatar = get_field('avatar_mem', $post->ID);
                                    if ($avatar) :
                                        echo wp_get_attachment_image($avatar, 'full', false, ['class' => 'avatar']);
                                    endif;
                                    ?>
                        <div class="review__header__info">
                            <p class="name"><?php echo get_the_title($post->ID); ?></p>
                            <p class="role"><?php the_field('role_mem', $post->ID); ?></p>
                        </div>
                    </div>

                    <p class="content">
                        <?php the_field('content_rv', $post->ID); ?>
                    </p>

                    <div class="learn-more-wrapper">
                        <a class="learn-more" href="#">
                            <span>Tìm hiểu thêm</span>
                            <div class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="7" height="12" viewBox="0 0 7 12"
                                    fill="none">
                                    <path d="M1.45703 1.63086L5.8847 6.10825L1.45703 10.4862" stroke="white"
                                        stroke-width="1.5" stroke-linecap="round" />
                                </svg>
                            </div>
                        </a>
                    </div>
                </div>
                <?php endforeach;
                        wp_reset_postdata(); ?>
            </div>
        </div>
        <?php endif; ?>
        <?php if (!empty($data['items'])) : ?>
        <div class="marquue__container marquue__container-mb-2 swiper">
            <div class="swiper-wrapper">
                <?php foreach ($data['items'] as $post) : setup_postdata($post); ?>
                <div class="review__item swiper-slide">
                    <img src="/wp-content/uploads/2025/07/Vector.svg" alt="" class="rate__icon">

                    <div class="img-wrapper">
                        <?php
                                    $social_img = get_field('social_img', $post->ID);
                                    if ($social_img) :
                                        echo wp_get_attachment_image($social_img, 'full', false, ['class' => 'social_img']);
                                    endif;
                                    ?>
                        <?php
                                    $social_logo = get_field('social_logo', $post->ID);
                                    if ($social_logo) :
                                        echo wp_get_attachment_image($social_logo, 'full', false, ['class' => 'social_logo']);
                                    endif;
                                    ?>
                    </div>

                    <div class="review__header">
                        <?php
                                    $avatar = get_field('avatar_mem', $post->ID);
                                    if ($avatar) :
                                        echo wp_get_attachment_image($avatar, 'full', false, ['class' => 'avatar']);
                                    endif;
                                    ?>
                        <div class="review__header__info">
                            <p class="name"><?php echo get_the_title($post->ID); ?></p>
                            <p class="role"><?php the_field('role_mem', $post->ID); ?></p>
                        </div>
                    </div>

                    <p class="content">
                        <?php the_field('content_rv', $post->ID); ?>
                    </p>

                    <div class="learn-more-wrapper">
                        <a class="learn-more" href="#">
                            <span>Tìm hiểu thêm</span>
                            <div class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="7" height="12" viewBox="0 0 7 12"
                                    fill="none">
                                    <path d="M1.45703 1.63086L5.8847 6.10825L1.45703 10.4862" stroke="white"
                                        stroke-width="1.5" stroke-linecap="round" />
                                </svg>
                            </div>
                        </a>
                    </div>
                </div>
                <?php endforeach;
                        wp_reset_postdata(); ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
    <?php endif; ?>
</section>