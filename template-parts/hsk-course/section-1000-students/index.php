<?php
$data = get_field('section_1000_students');

?>
<section class="section-1000-students">
  <h2>
    <?= esc_html($data['title']); ?>
  </h2>
  <p>
    <?= esc_html($data['description']); ?>
  </p>
  <div class="image-container">
    <?php foreach ($data['images'] as $item) : ?>
      <?= wp_get_attachment_image($item['item'], 'full', false) ?>
    <?php endforeach; ?>
    <div class="dot"></div>
    <div class="dot"></div>
    <div class="dot"></div>
    <div class="dot"></div>
    <div class="dot"></div>
    <div class="content-intro">
      <?= wp_get_attachment_image($data['content']['logo'], 'full', false) ?>
      <div class="space"></div>
      <p>
        <?= esc_html($data['content']['text']); ?>
      </p>
    </div>
  </div>
</section>