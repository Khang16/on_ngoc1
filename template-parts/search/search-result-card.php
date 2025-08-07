<?php
$terms = get_the_terms(get_the_ID(), 'categories-extends');
$text_btn = isset($args['text-btn']) ? $args['text-btn'] : 'Chi tiết bài viết';
?>
<div class="search-result-card">
  <a href="<?= esc_url(get_the_permalink()) ?>" class="search-result-card__thumb">
    <?= get_the_post_thumbnail(get_the_ID(), 'full', array('class' => 'search-result-card__thumb-img')) ?>
    <?php if (!empty($terms) && is_array($terms)): ?>
      <span class="search-result-card__badge">
        <?= esc_html($terms[0]->name) ?>
      </span>
    <?php endif; ?>
  </a>
  <div class="search-result-card__content">
    <?php if (!empty($terms) && is_array($terms)): ?>
      <span class="search-result-card__label">
        <?= esc_html($terms[0]->name) ?>
      </span>
    <?php endif; ?>
    <h3 class="search-result-card__title">
      <a href="<?= esc_url(get_the_permalink()) ?>"><?= esc_html(get_the_title()) ?></a>
    </h3>
    <?php if (get_the_excerpt()) : ?>
      <p class="search-result-card__desc"><?= esc_html(get_the_excerpt()) ?></p>
    <?php endif; ?>
    <div class="search-result-card__meta">
      <span class="search-result-card__date">
        <?= wp_get_attachment_image(730, 'full', false, array('class' => 'search-result-card__date-icon')) ?>
        <span class="search-result-card__date-text"><?= esc_html(get_the_date('d/m/Y')) ?></span>
      </span>
      <a href="<?= esc_url(get_the_permalink()) ?>" class="search-result-card__cta">
        <span class="search-result-card__cta-text">
          <?= esc_html($text_btn) ?>
        </span>
        <span class="search-result-card__cta-icon">
          <?= wp_get_attachment_image(1147, 'full', false) ?>
        </span>
      </a>
    </div>
  </div>
</div>