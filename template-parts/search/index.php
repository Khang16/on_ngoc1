<?php
// acf
$list_of_courses = get_field('list_of_courses', 'option');
$you_may_be_interested = get_field('you_may_be_interested', 'option');

// lấy từ khóa tìm kiếm
$s = get_search_query();

// tìm kiếm các bài viết
$blogs = new WP_Query(array(
  'post_type' => 'post',
  's' => $s,
  'posts_per_page' => 3,
  'orderby' => 'relevance',
  'order' => 'DESC',
));

// post_type = extends (categories-extends = video-luyen-nghe)
$video_luyen_nghe = new WP_Query(array(
  'post_type' => 'extends',
  's' => $s,
  'posts_per_page' => 3,
  'orderby' => 'relevance',
  'order' => 'DESC',
  'tax_query' => array(
    array(
      'taxonomy' => 'categories-extends',
      'field'    => 'slug',
      'terms'    => 'video-luyen-nghe',
    ),
  ),
));

// post_type = extends (categories-extends = tu-vung-chuyen-nganh)
$tu_vung_chuyen_nganh = new WP_Query(array(
  'post_type' => 'extends',
  's' => $s,
  'posts_per_page' => 3,
  'orderby' => 'relevance',
  'order' => 'DESC',
  'tax_query' => array(
    array(
      'taxonomy' => 'categories-extends',
      'field'    => 'slug',
      'terms'    => 'tu-vung-chuyen-nganh',
    ),
  ),
));

// post_type = extends (categories-extends = ngu-phap)
$ngu_phap = new WP_Query(array(
  'post_type' => 'extends',
  's' => $s,
  'posts_per_page' => 3,
  'orderby' => 'relevance',
  'order' => 'DESC',
  'tax_query' => array(
    array(
      'taxonomy' => 'categories-extends',
      'field'    => 'slug',
      'terms'    => 'ngu-phap',
    ),
  ),
));


?>

