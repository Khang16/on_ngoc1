<?php
$about_us_banner = get_field('about_us_banner');
$about_us_about_us = get_field('about_us_about_us');
?>
<section class="new-language-section">
	<?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
    <div class="container">
        <div class="new-language-content">
            <h2 class="section-title">
                <?php echo $about_us_banner['title']; ?>
            </h2>
            <div class="section-text text-pc-18-bo">
                <?php echo $about_us_banner['description']; ?>
            </div>

            <div class="image-container">
                <div class="section-image">
                    <?php echo wp_get_attachment_image(wp_is_mobile() ? $about_us_banner['image_mobile'] : $about_us_banner['image_desktop'], 'full'); ?>
                </div>
            </div>

            <div class="section-text1">
                <?php echo $about_us_about_us['title']; ?>
            </div>

            <!-- Desktop Description -->
            <div class="section-description">
                <?php echo $about_us_about_us['description']; ?>
            </div>

            <div class="stats-grid">
                <?php if (!empty($about_us_about_us['number_of_student'])): ?>
                <div class="stat-item1">
                    <div class="stat-number">
                        <?php echo $about_us_about_us['number_of_student']['number']; ?>
                        <?php if (!empty($about_us_about_us['number_of_student']['suffix'])): ?><span
                            class="suffix"><?php echo esc_html($about_us_about_us['number_of_student']['suffix']); ?></span><?php endif; ?>
                    </div>
                    <?php if (!empty($about_us_about_us['number_of_student']['content'])): ?>
                    <div class="stat-content">
                        <?php echo esc_html($about_us_about_us['number_of_student']['content']); ?>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endif; ?>

                <?php if (!empty($about_us_about_us['experience'])): ?>
                <div class="stat-item2">
                    <div class="stat-number">
                        <?php echo esc_html($about_us_about_us['experience']['number']); ?>
                        <?php if (!empty($about_us_about_us['experience']['suffix'])): ?><span
                            class="suffix"><?php echo esc_html($about_us_about_us['experience']['suffix']); ?></span><?php endif; ?>
                    </div>
                    <?php if (!empty($about_us_about_us['experience']['content'])): ?>
                    <div class="stat-content">
                        <?php echo esc_html($about_us_about_us['experience']['content']); ?>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endif; ?>

                <?php if (!empty($about_us_about_us['certificate'])): ?>
                <div class="stat-item3">
                    <div class="stat-number">
                        <?php echo esc_html($about_us_about_us['certificate']['number']); ?>
                        <?php if (!empty($about_us_about_us['certificate']['suffix'])): ?><span
                            class="suffix"><?php echo esc_html($about_us_about_us['certificate']['suffix']); ?></span><?php endif; ?>
                    </div>
                    <?php if (!empty($about_us_about_us['certificate']['content'])): ?>
                    <div class="stat-content">
                        <?php echo esc_html($about_us_about_us['certificate']['content']); ?>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </div>

            <!-- Desktop Background -->
            <div class="bg-container bg-desktop">
                <?= wp_get_attachment_image(1805, 'full', false, ['class' => 'section-bg-img']); ?>
            </div>

            <!-- Mobile Background -->
            <div class="bg-container bg-mobile">
                <?= wp_get_attachment_image(1804, 'full', false, ['class' => 'section-bg-img']); ?>
            </div>
        </div>
    </div>
</section>