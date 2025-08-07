<?php
$fallback_img_id = 985; // ID of the fallback image
$icon_calendar_id = 56; // Replace with the actual ID of the calendar icon
$icon_arrow_right_id = 36; // Replace with the actual ID of the arrow right icon
$icon_search_id = 982; // Replace with the actual ID of the search icon
$icon_arrow_down_id = 33; // Replace with the actual ID of the arrow down icon
$icon_filter_search_id = 994; // Replace with the actual ID of the filter search icon
$icon_close_id = 1148;
$icon_pagination_next_id = 1144;

// Lấy 9 bài post thuộc chuyên mục /su-kien
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$order = isset($_GET['order']) ? sanitize_text_field($_GET['order']) : 'DESC';
$s = isset($_GET['search']) ? sanitize_text_field($_GET['search']) : '';
$orderby = isset($_GET['orderby']) ? sanitize_text_field($_GET['orderby']) : 'date';

$category = '';
$term = get_queried_object();
if ($term && isset($term->slug)) {
	$category = $term->slug;
}

$args = array(
	'posts_per_page' => 9,
	'post_type' => 'post',
	'post_status' => 'publish',
	'paged' => $page,
	'order' => $order,
	'orderby' => $orderby,
);
// Ghép lại thành value để so sánh với radio button
$current_order_value = $orderby && $order ? "{$orderby}-{$order}" : '';
$filter_text = 'Bài viết mới nhất';
if ($orderby === 'title') {
    $filter_text = 'Alphabet A - Z';
} elseif ($orderby === 'title-DESC') {
    $filter_text = 'Alphabet Z - A';
}
// Handle search query
if (!empty($s)) {
	$args['s'] = $s;
	// Add search in title and content
	$args['search_columns'] = array('post_title');
}
if ($category) {
	$args['tax_query'] = array(
		array(
			'taxonomy' => 'category',
			'field'    => 'slug',
			'terms'    => $category,
		),
	);
}
$query = new WP_Query($args);
$count_posts = $query->found_posts;
?>
<section id="news-list-container" data-category-slug="<?= $category ?? ""; ?>" class="news-event">
	<div class="news-event__container">
		<div class="news-event__top">
			<h2 class="news-event__title">
				Danh sách tin tức 
			</h2>
			<div class="news-event__filter">
				<label class="news-event__filter-search">
					<?php echo wp_get_attachment_image($icon_search_id, 'full', false, array('class' => 'news-event__filter-search-icon')); ?>
					<input type="text" value="<?= $s; ?>" name="search_news" placeholder="Tìm kiếm trong Blog" class="news-event__filter-search-input"/>
				</label>
				<?php if(!isMobileDevice()): ?>
				<div class="news-event__filter-type">
					<p class="news-event__filter-type-label">Lọc theo: 
						<span class="news-event__filter-type-value">
							<?= $filter_text; ?>
						</span></p>
					<?php echo wp_get_attachment_image($icon_arrow_down_id, 'full', false, array('class' => 'news-event__filter-type-icon')); ?>

					<div id="news-event__filter-type-select" class="news-event__filter-type-select">
						<label data-type="all" class="news-event__filter-type-select-label">
                            <input type="radio" name="orderby" value="date-DESC"
                                <?= $current_order_value === 'date-DESC' || $current_order_value === '' ? 'checked' : '' ?>
                                hidden>
                            <span class="news-event__filter-type-select-radio"></span>
                            <span class="news-event__filter-type-select-value">Bài viết mới nhất</span>
                        </label>
                        <label data-type="alphabet-a-z" class="news-event__filter-type-select-label">
                            <input type="radio" name="orderby" value="title-ASC"
                                <?= $current_order_value === 'title-ASC' ? 'checked' : '' ?> hidden>
                            <span class="news-event__filter-type-select-radio"></span>
                            <span class="news-event__filter-type-select-value">Alphabet A - Z</span>
                        </label>
                        <label data-type="alphabet-z-a" class="news-event__filter-type-select-label">
                            <input type="radio" name="orderby" value="title-DESC"
                                <?= $current_order_value === 'title-DESC' ? 'checked' : '' ?> hidden>
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
									<?= wp_get_attachment_image($icon_close_id, 'full', false, array('class' => '')); ?>
								</button>
							</custom-drawer-close>
						</div>
						<div id="news-event__filter-type-select" class="news-event__filter-type-select-mb">
							<label data-type="all" class="news-event__filter-type-select-label">
								<input type="radio" name="orderby" value="date-DESC"
									<?= $current_order_value === 'date-DESC' || $current_order_value === '' ? 'checked' : '' ?>
									hidden>
								<span class="news-event__filter-type-select-radio"></span>
								<span class="news-event__filter-type-select-value">Bài viết mới nhất</span>
							</label>
							<label data-type="alphabet-a-z" class="news-event__filter-type-select-label">
								<input type="radio" name="orderby" value="title-ASC"
									<?= $current_order_value === 'title-ASC' ? 'checked' : '' ?> hidden>
								<span class="news-event__filter-type-select-radio"></span>
								<span class="news-event__filter-type-select-value">Alphabet A - Z</span>
							</label>
							<label data-type="alphabet-z-a" class="news-event__filter-type-select-label">
								<input type="radio" name="orderby" value="title-DESC"
									<?= $current_order_value === 'title-DESC' ? 'checked' : '' ?> hidden>
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
		</div>
		<div class="news-event__bottom">
			<div class="news-event__list news-event__list--loading">
				<?php for ($i = 0; $i < 9; $i++): ?>
				<div class="news-event__item loading">
					<div class="news-event__item-thumb">
					</div>
					<div class="news-event__item-info">
						<div class="news-event__item-category">
							<span>
							</span>
						</div>
						<h3 class="news-event__item-title">
						</h3>
						<div class="news-event__item-excerpt">
						</div>
						<div class="news-event__item-meta">
						</div>
					</div>
					<a href="" class="news-item__link"></a>
				</div>
				<?php endfor; ?>
			</div>

      <!--Hiển thị 9 card nội dung -->
			<div class="news-event__list">
				<?php if ($query->have_posts()) : ?>
				<?php while ($query->have_posts()) : $query->the_post(); ?>
				<article class="news-event__item">
					<a href="<?= get_permalink(); ?>" class="news-event__item-link"></a>
					<div class="news-event__item-thumbnail">
						<?php
						if (has_post_thumbnail()) {
							echo get_the_post_thumbnail(get_the_ID(), 'medium');
						} else {
							echo wp_get_attachment_image($fallback_img_id, 'medium', false, array('class' => 'news-event__item-thumbnail-fallback'));
						}
						?>
					</div>
					<div class="news-event__item-content">
						<?php
						$categories = get_the_category();
						if (!empty($categories)) {
							echo '<p class="news-event__item-category">' . esc_html($categories[0]->name) . '</p>';
						}
						?>
						<h3 class="news-event__item-title"><?= esc_html(get_the_title()); ?></h3>
						<p class="news-event__item-excerpt"><?= esc_html(get_the_excerpt()); ?></p>
						<div class="news-event__item-meta">
							<p class="news-event__item-date">
								<?= wp_get_attachment_image($icon_calendar_id, 'full', false, array('class' => 'news-event__item-date-icon')); ?>
								<span class="news-event__item-date-text">
									<?= get_the_date('d/m/Y'); ?>
								</span>
							</p>
							<p class="news-event__item-detail">
								<span class="news-event__item-detail-text">Chi tiết bài viết</span>
								<span class="news-event__item-detail-icon"><?php echo wp_get_attachment_image($icon_arrow_right_id, 'full', false, array('class' => '')); ?></span>
							</p>
						</div>
					</div>
				</article>
				<?php endwhile; wp_reset_postdata(); ?>
				<?php else : ?>
				<p>Không có bài viết sự kiện nào.</p>
				<?php endif; ?>
			</div>
      <!--Kết thúc phần hiển thị 9 card nội dung -->
      
			<?php
			$show_pagination = $query->max_num_pages > 1;
			?>
			<nav <?= !$show_pagination ? 'style="display: none;"' : '' ?> class="pagination">
				<?php
				$pagination = paginate([
					"current" => max(1, get_query_var('page')),
					'max' => $query->max_num_pages
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
					<?= wp_get_attachment_image($icon_pagination_next_id, 'full', false, array('class' => '')); ?>
				</span>
			</nav>
		</div>
    
	</div>
</section>

<template id="news-event-item-template">
	<article class="news-event__item">
		<a href="#" class="news-event__item-link"></a>
		<div class="news-event__item-thumbnail">
			<?php echo wp_get_attachment_image($fallback_img_id, 'full', false, array('class' => '')); ?>
		</div>
		<div class="news-event__item-content">
			<p class="news-event__item-category"></p>
			<h3 class="news-event__item-title"></h3>
			<p class="news-event__item-excerpt"></p>
			<div class="news-event__item-meta">
				<p class="news-event__item-date">
					<?php echo wp_get_attachment_image($icon_calendar_id, 'full', false, array('class' => 'news-event__item-date-icon')); ?>
					<span class="news-event__item-date-text"></span>
				</p>
				<p class="news-event__item-detail">
					<span class="news-event__item-detail-text">Chi tiết bài viết</span>
					<span class="news-event__item-detail-icon"><?php echo wp_get_attachment_image($icon_arrow_right_id, 'full', false, array('class' => '')); ?></span>
				</p>
			</div>
		</div>
	</article>
</template>