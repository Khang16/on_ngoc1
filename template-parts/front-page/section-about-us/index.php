<?php
$homepage_about_us = get_field('homepage_about_us');

$image_id = $homepage_about_us['image'] ?? '';
$type = $homepage_about_us['type'] ?? 'upload';
$media = $homepage_about_us[$type] ?? '';

$content = $homepage_about_us['content'] ?? '';

$link = $homepage_about_us['link'] ?? [];
$link_title = $link['title'] ?? '';
$link_url = $link['url'] ?? '';
$link_target = $link['target'] ?? '_self';

$is_youtube = ($type === 'youtube' && !empty($media));
$is_upload = ($type === 'upload' && !empty($media));

function get_youtube_video_id($url)
{
    $pattern =
        '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/|youtube\.com/shorts/)([^\s&?/]+)%';
    if (preg_match($pattern, $url, $matches)) {
        return $matches[1];
    }
    return false;
}


?>

<section class="about-us">
    <div class="about-us__container">
        <div class="about-us__left-deco-bounce">
            <span>Cuộn để khám phá</span>
            <svg xmlns="http://www.w3.org/2000/svg" width="88" height="148" viewBox="0 0 22 37" fill="none">
                <rect x="0.078125" width="21.6674" height="36.668" rx="10.8337" fill="url(#paint0_linear_551_17036)" />
                <rect x="1.74414" y="1.66724" width="18.334" height="33.3345" rx="9.16699" fill="white" />
                <!-- Animated inner dot -->
                <rect x="8.82812" y="5.10181" width="4.16681" height="4.16681" rx="2.08341" fill="#5B378F"
                    class="bounce-dot" />
                <rect x="8.82812" y="5.10181" width="4.16681" height="4.16681" rx="2.08341"
                    fill="url(#paint1_linear_551_17036)" class="bounce-dot" />
                <defs>
                    <linearGradient id="paint0_linear_551_17036" x1="10.9118" y1="0" x2="10.9118" y2="36.668"
                        gradientUnits="userSpaceOnUse">
                        <stop stop-color="#2CBDBE" />
                        <stop offset="1" stop-color="white" />
                    </linearGradient>
                    <linearGradient id="paint1_linear_551_17036" x1="10.9115" y1="5.10181" x2="10.9115" y2="9.26862"
                        gradientUnits="userSpaceOnUse">
                        <stop stop-color="#2CBDBE" />
                        <stop offset="1" stop-color="white" />
                    </linearGradient>
                </defs>
            </svg>
        </div>
        <div class="about-us__left">
            <div class="about-us__content">
                <?= wp_kses_post($content); ?>
            </div>

            <?php if ($link_url && $link_title): ?>
            <div class="about-us__button-wrapper">
                <a href="<?= esc_url($link_url); ?>" target="<?= esc_attr($link_target); ?>"
                    class="main-banner__button">
                    <span class="main-banner__button-text"> <?= esc_html($link_title); ?></span>
                    <span class="main-banner__button-icon"><?= wp_get_attachment_image(87) ?></span>
                </a>
            </div>
            <?php endif; ?>
        </div>

        <div class="about-us__right">
            <?php if ($image_id): ?>
            <?= wp_get_attachment_image($image_id, 'large', false, [
                    'class' => 'about-us__image',
                ]); ?>
            <?php endif; ?>

            <div class="about-us__video-wrapper">
                <?php if ($is_youtube || $is_upload): ?>
                <?php
                    $fancybox_id = 'about-us-video-popup';
                    $video_embed = $is_youtube
                        ? $media  // URL YouTube đầy đủ, không cần nhúng thủ công nữa
                        : $media;

                    $thumbnail = $image_id
                        ? wp_get_attachment_image($image_id, 'medium', false, ['class' => 'about-us__image'])
                        : '<div class="about-us__image about-us__image--placeholder"></div>';
                    ?>
                <a data-fancybox data-src="<?= $media ?>" class="about-us__video-trigger">
                    <?= wp_get_attachment_image(188) ?>
                    <span>Tìm hiểu về chúng tôi</span>
                </a>
                <div id="<?= esc_attr($fancybox_id); ?>" class="about-us__video-container">
                    <?php if ($is_youtube): ?>
                    <div class="plyr__video-embed" id="about-us-player">
                        <div id="player" data-plyr-provider="youtube"
                            data-plyr-embed-id="<?= get_youtube_video_id($video_embed); ?>"></div>
                    </div>
                    <?php else: ?>
                    <video id="player" class="about-us__video" autoplay muted playsinline>
                        <source src="<?= esc_url($media); ?>" type="video/mp4">
                        <?= esc_html__('Trình duyệt của bạn không hỗ trợ video.', 'text-domain'); ?>
                    </video>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>