<?php
$header_contact = get_field('header_contact', 'option');
$header_contact_link = get_field('header_contact_link', 'option');
$header_main_menu = get_field('header_main_menu', 'option');
$logo = $header_main_menu['logo'] ?? '';
$menu_lv1 = $header_main_menu['menu_lv1'] ?? [];
$transparent_page = is_page_template("opening-course-schedule-page.php") || is_page_template('blog-list.php') || is_category() || is_page_template('extends-page.php') ;
?>
<header data-transparent-top="<?= $transparent_page ? "true" : "false"; ?>" class="header header-mobile">
    <div class="header-mobile__top">
        <a href="<?= esc_url(site_url()) ?>" class="header-mobile__logo-link">
            <?= wp_get_attachment_image($logo, 'medium', false, [
                'class' => 'header-mobile__logo-image',
            ]) ?>
        </a>
        <div class="header-mobile__actions-btn">
            <svg id="trigger-search-header" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                <path d="M17.7344 16.4593L15.1932 13.927C16.5708 12.2251 17.2428 10.0594 17.0707 7.87658C16.8986 5.69373 15.8954 3.66015 14.2681 2.19517C12.6407 0.730193 10.5132 -0.0544843 8.32437 0.00294371C6.13551 0.0603717 4.05212 0.955527 2.50382 2.50382C0.955527 4.05212 0.0603717 6.13551 0.00294371 8.32437C-0.0544843 10.5132 0.730193 12.6407 2.19517 14.2681C3.66015 15.8954 5.69373 16.8986 7.87658 17.0707C10.0594 17.2428 12.2251 16.5708 13.927 15.1932L16.4593 17.7344C16.5428 17.8185 16.6421 17.8854 16.7515 17.9309C16.8609 17.9765 16.9783 18 17.0968 18C17.2154 18 17.3327 17.9765 17.4422 17.9309C17.5516 17.8854 17.6509 17.8185 17.7344 17.7344C17.8185 17.6509 17.8854 17.5516 17.9309 17.4422C17.9765 17.3327 18 17.2154 18 17.0968C18 16.9783 17.9765 16.8609 17.9309 16.7515C17.8854 16.6421 17.8185 16.5428 17.7344 16.4593ZM1.83152 8.56622C1.83152 7.23422 2.2265 5.93213 2.96652 4.82462C3.70654 3.7171 4.75835 2.8539 5.98896 2.34416C7.21956 1.83443 8.57369 1.70106 9.88009 1.96092C11.1865 2.22078 12.3865 2.8622 13.3284 3.80406C14.2702 4.74593 14.9116 5.94594 15.1715 7.25234C15.4314 8.55874 15.298 9.91287 14.7883 11.1435C14.2785 12.3741 13.4153 13.4259 12.3078 14.1659C11.2003 14.9059 9.89821 15.3009 8.56622 15.3009C6.78006 15.3009 5.06706 14.5914 3.80406 13.3284C2.54106 12.0654 1.83152 10.3524 1.83152 8.56622Z" fill="#2CBDBE" />
            </svg>
            <button class="header-mobile__toggle" aria-label="<?php esc_attr_e('Toggle navigation', 'okhub'); ?>">
                <span class="header-mobile__toggle-divine header-mobile__toggle-divine--1"></span>
                <span class="header-mobile__toggle-divine header-mobile__toggle-divine--1"></span>
                <span class="header-mobile__toggle-divine header-mobile__toggle-divine--1"></span>
            </button>
        </div>
    </div>
    <?php if ($menu_lv1): ?>
        <nav class="header-mobile__nav">
            <span>Menu</span>
            <ul class="header-mobile__menu">
                <?php foreach ($menu_lv1 as $item):
                    $link = $item['link'] ?? [];
                    $link_url = $link['url'] ?? '';
                    $link_title = $link['title'] ?? '';
                    $link_target = $link['target'] ?? '_self';
                    $menu_lv2 = $item['menu_lv2'] ?? [];
                ?>
                    <li class="header-mobile__menu-item <?= $menu_lv2 ? 'header-mobile__menu-item--has-sub' : '' ?>">
                        <a href="<?= esc_url($link_url) ?>" target="<?= esc_attr($link_target) ?>"
                            class="header-mobile__menu-link">
                            <span><?= esc_html($link_title) ?></span>
                            <?php if ($menu_lv2): ?>
                                <?= wp_get_attachment_image(33, 'thumbnail', false, [
                                    'class' => 'header-mobile__menu-icon',
                                ]) ?>
                            <?php endif; ?>
                        </a>

                        <?php if ($menu_lv2):
                            $title = $item['title'] ?? '';
                            $description = $item['description'] ?? '';
                            $background = $item['background'] ?? '';
                        ?>
                            <div class="header-mobile__submenu">
                                <nav class="header-mobile__submenu-nav">
                                    <span class="header-mobile__submenu-nav-prev">
                                        <?= wp_get_attachment_image(59, 'thumbnail') ?>
                                        <?= esc_html($link_title) ?>
                                    </span>
                                    <ul class="header-mobile__submenu-list">
                                        <?php foreach ($menu_lv2 as $submenu_item):
                                            $submenu_link = $submenu_item['link'] ?? [];
                                            $submenu_url = $submenu_link['url'] ?? '';
                                            $submenu_title = $submenu_link['title'] ?? '';
                                            $submenu_target = $submenu_link['target'] ?? '_self';
                                            $menu_lv3 = $submenu_item['menu_lv3'] ?? [];
                                        ?>
                                            <li
                                                class="header-mobile__submenu-item <?= $menu_lv3 ? 'header-mobile__submenu-item--has-sub' : '' ?>">
                                                <a href="<?= esc_url($submenu_url) ?>" target="<?= esc_attr($submenu_target) ?>"
                                                    class="header-mobile__submenu-link">
                                                    <span><?= esc_html($submenu_title) ?></span>
                                                    <?php if ($menu_lv3): ?>
                                                        <?= wp_get_attachment_image(36, 'thumbnail') ?>
                                                    <?php endif; ?>
                                                </a>

                                                <?php if ($menu_lv3): ?>
                                                    <ul class="header-mobile__sub-submenu-list">
                                                        <li>
                                                            <span class="header-mobile__sub-submenu-list-prev">
                                                                <?= wp_get_attachment_image(59, 'thumbnail') ?>
                                                                <?= esc_html($submenu_title) ?>
                                                            </span>
                                                        </li>
                                                        <?php foreach ($menu_lv3 as $subsubmenu_item):
                                                            $sublink = $subsubmenu_item['link'] ?? [];
                                                            $sublink_url = $sublink['url'] ?? '';
                                                            $sublink_title = $sublink['title'] ?? '';
                                                            $sublink_target = $sublink['target'] ?? '_self';
                                                        ?>
                                                            <li class="header-mobile__sub-submenu-item">
                                                                <a href="<?= esc_url($sublink_url) ?>"
                                                                    target="<?= esc_attr($sublink_target) ?>">
                                                                    <span><?= esc_html($sublink_title) ?></span>
                                                                </a>
                                                            </li>
                                                        <?php endforeach; ?>
                                                        <?= header_bottom() ?>
                                                    </ul>
                                                <?php endif; ?>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                    <?= header_bottom() ?>
                                </nav>
                            </div>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
            <?= header_bottom() ?>
        </nav>
    <?php endif; ?>
