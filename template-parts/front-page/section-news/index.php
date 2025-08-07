<section id="hot__news">
	<?php 
	$title_news_home = get_field('title_news_home');
	?>
	<?= wp_get_attachment_image(134,'full',false,['class' => 'news__background__mb']) ?>
	<?= wp_get_attachment_image(54,'full',false,['class' => 'news__background']) ?>
	<div class="container">
		<div class="group__title" data-aos="fade-up" data-aos-offset="0" data-aos-duration="800">
			<h2 class="title" >
				<?= esc_html($title_news_home) ?>
			</h2>
			<a class="view__all" href="#">
				<p>Xem tất cả</p>
				<div class="line"></div>
				<div>
					<svg xmlns="http://www.w3.org/2000/svg" width="43" height="44" viewBox="0 0 43 44" fill="none">
						<path d="M19.6133 17.5723L24.0409 22.0497L19.6133 26.4276" stroke="white" stroke-width="1.5"
							  stroke-linecap="round" />
					</svg>
				</div>
			</a>
		</div>

		<!-- tabs -->
		<div class="list__tabs" data-aos="fade-up" data-aos-offset="0" data-aos-duration="800">
			<?php
	$terms = get_terms([
		'taxonomy' => 'category',
		'hide_empty' => false,
	]);

	if (!empty($terms) && !is_wp_error($terms)) :
	$first = true;
	foreach ($terms as $term) :
			?>
			<div tax-slug="<?= $term->slug ?>" class="tab__item<?php echo $first ? ' active' : ''; ?>">
				<p><?php echo esc_html($term->name); ?></p>
			</div>
			<?php
			$first = false;
			endforeach;
			endif;
			?>
		</div>

		<?php 
		$cate_terms = get_terms([
			'taxonomy'   => 'category',
			'hide_empty' => true,
			'number'     => 1,
		]);

		$first_cate = ! empty($cate_terms) ? $cate_terms[0] : null;

		if ($first_cate) {
			$course_args = [
				'post_type'      => 'post',
				'posts_per_page' => 3,
				'orderby'        => 'ID',
				'order'          => 'DESC',
				'tax_query'      => [
					[
						'taxonomy' => 'category',
						'field'    => 'term_id',
						'terms'    => $first_cate->term_id,
					],
				],
			];

			$course_query = new WP_Query($course_args);

			if ($course_query->have_posts()) :
			$i = 0;
			$next_four = [];
		?>
		<div class="news__container" data-aos="fade-up" data-aos-offset="0" data-aos-duration="800">
			<?php
			while ($course_query->have_posts()) : $course_query->the_post();
			$post_id = get_the_ID();
				// 3 bài đầu: render new__item bên trong news__container
			?>
			<div class="new__item">
				<div class="overlay__mb"></div>
				<div class="new__thumb">
					<span class="new__badge">NEWS</span>
					<a href="<?php the_permalink(); ?>">
						<img src="<?php echo get_the_post_thumbnail_url($post_id, 'full'); ?>" alt="<?php the_title(); ?>">
					</a>
				</div>
				<div class="new__body">
					<a href="<?php the_permalink(); ?>" class="new__title"><?php the_title(); ?></a>
					<div class="new__footer">
						<div class="new__date">
							<img class="icon" src="/wp-content/uploads/2025/05/Calendar_duotone.svg" alt="">
							<p><?php echo get_the_date('d/m/Y'); ?></p>
						</div>
						<a href="<?php the_permalink(); ?>" class="new__link">
							<p>Chi tiết bài viết</p>
							<div>
								<svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" viewBox="0 0 27 27" fill="none">
									<path d="M11.9805 11.0264L14.7524 13.8294L11.9805 16.5702" stroke="#5B378F" stroke-width="1.5" stroke-linecap="round" />
								</svg>
							</div>
						</a>
					</div>
				</div>
			</div>
			<?php
			$i++;
			endwhile;
			?>
		</div> <!-- đóng news__container -->
		<?php
			wp_reset_postdata();
			endif;
		}
		?>

		<!-- news 2 -->
		
		<div class="other__news" data-aos="fade-up" data-aos-offset="0" data-aos-duration="800">
			<div class="other__new__item">
				<a href="#" class="overlay"></a>
				<div class="image__link" >
					<img src="/wp-content/uploads/2025/06/image-8.webp" alt="">
				</div>
				<p class="title">
					<span>Video luyện nghe</span>
					<svg xmlns="http://www.w3.org/2000/svg" width="5" height="8" viewBox="0 0 5 8" fill="none">
  <path d="M1 1.09961L3.77194 3.90268L1 6.64347" stroke="white" stroke-width="1.5" stroke-linecap="round"/>
