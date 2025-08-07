<?php 
$term = get_queried_object();
$banner = get_field('banner', 'term_' . $term->term_id);
?>

<section class="blog-list-banner">
	<?php if (!isMobileDevice()): ?>
	<?= wp_get_attachment_image($banner['banner_pc'], 'full', false); ?>
	<?php else: ?>
	<?= wp_get_attachment_image($banner['banner_mb'], 'full', false); ?>
	<?php endif; ?>
	<div class="blog-list-banner-content">
		<div class="blog-list-breadcrumb">
			<a href="/">Trang chủ</a>
			<p><a href="/tin-tuc">Tin tức</a></p>
			<p><span><?= single_cat_title('', false); ?></span></p>
		</div>
		<h1><?= single_cat_title('', false); ?></h1>
		<div class="blog-list-banner--deco">
			<?php if (isMobileDevice()): ?>
			<svg xmlns="http://www.w3.org/2000/svg" width="376" height="29" viewBox="0 0 376 29" fill="none">
				<path
					  d="M0.412109 0.585938C0.412109 0.585938 83.9121 17.4216 187.912 17.4216C291.912 17.4216 375.412 0.585938 375.412 0.585938V28.5664H0.412109V0.585938Z"
					  fill="white" />
			</svg>
			<?php else: ?>
			<svg xmlns="http://www.w3.org/2000/svg" width="1600" height="44" viewBox="0 0 1600 44" fill="none">
				<path
					  d="M-105.828 0.698242C108.932 25.26 421.634 40.7278 769.771 40.7278C1117.91 40.7278 1430.61 25.2601 1645.37 0.698275V56.8414L-105.828 56.8414V0.698242Z"
					  fill="white" />
			</svg>
			<?php endif; ?>
		</div>
	</div>
</section>