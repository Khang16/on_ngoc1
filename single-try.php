<?php
/**
 * Template for single try post
 * File: single-try.php
 */

get_header(); ?>

<main class="main-content single-try">
    <div class="container">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('try-single-post'); ?>>
                    
                    <!-- Header Section -->
                    <header class="try-header">
                        <div class="breadcrumb">
                            <a href="<?php echo home_url(); ?>">Trang chủ</a>
                            <span>/</span>
                            <a href="<?php echo get_post_type_archive_link('try'); ?>">Try</a>
                            <span>/</span>
                            <span><?php the_title(); ?></span>
                        </div>
                        
                        <h1 class="try-title"><?php the_title(); ?></h1>
                        
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="try-featured-image">
                                <?php the_post_thumbnail('large'); ?>
                            </div>
                        <?php endif; ?>
                        
                        <div class="try-meta">
                            <div class="try-date">
                                <i class="icon-calendar"></i>
                                <?php echo get_the_date(); ?>
                            </div>
                            
                            <?php 
                            $categories = get_the_terms(get_the_ID(), 'try-categories');
                            if ($categories && !is_wp_error($categories)) : ?>
                                <div class="try-categories">
                                    <i class="icon-folder"></i>
                                    <?php foreach ($categories as $category) : ?>
                                        <a href="<?php echo get_term_link($category); ?>" class="category-link">
                                            <?php echo $category->name; ?>
                                        </a>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </header>
                    
                    <!-- Content Section -->
                    <div class="try-content">
                        <?php the_content(); ?>
                    </div>
                    
                    <!-- Custom Fields Section -->
                    <?php if (function_exists('get_field')) : ?>
                        <div class="try-custom-fields">
                            <?php 
                            $featured_video = get_field('featured_video');
                            $duration = get_field('duration');
                            $difficulty = get_field('difficulty');
                            $tags = get_field('tags');
                            ?>
                            
                            <?php if ($featured_video) : ?>
                                <div class="try-video">
                                    <h3>Video hướng dẫn</h3>
                                    <div class="video-wrapper">
                                        <?php echo $featured_video; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                            
                            <?php if ($duration || $difficulty || $tags) : ?>
                                <div class="try-details">
                                    <h3>Chi tiết</h3>
                                    <div class="details-grid">
                                        <?php if ($duration) : ?>
                                            <div class="detail-item">
                                                <span class="label">Thời lượng:</span>
                                                <span class="value"><?php echo $duration; ?></span>
                                            </div>
                                        <?php endif; ?>
                                        
                                        <?php if ($difficulty) : ?>
                                            <div class="detail-item">
                                                <span class="label">Độ khó:</span>
                                                <span class="value difficulty-<?php echo strtolower($difficulty); ?>">
                                                    <?php echo $difficulty; ?>
                                                </span>
                                            </div>
                                        <?php endif; ?>
                                        
                                        <?php if ($tags) : ?>
                                            <div class="detail-item">
                                                <span class="label">Tags:</span>
                                                <span class="value"><?php echo $tags; ?></span>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                    
                    <!-- Navigation Section -->
                    <nav class="try-navigation">
                        <div class="nav-links">
                            <?php
                            $prev_post = get_previous_post(true, '', 'try-categories');
                            $next_post = get_next_post(true, '', 'try-categories');
                            ?>
                            
                            <?php if ($prev_post) : ?>
                                <div class="nav-previous">
                                    <a href="<?php echo get_permalink($prev_post->ID); ?>" class="nav-link">
                                        <span class="nav-direction">← Bài trước</span>
                                        <span class="nav-title"><?php echo get_the_title($prev_post->ID); ?></span>
                                    </a>
                                </div>
                            <?php endif; ?>
                            
                            <?php if ($next_post) : ?>
                                <div class="nav-next">
                                    <a href="<?php echo get_permalink($next_post->ID); ?>" class="nav-link">
                                        <span class="nav-direction">Bài sau →</span>
                                        <span class="nav-title"><?php echo get_the_title($next_post->ID); ?></span>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </nav>
                    
                </article>
                
                <!-- Related Try Posts -->
                <?php
                $categories = get_the_terms(get_the_ID(), 'try-categories');
                if ($categories && !is_wp_error($categories)) {
                    $category_ids = wp_list_pluck($categories, 'term_id');
                    
                    $related_args = [
                        'post_type' => 'try',
                        'post_status' => 'publish',
                        'posts_per_page' => 3,
                        'post__not_in' => [get_the_ID()],
                        'tax_query' => [
                            [
                                'taxonomy' => 'try-categories',
                                'field' => 'term_id',
                                'terms' => $category_ids,
                                'operator' => 'IN'
                            ]
                        ]
                    ];
                    
                    $related_query = new WP_Query($related_args);
                    
                    if ($related_query->have_posts()) : ?>
                        <section class="related-try-posts">
                            <div class="container">
                                <h2>Bài liên quan</h2>
                                <div class="related-grid">
                                    <?php while ($related_query->have_posts()) : $related_query->the_post(); ?>
                                        <div class="related-item">
                                            <?php if (has_post_thumbnail()) : ?>
                                                <div class="related-image">
                                                    <a href="<?php the_permalink(); ?>">
                                                        <?php the_post_thumbnail('medium'); ?>
                                                    </a>
                                                </div>
                                            <?php endif; ?>
                                            
                                            <div class="related-content">
                                                <h3 class="related-title">
                                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                </h3>
                                                <div class="related-excerpt">
                                                    <?php echo wp_trim_words(get_the_excerpt(), 20); ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endwhile; ?>
                                </div>
                            </div>
                        </section>
                    <?php 
                    endif;
                    wp_reset_postdata();
                }
                ?>
                
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
</main>

