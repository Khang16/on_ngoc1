<?php
$fallback_img_id = 985; // ID of the fallback image
$icon_arrow_down_id = 33; // Replace with the actual ID of the arrow down icon
$icon_filter_search_id = 994; // Replace with the actual ID of the filter search icon
$icon_arrow_next_id = 1144;
$icon_checkbox_unchecked_id = 1146;
$icon_checkbox_checked_id = 1145;
$icon_close_id = 1148;
// Lấy và chuẩn hóa các tham số từ URL
$params = [
	'category' => $_GET['category'] ?? '',
	'limit' => $_GET['limit'] ?? 9,
	'page' => $_GET['page'] ?? 1,
	'search' => $_GET['search'] ?? ''
];
// Phân tách category thành mảng (dùng cho tax_query)
$categories = explode(',', $params['category']);
// Lấy đối tượng term hiện tại từ query
$term = get_queried_object();
$term_slug = $term->slug;
// Thiết lập post type cần truy vấn
$post_type = 'extends';
// Cấu hình các tham số query
$args = [
	'post_type' => $post_type,
	'posts_per_page' => $params['limit'],
	'paged' => $params['page'], // Lưu ý: Nếu dùng WP_Query thì phải dùng 'paged' thay vì 'page'
];

// Nếu đang nằm trong taxonomy archive, thêm điều kiện filter theo term hiện tại
if ($term) {
	$args['tax_query'] = [
		[
			'taxonomy' => $term->taxonomy,
			'field' => 'slug',
			'terms' => $term->slug,
		],
	];
}

// Nếu có filter thêm từ category (radio hoặc checkbox), kết hợp với điều kiện AND
if ($params['category']) {
	$args['tax_query'][] = [
		'taxonomy' => $term->taxonomy,
		'field' => 'slug',
		'terms' => $categories,
	];
	$args['tax_query']['relation'] = 'AND';
}

if ($params['search']) {
	$args['s'] = $params['search'];
}

// Thực thi query lấy danh sách bài viết (video)
$videos = new WP_Query($args);

// Lấy danh sách các category con của term hiện tại (dùng để render checkbox filter)
$child_terms = get_terms([
	'taxonomy' => $term->taxonomy,
	'parent' => $term->term_id,
	'hide_empty' => false,
]);

// Thiết lập text mô tả bộ lọc hiện tại (cho UI hiển thị)
$current_order_value = $orderby && $order ? "{$orderby}-{$order}" : '';
$filter_text = 'Bài viết mới nhất';
if ($orderby === 'title') {
	$filter_text = 'Alphabet A - Z';
} elseif ($orderby === 'title-DESC') {
	$filter_text = 'Alphabet Z - A';
}
?>

