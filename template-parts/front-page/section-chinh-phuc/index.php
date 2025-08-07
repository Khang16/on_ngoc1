<section id="target">
  <?php
  $target_home = get_field('target_home', 72);
  $title = $target_home['title'];
  ?>
  <?= wp_get_attachment_image(238, 'full', false, ['class' => 'background']) ?>
  <div class="container__top">
    <?= wp_get_attachment_image(177, 'full', false, ['class' => 'background__ctn__top']) ?>
    <div class="group__header" data-aos="fade-up" data-aos-duration="1000">
      <h2 class="title"><?= esc_html($title); ?></h2>
      <div class="tab__container">
        <div class="list__tab">
          <?php
          $terms = $target_home['categories'];

          if (!empty($terms) && !is_wp_error($terms)):
            $first = true;
            foreach ($terms as $term):
              ?>
              <div tax-slug="<?= $term->slug ?>" class="tab__item<?php echo $first ? ' active' : ''; ?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="14" viewBox="0 0 16 14" fill="none">
                  <path
                    d="M16 5.10765C16.0028 5.71261 15.6493 6.26255 15.0977 6.51114L13.3033 7.32315L12.3008 7.77428L9.45372 9.06749C8.53535 9.49525 7.47488 9.49525 6.55652 9.06749L3.69942 7.77428L2.69693 7.32315L1.69444 6.86201V11.1928C1.83912 11.2836 1.92638 11.443 1.92501 11.6138V12.6464C1.92769 12.9205 1.70763 13.1449 1.43348 13.1476H1.42376H0.962619C0.688493 13.1503 0.464078 12.9303 0.461373 12.6562V12.6464V11.6138C0.460023 11.443 0.547279 11.2836 0.691946 11.1928V6.58131C0.691283 6.52313 0.701482 6.46533 0.722021 6.41089C0.00254035 5.96095 -0.215968 5.01295 0.233968 4.29347C0.396356 4.0338 0.632641 3.82859 0.912494 3.70416L6.55652 1.14781C7.47636 0.726771 8.53388 0.726771 9.45372 1.14781L15.0977 3.70416C15.6493 3.95277 16.0028 4.5027 16 5.10765Z"
                    fill="#5B378F" />
                  <path
                    d="M9.86474 9.97976C8.68556 10.5278 7.32467 10.5278 6.1455 9.97976L2.69693 8.42589V9.70908C2.69916 10.49 3.0617 11.2262 3.67937 11.7041C6.23307 13.6555 9.77717 13.6555 12.3309 11.7041C12.9459 11.2252 13.3049 10.4887 13.3033 9.70913V8.41592L12.7118 8.68659L9.86474 9.97976Z"
                    fill="#5B378F" />
                </svg>
                <p><?php echo esc_html($term->name); ?></p>
              </div>
              <?php
              $first = false;
            endforeach;
          endif;
          ?>
        </div>

        <a class="btn-secondary" href="/khoa-hoc">
          <p class="btn-secondary-text">Tất cả khoá học</p>
          <div class="btn-secondary-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="43" height="44" viewBox="0 0 43 44" fill="none">
              <path d="M19.6133 17.5723L24.0409 22.0497L19.6133 26.4276" stroke="white" stroke-width="1.5"
                stroke-linecap="round" />
            </svg>
          </div>
        </a>
      </div>
    </div>

    <!-- slide -->
    <div class="swiper__container">
      <div class="swiper swiper__course" data-aos="fade-left" data-aos-offset="0" data-aos-duration="1000">
        <div class="swiper-wrapper">
          <?php
          $cate_terms = get_terms(array(
            'taxonomy' => 'category-course',
            'hide_empty' => true,
            'number' => 1,
          ));

          $first_cate = !empty($cate_terms) ? $cate_terms[0] : null;


          if ($first_cate) {
            // Tạo mảng tham số để truy vấn các bài viết (khóa học)
            $course_args = array(
              // Chỉ lấy các bài viết thuộc post type 'course'
              'post_type' => 'course',
              // Giới hạn số lượng bài viết lấy ra là 5
              'posts_per_page' => 5,
              // Sắp xếp theo ID bài viết
              'orderby' => 'ID',
              // Sắp xếp theo thứ tự giảm dần (bài mới nhất trước)
              'order' => 'desc',
              // Lọc bài viết theo taxonomy 'category-course'
              'tax_query' => array(
                array(
                  // Tên taxonomy cần lọc
                  'taxonomy' => 'category-course',
                  // So sánh theo ID của term (chuyên mục)
                  'field' => 'term_id',
                  // Chỉ lấy bài viết thuộc chuyên mục đầu tiên
                  'terms' => $first_cate->term_id,
                ),
              ),
            );          
            $course_query = new WP_Query($course_args);

            if ($course_query->have_posts()):
              while ($course_query->have_posts()):
                $course_query->the_post();
                $post_id = get_the_ID();
                ?>
                <div class="swiper-slide">
                  <div class="course-card">
                    <div class="discount-tag">
                      <p><?= get_field('discount_title', $post_id); ?></p>
                      <span><?= get_field('discount_note', $post_id); ?></span>
                      <img src="/wp-content/uploads/2025/06/Rectangle-28.svg" alt="" />
                    </div>
                    <div class="course-card__inner">

                      <h2 class="course-title"><?= get_the_title(); ?></h2>
                      <p class="course-desc"><?= get_the_excerpt(); ?></p>

                      <ul class="course-info">
                        <li class="cour-info-item">
                          <?= wp_get_attachment_image(246, 'full', false, ['class' => 'icon']) ?>
                          <p>Mục tiêu: <?= get_field('target', $post_id); ?></p>
                        </li>
                        <li class="cour-info-item">
                          <?= wp_get_attachment_image(245, 'full', false, ['class' => 'icon']) ?>
                          <p>Đối tượng: <?= get_field('destine', $post_id); ?></p>
                        </li>
                        <li class="cour-info-item">
                          <?= wp_get_attachment_image(244, 'full', false, ['class' => 'icon']) ?>
                          <p>Trình độ: <?= get_field('level', $post_id); ?></p>
                        </li>
                      </ul>

                      <a href="<?= get_permalink(); ?>" class="learn-more">
                        <p>Tìm hiểu khóa học</p>
                        <div class="line"></div>
                        <div class="learn-more-icon">
                          <svg xmlns="http://www.w3.org/2000/svg" width="43" height="44" viewBox="0 0 43 44" fill="none">
                            <path d="M18.957 17.5723L23.3847 22.0497L18.957 26.4276" stroke="#5B378F" stroke-width="1.5"
                              stroke-linecap="round" />
                          </svg>
                        </div>
                      </a>

                      <?= wp_get_attachment_image(243, 'full', false, ['class' => 'image-decoration']) ?>
                      <?= wp_get_attachment_image(get_field('image_thumb', $post_id) ?? 692, 'full', false, ['class' => 'student-image']) ?>
                    </div>
                  </div>
                </div>
                <?php
              endwhile;
              wp_reset_postdata();
            endif;
          }
          ?>
        </div>

      </div>
      <div class="btn__prev__course">
        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="14" viewBox="0 0 17 14" fill="none">
          <path d="M15.1419 7H1" stroke="#063E2B" stroke-width="2" stroke-lnecap="round" stroke-linejoin="round" />
          <path d="M6.78532 12.7855L1 7.00015L6.78532 1.21484" stroke="#063E2B" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round" />
        </svg>
      </div>
      <div class="btn__next__course">
        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="14" viewBox="0 0 17 14" fill="none">
          <path d="M15.1419 7H1" stroke="#063E2B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
          <path d="M6.78532 12.7855L1 7.00015L6.78532 1.21484" stroke="#063E2B" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round" />
        </svg>
      </div>
    </div>


    <div class="pagination__course">
    </div>
    <a class="btn-secondary mb" href="#">
      <p class="btn-secondary-text">Tất cả khoá học</p>
      <div class="btn-secondary-icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="43" height="44" viewBox="0 0 43 44" fill="none">
          <path d="M19.6133 17.5723L24.0409 22.0497L19.6133 26.4276" stroke="white" stroke-width="1.5"
            stroke-linecap="round" />
        </svg>
      </div>
    </a>
  </div>

  <!-- Rate slide -->

  <?php if (is_front_page()): ?>
    <div class="group__review" data-aos="fade-up" data-aos-offset="0" data-aos-duration="500">
      <?php
      $feedbacks_std = get_field('feedbacks_std');
      $title = $feedbacks_std['title'];
      $list_feedbacks = $feedbacks_std['list_feedbacks'];
      ?>
      <?= wp_get_attachment_image(240, 'full', false, ['class' => 'background__review']) ?>
      <?= wp_get_attachment_image(185, 'full', false, ['class' => 'bg__review__mb']) ?>
      <p class="review__title">
        <?= esc_html($title); ?>
      </p>
      <div class="group__marquee">
        <?php if (!empty($list_feedbacks)): ?>
          <div class="marquue__container right swiper">
            <div class="swiper-wrapper">
              <?php foreach ($list_feedbacks as $post):
                setup_postdata($post); ?>
                <div class="review__item swiper-slide">
                  <img src="https://onngocbeuvinvi.edu.vn/wp-content/uploads/2025/07/Vector.svg" alt="" class="rate__icon">

                  <div class="img-wrapper">
                    <?php
                    $social_img = get_field('social_img', $post->ID);
                    if ($social_img):
                      echo wp_get_attachment_image($social_img, 'full', false, ['class' => 'social_img']);
                    endif;
                    ?>
                    <?php
                    $social_logo = get_field('social_logo', $post->ID);
                    if ($social_logo):
                      echo wp_get_attachment_image($social_logo, 'full', false, ['class' => 'social_logo']);
                    endif;
                    ?>
                  </div>

                  <div class="review__header">
                    <?php
                    $avatar = get_field('avatar_mem', $post->ID);
                    if ($avatar):
                      echo wp_get_attachment_image($avatar, 'full', false, ['class' => 'avatar']);
                    endif;
                    ?>
                    <div class="review__header__info">
                      <p class="name"><?php echo get_the_title($post->ID); ?></p>
                      <p class="role"><?php the_field('role_mem', $post->ID); ?></p>
                    </div>
                  </div>

                  <p class="content">
                    <?php the_field('content_rv', $post->ID); ?>
                  </p>

                  <div class="learn-more-wrapper">
                    <a class="learn-more" href="#">
                      <span>Tìm hiểu thêm</span>
                      <div class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="7" height="12" viewBox="0 0 7 12" fill="none">
                          <path d="M1.45703 1.63086L5.8847 6.10825L1.45703 10.4862" stroke="white" stroke-width="1.5"
                            stroke-linecap="round" />
                        </svg>
                      </div>
                    </a>
                  </div>
                </div>
              <?php endforeach;
              wp_reset_postdata(); ?>
            </div>
          </div>
        <?php endif; ?>

        <?php if (!empty($list_feedbacks)): ?>
          <div class="marquue__container left swiper">
            <div class="swiper-wrapper">
              <?php foreach ($list_feedbacks as $post):
                setup_postdata($post); ?>
                <div class="review__item swiper-slide">
                  <img src="https://onngocbeuvinvi.edu.vn/wp-content/uploads/2025/07/Vector.svg" alt="" class="rate__icon">

                  <div class="img-wrapper">
                    <?php
                    $social_img = get_field('social_img', $post->ID);
                    if ($social_img):
                      echo wp_get_attachment_image($social_img, 'full', false, ['class' => 'social_img']);
                    endif;
                    ?>
                    <?php
                    $social_logo = get_field('social_logo', $post->ID);
                    if ($social_logo):
                      echo wp_get_attachment_image($social_logo, 'full', false, ['class' => 'social_logo']);
                    endif;
                    ?>
                  </div>

                  <div class="review__header">
                    <?php
                    $avatar = get_field('avatar_mem', $post->ID);
                    if ($avatar):
                      echo wp_get_attachment_image($avatar, 'full', false, ['class' => 'avatar']);
                    endif;
                    ?>
                    <div class="review__header__info">
                      <p class="name"><?php echo get_the_title($post->ID); ?></p>
                      <p class="role"><?php the_field('role_mem', $post->ID); ?></p>
                    </div>
                  </div>

                  <p class="content">
                    <?php the_field('content_rv', $post->ID); ?>
                  </p>

                  <div class="learn-more-wrapper">
                    <a class="learn-more" href="#">
                      <span>Tìm hiểu thêm</span>
                      <div class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="7" height="12" viewBox="0 0 7 12" fill="none">
                          <path d="M1.45703 1.63086L5.8847 6.10825L1.45703 10.4862" stroke="white" stroke-width="1.5"
                            stroke-linecap="round" />
                        </svg>
                      </div>
                    </a>
                  </div>
                </div>
              <?php endforeach;
              wp_reset_postdata(); ?>
            </div>
          </div>
        <?php endif; ?>
      </div>
    </div>
  <?php endif; ?>
