<?php
$mission = get_field('mission');
$title = $mission['title'];
$description = $mission['description'];
$list = $mission['list'];
$_BG_PC = 93;
$_BG_MB = 92;
?>
<section class="mission" id="mission">
	<picture>
		<!-- Ảnh dành cho màn hình nhỏ hơn 640px -->
		<?= '<source media="(max-width: 639px)" srcset="' . esc_url(wp_get_attachment_image_url($_BG_MB, 'full')) . '" />' ?>

		<!-- Ảnh mặc định (>= 640px) -->
		<?= '<img class="mission__bg" src="' . esc_url(wp_get_attachment_image_url($_BG_PC, 'full')) . '" alt="">' ?>
	</picture>
	<div class="mission__main">
		<h2 class="text-pc-36-b text-mb-22-b color-text-title-main mission__title"><?= $title?>
		</h2>
		<p class="text-pc-18-bo text-mb-14-bo mission__description"><?= $description?></p>
		<div class="mission__category">
			<?php foreach ($list as $index => $item): ?>
			<div class="mission__category__item"
				 data-aos-delay="<?= 100 + ($index * 300) ?>">
				<?php if (!empty($item['image']['ID'])): ?>
				<?= wp_get_attachment_image($item['image']['ID'], 'full', false) ?>
				<?php endif; ?>
				<span><?= $item['title'] ?></span>
			</div>
			<?php endforeach; ?>
			<?php if(isMobileDevice()): ?>
			<div class="mission__category__item mission__category__item-2">
				<?php if (!empty($list[1]['image']['ID'])): ?>
				<?= wp_get_attachment_image($list[1]['image']['ID'], 'full', false) ?>
				<?php endif; ?>
				<span><?= $item['title'] ?></span>
			</div>
			<?php endif; ?>
		</div>
	</div>
</section>
