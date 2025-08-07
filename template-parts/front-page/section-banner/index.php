<?php
$homepage_banner = get_field('homepage_banner');
?>

<section class="main-banner">
    <div class="main-banner__container">
        <div class="swiper main-banner__swiper">
            <div class="swiper-wrapper">
                <?php if (!empty($homepage_banner)) : ?>
                <?php foreach ($homepage_banner as $banner) :
                        $background = wp_is_mobile() && !empty($banner['background_mb']) ? $banner['background_mb'] : $banner['background'];
                        $content = !empty($banner['content']) ? $banner['content'] : '';
                        $link = !empty($banner['link']) ? $banner['link'] : [];
                        $link_title = !empty($link['title']) ? $link['title'] : '';
                        $link_url = !empty($link['url']) ? $link['url'] : '';
                        $link_target = !empty($link['target']) ? $link['target'] : '_self';
                        $post = !empty($banner['post']) ? $banner['post'] : null;
                    ?>
                <div class="swiper-slide main-banner__slide">
                    <?php if (!empty($background)) : ?>
                    <?= wp_get_attachment_image($background, 'full', false, [
                                    'class' => 'main-banner__background',
                                ]) ?>
                    <?php endif; ?>
                    <div class="main-banner__background-deco-rectangle">
                    </div>
                    <div class="main-banner__background-deco-ellipse">
                    </div>
                    <div class="main-banner__content-wrapper">
                        <?php if (!empty($content)) : ?>
                        <div class="main-banner__text">
                            <?= wp_kses_post($content); ?>
                        </div>
                        <?php endif; ?>

                        <?php if (!empty($link_url) && !empty($link_title)) : ?>
                        <a href="<?= esc_url($link_url); ?>" target="<?= esc_attr($link_target); ?>"
                            class="main-banner__button">
                            <span class="main-banner__button-text"> <?= esc_html($link_title); ?></span>
                            <span class="main-banner__button-icon"><?= wp_get_attachment_image(87) ?></span>
                        </a>
                        <?php endif; ?>
                    </div>

                    <?php if (!empty($post) && is_a($post, 'WP_Post')) : ?>
                    <div style="--icon: url('<?= wp_get_attachment_image_url(85) ?>');" class="main-banner__post">
                        <a href="<?= get_permalink($post->ID); ?>" class="main-banner__post-link">
                            <?= get_the_post_thumbnail($post->ID, 'full', [
                                            'class' => 'main-banner__post-thumbnail',
                                        ]); ?>
                            <div class="main-banner__post-content">
                                <span class="main-banner__post-label">Khóa học</span>
                                <h3 class="main-banner__post-title">
                                    <?= esc_html(get_the_title($post->ID)); ?>
                                </h3>
                                <p class="main-banner__post-excerpt">
                                    <?= esc_html(get_the_excerpt($post->ID)); ?>
                                </p>
                            </div>
                        </a>
                    </div>
                    <?php endif; ?>
                </div>
                <?php wp_reset_postdata();
                    endforeach; ?>
                <?php endif; ?>
            </div>

            <div style="--icon: url('<?= wp_get_attachment_image_url(175) ?>');
            --icon-active: url('<?= wp_get_attachment_image_url(176) ?>');"
                class="swiper-pagination main-banner__pagination">
            </div>
            <div style="--icon: url('<?= wp_get_attachment_image_url(157) ?>');"
                class="swiper-button-prev main-banner__prev"></div>
            <div style="--icon: url('<?= wp_get_attachment_image_url(157) ?>');"
                class="swiper-button-next main-banner__next"></div>
        </div>
        <div class="main-banner__container--deco">
            <?php if (wp_is_mobile()): ?>
            <svg xmlns="http://www.w3.org/2000/svg" width="376" height="29" viewBox="0 0 376 29" fill="none">
                <path
                    d="M0.412109 0.585938C0.412109 0.585938 83.9121 17.4216 187.912 17.4216C291.912 17.4216 375.412 0.585938 375.412 0.585938V28.5664H0.412109V0.585938Z"
                    fill="white" />
            </svg>
            <?php else: ?>
            <svg xmlns="http://www.w3.org/2000/svg" width="1600" height="44" viewBox="0 0 1600 44" fill="none">
                <path
                    d="M-105.828 0.698242C108.932 25.26 421.634 40.7278 769.771 40.7278C1117.91 40.7278 1430.61 25.2601 1645.37 0.698275V56.8414L-105.828 56.8414V0.698242Z"
                    fill="white" />
            </svg>
            <?php endif; ?>
        </div>
    </div>
</section>