</header>
<?php
function header_bottom()
{
    $header_submenu = get_field('header_submenu', 'option');
    $header_socials = get_field('header_socials', 'option');
    ob_start();
?>
    <?php if ($header_submenu): ?>
        <div class="header-mobile__submenu-contact">
            <?php foreach ($header_submenu as $submenu_contact):
                $sub_link = $submenu_contact['link'] ?? [];
                $sub_link_url = $sub_link['url'] ?? '';
                $sub_link_title = $sub_link['title'] ?? '';
                $sub_link_target = $sub_link['target'] ?? '_self';
            ?>
                <a href="<?= esc_url($sub_link_url) ?>" target="<?= esc_attr($sub_link_target) ?>"
                    class="header-mobile__submenu-contact-item">
                    <span class="header-mobile__submenu-text">
                        <?= esc_html($sub_link_title) ?>
                    </span>
                </a>
            <?php endforeach; ?>
        </div>
        <div class="header-mobile__submenu-socials">
            <?php foreach ($header_socials as $social):
                $social_link = $social['link'] ?? [];
                $social_url = $social_link['url'] ?? '';
                $social_title = $social_link['title'] ?? '';
                $social_target = $social_link['target'] ?? '_blank';
            ?>
                <a href="<?= esc_url($social_url) ?>" target="<?= esc_attr($social_target) ?>"
                    class="header-mobile__submenu-social-link">
                    <?= wp_get_attachment_image($social['icon'], 'thumbnail', false, [
                        'class' => 'header-mobile__submenu-social-icon',
                    ]) ?>
                    <span class="header-mobile__submenu-social-text"><?= esc_html($social_title) ?></span>
                </a>
            <?php endforeach; ?>
        </div>
        <div class="header-mobile__copyright">
            <p>
                ©2025 Ôn Ngọc BeU
            </p>
            <p>
                Designed by OKHub
            </p>
        </div>
        <div class="header-mobile__background-blur"></div>
        <?= wp_get_attachment_image(41, 'medium', false, [
            'class' => 'header-mobile__background',
        ]) ?>
    <?php endif; ?>
<?php
    return ob_get_clean();
}
?>