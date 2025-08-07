<?php 
$fallback_img_id = 985; // ID of the fallback image
$logo_id = 984; // ID of the logo image
$outstanding_arrow_right_id = 983; // ID of the right arrow icon
$latest_icon_arrow_right_id = 986; // ID of the latest icon arrow right

$term = get_queried_object();
$banner = get_field('banner', 'term_' . $term->term_id);
$news_outstanding = get_field('news_outstanding', 'term_' . $term->term_id);
$title = $news_outstanding["title"];
$outstanding_list = $news_outstanding["outstanding_list"];
$latest_list = $news_outstanding["latest_list"];
?>
<section class="news-outstanding">
	<div class="news-outstanding__container">
		<h2 class="news-outstanding__title">
			<?= $title ?? ""; ?>
		</h2>
		<div class="news-outstanding__outstanding-list">
			<div class="swiper news-outstanding__outstanding-list__swiper">
				<div class="swiper-wrapper news-outstanding__outstanding-list__swiper-wrapper">
					<?php if (!empty($logo_id)): ?>
					<?php echo wp_get_attachment_image($logo_id, 'full', false, array('class' => 'news-outstanding__outstanding-list__logo')); ?>
					<?php endif; ?>
					<?php if (!empty($outstanding_list)): ?>
					<?php foreach ($outstanding_list as $post): ?>
					<?php if ($post instanceof WP_Post): ?>
					<?php setup_postdata($post); ?>
					<!-- Start: Outstanding Item -->
					<article class="swiper-slide news-outstanding__outstanding-item">
						<div class="news-outstanding__outstanding-item__thumbnail">
							<?php
							if (has_post_thumbnail($post)) {
								echo get_the_post_thumbnail($post, 'full');
							} else {
								echo wp_get_attachment_image($fallback_img_id, 'full');
							}
							?>
						</div>
						<div class="news-outstanding__outstanding-item__content">
							<div class="news-outstanding__outstanding-item__content-top">
								<p class="news-outstanding__outstanding-item__category">
									<?php 
									$categories = get_the_category();
									if (!empty($categories)) {
										echo esc_html($categories[0]->name);
									}
									?>
								</p>
								<h3 class="news-outstanding__outstanding-item__title">
									<?= esc_html(get_the_title()); ?>
								</h3>
							</div>
							<div class="news-outstanding__outstanding-item__content-bottom">
								<div class="news-outstanding__outstanding-item__info">
									<p class="news-outstanding__outstanding-item__excerpt">
										<?= esc_html(get_the_excerpt()); ?>
									</p>
									<div class="news-outstanding__outstanding-item__meta">
										<span class="news-outstanding__outstanding-item__day">
											<?= get_the_date('d'); ?>
										</span>
										<span class="news-outstanding__outstanding-item__month">
											<?= 'Th' . get_the_date('n'); ?>
										</span>
									</div>
								</div>
								<a class="news-outstanding__outstanding-item__link" href="<?= get_permalink(); ?>">
									<span class="news-outstanding__outstanding-item__link-text">Xem chi tiết</span>
									<?php echo wp_get_attachment_image($outstanding_arrow_right_id, 'full', false, array('class' => 'news-outstanding__outstanding-item__link-icon')); ?>
								</a>
							</div>
						</div>
					</article>
					<!-- End: Outstanding Item -->
					<?php endif; ?>
					<?php endforeach; ?>
					<?php wp_reset_postdata(); ?>
					<?php endif; ?>
				</div>
				<div class="swiper-pagination news-outstanding__outstanding-list__swiper-pagination"></div>
			</div>
		</div>
		<div class="news-outstanding__latest-list">
			<?php if (!empty($latest_list)): ?>
			<?php foreach ($latest_list as $post): ?>
			<?php if ($post instanceof WP_Post): ?>
			<?php setup_postdata($post); ?>
			<!-- Start: Latest Item -->
			<article class="news-outstanding__latest-item">
				<div class="news-outstanding__latest-item-inner">
					<a href="<?= get_permalink(); ?>" class="news-outstanding__latest-item__link"></a>
					<?php if (has_post_thumbnail()): ?>
					<div class="news-outstanding__latest-item__thumbnail">
						<?php
						if (has_post_thumbnail($post)) {
							echo get_the_post_thumbnail($post, 'medium');
						} else {
							echo wp_get_attachment_image($fallback_img_id, 'medium');
						}
						?>
					</div>
					<?php endif; ?>
					<div class="news-outstanding__latest-item__content">
						<p class="news-outstanding__latest-item__category">
							<?php  echo wp_get_attachment_image($latest_icon_arrow_right_id, 'full', false, array('class' => 'news-outstanding__latest-item__category-icon')); ?>
							<span class="news-outstanding__latest-item__category-text">Bài viết mới</span>
						</p>
						<h3 class="news-outstanding__latest-item__title">
							<?= esc_html(get_the_title()); ?>
						</h3>

						<p class="news-outstanding__latest-item__excerpt">
							<?= esc_html(get_the_excerpt()); ?>
						</p>
					</div>
				</div>
			</article>
			<!-- End: Latest Item -->
			<?php endif; ?>
			<?php endforeach; ?>
			<?php wp_reset_postdata(); ?>
			<?php endif; ?>
		</div>
	</div>
</section>