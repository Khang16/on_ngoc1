<?php

/**
 * Featured Content Component
 * Displays main video and related videos in a tabbed interface
 */

// Get current term and featured video
$term_id = get_queried_object_id();
$featured_video = get_field('listening_practice_video', 'term_' . $term_id);

// Early return if no featured video
if (!$featured_video) {
    return;
}

// Helper functions
function get_video_thumbnail_url($post_id, $size = 'full')
{
    $thumbnail_url = get_the_post_thumbnail_url($post_id, $size);
    if ($thumbnail_url) {
        return $thumbnail_url;
    }

    // Fallback to default placeholder
    return get_template_directory_uri() . '/assets/images/placeholder.svg?height=60&width=80';
}

function get_video_category($post_id)
{
    $terms = get_the_terms($post_id, 'categories-youtube');
    return $terms ? $terms[0]->name : '';
}

function get_video_duration($post_id)
{
    return get_post_meta($post_id, '_youtube_video_duration', true) ?: '00:00';
}

function render_video_item($post_id, $is_featured = false)
{
    $youtube_link = get_field('youtube_video_link', $post_id);
    $thumbnail = get_video_thumbnail_url($post_id);
    $title = get_the_title($post_id);
    $category = get_video_category($post_id);
    $duration = get_video_duration($post_id);

    // Get excerpt properly
    $post = get_post($post_id);
    $excerpt = $post->post_excerpt ?: wp_trim_words($post->post_content, 20, '...');

?>
<li class="featured-content__video-item <?= $is_featured ? 'selected' : '' ?>"
    data-link="<?= esc_attr($youtube_link) ?>" data-id="<?= esc_attr($post_id) ?>" data-title="<?= esc_attr($title) ?>"
    data-duration="<?= esc_attr($duration) ?>" data-category="<?= esc_attr($category) ?>"
    data-thumbnail="<?= esc_url($thumbnail) ?>" data-excerpt="<?= esc_attr($excerpt) ?>">

    <div class="featured-content__video-thumb-sm-wrapper">
        <?= get_the_post_thumbnail($post_id, 'full', ['class' => 'featured-content__video-thumb-sm']) ?>
        <span class="featured-content__duration"><?= esc_html($duration) ?></span>
    </div>
    <div class="featured-content__video-text">
        <span class="featured-content__category"><?= esc_html($category) ?></span>
        <p class="featured-content__video-title-sm"><?= esc_html($title) ?></p>
    </div>
</li>
<?php
}

function get_related_videos($exclude_post_id)
{
    $args = [
        'post_type' => 'youtube-video',
        'posts_per_page' => -1,
        'post__not_in' => [$exclude_post_id],
        'orderby' => 'date',
        'order' => 'DESC',
    ];

    $related_terms = get_the_terms($exclude_post_id, 'categories-youtube');
    if ($related_terms) {
        $args['tax_query'] = [
            [
                'taxonomy' => 'categories-youtube',
                'field' => 'term_id',
                'terms' => $related_terms[0]->term_id,
            ],
        ];
    }
    return new WP_Query($args);
}

function get_latest_videos($exclude_post_id = null)
{
    $args = [
        'post_type' => 'youtube-video',
        'posts_per_page' => -1,
        'orderby' => 'date',
        'order' => 'DESC',
    ];

    // Exclude featured video if provided
    if ($exclude_post_id) {
        $args['post__not_in'] = [$exclude_post_id];
    }

    return new WP_Query($args);
}

?>

<section class="featured-section">
    <?= wp_get_attachment_image(883, 'full', false, ['class' => 'featured-content__bg']) ?>
    <div class="featured-content">
        <h2 class="featured-content__title">Nội Dung Nổi Bật</h2>

        <div class="featured-content__layout">
            <!-- Main Video Section -->
            <div class="featured-content__video">
                <div class="featured-content__video-wrapper"
                    data-link="<?= esc_attr(get_field('youtube_video_link', $featured_video->ID)) ?>">

                    <!-- Video Thumbnail with Play Button -->
                    <div class="featured-content__video-thumb" id="video-trigger">
                        <?= get_the_post_thumbnail($featured_video->ID, 'full', ['class' => 'featured-content__poster']) ?>
                        <button class="featured-content__play-button">
                            <?= wp_get_attachment_image(885, 'full', false) ?>
                        </button>
                        <a href="<?= esc_attr(get_field('youtube_video_link', $featured_video->ID)) ?>" target="_blank"
                            class="featured-content__play-caption">Truy cập Video trên Youtube của ONBU</a>
                    </div>

                    <!-- Video Information -->
                    <a href="<?= esc_attr(get_field('youtube_video_link', $featured_video->ID)) ?>" target="_blank"
                        class="featured-content__video-info">
                        <?= get_the_post_thumbnail($featured_video->ID, 'full', ['class' => 'featured-content__avatar']) ?>

                        <div class="featured-content__meta">
                            <p class="featured-content__video-title">
                                <?= esc_html($featured_video->post_title) ?>
                            </p>
                            <p class="featured-content__video-desc">
                                <?= esc_html($featured_video->post_excerpt) ?>
                            </p>
                        </div>

                        <?= wp_get_attachment_image(884, 'full', false, ['class' => 'featured-content__yt-icon']) ?>
                    </a>
                </div>
            </div>

            <!-- Sidebar with Tabs and Video List -->
            <div class="featured-content__sidebar">
                <!-- Tab Navigation -->
                <div class="featured-content__tabs-header">
                    <h3 class="featured-content__tabs-title">Video có nội dung tương tự</h3>
                    <p class="featured-content__tabs-desc">
                        Nội dung được đề xuất dựa trên video cùng chủ đề tiếng Trung
                    </p>
                </div>
                <div class="featured-content__tabs">
                    <button class="tab-button active" data-tab="related">Liên quan</button>
                    <button class="tab-button" data-tab="latest">Mới nhất</button>
                </div>

                <!-- Video List -->
                <ul class="featured-content__video-list" id="related-video-list">
                    <?php
                    render_video_item($featured_video->ID, true);
                    $related_videos = get_related_videos($featured_video->ID);
                    if ($related_videos->have_posts()) :
                        while ($related_videos->have_posts()) :
                            $related_videos->the_post();
                            render_video_item(get_the_ID());
                        endwhile;
                        wp_reset_postdata();
                    endif;
                    ?>
                </ul>
                <ul class="featured-content__video-list" id="latest-video-list">
                    <?php
                    $latest_videos = get_latest_videos($featured_video->ID);
                    if ($latest_videos->have_posts()) :
                        while ($latest_videos->have_posts()) :
                            $latest_videos->the_post();
                            render_video_item(get_the_ID());
                        endwhile;
                        wp_reset_postdata();
                    endif;
                    ?>
                </ul>
            </div>
        </div>
    </div>
</section>