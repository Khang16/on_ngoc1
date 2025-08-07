<section class="blog-list-banner">
  <?php if (!isMobileDevice()): ?>
    <?= wp_get_attachment_image(get_field('banner_pc'), 'full', false); ?>
  <?php else: ?>
    <?= wp_get_attachment_image(get_field('banner_mb'), 'full', false); ?>
  <?php endif; ?>
  <div class="blog-list-banner-content">
    <div class="blog-list-breadcrumb">
      <a href="/">Trang chủ</a>
      <p><span><?= get_the_title(); ?></span></p>
    </div>
    <h1><?= get_the_title(); ?></h1>
    <div class="blog-list-banner--deco">
      <?php if (isMobileDevice()): ?>
        <svg xmlns="http://www.w3.org/2000/svg" width="376" height="29" viewBox="0 0 376 29" fill="none">
          <path
            d="M0.412109 0.585938C0.412109 0.585938 83.9121 17.4216 187.912 17.4216C291.912 17.4216 375.412 0.585938 375.412 0.585938V28.5664H0.412109V0.585938Z"
            fill="white" />
        </svg>
      <?php else: ?>
        <svg xmlns="http://www.w3.org/2000/svg" width="1600" height="44" viewBox="0 0 1600 44" fill="none">
          <path
            d="M-105.828 0.698242C108.932 25.26 421.634 40.7278 769.771 40.7278C1117.91 40.7278 1430.61 25.2601 1645.37 0.698275V56.8414L-105.828 56.8414V0.698242Z"
            fill="white" />
        </svg>
      <?php endif; ?>
    </div>
  </div>
</section>

<section class="new-blogs">
  <div class="new-blogs__left">
    <!-- bài viết mới nhất (1 bài)-->
    <?php
    $query = new WP_Query([
      'post_type' => 'post',
      'posts_per_page' => 1,
      'orderby' => 'date',
      'order' => 'DESC',
    ]);
    if ($query->have_posts()) :
      while ($query->have_posts()) : $query->the_post();
    ?>
        <a href="<?php the_permalink(); ?>" class="new__item">
          <div class="overlay__mb"></div>
          <div class="new__thumb">
            <span class="new__badge">NEWS</span>
            <?php
            $thumbnail_url = get_the_post_thumbnail_url($item->ID, 'full');
            if ($thumbnail_url) {
              echo '<img src="' . esc_url($thumbnail_url) . '" alt="' . esc_attr(get_the_title($item)) . '">';
            } else {
              // Ảnh backup khi không có thumbnail
              echo '<img src="/wp-content/uploads/2025/07/PC-1.jpg" alt="No image">';
            }
            ?>
          </div>
          <div class="new__body">
            <?php
            $categories = get_the_category();
            if (!empty($categories)) {
              $category = $categories[0];
            }
            ?>
            <p class="new__title"><?php the_title(); ?></p>
            <p class="new__desc-short">
              <?= get_the_excerpt(); ?>
            </p>
            <div class="new__footer">
              <div class="new__date">
                <img class="icon" src="/wp-content/uploads/2025/05/Calendar_duotone.svg" alt="">
                <p><?php echo get_the_date('d/m/Y'); ?></p>
              </div>
              <div class="new__link">
                <p>Chi tiết bài viết</p>
                <div>
                  <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" viewBox="0 0 27 27" fill="none">
                    <path d="M11.9805 11.0264L14.7524 13.8294L11.9805 16.5702" stroke="#5B378F" stroke-width="1.5" stroke-linecap="round" />
                  </svg>
                </div>
              </div>
            </div>
          </div>
        </a>
    <?php
      endwhile;
      wp_reset_postdata();
    endif;
    ?>
  </div>
  <div class="new-blogs__right">
    <div class="blog-search">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
        <path d="M15 15L21 21M10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10C17 13.866 13.866 17 10 17Z" stroke="#092C4C" stroke-opacity="0.38" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
      </svg>
      <input type="text" placeholder="Tìm kiếm trong Blog" id="blog-search-input">
    </div>

    <!-- danh sách bài viết mới (4 bài) -->
    <?php
    $query = new WP_Query([
      'post_type' => 'post',
      'posts_per_page' => 4,
      'orderby' => 'date',
      'order' => 'DESC',
      'offset' => 1, // Bỏ qua bài đầu tiên
    ]);
    if ($query->have_posts()) :
      while ($query->have_posts()) : $query->the_post();
    ?>
        <a href="<?php the_permalink(); ?>" class="new__item-right">
          <div class="new__item-right__thumb">
            <?php
            $thumbnail_url = get_the_post_thumbnail_url($item->ID, 'full');
            if ($thumbnail_url) {
              echo '<img src="' . esc_url($thumbnail_url) . '" alt="' . esc_attr(get_the_title($item)) . '">';
            } else {
              // Ảnh backup khi không có thumbnail
              echo '<img src="/wp-content/uploads/2025/07/PC-1.jpg" alt="No image">';
            }
            ?>
          </div>
          <div class="new__item-right__body">
            <div>
              <p class="new__item-right__cate">
                <svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" viewBox="0 0 11 11" fill="none">
                  <circle cx="5.8125" cy="5.5" r="5.0625" fill="url(#paint0_linear_2334_42754)" />
                  <path d="M3.69014 5.27695C3.56519 5.27696 3.4639 5.37826 3.46391 5.50322C3.46392 5.62817 3.56523 5.72946 3.69018 5.72945L3.69014 5.27695ZM8.09448 5.66281C8.18283 5.57445 8.18282 5.43119 8.09445 5.34285L6.65448 3.90312C6.56612 3.81477 6.42287 3.81478 6.33452 3.90314C6.24617 3.99151 6.24618 4.13476 6.33454 4.22311L7.61452 5.50287L6.33476 6.78284C6.24641 6.87121 6.24642 7.01446 6.33478 7.10281C6.42315 7.19116 6.5664 7.19115 6.65475 7.10278L8.09448 5.66281ZM3.69016 5.5032L3.69018 5.72945L7.9345 5.72909L7.93448 5.50284L7.93446 5.27659L3.69014 5.27695L3.69016 5.5032Z" fill="white" />
                  <defs>
                    <linearGradient id="paint0_linear_2334_42754" x1="0.75" y1="5.5" x2="10.875" y2="5.5" gradientUnits="userSpaceOnUse">
                      <stop stop-color="#5B378F" />
                      <stop offset="1" stop-color="#7C58B1" />
                    </linearGradient>
                  </defs>
                </svg>
                <span>Bài viết mới</span>
              </p>
              <p class="new__title"><?php the_title(); ?></p>
            </div>
            <div class="new__footer">
              <div class="new__date">
                <img class="icon" src="/wp-content/uploads/2025/05/Calendar_duotone.svg" alt="">
                <p><?php echo get_the_date('d/m/Y'); ?></p>
              </div>
            </div>
          </div>
        </a>
    <?php
      endwhile;
      wp_reset_postdata();
    endif;
    ?>
  </div>
