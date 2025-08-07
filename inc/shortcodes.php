<?php
/**
 * Theme Shortcodes
 */

// Try Grid Shortcode
add_shortcode('try_grid', 'try_grid_shortcode');

function try_grid_shortcode($atts) {
    $atts = shortcode_atts([
        'category' => '', // Specific category slug
        'posts_per_page' => 12,
        'show_filters' => 'true',
        'show_search' => 'true'
    ], $atts);

    // Enqueue assets nếu chưa có
    wp_enqueue_style(
        'try-grid-styles', 
        get_template_directory_uri() . '/template-parts/try/grid-items/assets/styles.css',
        [],
        '1.0.0'
    );
    
    wp_enqueue_script(
        'try-grid-scripts', 
        get_template_directory_uri() . '/template-parts/try/grid-items/assets/scripts.js',
        ['jquery'],
        '1.0.0',
        true
    );
    
    wp_localize_script('try-grid-scripts', 'tryAjax', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('try_ajax_nonce')
    ));

    ob_start();
    
    // Set global query vars for template
    global $wp_query;
    $original_query = $wp_query;
    
    $args = [
        'post_type' => 'try',
        'post_status' => 'publish',
        'posts_per_page' => intval($atts['posts_per_page'])
    ];
    
    if (!empty($atts['category'])) {
        $args['tax_query'] = [
            [
                'taxonomy' => 'try-categories',
                'field' => 'slug',
                'terms' => $atts['category']
            ]
        ];
    }
    
    $wp_query = new WP_Query($args);
    
    // Pass shortcode attributes to template
    set_query_var('shortcode_atts', $atts);
    
    // Include template
    include locate_template('template-parts/try/grid-items/index.php');
    
    // Restore original query
    $wp_query = $original_query;
    wp_reset_postdata();
    
    return ob_get_clean();
}

// Try Categories List Shortcode
add_shortcode('try_categories', 'try_categories_shortcode');

function try_categories_shortcode($atts) {
    $atts = shortcode_atts([
        'show_count' => 'false',
        'parent' => 0,
        'hide_empty' => 'true'
    ], $atts);

    $categories = get_terms([
        'taxonomy' => 'try-categories',
        'hide_empty' => filter_var($atts['hide_empty'], FILTER_VALIDATE_BOOLEAN),
        'parent' => intval($atts['parent'])
    ]);

    if (empty($categories) || is_wp_error($categories)) {
        return '<p>Không có danh mục nào.</p>';
    }

    $output = '<ul class="try-categories-list">';
    
    foreach ($categories as $category) {
        $count = filter_var($atts['show_count'], FILTER_VALIDATE_BOOLEAN) 
                ? ' (' . $category->count . ')' 
                : '';
        
        $output .= sprintf(
            '<li><a href="%s">%s%s</a></li>',
            get_term_link($category),
            $category->name,
            $count
        );
    }
    
    $output .= '</ul>';
    
    return $output;
}