</svg>
				</p>
			</div>
			<div class="other__new__item">
				<a href="#" class="overlay"></a>
				<div class="image__link">
					<img src="/wp-content/uploads/2025/06/image-9.webp" alt="">
				</div>
				<p class="title">
					<span>Từ vựng theo chuyên ngành</span>
					<svg xmlns="http://www.w3.org/2000/svg" width="5" height="8" viewBox="0 0 5 8" fill="none">
  <path d="M1 1.09961L3.77194 3.90268L1 6.64347" stroke="white" stroke-width="1.5" stroke-linecap="round"/>
</svg>
				</p>
			</div>
			<div class="other__new__item">
				<a href="#" class="overlay"></a>
				<div class="image__link">
					<img src="/wp-content/uploads/2025/06/image-10.webp" alt="">
				</div>
				<p class="title">
					<span>Ngữ pháp</span>
					<svg xmlns="http://www.w3.org/2000/svg" width="5" height="8" viewBox="0 0 5 8" fill="none">
  <path d="M1 1.09961L3.77194 3.90268L1 6.64347" stroke="white" stroke-width="1.5" stroke-linecap="round"/>
</svg>
				</p>
			</div>
			<div class="other__new__item">
				<a href="#" class="overlay"></a>
				<div class="image__link">
					<img src="/wp-content/uploads/2025/06/image-11.webp" alt="">
				</div>
				<p class="title">
					<span>Văn hóa Trung</span>
					<svg xmlns="http://www.w3.org/2000/svg" width="5" height="8" viewBox="0 0 5 8" fill="none">
  <path d="M1 1.09961L3.77194 3.90268L1 6.64347" stroke="white" stroke-width="1.5" stroke-linecap="round"/>
</svg>
				</p>
			</div>
			<div class="other__new__item">
				<a href="#" class="overlay"></a>
				<div class="image__link">
					<img src="/wp-content/uploads/2025/06/image-12.webp" alt="">
				</div>
				<p class="title">
					<span>Luyện thi</span>
					<svg xmlns="http://www.w3.org/2000/svg" width="5" height="8" viewBox="0 0 5 8" fill="none">
  <path d="M1 1.09961L3.77194 3.90268L1 6.64347" stroke="white" stroke-width="1.5" stroke-linecap="round"/>
</svg>
				</p>
			</div>
		</div>
	</div>
</section>

<template id="new__card-template">
	<div class="new__item">
		<div class="overlay__mb"></div>
		<div class="new__thumb">
			<span class="new__badge">NEWS</span>
			<a href="<?php the_permalink(); ?>">
				<img src="<?php echo get_the_post_thumbnail_url($post_id, 'full'); ?>" alt="<?php the_title(); ?>">
			</a>
		</div>
		<div class="new__body">
			<a href="<?php the_permalink(); ?>" class="new__title"><?php the_title(); ?></a>
			<div class="new__footer">
				<div class="new__date">
					<img class="icon" src="/wp-content/uploads/2025/05/Calendar_duotone.svg" alt="">
					<p><?php echo get_the_date('d/m/Y'); ?></p>
				</div>
				<a href="" class="new__link">
					<p>Chi tiết bài viết</p>
					<div>
						<svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" viewBox="0 0 27 27" fill="none">
							<path d="M11.9805 11.0264L14.7524 13.8294L11.9805 16.5702" stroke="#5B378F" stroke-width="1.5" stroke-linecap="round" />
						</svg>
					</div>
				</a>
			</div>
		</div>
	</div>
</template>

<template id="new__card-template2">
	<div class="other__new__item">
		<a class="image__link" href="">
			<img src="<?php echo esc_url($item['thumbnail']); ?>" alt="<?php echo esc_attr($item['title']); ?>">
		</a>
		<p class="tag">News</p>
		<a class="title" href="<?php echo esc_url($item['permalink']); ?>">
			<?php echo esc_html($item['title']); ?>
		</a>
	</div>
</template>

<template id="news__skeleton-template">
  <div class="skeleton__item">
    <div class="skeleton__thumb"></div>
    <div class="skeleton__text">
      <div class="skeleton__title"></div>
      <div class="skeleton__date"></div>
    </div>
  </div>
</template>
