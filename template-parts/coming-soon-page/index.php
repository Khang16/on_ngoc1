<?php
$logo = get_field('logo');
$title = get_field('title');
$sub_title = get_field('sub_title');
$launch_date = get_field('launch_date'); // 2025-06-21 00:00:00
$list_social = get_field('list_social');

?>


<section class="coming-soon">
  <?= wp_get_attachment_image(581, 'full', false, ["class" => 'coming-soon__mask-1']); ?>
  <?= wp_get_attachment_image(580, 'full', false, ["class" => 'coming-soon__mask-2']); ?>

  <div class="coming-soon__content-wrapper">
    <?= wp_get_attachment_image($logo, 'full', false, ["class" => 'coming-soon__logo']); ?>
    <h1 class="coming-soon__title"><?= esc_html($title) ?></h1>
    <p class="coming-soon__sub-title"><?= esc_html($sub_title) ?></p>

    <!-- Countdown Timer -->
    <div class="countdown-container">
      <div class="countdown-circle">
        <div class="countdown-value" id="days">30</div>
        <div class="countdown-label">ngày</div>
      </div>
      <div class="countdown-circle">
        <div class="countdown-value" id="hours">30</div>
        <div class="countdown-label">giờ</div>
      </div>
      <div class="countdown-circle">
        <div class="countdown-value" id="minutes">30</div>
        <div class="countdown-label">phút</div>
      </div>
    </div>

    <div class="coming-soon__subscribe">
      <input type="email" name="email" id="subscribe-email" placeholder="Điền email của bạn" />
      <button id="subscribe-btn">
        Nhận thông tin
        <span id="subscribe-loading" class="subscribe-spinner" style="display:none;margin-left:0.25rem;"></span>
      </button>
      <div id="subscribe-message" class="subscribe-message"></div>

      <div id="hidden-cf7" style="display: none;">
        <?php echo do_shortcode('[contact-form-7 id="8fdb159" title="Coming soon form"]'); ?>
      </div>

    </div>

    <p class="coming-soon__social-title">
      Theo dõi chúng tôi
    </p>
    <?php if ($list_social && is_array($list_social) && count($list_social) > 0) : ?>
      <div class="social-links">
        <?php foreach ($list_social as $social) : ?>
          <a href="<?= esc_url($social['url']) ?>" target="_blank" rel="noopener">
            <?= wp_get_attachment_image($social['icon'], 'full'); ?>
          </a>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</section>

<script>
  const launchDate = <?= json_encode($launch_date) ?>; // Chuyển sang js
  // Lấy các thuộc tính CF7 từ form ẩn (theo HTML đã cho)
  const cf7Form = document.querySelector('#hidden-cf7 form');
  let cf7Data = {};
  if (cf7Form) {
    // Lấy các thuộc tính từ form cha và cha của form
    const cf7Wrapper = cf7Form.closest('.wpcf7');
    cf7Data['_wpcf7'] = cf7Wrapper ? cf7Wrapper.getAttribute('id')?.replace('wpcf7-f', '').replace('-o1', '') : '';
    cf7Data['_wpcf7_unit_tag'] = cf7Wrapper ? cf7Wrapper.getAttribute('id')?.replace('wpcf7-', '') : '';
    cf7Data['_wpcf7_version'] = cf7Form.querySelector('input[name="_wpcf7_version"]')?.value || '';
    cf7Data['_wpcf7_locale'] = cf7Wrapper ? cf7Wrapper.getAttribute('lang') : '';
    cf7Data['_wpcf7_container_post'] = cf7Form.querySelector('input[name="_wpcf7_container_post"]')?.value || '';
    // Nếu có hash
    cf7Data['_wpcf7_posted_data_hash'] = cf7Form.querySelector('input[name="_wpcf7_posted_data_hash"]')?.value || '';
  }
</script>