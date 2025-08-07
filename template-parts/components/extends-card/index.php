<?php 
$icon = [
	'calendar' => 2276,
	'arrow-right' => 2325,
];
$terms = get_the_terms(get_the_ID(), 'categories-extends');
$parent_category = '';
$child_category = '';

if (!empty($terms) && !is_wp_error($terms)) {
	foreach ($terms as $term) {
		if ($term->parent == 0) {
			$parent_category = $term;
		} else {
			$child_category = $term;
		}
	}
}
?>

<article class="extends-card">
	<?php if(!empty($parent_category)): ?>
	<p class="extends-card__subject">
		<span class="extends-card__subject-text">
			<?php echo esc_html($parent_category->name); ?>
		</span>
	</p>
	<?php endif; ?>
	<div class="extends-card__thumbnail">
		<?php if (has_post_thumbnail()) {
	the_post_thumbnail('full');
} ?>
	</div>
	<div class="extends-card__content">
		<?php if(!empty($parent_category)): ?>
		<p class="extends-card__category">
			<span class="extends-card__category-text">
				<?php echo esc_html($child_category ? $child_category->name : $parent_category->name); ?>
			</span>    
		</p>
		<?php endif; ?>
		<h4 class="extends-card__title">
			<a href="<?php the_permalink(); ?>">
				<?php the_title(); ?>
			</a>
		</h4>
		<p class="extends-card__desc">
			<?php echo get_the_excerpt(); ?>
		</p>
		<div class="extends-card__meta">
			<p class="extends-card__date">
				<?php echo wp_get_attachment_image($icon['calendar'], 'full', false, array( 'class' => 'extends-card__date-icon')) ?>
				<span class="extends-card__date-text">
					<?php echo get_the_date('d/m/Y'); ?>
				</span>
			</p>
			<a href="<?php the_permalink(); ?>" class="extends-card__link-detail">
				<span class="extends-card__link-detail-text">
					Chi tiết bài viết
				</span>
				<?php echo wp_get_attachment_image($icon['arrow-right'], 'full', false, array( 'class' => 'extends-card__link-detail-icon')) ?>
			</a>
		</div>
	</div>
</article>