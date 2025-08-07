<?php 
$detail_icon_id = 2326;
$calendar_icon_id = 2328;

$term = get_queried_object();
if(!empty($term)) {
	$term_id = $term->term_id;
	$outstanding_data = get_field('outstanding_content', 'term_' . $term_id);
	$primary_list = $outstanding_data['primary_content_list'] ?? [];
	$secondary_list = $outstanding_data['secondary_content_list'] ?? [];
}
?>

<section class="featured-content-section">
	<div class="container">
		<div class="featured-content">
			<div class="featured-content-title">
				Nội dung nổi bật
			</div>
		</div>

		<div class="container-video-and-post">
			<div class="swiper outstanding-swiper">
				<div class="swiper-wrapper outstanding-swiper-wrapper">
					<div class="outstanding-swiper-autoplay-progress-mobile">
						<div class="outstanding-swiper-autoplay-progress-mobile__inner"></div>
					</div>
					<?php if(!empty($primary_list)): ?>
					<?php foreach ($primary_list as $item): ?>
					<?php 
					// Lấy post object
					$post_object = get_post($item['post']); // đảm bảo là WP_Post
					setup_postdata($post_object);

					$post_title = get_the_title($post_object);
					$post_permalink = get_permalink($post_object);
					$post_date = get_the_date('d.m.Y', $post_object);

					// Lấy category đầu tiên
					$categories = wp_get_post_terms($post_object->ID, 'categories-extends');
					$first_category_name = !empty($categories) ? $categories[0]->name : '';

					// Lấy video (kiểu file trong ACF, nên là mảng)
					$video_file = $item['video'];
					$video_url = !empty($video_file['url']) ? $video_file['url'] : '';
					?>
					<div class="swiper-slide outstanding-swiper-slide">
						<div class="outstanding-swiper-slide__media">
							<?php if (!empty($video_url)): ?>
							<video playsinline autoplay muted loop disablepictureinpicture controlslist="nodownload nofullscreen noremoteplay" oncontextmenu="return false;">
								<source src="<?= esc_url($video_url) ?>" type="video/mp4">
							</video>
							<?php else: ?>
							<?php
							$thumbnail_url = get_the_post_thumbnail_url($post_object, 'full');
							?>
							<?php if (!empty($thumbnail_url)): ?>
							<img src="<?= esc_url($thumbnail_url) ?>" alt="<?= esc_attr($post_title) ?>">
							<?php endif; ?>
							<?php endif; ?>
						</div>
						<div class="outstanding-swiper-slide__content">
							<div class="outstanding-swiper-slide__info">
								<?php if(!empty($first_category_name)): ?>
								<p class="outstanding-swiper-slide__category">
									<?= $first_category_name; ?>
								</p>
								<?php endif; ?>
								<p class="outstanding-swiper-slide__date">
									<?php echo wp_get_attachment_image($calendar_icon_id, 'full', false, array( 'class' => 'outstanding-swiper-slide__date-icon')) ?>
									<span class="outstanding-swiper-slide__date-text">
										<?= $post_date; ?>
									</span>
								</p>
							</div>
							<h3 class="outstanding-swiper-slide__title">
								<a href="<?= $post_permalink; ?>">
									<?= esc_html($post_title) ?>
								</a>
							</h3>
							<a class="outstanding-swiper-slide__detail">
								<span class="outstanding-swiper-slide__detail-text">Chi tiết bài viết</span>
								<?php echo wp_get_attachment_image($detail_icon_id, 'full', false, array( 'class' => 'outstanding-swiper-slide__detail-icon')) ?>
							</a>
						</div>
					</div>
					<?php wp_reset_postdata(); ?>
					<?php endforeach; ?>
					<?php endif; ?>
				</div>
				<div class="outstanding-swiper__autoplay-progress-list">
					<?php if(!empty($primary_list)): ?>
					<?php foreach ($primary_list as $index => $item): ?>
					<?php 
					// Lấy post object
					$post_object = get_post($item['post']); // đảm bảo là WP_Post
					setup_postdata($post_object);
					$post_title = get_the_title($post_object);
					?>
					<div class="outstanding-swiper__autoplay-progress-item">
						<div class="outstanding-swiper__autoplay-progress-item__bar-outer">
							<div class="outstanding-swiper__autoplay-progress-item__bar-inner"></div>
						</div>
						<p class="outstanding-swiper__autoplay-progress-item__number">
							<?= str_pad($index + 1, 2, '0', STR_PAD_LEFT) ?>
						</p>
						<p class="outstanding-swiper__autoplay-progress-item__title">
							<?= esc_html($post_title) ?>
						</p>
					</div>
					<?php wp_reset_postdata(); ?>
					<?php endforeach; ?>
					<?php endif; ?>
				</div>

				<div class="outstanding-swiper-pagination"></div>
			</div>


			<div class="container-post-featured">
				<?php if(!empty($secondary_list)): ?>
				<?php foreach ($secondary_list as $post): ?>
				<?php 
				setup_postdata($post); 
				$post_title = get_the_title($post) ?? "";
				$post_permalink = get_permalink($post);
				$post_date = get_the_date('d/m/Y', $post);
				$post_thumbnail = get_the_post_thumbnail_url($post, 'full'); 
				// Sử dụng wp_get_post_terms nếu get_the_category() không ra
				$post_categories = wp_get_post_terms($post->ID, 'categories-extends');
				$post_first_category = !empty($post_categories) ? $post_categories[0]->name : '';
				?>
				<article class="post-item">
					<a class="post-link" href="<?= $post_permalink ?? "#"; ?>"></a>
					<div class="post-image">
						<img src="<?= esc_url($post_thumbnail) ?>" alt="<?= esc_attr($post_title) ?>">
					</div>
					<div class="post-content">
						<?php if(!empty($post_first_category)): ?>
						<div class="post-label">
							<span class="post-label-arrow">›</span>
							<span class="post-label-text">
								<?= $post_first_category; ?>
							</span>
						</div>
						<?php endif; ?>
						<h3 class="post-title">
							<?= esc_html($post_title) ?>
						</h3>
						<div class="post-date-wrapper">
							<?= wp_get_attachment_image(2276, 'full', false, array('class' => 'calendar-icon')) ?>
							<div class="post-date">
								<?= esc_html($post_date) ?>
							</div>
						</div>
					</div>
				</article>
				<?php endforeach; ?>
				<?php wp_reset_postdata(); ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>