</section>

<template id="course__card-template">
  <div class="course-card">
    <div class="discount-tag">
      <p></p>
      <span></span>
      <svg xmlns="http://www.w3.org/2000/svg" width="177" height="55" viewBox="0 0 177 55" fill="none">
        <path
          d="M0.0234375 -1.02393H180.765V54.0863H56.5494C39.4834 54.0863 23.8322 44.5997 15.9367 29.4699L0.0234375 -1.02393Z"
          fill="#5B378F" />
      </svg>
    </div>
    <div class="course-card__inner">
      <p class="course-title"></p>
      <p class="course-desc"></p>
      <ul class="course-info">
        <li class="cour-info-item">
          <?= wp_get_attachment_image(246, 'full', false, ['class' => 'icon']) ?>
          <p>Mục tiêu: <span></span></p>
        </li>
        <li class="cour-info-item">
          <?= wp_get_attachment_image(245, 'full', false, ['class' => 'icon']) ?>
          <p>Đối tượng: <span></span></p>
        </li>
        <li class="cour-info-item">
          <?= wp_get_attachment_image(244, 'full', false, ['class' => 'icon']) ?>
          <p>Trình độ: <span></span></p>
        </li>
      </ul>
      <a href="<?= get_permalink(); ?>" class="learn-more">
        <p>Tìm hiểu khóa học</p>
        <div class="line"></div>
        <div class="learn-more-icon">
          <svg xmlns="http://www.w3.org/2000/svg" width="43" height="44" viewBox="0 0 43 44" fill="none">
            <path d="M18.957 17.5723L23.3847 22.0497L18.957 26.4276" stroke="#5B378F" stroke-width="1.5"
              stroke-linecap="round" />
          </svg>
        </div>
      </a>
      <?= wp_get_attachment_image(243, 'full', false, ['class' => 'image-decoration']) ?>
      <img src="" alt="" class="student-image">
    </div>
  </div>
</template>