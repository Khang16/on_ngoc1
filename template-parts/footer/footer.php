<?php 
	$logo_ft = get_field('logo_ft','option');
	$title_ft = get_field('title_ft','option');
	$sub_title_ft = get_field('sub_title_ft','option');

	$title_about_ft = get_field('title_about_ft','option');
	$list_pages_1 = get_field('list_pages_1','option');
	$btn_about = get_field('btn_about', 'option');

	$title_pl_ft = get_field('title_pl_ft','option');
	$list_pages_2 = get_field('list_pages_2','option');
	$title_contact_ft = get_field('title_contact_ft','option');
	$list_socials_ft = get_field('list_socials_ft','option');

	$subtitle_address_ft = get_field('subtitle_address_ft','option');
	$title_address_ft = get_field('title_address_ft','option');
	$address_ft = get_field('address_ft','option');

	$phone_number_ft = get_field('phone_number_ft','option');
	$email_ft = get_field('email_ft','option');

	$title_time_ft = get_field('title_time_ft','option');
	$time_list = get_field('time_list','option');

?>
<footer class="footer">
	<?= wp_get_attachment_image(501, 'full', false, ['class' => 'background__mb']) ?>
	<?= wp_get_attachment_image(57, 'full', false, ['class' => 'background']) ?>
	<div class="container">
		<div class="container__top">
			<div class="column__top__left">
				<?= wp_get_attachment_image($logo_ft, 'full', false) ?>
				<p class="desc">
					<?= $title_ft ?>
				</p>
				<p class="sub__desc">
					<?= esc_html($sub_title_ft) ?>
				</p>
			</div>
			<div class="column__top__mid">
				<p class="title"><?= $title_about_ft ?></p>
				<div>
					<?php if(!empty($list_pages_1) && is_array($list_pages_1)): ?>
						<?php foreach($list_pages_1 as $item): ?>
							<a href="<?= esc_html($item['page']['url']) ?>" class="cloumn__item"><?= esc_html($item['page']['title']) ?></a>
						<?php endforeach; ?>
					<?php endif; ?>
				</div>
				<a href="<?= $btn_about['url'] ?>" target="<?= $btn_about['target'] ?>" class="main-banner__button btn-question">
					<span class="main-banner__button-text"><?= $btn_about['title'] ?></span>
					<span class="main-banner__button-icon"><img width="43" height="44" src="https://onngocbeuvinvi.edu.vn/wp-content/uploads/2025/05/Frame-1618872316-white.svg" class="attachment-thumbnail size-thumbnail" alt="" decoding="async"></span>
				</a>
			</div>

			<div class="column__top__right">
				<p class="title"><?= esc_html($title_pl_ft) ?></p>
				<?php if(!empty($list_pages_2) && is_array($list_pages_2)): ?>
					<?php foreach($list_pages_2 as $item): ?>
						<a href="<?= esc_html($item['page']['url']) ?>" class="cloumn__item"><?= esc_html($item['page']['title']) ?></a>
					<?php endforeach; ?>
				<?php endif; ?>

				<p class="social__title">
					<?= esc_html($title_contact_ft) ?>
				</p>
				<div class="list__socials">
					<?php if(!empty($list_socials_ft) && is_array($list_socials_ft)): ?>
						<?php foreach($list_socials_ft as $item): ?>
							<a href="<?= esc_html($item['link']['url']) ?>" class="social__item">
								<?= wp_get_attachment_image($item['icon'], 'full', false) ?>
							</a>
						<?php endforeach; ?>
					<?php endif; ?>
				</div>
			</div>
		</div>

		<div class="container__bottom">
			<div class="column__bottom__left">
				<div>
					<img src="/wp-content/uploads/2025/05/location.svg" alt=""
						 class="icon">
					<p class="sub__title">
						<?= esc_html($subtitle_address_ft) ?>
					</p>
				</div>
				<p class="title"><?= esc_html($title_address_ft) ?></p>
				<p class="desc"><?= esc_html($address_ft) ?></p>
			</div>
			<div class="column__bottom__mid">
				<div>
					<img src="/wp-content/uploads/2025/05/call.svg" alt="" class="icon">
					<p class="sub__title">
						Hotline
					</p>
				</div>
				<a href="telto:<?= esc_html($phone_number_ft) ?>" class="phone"><?= esc_html($phone_number_ft) ?></a>
				<div>
					<img src="/wp-content/uploads/2025/05/Frame-2147259658.svg" alt="" class="icon">
					<p class="sub__title">
						EMAIL
					</p>
				</div>
				<a href="mailto:<?= esc_html($email_ft) ?>" class="email"><?= esc_html($email_ft) ?></a>
			</div>
			<div class="column__bottom__right">
				<p class="title"><?= esc_html($title_time_ft) ?></p>
				<?php if(!empty($time_list) && is_array($time_list)): ?>
					<?php foreach($time_list as $item): ?>
						<div class="time">
							<p><?= esc_html($item['day']) ?></p> <span><?= esc_html($item['time']) ?></span>
						</div>
					<?php endforeach; ?>
				<?php endif; ?>
				
			</div>
		</div>
		<div class="container__copyright">
			<p class="copyright">
				©2025 Ôn Ngọc BeU
			</p>
			<a class="design" href="http://okhub.vn/" target="_blank">Designed by OKHub</a>
		</div>
	</div>
</footer>