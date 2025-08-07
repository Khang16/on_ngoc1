<?php
$header_contact = get_field('header_contact', 'option');
$header_contact_link = get_field('header_contact_link', 'option');
$header_main_menu = get_field('header_main_menu', 'option');
$header_submenu = get_field('header_submenu', 'option');
$header_socials = get_field('header_socials', 'option');
$header_slogan = get_field('header_slogan', 'option');

$logo = $header_main_menu['logo'] ?? '';
$menu_lv1 = $header_main_menu['menu_lv1'] ?? [];

$transparent_page = is_page_template("opening-course-schedule-page.php") || is_page_template('blog-list.php') || is_category() || is_page_template('extends-page.php') ;
?>

<header data-transparent-top="<?= $transparent_page ? "true" : "false"; ?>" 
		class="header site-header <?= $transparent_page ? "header--transparent":"" ?>">
    <div class="site-header__top">
        <?php if ($header_contact): ?>
            <div class="site-header__contact">
				<p class="site-header__contact-item">
					<span class="site-header__text">
						<?= $header_slogan ?? ""; ?>
					</span>
				</p>
            </div>
        <?php endif; ?>

        <?php
        $cta_url = $header_contact_link['url'] ?? '';
        $cta_text = $header_contact_link['title'] ?? '';
        $cta_target = $header_contact_link['target'] ?? '_self';
        ?>
        <?php if ($cta_url): ?>
            <div class="site-header__cta">
                <a href="<?= esc_url($cta_url) ?>" target="<?= esc_attr($cta_target) ?>" class="site-header__cta-button">
                    <span class="site-header__text">
                        <?= esc_html($cta_text) ?>
                    </span>
                    <?= wp_get_attachment_image(38, 'thumbnail', false, [
                        'class' => 'site-header__icon',
                    ]) ?>
                </a>
            </div>
        <?php endif; ?>
    </div>

    <div class="site-header__bottom">
        <div class="site-header__logo">
            <a href="<?= esc_url(site_url()) ?>" class="site-header__logo-link">
                <?= wp_get_attachment_image($logo, 'medium', false, [
                    'class' => 'site-header__logo-image',
                ]) ?>
            </a>
        </div>

        <?php if ($menu_lv1): ?>
            <nav class="site-header__nav">
                <ul class="site-header__menu">
                    <?php foreach ($menu_lv1 as $item):
                        $link = $item['link'] ?? [];
                        $link_url = $link['url'] ?? '';
                        $link_title = $link['title'] ?? '';
                        $link_target = $link['target'] ?? '_self';
                        $menu_lv2 = $item['menu_lv2'] ?? [];
                    ?>
                        <li class="site-header__menu-item <?= $menu_lv2 ? 'site-header__menu-item--has-sub' : '' ?>">
                            <a href="<?= esc_url($link_url) ?>" target="<?= esc_attr($link_target) ?>"
                                class="site-header__menu-link">
                                <span><?= esc_html($link_title) ?></span>
                                <?php if ($menu_lv2): ?>
                                    <?= wp_get_attachment_image(33, 'thumbnail', false, [
                                        'class' => 'site-header__menu-icon',
                                    ]) ?>
                                <?php endif; ?>
                            </a>

                            <?php if ($menu_lv2):
                                $title = $item['title'] ?? '';
                                $description = $item['description'] ?? '';
                                $background = $item['background'] ?? '';
                            ?>
                                <div class="site-header__submenu">
                                    <div class="site-header__submenu-inner">
                                        <div class="site-header__submenu-info">
                                            <p class="site-header__submenu-title">
                                                <?= esc_html($title) ?>
                                            </p>
                                            <p class="site-header__submenu-desc">
                                                <?= esc_html($description) ?>
                                            </p>
                                        </div>

                                        <nav class="site-header__submenu-nav">
                                            <ul class="site-header__submenu-list">
                                                <?php foreach ($menu_lv2 as $submenu_item):
                                                    $submenu_link = $submenu_item['link'] ?? [];
                                                    $submenu_url = $submenu_link['url'] ?? '';
                                                    $submenu_title = $submenu_link['title'] ?? '';
                                                    $submenu_target = $submenu_link['target'] ?? '_self';
                                                    $menu_lv3 = $submenu_item['menu_lv3'] ?? [];
                                                ?>
                                                    <li
                                                        class="site-header__submenu-item <?= $menu_lv3 ? 'site-header__submenu-item--has-sub' : '' ?>">
                                                        <a href="<?= esc_url($submenu_url) ?>" target="<?= esc_attr($submenu_target) ?>"
                                                            class="site-header__submenu-link">
                                                            <span><?= esc_html($submenu_title) ?></span>
                                                            <?php if ($menu_lv3): ?>
                                                                <?= wp_get_attachment_image(36, 'thumbnail') ?>
                                                            <?php endif; ?>
                                                        </a>

                                                        <?php if ($menu_lv3): ?>
                                                            <ul class="site-header__sub-submenu-list">
                                                                <?php foreach ($menu_lv3 as $subsubmenu_item):
                                                                    $sublink = $subsubmenu_item['link'] ?? [];
                                                                    $sublink_url = $sublink['url'] ?? '';
                                                                    $sublink_title = $sublink['title'] ?? '';
                                                                    $sublink_target = $sublink['target'] ?? '_self';
                                                                ?>
                                                                    <li class="site-header__sub-submenu-item">
                                                                        <a href="<?= esc_url($sublink_url) ?>"
                                                                            target="<?= esc_attr($sublink_target) ?>">
                                                                            <span><?= esc_html($sublink_title) ?></span>
                                                                        </a>
                                                                    </li>
                                                                <?php endforeach; ?>
                                                            </ul>
                                                        <?php endif; ?>
                                                    </li>
                                                <?php endforeach; ?>

                                                <li class="site-header__submenu-banner">
                                                    <span
                                                        class="site-header__submenu-banner-deco site-header__submenu-banner-deco--1"></span>
                                                    <span
                                                        class="site-header__submenu-banner-deco site-header__submenu-banner-deco--2"></span>
                                                    <span
                                                        class="site-header__submenu-banner-deco site-header__submenu-banner-deco--3"></span>
                                                    <?= wp_get_attachment_image($background, 'large') ?>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>

                                    <?php if ($header_submenu): ?>
                                        <div class="site-header__submenu-contact">
                                            <?php foreach ($header_submenu as $submenu_contact):
                                                $sub_link = $submenu_contact['link'] ?? [];
                                                $sub_link_url = $sub_link['url'] ?? '';
                                                $sub_link_title = $sub_link['title'] ?? '';
                                                $sub_link_target = $sub_link['target'] ?? '_self';
                                            ?>
                                                <a href="<?= esc_url($sub_link_url) ?>" target="<?= esc_attr($sub_link_target) ?>"
                                                    class="site-header__submenu-contact-item">
                                                    <span class="site-header__submenu-text">
                                                        <?= esc_html($sub_link_title) ?>
                                                    </span>
                                                </a>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>
                                    <?= wp_get_attachment_image(40, 'medium', false, [
                                        'class' => 'site-header__submenu-background-left',
                                    ]) ?>
                                </div>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>

                    <li class="site-header__menu-item site-header__menu-item--search">
                        <div id="trigger-search-header" class="site-header__menu-icon-link">
                            <?= wp_get_attachment_image(34) ?>
                        </div>
                    </li>
                    <div class="site-header__submenu-overlay"></div>
                </ul>
            </nav>
        <?php endif; ?>
    </div>
</header>