<section class="search-page">
  <div class="search-input-wrapper">
    <div class="search-input">
      <svg xmlns="http://www.w3.org/2000/svg" width="25" height="24" viewBox="0 0 25 24" fill="none">
        <path d="M15.5 15L21.5 21M10.5 17C6.63401 17 3.5 13.866 3.5 10C3.5 6.13401 6.63401 3 10.5 3C14.366 3 17.5 6.13401 17.5 10C17.5 13.866 14.366 17 10.5 17Z" stroke="#092C4C" stroke-opacity="0.38" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
      </svg>
      <input type="text" value="<?= esc_attr($s); ?>" id="search-input" />
    </div>
    <a href="" class="search-submit">
      <?php if (!isMobileDevice()) : ?>
        Tìm kiếm
      <?php else: ?>
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
          <path d="M18.0908 16.9095L15.7325 14.5595C17.011 12.98 17.6347 10.9702 17.4749 8.94446C17.3152 6.91872 16.3842 5.0315 14.874 3.67195C13.3638 2.31241 11.3894 1.5842 9.35808 1.6375C7.32674 1.69079 5.3933 2.52152 3.95644 3.95839C2.51957 5.39525 1.68884 7.3287 1.63554 9.36003C1.58225 11.3914 2.31045 13.3657 3.67 14.8759C5.02954 16.3862 6.91676 17.3171 8.94251 17.4769C10.9683 17.6366 12.9781 17.0129 14.5575 15.7345L16.9075 18.0928C16.985 18.1709 17.0772 18.2329 17.1787 18.2752C17.2803 18.3175 17.3892 18.3393 17.4992 18.3393C17.6092 18.3393 17.7181 18.3175 17.8197 18.2752C17.9212 18.2329 18.0134 18.1709 18.0908 18.0928C18.169 18.0153 18.231 17.9232 18.2733 17.8216C18.3156 17.7201 18.3373 17.6111 18.3373 17.5011C18.3373 17.3911 18.3156 17.2822 18.2733 17.1807C18.231 17.0791 18.169 16.9869 18.0908 16.9095ZM3.33251 9.58447C3.33251 8.34833 3.69907 7.13996 4.38583 6.11215C5.07259 5.08435 6.0487 4.28327 7.19074 3.81022C8.33278 3.33717 9.58945 3.2134 10.8018 3.45456C12.0142 3.69572 13.1279 4.29097 14.0019 5.16505C14.876 6.03913 15.4713 7.15277 15.7124 8.36515C15.9536 9.57753 15.8298 10.8342 15.3568 11.9762C14.8837 13.1183 14.0826 14.0944 13.0548 14.7812C12.027 15.4679 10.8186 15.8345 9.58251 15.8345C7.92491 15.8345 6.3352 15.176 5.1631 14.0039C3.99099 12.8318 3.33251 11.2421 3.33251 9.58447Z" fill="white" />
        </svg>
      <?php endif; ?>
    </a>
  </div>

  <?php
  if (
    !$blogs->have_posts() &&
    !$video_luyen_nghe->have_posts() &&
    !$tu_vung_chuyen_nganh->have_posts() &&
    !$ngu_phap->have_posts()
  ):
  ?>
    <div class="search-no-results">
      <img src="https://onngocbeuvinvi.edu.vn/wp-content/uploads/2025/07/ko-kq.webp" alt="">
      <p>
        Không tìm thấy kết quả cho “<span><?= esc_html($s); ?></span>“
      </p>
    </div>
    <div class="search-results">
      <h2 class="search-results__title">Có Thể Bạn Quan Tâm</h2>
      <div class="search-results__list">
        <?php if (!empty($you_may_be_interested) && is_array($you_may_be_interested)): ?>
          <?php foreach ($you_may_be_interested as $post): ?>
            <?php setup_postdata($post); ?>
            <?php get_template_part('template-parts/search/search-result-card'); ?>
          <?php endforeach; ?>
          <?php wp_reset_postdata(); ?>
        <?php endif; ?>
      </div>
    </div>
  <?php else: ?>
    <h1 class="search-page-title">
      Kết quả cho: <span><?= esc_html($s); ?></span>
    </h1>
  <?php endif; ?>


  <div class="search-results">
    <h2 class="search-results__title">Danh Sách Khóa Học</h2>
    <div class="search-results__list">
      <?php foreach ($list_of_courses as $course) :
        $term_id = $course->term_id;
        $course_category_info = get_field('course_category_info', 'term_' . $term_id);
        $objective = $course_category_info['objective'] ?? '';
        $featured_image = $course_category_info['featured_image'] ?? 0;
        $term_link = get_term_link($term_id);
      ?>
        <div class="course-card">
          <div class="course-card__content">
            <h3 class="course-card__title">
              <?= $course->name ?>
            </h3>
            <p class="course-card__description">
              <?= $course->description ?>
            </p>
            <?php if ($objective): ?>
              <ul class="course-card__goals">
                <?php foreach ($objective as $item) : ?>
                  <li class="course-card__goal-item">
                    <?= $item['content'] ?>
                  </li>
                <?php endforeach; ?>
              </ul>
            <?php endif; ?>
            <a href="<?= $term_link ?>" class="course-card__button">Tìm hiểu thêm</a>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
  <?php if ($blogs->have_posts()): ?>
    <div class="search-results">
      <h2 class="search-results__title">Danh Sách Tin Tức</h2>
      <div class="search-results__list">
        <?php while ($blogs->have_posts()): $blogs->the_post(); ?>
          <?php get_template_part('template-parts/search/search-result-card'); ?>
        <?php endwhile; ?>
      </div>
    </div>
  <?php endif; ?>
  <?php if ($video_luyen_nghe->have_posts()): ?>
    <div class="search-results">
      <h2 class="search-results__title">Video Luyện Nghe</h2>
      <div class="search-results__list">
        <?php while ($video_luyen_nghe->have_posts()): $video_luyen_nghe->the_post(); ?>
          <?php get_template_part('template-parts/search/search-result-card', null, array('text-btn' => 'Chi tiết video')); ?>
        <?php endwhile; ?>
      </div>
    </div>
  <?php endif; ?>
  <?php if ($tu_vung_chuyen_nganh->have_posts()): ?>
    <div class="search-results">
      <h2 class="search-results__title">Từ Vựng Chuyên Ngành</h2>
      <div class="search-results__list">
        <?php while ($tu_vung_chuyen_nganh->have_posts()): $tu_vung_chuyen_nganh->the_post(); ?>
          <?php get_template_part('template-parts/search/search-result-card', null, array('text-btn' => 'Tìm hiểu thêm')); ?>
        <?php endwhile; ?>
      </div>
    </div>
  <?php endif; ?>
  <?php if ($ngu_phap->have_posts()): ?>
    <div class="search-results">
      <h2 class="search-results__title">Ngữ Pháp</h2>
      <div class="search-results__list">
        <?php while ($ngu_phap->have_posts()): $ngu_phap->the_post(); ?>
          <?php get_template_part('template-parts/search/search-result-card', null, array('text-btn' => 'Tìm hiểu thêm')); ?>
        <?php endwhile; ?>
      </div>
    </div>
  <?php endif; ?>
</section>