<style>
.single-try {
    padding: 40px 0;
}

.try-single-post {
    max-width: 800px;
    margin: 0 auto;
}

.try-header {
    margin-bottom: 40px;
}

.breadcrumb {
    margin-bottom: 20px;
    font-size: 14px;
    color: #666;
}

.breadcrumb a {
    color: #007cba;
    text-decoration: none;
}

.breadcrumb span {
    margin: 0 10px;
}

.try-title {
    font-size: 32px;
    margin-bottom: 20px;
    line-height: 1.2;
}

.try-featured-image {
    margin-bottom: 20px;
}

.try-featured-image img {
    width: 100%;
    height: auto;
    border-radius: 8px;
}

.try-meta {
    display: flex;
    gap: 20px;
    margin-bottom: 30px;
    font-size: 14px;
    color: #666;
}

.try-categories a {
    color: #007cba;
    text-decoration: none;
    margin-right: 10px;
}

.try-content {
    font-size: 16px;
    line-height: 1.6;
    margin-bottom: 40px;
}

.try-custom-fields {
    margin-bottom: 40px;
}

.try-custom-fields h3 {
    margin-bottom: 15px;
    font-size: 20px;
}

.video-wrapper {
    position: relative;
    padding-bottom: 56.25%;
    height: 0;
    overflow: hidden;
}

.video-wrapper iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}

.details-grid {
    display: grid;
    gap: 15px;
}

.detail-item {
    display: flex;
    gap: 10px;
}

.detail-item .label {
    font-weight: bold;
    min-width: 100px;
}

.difficulty-easy { color: #4caf50; }
.difficulty-medium { color: #ff9800; }
.difficulty-hard { color: #f44336; }

.try-navigation {
    border-top: 1px solid #eee;
    padding-top: 30px;
    margin-bottom: 40px;
}

.nav-links {
    display: flex;
    justify-content: space-between;
}

.nav-link {
    display: block;
    text-decoration: none;
    padding: 15px;
    border: 1px solid #ddd;
    border-radius: 5px;
    max-width: 300px;
}

.nav-direction {
    display: block;
    font-size: 12px;
    color: #666;
    margin-bottom: 5px;
}

.nav-title {
    display: block;
    font-weight: bold;
}

.related-try-posts {
    background: #f9f9f9;
    padding: 40px 0;
    margin-top: 40px;
}

.related-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    margin-top: 20px;
}

.related-item {
    background: white;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.related-image img {
    width: 100%;
    height: 150px;
    object-fit: cover;
}

.related-content {
    padding: 15px;
}

.related-title a {
    color: #333;
    text-decoration: none;
    font-size: 16px;
    font-weight: bold;
}

.related-excerpt {
    margin-top: 10px;
    color: #666;
    font-size: 14px;
}

@media (max-width: 768px) {
    .try-meta {
        flex-direction: column;
        gap: 10px;
    }
    
    .nav-links {
        flex-direction: column;
        gap: 15px;
    }
    
    .related-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<?php get_footer(); ?>
