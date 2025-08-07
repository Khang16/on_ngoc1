<?php
add_action('rest_api_init', function () {
    register_rest_route('api/v1', '/get-course-by-category/', array(
        'methods' => 'GET',
        'callback' => 'get_course_by_cate',
        'permission_callback' => '__return_true',
    ));
});

add_action('rest_api_init', function () {
    register_rest_route('api/v1', '/get-news-by-category/', array(
        'methods' => 'GET',
        'callback' => 'get_news_by_cate',
        'permission_callback' => '__return_true',
    ));
});


function get_course_by_cate($request)
{
    $cate_slug = $request->get_param('category');

    if (empty($cate_slug)) {
        return new WP_Error('no_cate', 'Missing category parameter', array('status' => 400));
    }

    $args = array(
        'post_type' => 'course',
        'posts_per_page' => 5,
        'post_status' => 'publish',
        'orderby' => 'ID',
        'order' => 'desc',
        'tax_query' => array(
            array(
                'taxonomy' => 'category-course',
                'field' => 'slug',
                'terms' => $cate_slug,
            ),
        ),
    );

    $query = new WP_Query($args);

    $results = [];

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $post_id = get_the_ID();

            // get all acf fields for the course post type
            $target = get_field('target', $post_id);
            $destine = get_field('destine', $post_id);
            $level = get_field('level', $post_id);
            $image_thumb = get_field('image_thumb', $post_id);
            // get url img from id
            if (!empty($image_thumb) && is_numeric($image_thumb)) {
                $image_thumb = wp_get_attachment_url($image_thumb);
            } else {
                $image_thumb = '';
            }

            $discount_title = get_field('discount_title', $post_id);
            $discount_note = get_field('discount_note', $post_id);

            $results[] = array(
                'title'     => get_the_title(),
                'slug'      => get_post_field('post_name', $post_id),
                'thumbnail' => get_the_post_thumbnail_url($post_id, 'full'),
                'excerpt'   => get_the_excerpt(),
                'target'    => $target,
                'destine'   => $destine,
                'level'     => $level,
                'image_thumb' => $image_thumb,
                'discount_title' => $discount_title,
                'discount_note' => $discount_note,
            );
        }
        wp_reset_postdata();
    }
    return rest_ensure_response($results);
}


function get_news_by_cate($request) {
    $cate_slug = $request->get_param('category');

    if (empty($cate_slug)) {
        return new WP_Error('no_cate', 'Missing category parameter', array('status' => 400));
    }

    $args = array(
        'post_type' => 'post',
        'posts_per_page' => 7,
        'post_status' => 'publish',
		'orderby' => 'ID',
    	'order' => 'desc', 
        'tax_query' => array(
            array(
                'taxonomy' => 'category',
                'field' => 'slug',
                'terms' => $cate_slug,
            ),
        ),
    );

    $query = new WP_Query($args);

    $results = [];

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $post_id = get_the_ID();

            $results[] = array(
                'title'     => get_the_title(),
                'slug'      => get_post_field('post_name', $post_id),
                'thumbnail' => get_the_post_thumbnail_url($post_id, 'full'),
				'date'      => get_the_date('d/m/Y', $post_id),
            );
        }
        wp_reset_postdata();
    }

    return rest_ensure_response($results);
}

// Register a custom REST API endpoint to retrieve all posts of a specific post type.
// Endpoint: /wp-json/api/v1/news/{category_slug}
// Method: GET
// This API supports various filters such as pagination, search,...
add_action('rest_api_init', function () {
	register_rest_route('api/v1', '/news/(?P<category_slug>[a-zA-Z0-9-_]+)', [
		'methods' => 'GET',
		'callback' => 'get_news_by_category_slug',
		'permission_callback' => '__return_true',
	]);
});

/**
 * Callback for retrieving news posts by category slug
 * 
 * Endpoint: /wp-json/api/v1/tin-tuc/{category_slug}
 * Query params:
 * - limit (int): Number of posts per page (default: 9)
 * - page (int): Page number (default: 1)
 * - search (string): Search keyword
 * - order (string): 'ASC' or 'DESC' (default: 'DESC')
 * - orderby (string): 'date', 'title', 'modified', etc.
 */
