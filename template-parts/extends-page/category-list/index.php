<?php 
$icon = [
	'arrow-right' => 38,
	'arrow-nav-prev' => 157,
];
$category_thumbnail = 2335;

$categories_extends = get_terms([
	'taxonomy'   => 'categories-extends',
	'hide_empty' => false,
	'parent'     => 0
]);
$extends_category = get_field('extends_category');
?>

<section class="extends-category">
	<div class="extends-category-list">
		<?php 
		if(!empty($extends_category)):
		foreach($extends_category as $category):
		
		$category_type = $category['category_type'];
		$category_description = $category['category_description'];
		$category_thumbnail_id = $category['category_thumbnail'];
		$extends_post = $category['extends_post'];
		
		if ( $category_type ) {
			$term_id = is_object( $category_type ) ? $category_type->term_id : (int) $category_type;
			$term    = get_term( $term_id, 'categories-extends' );
			if ( ! is_wp_error( $term ) && $term ) {
				$category_name = $term->name;
				$category_link = get_term_link( $term );
			}
		}
		
		?>
		<div class="extends-category-item">
			<div class="extends-category-item__intro">
				<div class="extends-category-item__thumbnail">
					<?php 
					if ($category_thumbnail_id) {
						echo wp_get_attachment_image($category_thumbnail_id, 'full', false, array('class' => ''));
					} 
					?>
				</div>
				<div class="extends-category-item__content">
					<h3 class="extends-category-item__title">
						<?php echo esc_html($category_name); ?>
					</h3>
					<p class="extends-category-item__desc">
						<?php echo esc_html($category_description); ?>
					</p>
				</div>
			</div>
			<div class="extends-category-item__blog">
				<div class="extends-category-item__blog-head">
					<div class="extends-category-item__blog-head-title">Danh sách</div>
					<a href="<?php echo esc_url($category_link); ?>" class="extends-category-item__blog-head-detail">
						<span class="extends-category-item__blog-head-detail-text">
							Tìm hiểu thêm
						</span>
						<span class="extends-category-item__blog-head-detail-icon">
							<?php echo wp_get_attachment_image($icon['arrow-right'], 'full', false, array( 'class' => '')) ?>
						</span>
					</a>
				</div>
				<div class="extends-category-item__blog-wrapper">
					<div class="swiper extends-category-swiper">
						<div class="swiper-wrapper extends-category-swiper-wrapper">
							<?php 
							if(!empty($extends_post)):
								foreach($extends_post as $post_item):
									$post = is_object($post_item) ? $post_item : get_post($post_item);
									if ($post):
										setup_postdata($post);
							?>
								<div class="swiper-slide extends-category-swiper__slide-item">
									<?php get_template_part('template-parts/components/extends-card/index'); ?>
								</div>
							<?php 
										wp_reset_postdata();
									endif;
								endforeach;
							endif;
							?>
						</div>
						<div class="extends-category-scrollbar"></div>
					</div>
					<button class="extends-category-swiper__btn-nav-prev">
						<?php echo wp_get_attachment_image($icon['arrow-nav-prev'], 'full', false, array( 'class' => '')) ?>
					</button>
					<button class="extends-category-swiper__btn-nav-next">
						<?php echo wp_get_attachment_image($icon['arrow-nav-prev'], 'full', false, array( 'class' => '')) ?>
					</button>
				</div>
			</div>
		</div>
		<?php 
		endforeach;
		endif;
		?>
	</div>
</section>