</section>

<?php
$sections = get_field('blog_sections');
?>

<section class="section-blog">
  <div class="list-blog-by-cate">
    <?php if ($sections): ?>
      <?php foreach ($sections as $section): ?>
        <div class="list-blog-by-cate__item">
          <div class="list-blog-by-cate__item-header">
            <h2 class="list-blog-by-cate__item-title"><?= $section['title']; ?></h2>
            <a href="<?= $section['view_all_button']['url']; ?>" class="list-blog-by-cate__item-link" target="<?= esc_attr($section['view_all_button']['target']); ?>">
              <?= esc_html($section['view_all_button']['title']); ?>
            </a>
          </div>
          <?= wp_get_attachment_image($section['thumbnail'], 'full', false); ?>
          <div class="list-blog-by-cate__item-wrapper">
            <?php foreach ($section['blog_items'] as $item): ?>
              <?php setup_postdata($item); ?>
              <a href="<?php the_permalink($item); ?>" class="new__item">
                <div class="overlay__mb"></div>
                <div class="new__thumb">
                  <span class="new__badge">NEWS</span>
                  <?php
                    $thumbnail_url = get_the_post_thumbnail_url($item->ID, 'full');
                    if ($thumbnail_url) {
                      echo '<img src="' . esc_url($thumbnail_url) . '" alt="' . esc_attr(get_the_title($item)) . '">';
                    } else {
                      // Ảnh backup khi không có thumbnail
                      echo '<img src="/wp-content/uploads/2025/07/PC-1.jpg" alt="No image">';
                    }
                    ?>
                </div>
                <div class="new__body">
                  <?php
                  $categories = get_the_category($item->ID);
                  $category = !empty($categories) ? $categories[0] : null;
                  ?>
                  <div>
                      <p class="new__cate">
                        <svg xmlns="http://www.w3.org/2000/svg" width="4" height="5" viewBox="0 0 4 5" fill="none">
                          <circle cx="1.82812" cy="2.38086" r="1.82812" fill="#5B378F" />
                        </svg>
                        <span><?= $category ? esc_html($category->name) : ''; ?></span>
                      </p>
                      <p class="new__title"><?php echo get_the_title($item); ?></p>
                      <p class="new__desc-short">
                        <?= get_the_excerpt($item); ?>
                      </p>
                  </div>
                  <div class="new__footer">
                    <div class="new__date">
                      <img class="icon" src="/wp-content/uploads/2025/05/Calendar_duotone.svg" alt="">
                      <p><?php echo get_the_date('d/m/Y', $item); ?></p>
                    </div>
                    <div href="<?php the_permalink($item); ?>" class="new__link">
                      <p>Chi tiết bài viết</p>
                      <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" viewBox="0 0 27 27" fill="none">
                          <path d="M11.9805 11.0264L14.7524 13.8294L11.9805 16.5702" stroke="#5B378F" stroke-width="1.5" stroke-linecap="round" />
                        </svg>
                      </div>
                    </div>
                  </div>
                </div>
              </a>
              <?php wp_reset_postdata(); ?>
            <?php endforeach; ?>
          </div>
          <a href="<?= $section['view_all_button']['url']; ?>" class="list-blog-by-cate__item-link-mb" target="<?= esc_attr($section['view_all_button']['target']); ?>">
            <?= esc_html($section['view_all_button']['title']); ?>
          </a>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
  <div class="section-blog-right">
    <div class="section-blog-right-wrapper">
      <div class="tags-container">
        <p class="tags__title">Tags</p>
        <div class="tags__list">
          <?php
          $tags = get_tags(array('hide_empty' => false));
          if ($tags) {
            foreach ($tags as $tag) {
               echo '<a href="/?s=' . urlencode($tag->name) . '" class="tag-item">' . esc_html($tag->name) . '</a>';
            }
          }
          ?>
        </div>

      </div>
      <div class="course-info">
        <img src="/wp-content/uploads/2025/07/fb.webp" alt="">
        <p>
          truy cập ngay vào các khóa học của chúng tôi!
        </p>
        <a href="/khoa-hoc" class="main-banner__button">
          <span class="main-banner__button-text">Tìm hiểu các khoá học</span>
          <span class="main-banner__button-icon"><?= wp_get_attachment_image(87) ?></span>
        </a>
      </div>
    </div>
  </div>
</section>