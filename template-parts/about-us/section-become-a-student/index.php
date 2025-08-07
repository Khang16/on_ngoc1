<?php
$become_a_student = get_field('become_a_student');
$vision = $become_a_student['vision'];
$vision_title = $vision['title'];
$vision_description = $vision['description'];
$vision_image_desktop = $vision['image_desktop'];
$vision_image_mobile = $vision['image_mobile'];

$mission = $become_a_student['mission'];
$mission_title = $mission['title'];
$mission_description = $mission['description'];
$mission_image_desktop = $mission['image_desktop'];
$mission_image_mobile = $mission['image_mobile'];

$video_title = $become_a_student['video_title'];
$video = $become_a_student['video'];
?>

<section class="become-student-section">
    <div class="student-background">

        <!-- Desktop Images -->
        <?php echo wp_get_attachment_image($vision_image_desktop, 'full', false, ['class' => 'main-image desktop-image active', 'data-tab' => 'vision']); ?>

        <?php echo wp_get_attachment_image($mission_image_desktop, 'full', false, ['class' => 'main-image desktop-image', 'data-tab' => 'mission']); ?>

        <!-- Mobile Images -->
        <?php echo wp_get_attachment_image($vision_image_mobile, 'full', false, ['class' => 'main-image mobile-image active', 'data-tab' => 'vision']); ?>

        <?php echo wp_get_attachment_image($mission_image_mobile, 'full', false, ['class' => 'main-image mobile-image', 'data-tab' => 'mission']); ?>

        <div class="overlay"></div>

        <div class="student-overlay-content">
            <!-- Tabs -->
            <div>
                <div class="tab-buttons">
                    <button class="tab-button active" data-tab="vision"><?php echo esc_html($vision_title); ?></button>
                    <button class="tab-button" data-tab="mission"><?php echo esc_html($mission_title); ?></button>
                </div>

                <div class="tab-content">
                    <div class="tab-panel active" id="vision">
                        <?php echo wp_kses_post($vision_description); ?>
                    </div>
                    <div class="tab-panel" id="mission">
                        <?php echo wp_kses_post($mission_description); ?>
                    </div>
                </div>
            </div>

        </div>
        <div class="contain-video">
            <div class="why-choose">
                <?php echo esc_html($video_title); ?>
            </div>
            <div class="video-become-student">
                <video autoplay muted loop preload="auto">
                    <source src="<?php echo esc_url($video['url']); ?>" type="video/mp4">
                    <p>Trình duyệt của bạn không hỗ trợ video HTML5.</p>
                </video>
                <div class="video-controls">
                    <a data-fancybox data-src="<?= $video['url'] ?>" class="video-play-pause-btn">
                        <?php echo wp_get_attachment_image(wp_is_mobile() ? 2295 : 2294, 'full', false, ['class' => 'pause-icon']); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>