<section id="grid-items" data-category="<?= $term_slug; ?>" class="grid-items">
	<div class="grid-items__container">
		<div class="grid-items__header">
			<h2 class="grid-items__title">Danh sách bài viết</h2>
			<div class="grid-items__searchbar">
				<!-- Thanh tìm kiếm -->
				<div class="grid-items__search-container">
					<?= wp_get_attachment_image(982, 'full', false, array('class' => 'grid-items__search-icon')) ?>
					<input type="text" value="<?= $params['search'] ?? ""; ?>" class="grid-items__search" placeholder="Tìm kiếm trong Blog" />
				</div>
				<!-- Dropdown bộ lọc desktop và mobile -->
				<?php if(!isMobileDevice()): ?>
				<div class="news-event__filter-type">
					<p class="news-event__filter-type-label">Lọc theo: 
						<span class="news-event__filter-type-value">
							<?= $filter_text; ?>
						</span></p>
					<?php echo wp_get_attachment_image($icon_arrow_down_id, 'full', false, array('class' => 'news-event__filter-type-icon')); ?>

					<div id="news-event__filter-type-select" class="news-event__filter-type-select">
						<label data-type="all" class="news-event__filter-type-select-label" >
							<input type="radio" name="orderby" value="date-DESC" <?= $current_order_value === 'date-DESC' || $current_order_value ==='' ? 'checked' : '' ?> hidden> 
							<span class="news-event__filter-type-select-radio"></span>
							<span class="news-event__filter-type-select-value">Bài viết mới nhất</span>
						</label>
						<label data-type="alphabet-a-z" class="news-event__filter-type-select-label" >
							<input type="radio" name="orderby" value="title-ASC" <?= $current_order_value === 'title-ASC' ? 'checked' : '' ?> hidden>    
							<span class="news-event__filter-type-select-radio"></span>
							<span class="news-event__filter-type-select-value">Alphabet A - Z</span >
						</label>
						<label data-type="alphabet-z-a" class="news-event__filter-type-select-label" >
							<input type="radio" name="orderby" value="title-DESC" <?= $current_order_value === 'title-DESC' ? 'checked' : '' ?> hidden>    
							<span class="news-event__filter-type-select-radio"></span>
							<span class="news-event__filter-type-select-value">Alphabet Z - A</span>
						</label>
					</div>
				</div>
				<?php else: ?>
				<custom-drawer data-direction="bottom" class="news-event__filter-type">
					<custom-drawer-trigger>
						<button class="custom-drawer-trigger-btn">
							<?php echo wp_get_attachment_image($icon_filter_search_id, 'full', false, array('class' => 'news-event__filter-type-icon')); ?>
						</button>
					</custom-drawer-trigger>
					<custom-drawer-content>
						<div class="news-event__filter-type-select-header">
							<p class="news-event__filter-type-select-title">Sắp Xếp Theo</p>
							<custom-drawer-close>
								<button class="news-event__filter-type-select-close">
									<?php echo wp_get_attachment_image($icon_close_id, 'full', false, array( 'class' => '')) ?>
								</button>
							</custom-drawer-close>
						</div>
						<div id="news-event__filter-type-select" class="news-event__filter-type-select-mb">
							<label data-type="all" class="news-event__filter-type-select-label" >
								<input type="radio" name="orderby" value="date-DESC" <?= $current_order_value === 'date-DESC' || $current_order_value ==='' ? 'checked' : '' ?> hidden> 
								<span class="news-event__filter-type-select-radio"></span>
								<span class="news-event__filter-type-select-value">Bài viết mới nhất</span>
							</label>
							<label data-type="alphabet-a-z" class="news-event__filter-type-select-label" >
								<input type="radio" name="orderby" value="title-ASC" <?= $current_order_value === 'title-ASC' ? 'checked' : '' ?> hidden>    
								<span class="news-event__filter-type-select-radio"></span>
								<span class="news-event__filter-type-select-value">Alphabet A - Z</span >
							</label>
							<label data-type="alphabet-z-a" class="news-event__filter-type-select-label" >
								<input type="radio" name="orderby" value="title-DESC" <?= $current_order_value === 'title-DESC' ? 'checked' : '' ?> hidden>    
								<span class="news-event__filter-type-select-radio"></span>
								<span class="news-event__filter-type-select-value">Alphabet Z - A</span>
							</label>
						</div>
						<div class="news-event__filter-type-select-apply">
							<custom-drawer-close>
								<button class="news-event__filter-type-select-apply-btn">
									<span class="news-event__filter-type-select-apply-text">Áp dụng</span>
								</button>
							</custom-drawer-close>
						</div>
					</custom-drawer-content>
				</custom-drawer>
				<?php endif; ?>
			</div>
			<!-- Tag filter (hiển thị các category con) -->
			<?php if (!wp_is_mobile()) : ?>
			<div class="grid-items__tags">
				<?php foreach ($child_terms as $child_term) : ?>
				<input hidden type="checkbox" id="<?= $child_term->taxonomy ?>-<?= $child_term->slug ?>"
					   name="<?= $child_term->taxonomy ?>" value="<?= $child_term->slug ?>"
					   <?= in_array($child_term->slug, $categories) ? 'checked' : '' ?>>
				<label class="grid-items__tag" for="<?= $child_term->taxonomy ?>-<?= $child_term->slug ?>">
					<?= $child_term->name ?>
				</label>
				<?php endforeach; ?>
			</div>
			<?php endif; ?>
		</div>
		<!-- Placeholder loading trong lúc fetch dữ liệu (JS) -->
		<div class="grid-items__grid grid-items__grid--loading" >
			<?php for ($i = 0; $i < 9; $i++): ?>
			<div class="skeleton loading">
				<div class="skeleton-thumb">
				</div>
				<div class="skeleton-content">
					<div></div>
					<div></div>
					<div></div>
					<div></div>
				</div>
			</div>
			<?php endfor; ?>
		</div>
		<!-- Grid hiển thị danh sách video đã load -->
		<div data-limit="<?= $params['limit']; ?>" class="grid-items__grid" id="videoGrid">
			<?php
			if ($videos->have_posts()) {
				while ($videos->have_posts()) {
					$videos->the_post();
					get_template_part('template-parts/taxonomy-categories-extends/grid-items/item-loop');
				}
			} else {
				echo '<div>Không tìm thấy bài viết phù hợp.</div>';
			}
			wp_reset_postdata();
			?>
		</div>
		<!-- Phân trang -->
		<?php
		$show_pagination = $videos->max_num_pages > 1;
		?>
		<nav <?= !$show_pagination ? 'style="display: none;"' : '' ?> class="pagination">
			<?php
	$pagination = paginate([
		"current" => max(1, get_query_var('page')),
		'max' => $videos->max_num_pages
	]);
			 $items = $pagination['items'];
			 $prev = $pagination['prev'];
			 $next = $pagination['next'];
			?>
			<div class="pagination__list">
				<?php foreach ($items as $key => $item):
				  $active_page = $item == $page || ($page < 2 && $key === 0);
				?>
				<button data-page="<?= esc_attr($item) ?>" class="pagination__item <?= $active_page ? 'active' : '' ?>"
						<?= !is_numeric($item) ? 'style="pointer-events: none;"' : '' ?>>
					<?= esc_html($item) ?>
				</button>
				<?php endforeach; ?>
			</div>
			<span page="<?= esc_attr($next) ?>" class="pagination__nav pagination__nav--next">
				<?php echo wp_get_attachment_image($icon_arrow_next_id, 'full', false, array('class' => '')); ?>
			</span>
		</nav>
	</div>
