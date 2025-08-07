<?php 
$banner_acf = get_field("compound_banner");
?>
<section class="banner">
	<div class="banner__image-wrapper">
		<?php 
		if(!wp_is_mobile()): 
		echo wp_get_attachment_image($banner_acf["banner_pc"], 'full', false, array( 'class' => 'banner__image'));
		else:
		echo wp_get_attachment_image($banner_acf["banner_mobile"], 'full', false, array( 'class' => 'banner__image'));
		endif;
		?>
	</div>
	<?php if(!wp_is_mobile()): ?>
	<svg class="banner-decor-1" xmlns="http://www.w3.org/2000/svg" width="1600" height="44" viewBox="0 0 1600 44" fill="none">
		<path d="M-105.828 0.698242C108.932 25.26 421.634 40.7278 769.771 40.7278C1117.91 40.7278 1430.61 25.2601 1645.37 0.698275V56.8414L-105.828 56.8414V0.698242Z" fill="#E8F8FD"></path>
	</svg>
	<?php else: ?>
	<svg  class="banner-decor-1" xmlns="http://www.w3.org/2000/svg" width="376" height="20" viewBox="0 0 376 20" fill="none">
		<path d="M-1.22656 0.787109C-1.22656 0.787109 82.5783 17.6843 186.958 17.6843C291.338 17.6843 375.143 0.787109 375.143 0.787109V28.8697H-1.22656V0.787109Z" fill="#D5F2F2"/>
	</svg>
	<?php endif; ?>
	<?php echo wp_get_attachment_image(498, 'full', false, array( 'class' => 'banner__decor-2'));?>
	<div class="banner__content-wrapper">
		<div class="banner__content">
			<div class="banner__content-breadcrumb">
				<ul class="breadcrumb-list">
					<li class="breadcrumb-item">
						<a href="/" class="breadcrumb-item__link">Trang chủ</a>
					</li>
					<li class="breadcrumb-item">
						<a href="#" class="breadcrumb-item__link"> • Lịch khai giảng</a>
					</li>
				</ul>
			</div>
			<h1 class="banner__content-title">
				<?=  $banner_acf["title_pc"] ?? ""; ?>
			</h1>
		</div>
	</div>
</section>