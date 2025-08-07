<?php
$introduction = get_field('introduction');
$image_1 = $introduction['image_1'];
$image_2 = $introduction['image_2'];
$image_3 = $introduction['image_3'];
$logo = $introduction['logo'];
$description = $introduction['description'];
$content = $introduction['content'];
$text = $introduction['text'];
$year = $introduction['year'];
?>

<section class="introduction-section">
    <div class="section-background">
        <div class="background-desktop">
            <?= wp_get_attachment_image(1862, 'full'); ?>
        </div>
        <div class="background-mobile">
            <?= wp_get_attachment_image(1863, 'full'); ?>
        </div>
    </div>
    <div class="container">
        <div class="introduction-wrapper">
            <!-- Images Gallery -->
            <div class="introduction-images">
                <div class="images-grid">
                    <div class="image-item image-main">
                        <div class="image-frame1">
                            <?php echo wp_get_attachment_image($image_1, 'full', false, [
                'class' => 'introduction-image'
              ]); ?>
                        </div>
                    </div>

                    <div class="image-item image-secondary">
                        <div class="image-frame2">
                            <?php echo wp_get_attachment_image($image_2, 'full', false, [
                'class' => 'introduction-image'
              ]); ?>
                        </div>
                    </div>

                    <div class="image-item image-tertiary">
                        <div class="image-frame3">
                            <?php echo wp_get_attachment_image($image_3, 'full', false, [
                'class' => 'introduction-image'
              ]); ?>
                        </div>
                    </div>
                </div>

                <div class="image-logo">
                    <?php echo wp_get_attachment_image($logo, 'full', false, [
            'class' => 'logo-image'
          ]); ?>
                </div>
                <!-- Text Content -->
                <div class="introduction-content">
                    <div class="introduction-description">
                        <?php echo wp_kses_post($description); ?>
                    </div>

                    <div class="introduction-detail">
                        <?php echo wp_kses_post($content); ?>
                    </div>
                </div>
                <div class="title-and-year">
                    <p class="introduction-title"><?php echo esc_html($text); ?></p>
                    <p class="introduction-year"><?php echo esc_html($year); ?></p>
                </div>
            </div>
            <div class="decoration-dot dot-1"></div>
            <div class="decoration-dot dot-2"></div>
            <div class="decoration-dot dot-3"></div>
            <div class="decoration-dot dot-4"></div>
        </div>
    </div>
</section>