</section>
<?php if (wp_is_mobile()) : ?>
<div class="category-search-fixed">
	<custom-drawer>
		<custom-drawer-trigger>
			<button class="category-filter__btn-trigger">
				<span class="category-filter__btn-trigger-text">Chủ đề</span>
			</button>
		</custom-drawer-trigger>
		<custom-drawer-content>
			<!-- Tag filter (hiển thị các category con) -->
			<div class="category-filter__container">
				<div class="category-filter__head">
					<div class="category-filter__title">Chủ Đề</div>
					<custom-drawer-close class="category-filter__btn-close">
						<?php echo wp_get_attachment_image($icon_close_id, 'full', false, array( 'class' => '')) ?>
					</custom-drawer-close>
				</div>
				<div class="category-filter__list grid-items__tags">
					<?php foreach ($child_terms as $child_term) : ?>
					<label class="category-filter__item">
						<input hidden type="checkbox" id="<?= $child_term->taxonomy ?>-<?= $child_term->slug ?>"
							   name="<?= $child_term->taxonomy ?>" value="<?= $child_term->slug ?>"
							   <?= in_array($child_term->slug, $categories) ? 'checked' : '' ?>>
						<?php echo wp_get_attachment_image($icon_checkbox_unchecked_id, 'full', false, array( 'class' => 'unchecked')) ?>
						<?php echo wp_get_attachment_image($icon_checkbox_checked_id, 'full', false, array( 'class' => 'checked')) ?>
						<span class="grid-items__tag">
							<?= $child_term->name ?>
						</span>
					</label>
					<?php endforeach; ?>
				</div>
				<custom-drawer-close>
					<button class="category-filter__btn-apply">
						<span class="category-filter__btn-apply-text">Áp dụng</span>
					</button>
				</custom-drawer-close>
			</div>
		</custom-drawer-content>
	</custom-drawer>
</div>
<?php endif; ?>
<!-- Template card video - được dùng để clone bằng JS -->
<template id="video-card-template">
    <div class="video-card">
        <a href="<?= get_the_permalink() ?>" class="video-card__thumb">
			<img alt="" src="" class="video-card__thumb-img" />
            <span class="video-card__badge">
            </span>
        </a>
        <div class="video-card__content">
            <span class="video-card__label">
            </span>
            <h3 class="video-card__title">
                <a href="#"></a>
            </h3>
            <p class="video-card__desc"></p>
            <div class="video-card__meta">
                <span class="video-card__date">
                    <?= wp_get_attachment_image(2276, 'full', false, array('class' => 'video-card__date-icon')) ?>
                    <span class="video-card__date-text"></span>
                </span>
                <a href="#" class="video-card__cta">
                    <span class="video-card__cta-text">Chi tiết video</span>
                    <span class="video-card__cta-icon">
                        <?= wp_get_attachment_image(1147, 'full', false) ?>
                    </span>
                </a>
            </div>
        </div>
    </div>
</template>