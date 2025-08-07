<?php
$data = get_field('section_course_for_whom');
?>
<section class="section-course-for-whom">
  <!-- 765 -->
  <!--<img src="https://onngocbeuvinvi.edu.vn/wp-content/uploads/2025/07/bg-1.webp" alt="" class="hoa" />-->
  <!-- 762 -->
  <!--<img src="https://onngocbeuvinvi.edu.vn/wp-content/uploads/2025/07/nha.webp" alt="" class="nha" />-->
  <!-- 764 -->
  <!--<img src="https://onngocbeuvinvi.edu.vn/wp-content/uploads/2025/07/thap.webp" alt="" class="thap" />-->
  <?= wp_get_attachment_image(765, 'full', false, ['class' => 'hoa']) ?>
  <?= wp_get_attachment_image(762, 'full', false, ['class' => 'nha']) ?>
  <?= wp_get_attachment_image(764, 'full', false, ['class' => 'thap']) ?>
  <?= wp_get_attachment_image($data['image'], 'full', false, ['class' => 'people']) ?>


  <div class="section-course-for-whom__content">
    <h2 class="section-course-for-whom__title"><?= esc_html($data['title']) ?></h2>
    <p>PHÙ HỢP VỚI:</p>
    <div class="section-course-for-whom__list">
      <?php foreach ($data['content'] as $item) : ?>
        <div class="section-course-for-whom__item">
          <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 21 21" fill="none">
            <path d="M10.0781 20.6523C12.7303 20.6523 15.2738 19.5988 17.1492 17.7234C19.0246 15.848 20.0781 13.3045 20.0781 10.6523C20.0781 8.00018 19.0246 5.45664 17.1492 3.58128C15.2738 1.70591 12.7303 0.652344 10.0781 0.652344C7.42596 0.652344 4.88242 1.70591 3.00706 3.58128C1.13169 5.45664 0.078125 8.00018 0.078125 10.6523C0.078125 13.3045 1.13169 15.848 3.00706 17.7234C4.88242 19.5988 7.42596 20.6523 10.0781 20.6523ZM14.4922 8.81641L9.49219 13.8164C9.125 14.1836 8.53125 14.1836 8.16797 13.8164L5.66797 11.3164C5.30078 10.9492 5.30078 10.3555 5.66797 9.99219C6.03516 9.62891 6.62891 9.625 6.99219 9.99219L8.82812 11.8281L13.1641 7.48828C13.5312 7.12109 14.125 7.12109 14.4883 7.48828C14.8516 7.85547 14.8555 8.44922 14.4883 8.8125L14.4922 8.81641Z" fill="#FFB800" />
            <path d="M14.4922 8.81641L9.49219 13.8164C9.125 14.1836 8.53125 14.1836 8.16797 13.8164L5.66797 11.3164C5.30078 10.9492 5.30078 10.3555 5.66797 9.99219C6.03516 9.62891 6.62891 9.625 6.99219 9.99219L8.82812 11.8281L13.1641 7.48828C13.5312 7.12109 14.125 7.12109 14.4883 7.48828C14.8516 7.85547 14.8555 8.44922 14.4883 8.8125L14.4922 8.81641Z" fill="white" />
          </svg>
          <span class="section-course-for-whom__text"><?= esc_html($item['text']) ?></span>
        </div>
      <?php endforeach; ?>
    </div>
    <a href="<?= $data['button']['url'] ?>" target="<?= $data['button']['target'] ?>" class="main-banner__button">
      <span class="main-banner__button-text"><?= $data['button']['title'] ?></span>
      <span class="main-banner__button-icon"><img width="43" height="44" src="https://onngocbeuvinvi.edu.vn/wp-content/uploads/2025/05/Frame-1618872316-white.svg" class="attachment-thumbnail size-thumbnail" alt="" decoding="async"></span>
    </a>
  </div>

  <div class="section-course-for-whom__highlight">
    <?php foreach ($data['highlight'] as $item) : ?>
      <div class="highlight-item">
        <?= wp_get_attachment_image($item['icon'], 'full', false) ?>
        <p>
          <?= esc_html($item['text']) ?>
        </p>
      </div>
    <?php endforeach; ?>
  </div>

</section>