<?php
$header_main_menu = get_field('header_main_menu', 'option');
$logo = $header_main_menu['logo'] ?? '';
$the_most_searched = get_field('the_most_searched', 'option');
?>
<div class="popup-search">
  <svg class="close-popup-search" xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none">
    <path d="M13.2245 12.635L27.3667 26.7772C27.5244 26.9349 27.5244 27.2091 27.3667 27.3669C27.2089 27.5246 26.9347 27.5246 26.777 27.3669L12.6348 13.2247C12.4771 13.067 12.4771 12.7928 12.6348 12.635C12.7926 12.4773 13.0668 12.4773 13.2245 12.635Z" fill="#393939" stroke="#393939" stroke-width="1.66667" />
    <path d="M12.0443 27.9559C11.5611 27.4727 11.5611 26.6713 12.0443 26.1881L26.1864 12.046C26.6696 11.5628 27.471 11.5628 27.9542 12.046C28.4374 12.5292 28.4374 13.3306 27.9542 13.8138L13.8121 27.9559C13.3289 28.4391 12.5275 28.4391 12.0443 27.9559Z" fill="#393939" />
  </svg>
  <div class="site-header__logo">
    <a href="<?= esc_url(site_url()) ?>" class="site-header__logo-link">
      <?= wp_get_attachment_image($logo, 'medium', false, [
        'class' => 'site-header__logo-image',
      ]) ?>
    </a>
  </div>
  <div class="popup-search__input-container">
    <div class="popup-search__input">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
        <path d="M15 15.1992L21 21.1992M10 17.1992C6.13401 17.1992 3 14.0652 3 10.1992C3 6.33323 6.13401 3.19922 10 3.19922C13.866 3.19922 17 6.33323 17 10.1992C17 14.0652 13.866 17.1992 10 17.1992Z" stroke="#092C4C" stroke-opacity="0.38" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
      </svg>
      <input type="text" placeholder="Nhập từ khóa bạn muốn tìm">
    </div>
    <?php if (!isMobileDevice()) : ?>
      <a id="submit-search-header" class="main-banner__button">
        <span class="main-banner__button-text">Tìm kiếm</span>
        <span class="main-banner__button-icon"><img width="43" height="44" src="https://onngocbeuvinvi.edu.vn/wp-content/uploads/2025/05/Frame-1618872316-white.svg" class="attachment-thumbnail size-thumbnail" alt="" decoding="async"></span>
      </a>
    <?php endif; ?>
  </div>

  <p class="recommend-title">Tìm kiếm trước đây:</p>
  <div class="recommend-list recommend-list-history">
  </div>
  <p class="recommend-title">Được tìm kiếm nhiều nhất:</p>
  <div class="recommend-list recommend-list-most-searched">
    <?php foreach ($the_most_searched as $item) : ?>
      <div class="recommend-item">
        <span><?= esc_html($item['text']); ?></span>
      </div>
    <?php endforeach; ?>
  </div>

  <?php if (isMobileDevice()) : ?>
    <a id="submit-search-header">
      Tìm Kiếm
    </a>
  <?php endif; ?>
</div>
<div class="popup-search-overlay"></div>