function get_news_by_category_slug(WP_REST_Request $request) {
	$category_slug = sanitize_text_field($request->get_param('category_slug'));

	// Parameters
	$limit    = (int) ($request->get_param('limit') ?? 9);
	$page     = (int) ($request->get_param('page') ?? 1);
	$search   = sanitize_text_field($request->get_param('search') ?? '');
	$order    = strtoupper($request->get_param('order') ?? 'DESC');
	$orderby  = sanitize_text_field($request->get_param('orderby') ?? 'date');

	$args = [
		'post_type'      => 'post',
		'posts_per_page' => $limit,
		'paged'          => $page,
		'order'          => $order,
		'category_name'  => $category_slug,
	];

	// Handle orderby: either core fields or meta
	$core_orderby = ['date', 'title', 'modified', 'ID', 'author', 'name', 'rand', 'comment_count'];
	if (in_array($orderby, $core_orderby)) {
		$args['orderby'] = ($orderby === 'ID') ? 'ID' : $orderby;
	} else {
		$args['meta_key'] = $orderby;
		$args['orderby'] = 'meta_value';
	}

	if (!empty($search)) {
		$args['s'] = $search;
	}

	$query = new WP_Query($args);

	$response = [
		'success'    => true,
		'total'      => $query->found_posts,
		'totalPages' => $query->max_num_pages,
		'page'       => $page,
		'limit'      => $limit,
		'data'       => [],
	];

	while ($query->have_posts()) {
		$query->the_post();
		$category_data = null;
		$categories = get_the_category();

		if (!empty($categories)) {
			$category_data = [
				'name' => $categories[0]->name,
			];
		}

		$response['data'][] = [
			'id'         => get_the_ID(),
			'title'      => get_the_title(),
			'excerpt'    => get_the_excerpt(),
			'link'       => get_permalink(),
			'date'       => get_the_date('d/m/Y'),
			'thumbnail'  => get_the_post_thumbnail_url(get_the_ID(), 'medium'),
			'category'   => $category_data['name'] ?? null,
		];
	}

	wp_reset_postdata();

	return $response;
}


add_action('rest_api_init', function () {
  register_rest_route('custom/v1', '/extends/(?P<parent>[a-zA-Z0-9-_]+)', [
    'methods'             => 'GET',
    'callback'            => 'get_extends_posts_by_category',
    'permission_callback' => '__return_true',
  ]);
});

/**
 * REST API callback to fetch 'extends' posts based on parent category, optional child categories,
 * search keyword, sorting, and pagination.
 *
 * Endpoint: /wp-json/custom/v1/extends/{parent_category_slug}?category=child1,child2&s=keyword&orderby=title&order=ASC&page=1
 *
 * @param WP_REST_Request $request
 * @return WP_REST_Response
 */
function get_extends_posts_by_category(WP_REST_Request $request) {
  $parent_slug = $request->get_param('parent');
  $search      = $request->get_param('s');
  $orderby     = $request->get_param('orderby') ?: 'date';
  $order       = $request->get_param('order') ?: 'DESC';
  $page        = max(1, (int) $request->get_param('page'));
  $per_page    = 9;

  // Get parent term object by slug
  $parent_term = get_term_by('slug', $parent_slug, 'categories-extends');
  if (!$parent_term || is_wp_error($parent_term)) {
    return new WP_REST_Response([
      'message' => 'Parent category not found.'
    ], 404);
  }

  // Get child category slugs
  $child_slugs_param = $request->get_param('category');
  $child_slugs = $child_slugs_param ? explode(',', $child_slugs_param) : [];

  // Build taxonomy query
  $tax_query = [
    [
      'taxonomy' => 'categories-extends',
      'field'    => 'slug',
      'terms'    => [$parent_slug],
    ],
  ];

  if (!empty($child_slugs)) {
    $tax_query[] = [
      'taxonomy' => 'categories-extends',
      'field'    => 'slug',
      'terms'    => $child_slugs,
    ];
    $tax_query['relation'] = 'AND';
  }

  // WP_Query arguments
  $query_args = [
    'post_type'      => 'extends',
    'post_status'    => 'publish',
    's'              => $search,
    'orderby'        => $orderby,
    'order'          => $order,
    'paged'          => $page,
    'posts_per_page' => $per_page,
    'tax_query'      => $tax_query,
  ];

  $query = new WP_Query($query_args);

  // Format post data
  $posts = [];
  foreach ($query->posts as $post) {
    // Get assigned terms for this post
    $terms = get_the_terms($post->ID, 'categories-extends');

    $parent_category = null;
    $child_category  = null;

    if (!empty($terms) && !is_wp_error($terms)) {
      foreach ($terms as $term) {
        // If the term has no parent, it's a parent category
        if ($term->parent === 0 && !$parent_category) {
          $parent_category = [
            'id'   => $term->term_id,
            'name' => $term->name,
            'slug' => $term->slug,
          ];
        } elseif ($term->parent !== 0 && !$child_category) {
          $child_category = [
            'id'   => $term->term_id,
            'name' => $term->name,
            'slug' => $term->slug,
          ];
        }

        // Break if both parent and child categories are found
        if ($parent_category && $child_category) {
          break;
        }
      }
    }

    $posts[] = [
      'id'              => $post->ID,
      'title'           => get_the_title($post),
      'excerpt'         => get_the_excerpt($post),
      'link'            => get_permalink($post),
	  'date'            => get_the_date('d/m/Y', $post),
      'thumbnail'       => get_the_post_thumbnail_url($post, 'medium'),
      'categoryParent' => $parent_category,
      'categoryChild'  => $child_category,
    ];
  }

  $total_posts  = $query->found_posts;
  $total_pages  = $query->max_num_pages;

  return new WP_REST_Response([
    'data'       => $posts,
    'page'       => $page,
    'totalPages' => $total_pages,
    'total'      => $total_posts,
  ]);
}

