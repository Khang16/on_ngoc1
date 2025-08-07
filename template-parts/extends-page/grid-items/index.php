<?php
$icon_calendar = 2276;
$icon_detail_arrow = 2325;
$fallback_image_id = 985;

$poster = get_field('poster');

$args = array(
	'post_type'      => 'extends',
	'posts_per_page' => 6,
	'orderby'        => 'date',
	'order'          => 'DESC',
);

$query = new WP_Query($args);

?>

<section class="grammar-section">
	<div class="container">
		<div class="grammar-content">
			<!-- Left side - Grammar posts grid -->
			<div class="grammar-posts-grid">
				<?php if ($query->have_posts()) : ?>
				<?php while ($query->have_posts()) : $query->the_post(); ?>
				<?php
				// Lấy dữ liệu
				$thumbnail_id = get_post_thumbnail_id(get_the_ID());
				$image_id = $thumbnail_id ? $thumbnail_id : $fallback_image_id;
				$title = get_the_title();
				$link = get_the_permalink();
				$date = get_the_date('d/m/Y');
				$description = get_the_excerpt();

				$terms = get_the_terms(get_the_ID(), 'categories-extends');
				$child_name = '';
				$parent_name = '';

				if (!empty($terms) && !is_wp_error($terms)) {
					$term = $terms[0];
					if ($term->parent != 0) {
						$parent = get_term($term->parent, 'categories-extends');
						$child_name = $term->name;
						$parent_name = !is_wp_error($parent) ? $parent->name : '';
					} else {
						$parent_name = $term->name;
					}
				}
				?>
				<a href="<?= esc_url($link); ?>" class="grammar-post-item">
					<article>
						<div class="grammar-post-image">
							<?php
							if ($thumbnail_id) {
								echo wp_get_attachment_image($image_id, 'medium', false, ['alt' => $title, 'class' => 'grammar-post-thumb']);
							}
							?>
							<?php if(!empty($parent_name)): ?>
							<div class="grammar-new-badge">
								<span class="grammar-new-badge-text">
									<?= esc_html($parent_name); ?>
								</span>
							</div>
							<?php endif; ?>
						</div>
						<div class="grammar-post-content">
							<?php if(!empty($parent_name)): ?>
							<div class="grammar-post-category">
								<?= esc_html($child_name ?: $parent_name); ?>
							</div>
							<?php endif; ?>
							<h3 class="grammar-post-title"><?= esc_html($title); ?></h3>
							<p class="grammar-post-description"><?= esc_html($description); ?></p>
							<div class="grammar-post-meta">
								<div class="grammar-post-date">
									<?php echo wp_get_attachment_image($icon_calendar, 'full', false, ['class' => 'grammar-calendar-icon']) ?>
									<span><?= esc_html($date); ?></span>
								</div>
								<div class="grammar-post-detail">
									<span class="grammar-post-detail-link">Chi tiết bài viết</span>
									<?php echo wp_get_attachment_image($icon_detail_arrow, 'full', false, ['class' => 'grammar-right-arrow']) ?>
								</div>
							</div>
						</div>
					</article>
				</a>
				<?php endwhile; wp_reset_postdata(); ?>
				<?php endif; ?>
			</div>

			<!-- Right side - Featured image -->
			<div class="grammar-featured">
				<div class="grammar-featured-image">
					<?php echo wp_get_attachment_image($poster, 'full', false, array( 'class' => '')) ?>
				</div>
			</div>
		</div>
	</div>
</section>