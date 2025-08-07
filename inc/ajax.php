<?php
/**
 * AJAX Handlers
 */

// Try Grid Filter Handler
add_action('wp_ajax_try_grid_filter', 'handle_try_grid_filter');
add_action('wp_ajax_nopriv_try_grid_filter', 'handle_try_grid_filter');

function handle_try_grid_filter() {
    // Verify nonce
    if (!wp_verify_nonce($_POST['nonce'], 'try_ajax_nonce')) {
        wp_die('Security check failed');
    }

    $category = sanitize_text_field($_POST['category'] ?? '');
    $search = sanitize_text_field($_POST['search'] ?? '');
    $page = intval($_POST['page'] ?? 1);
    $posts_per_page = 12;

    $args = [
        'post_type' => 'try',
        'post_status' => 'publish',
        'posts_per_page' => $posts_per_page,
        'paged' => $page
    ];

    // Add search
    if (!empty($search)) {
        $args['s'] = $search;
    }

    // Add category filter
    if (!empty($category) && $category !== 'all') {
        $args['tax_query'] = [
            [
                'taxonomy' => 'try-categories',
                'field' => 'slug',
                'terms' => $category
            ]
        ];
    }

    $query = new WP_Query($args);
    
    ob_start();
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            include locate_template('template-parts/try/grid-items/item-loop.php');
        }
        wp_reset_postdata();
    } else {
        echo '<div class="no-results">Không tìm thấy kết quả nào.</div>';
    }
    $content = ob_get_clean();

    // Pagination
    $pagination = '';
    if ($query->max_num_pages > 1) {
        $pagination = '<div class="pagination">';
        for ($i = 1; $i <= $query->max_num_pages; $i++) {
            $active = ($i == $page) ? ' active' : '';
            $pagination .= '<button class="page-btn' . $active . '" data-page="' . $i . '">' . $i . '</button>';
        }
        $pagination .= '</div>';
    }

    wp_send_json_success([
        'content' => $content,
        'pagination' => $pagination,
        'found_posts' => $query->found_posts,
        'max_pages' => $query->max_num_pages
    ]);
}