// Register Try API endpoint
add_action('rest_api_init', function () {
  register_rest_route('custom/v1', '/try/(?P<category_slug>[a-zA-Z0-9-_]+)', [
    'methods' => 'GET',
    'callback' => 'get_try_posts_by_category',
    'permission_callback' => '__return_true',
  ]);
});

/**
 * Callback for retrieving try posts by category slug
 * 
 * Endpoint: /wp-json/custom/v1/try/{category_slug}
 * Query params:
 * - limit (int): Number of posts per page (default: 9)
 * - page (int): Page number (default: 1)
 * - s (string): Search keyword
 * - search (string): Search keyword (alternative)
 * - category (string): Additional category filter
 * - orderby (string): 'date', 'title', 'modified', etc. (default: 'date')
 * - order (string): 'ASC' or 'DESC' (default: 'DESC')
 */
function get_try_posts_by_category(WP_REST_Request $request) {
  $category_slug = sanitize_text_field($request->get_param('category_slug'));

  // Parameters
  $limit    = (int) ($request->get_param('limit') ?? 9);
  $page     = (int) ($request->get_param('page') ?? 1);
  $search   = sanitize_text_field($request->get_param('s') ?? $request->get_param('search') ?? '');
  $category = sanitize_text_field($request->get_param('category') ?? '');
  $orderby  = sanitize_text_field($request->get_param('orderby') ?? 'date');
  $order    = strtoupper(sanitize_text_field($request->get_param('order') ?? 'DESC'));

  // Validate order
  if (!in_array($order, ['ASC', 'DESC'])) {
    $order = 'DESC';
  }

  // Validate orderby
  $allowed_orderby = ['date', 'title', 'modified', 'menu_order', 'ID'];
  if (!in_array($orderby, $allowed_orderby)) {
    $orderby = 'date';
  }

  // Base tax query for main category
  $tax_query = [
    [
      'taxonomy' => 'try-categories',
      'field'    => 'slug',
      'terms'    => $category_slug,
    ]
  ];

  // Additional category filter if provided
  if (!empty($category)) {
    $category_terms = explode(',', $category);
    $category_terms = array_map('trim', $category_terms);
    $category_terms = array_filter($category_terms);
    
    if (!empty($category_terms)) {
      $tax_query[] = [
        'taxonomy' => 'try-categories',
        'field'    => 'slug',
        'terms'    => $category_terms,
        'operator' => 'IN'
      ];
      $tax_query['relation'] = 'AND';
    }
  }

  // Query arguments
  $query_args = [
    'post_type'      => 'try',
    'post_status'    => 'publish',
    's'              => $search,
    'orderby'        => $orderby,
    'order'          => $order,
    'paged'          => $page,
    'posts_per_page' => $limit,
    'tax_query'      => $tax_query,
  ];

  $query = new WP_Query($query_args);

  // Format post data
  $posts = [];
  foreach ($query->posts as $post) {
    // Get assigned terms for this post
    $terms = get_the_terms($post->ID, 'try-categories');

    $parent_category = null;
    $child_category  = null;

    if (!empty($terms) && !is_wp_error($terms)) {
      foreach ($terms as $term) {
        if ($term->parent == 0) {
          // This is a parent term
          $parent_category = [
            'name' => $term->name,
            'slug' => $term->slug,
          ];
        } else {
          // This is a child term
          $child_category = [
            'name' => $term->name,
            'slug' => $term->slug,
          ];
        }
      }
    }

    $posts[] = [
      'id'             => $post->ID,
      'title'          => get_the_title($post),
      'link'           => get_permalink($post),
      'excerpt'        => get_the_excerpt($post),
      'date'           => get_the_date('d/m/Y', $post),
      'thumbnail'      => get_the_post_thumbnail_url($post, 'medium'),
      'categoryParent' => $parent_category,
      'categoryChild'  => $child_category,
    ];
  }

  $total_posts  = $query->found_posts;
  $total_pages  = $query->max_num_pages;

  return new WP_REST_Response([
    'data'       => $posts,
    'page'       => $page,
    'totalPages' => $total_pages,
    'total'      => $total_posts,
  ]);
}
