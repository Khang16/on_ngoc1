<?php

// Lấy content và tạo mục lục cho SEO
function generate_table_of_contents($content)
{
    // Tìm tất cả các thẻ h2, h3, h4
    preg_match_all('/<(h[2-4])[^>]*>(.*?)<\/h[2-4]>/i', $content, $matches, PREG_SET_ORDER);

    $toc = array();
    $updated_content = $content;

    foreach ($matches as $index => $match) {
        $tag = $match[1]; // h2, h3, h4
        $title = strip_tags($match[2]); // Nội dung tiêu đề
        $anchor = 'heading-' . ($index + 1);

        // Thêm data attribute cho heading - tối ưu SEO
        $new_heading = '<' . $tag . ' data-toc-target="' . $anchor . '" class="toc-heading">' . $match[2] . '</' . $tag . '>';
        $updated_content = str_replace($match[0], $new_heading, $updated_content);

        // Thêm vào mục lục
        $toc[] = array(
            'anchor' => $anchor,
            'title' => $title,
            'level' => intval(substr($tag, 1)) // 2, 3, 4
        );
    }

    return array('content' => $updated_content, 'toc' => $toc);
}

// Đăng ký shortcode cho blog quote với biến truyền vào
function blog_quote_shortcode($atts)
{
    $atts = shortcode_atts(
        array(
            'content' => '“Việc học không bao giờ làm trí tuệ mệt mỏi”',
            'author' => '– Leonardo da Vinci',
        ),
        $atts,
        'blog_quote'
    );

    ob_start();
?>
<div class="blog-quote">
    <p class="blog-quote__content"><?php echo esc_html($atts['content']); ?></p>
    <p class="blog-quote__author"><?php echo esc_html($atts['author']); ?></p>
    <svg xmlns="http://www.w3.org/2000/svg" width="44" height="28" viewBox="0 0 44 28" fill="none">
        <path
            d="M32.3602 0.63564C31.8069 0.40213 31.1749 0.645568 30.8923 1.17549L29.6877 3.43414C29.3445 4.07763 29.6535 4.86881 30.3047 5.19709C31.5098 5.80457 32.4079 6.55161 32.9989 7.4382C33.6834 8.61164 34.0257 9.19836 34.0257 9.19836C34.0257 9.19836 33.5368 9.29614 32.5589 9.49174C31.581 9.58952 30.5053 9.93177 29.3319 10.5185C28.0607 11.1052 26.9361 12.0342 25.9582 13.3054C24.9804 14.4789 24.4914 16.1413 24.4914 18.2926C24.4914 21.0307 25.4693 23.3775 27.4251 25.3333C29.283 27.1912 31.5321 28.0714 34.1724 27.9736C36.9104 27.8757 39.2573 26.8001 41.2131 24.7466C43.071 22.5953 44 20.0039 44 16.9724C44 13.1587 42.8266 9.78509 40.4797 6.85146C38.3414 4.08954 35.6349 2.0176 32.3602 0.63564ZM8.15791 0.63564C7.60453 0.40213 6.97247 0.645568 6.68995 1.17549L5.48527 3.43414C5.14214 4.07763 5.45118 4.86881 6.10233 5.19709C7.30743 5.80457 8.20555 6.55161 8.79652 7.4382C9.48103 8.61164 9.82329 9.19836 9.82329 9.19836C9.82329 9.19836 9.33446 9.29614 8.3565 9.49174C7.37868 9.58952 6.30296 9.93177 5.12947 10.5185C3.85835 11.1052 2.73381 12.0342 1.75586 13.3054C0.778042 14.4789 0.289062 16.1413 0.289062 18.2926C0.289062 21.0307 1.26688 23.3775 3.22265 25.3333C5.08065 27.1912 7.32973 28.0714 9.97002 27.9736C12.7081 27.8757 15.0549 26.8001 17.0107 24.7466C18.8687 22.5953 19.7977 20.0039 19.7977 16.9724C19.7977 13.1587 18.6242 9.78509 16.2774 6.85146C14.139 4.08954 11.4326 2.0176 8.15791 0.63564Z"
            fill="#2CBDBE" />
    </svg>
</div>
<?php
    return ob_get_clean();
}
add_shortcode('blog_quote', 'blog_quote_shortcode');

$categories = get_the_category();
$review = get_field('review');
$review_post = $review[0] ?? null; // Lấy bài review đầu tiên nếu có
$post_content = get_the_content();
$content_data = generate_table_of_contents($post_content);
?>


<div class="breadcrumbs">
    <a href="/" class="breadcrumb-item"><span>Trang chủ</span></a>
    <a href="/tin-tuc" class="breadcrumb-item"><span>Tin tức</span></a>
    <a href="<?= esc_url(get_category_link($categories[0]->term_id)) ?>" class="breadcrumb-item"><span><?= esc_html($categories[0]->name) ?></span></a>
    <p class="breadcrumb-item"><span>Chi tiết bài viết</span></p>
</div>

<section class="blog-detail-container">
    <div class="blog-detail">
        <h1>
            <?php the_title(); ?>
        </h1>
        <div class="blog-content">
            <?php echo apply_filters('the_content', $content_data['content']); ?>
        </div>

        <div class="blog-meta">
            <div class="blog-meta-item">
                <p class="blog-date"><span>Ngày đăng: </span><?php echo get_the_date('j/n/Y'); ?></p>
                <p class="blog-date"><span>Tác giả:
                    </span><?php echo get_the_author_meta('display_name', $post->post_author); ?></p>
            </div>
            <div class="blog-share">
                <span>Chia sẻ:</span>
                <?php if (!isMobileDevice()) :
                    $post_url = urlencode(get_permalink());
                ?>
                <!-- fb -->
                <a href="https://www.facebook.com/sharer/sharer.php?u=<?= $post_url ?>" target="_blank" rel="noopener"
                    class="blog-share-item">
                    <?= wp_get_attachment_image(65, 'full', false); ?>
                </a>
                <!-- tiktok -->
                <a href="" class="blog-share-item">
                    <?= wp_get_attachment_image(64, 'full', false); ?>
                </a>
                <!-- instagram -->
                <a href="" class="blog-share-item">
                    <?= wp_get_attachment_image(63, 'full', false); ?>
                </a>
                <!-- thread -->
                <a href="" class="blog-share-item">
                    <?= wp_get_attachment_image(62, 'full', false); ?>
                </a>
                <!-- zalo -->
                <a href="https://zalo.me/share?url=<?= $post_url ?>" target="_blank" rel="noopener"
                    class="blog-share-item">
                    <?= wp_get_attachment_image(61, 'full', false); ?>
                </a>
                <?php else : ?>
                <div class="blog-share-item">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path
                            d="M14.4561 17.6113C13.8075 17.6113 13.2561 17.3843 12.8021 16.9303C12.3481 16.4763 12.1211 15.925 12.1211 15.2764C12.1211 15.1856 12.1276 15.0915 12.1406 14.9942C12.1535 14.8969 12.173 14.8094 12.1989 14.7315L6.71177 11.5404C6.49124 11.735 6.24478 11.8874 5.97236 11.9977C5.69995 12.108 5.41457 12.1631 5.11621 12.1631C4.46761 12.1631 3.9163 11.9361 3.46228 11.4821C3.00826 11.028 2.78125 10.4767 2.78125 9.82812C2.78125 9.17952 3.00826 8.62821 3.46228 8.17419C3.9163 7.72017 4.46761 7.49316 5.11621 7.49316C5.41457 7.49316 5.69995 7.5483 5.97236 7.65856C6.24478 7.76882 6.49124 7.92124 6.71177 8.11582L12.1989 4.92471C12.173 4.84687 12.1535 4.75931 12.1406 4.66202C12.1276 4.56473 12.1211 4.47069 12.1211 4.37988C12.1211 3.73128 12.3481 3.17997 12.8021 2.72595C13.2561 2.27193 13.8075 2.04492 14.4561 2.04492C15.1047 2.04492 15.656 2.27193 16.11 2.72595C16.564 3.17997 16.791 3.73128 16.791 4.37988C16.791 5.02848 16.564 5.57979 16.11 6.03381C15.656 6.48783 15.1047 6.71484 14.4561 6.71484C14.1577 6.71484 13.8723 6.65971 13.5999 6.54945C13.3275 6.43919 13.081 6.28677 12.8605 6.09219L7.37334 9.2833C7.39928 9.36113 7.41874 9.44869 7.43171 9.54598C7.44469 9.64327 7.45117 9.73732 7.45117 9.82812C7.45117 9.91893 7.44469 10.013 7.43171 10.1103C7.41874 10.2076 7.39928 10.2951 7.37334 10.3729L12.8605 13.5641C13.081 13.3695 13.3275 13.2171 13.5999 13.1068C13.8723 12.9965 14.1577 12.9414 14.4561 12.9414C15.1047 12.9414 15.656 13.1684 16.11 13.6224C16.564 14.0765 16.791 14.6278 16.791 15.2764C16.791 15.925 16.564 16.4763 16.11 16.9303C15.656 17.3843 15.1047 17.6113 14.4561 17.6113ZM14.4561 5.1582C14.6766 5.1582 14.8614 5.08361 15.0106 4.93444C15.1598 4.78526 15.2344 4.60041 15.2344 4.37988C15.2344 4.15936 15.1598 3.97451 15.0106 3.82533C14.8614 3.67615 14.6766 3.60156 14.4561 3.60156C14.2355 3.60156 14.0507 3.67615 13.9015 3.82533C13.7523 3.97451 13.6777 4.15936 13.6777 4.37988C13.6777 4.60041 13.7523 4.78526 13.9015 4.93444C14.0507 5.08361 14.2355 5.1582 14.4561 5.1582ZM5.11621 10.6064C5.33674 10.6064 5.52159 10.5319 5.67076 10.3827C5.81994 10.2335 5.89453 10.0486 5.89453 9.82812C5.89453 9.6076 5.81994 9.42275 5.67076 9.27357C5.52159 9.12439 5.33674 9.0498 5.11621 9.0498C4.89569 9.0498 4.71084 9.12439 4.56166 9.27357C4.41248 9.42275 4.33789 9.6076 4.33789 9.82812C4.33789 10.0486 4.41248 10.2335 4.56166 10.3827C4.71084 10.5319 4.89569 10.6064 5.11621 10.6064ZM14.4561 16.0547C14.6766 16.0547 14.8614 15.9801 15.0106 15.8309C15.1598 15.6817 15.2344 15.4969 15.2344 15.2764C15.2344 15.0558 15.1598 14.871 15.0106 14.7218C14.8614 14.5726 14.6766 14.498 14.4561 14.498C14.2355 14.498 14.0507 14.5726 13.9015 14.7218C13.7523 14.871 13.6777 15.0558 13.6777 15.2764C13.6777 15.4969 13.7523 15.6817 13.9015 15.8309C14.0507 15.9801 14.2355 16.0547 14.4561 16.0547Z"
                            fill="url(#paint0_linear_3161_72280)" />
                        <defs>
                            <linearGradient id="paint0_linear_3161_72280" x1="2.78125" y1="9.82812" x2="16.791"
                                y2="9.82812" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#5B378F" />
                                <stop offset="1" stop-color="#7C58B1" />
                            </linearGradient>
                        </defs>
                    </svg>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <?php if ($review_post) : ?>
        <div class="blog-review">
            <?php
                $avatar = get_field('avatar_mem', $review_post->ID);
                if ($avatar) :
                    echo wp_get_attachment_image($avatar, 'full', false, ['class' => 'avatar']);
                endif;
                ?>
            <div class="review__header__info">
                <img src="https://onngocbeuvinvi.edu.vn/wp-content/uploads/2025/07/Vector.svg" alt=""
                    class="rate__icon">
                <p class="content">
                    <?php the_field('content_rv', $review_post->ID); ?>
                </p>
                <p class="role"><?php the_field('role_mem', $review_post->ID); ?></p>
                <p class="name"><?php echo get_the_title($review_post->ID); ?></p>
            </div>
        </div>
        <?php endif; ?>

    </div>
    <div class="blog-sidebar">
        <div class="blog-summary">
            <?php if (!empty($content_data['toc'])): ?>
            <p class="blog-summary-title">Mục lục</p>
            <ul id="table-of-contents">
                <?php foreach ($content_data['toc'] as $item): ?>
                <li class="toc-level-<?php echo $item['level']; ?>">
                    <span class="toc-item" data-target="<?php echo $item['anchor']; ?>">
                        <?php echo esc_html($item['title']); ?>
                    </span>
                </li>
                <?php endforeach; ?>
            </ul>
            <?php endif; ?>
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

    <?php if (isMobileDevice()) : ?>
    <div class="trigger-toc-mb-wrapper">
        <div class="trigger-toc">
            <span>Mục lục</span>
            <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 19 19" fill="none">
                <path
                    d="M9.33984 8.56602L5.75957 12.1463L4.66992 11.0566L9.33984 6.38672L14.0098 11.0566L12.9201 12.1463L9.33984 8.56602Z"
                    fill="#2CBDBE" />
            </svg>
        </div>
        <div class="blog-share">
            <span>Chia sẻ:</span>
            <div class="blog-share-item">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                    <path
                        d="M14.4561 17.6113C13.8075 17.6113 13.2561 17.3843 12.8021 16.9303C12.3481 16.4763 12.1211 15.925 12.1211 15.2764C12.1211 15.1856 12.1276 15.0915 12.1406 14.9942C12.1535 14.8969 12.173 14.8094 12.1989 14.7315L6.71177 11.5404C6.49124 11.735 6.24478 11.8874 5.97236 11.9977C5.69995 12.108 5.41457 12.1631 5.11621 12.1631C4.46761 12.1631 3.9163 11.9361 3.46228 11.4821C3.00826 11.028 2.78125 10.4767 2.78125 9.82812C2.78125 9.17952 3.00826 8.62821 3.46228 8.17419C3.9163 7.72017 4.46761 7.49316 5.11621 7.49316C5.41457 7.49316 5.69995 7.5483 5.97236 7.65856C6.24478 7.76882 6.49124 7.92124 6.71177 8.11582L12.1989 4.92471C12.173 4.84687 12.1535 4.75931 12.1406 4.66202C12.1276 4.56473 12.1211 4.47069 12.1211 4.37988C12.1211 3.73128 12.3481 3.17997 12.8021 2.72595C13.2561 2.27193 13.8075 2.04492 14.4561 2.04492C15.1047 2.04492 15.656 2.27193 16.11 2.72595C16.564 3.17997 16.791 3.73128 16.791 4.37988C16.791 5.02848 16.564 5.57979 16.11 6.03381C15.656 6.48783 15.1047 6.71484 14.4561 6.71484C14.1577 6.71484 13.8723 6.65971 13.5999 6.54945C13.3275 6.43919 13.081 6.28677 12.8605 6.09219L7.37334 9.2833C7.39928 9.36113 7.41874 9.44869 7.43171 9.54598C7.44469 9.64327 7.45117 9.73732 7.45117 9.82812C7.45117 9.91893 7.44469 10.013 7.43171 10.1103C7.41874 10.2076 7.39928 10.2951 7.37334 10.3729L12.8605 13.5641C13.081 13.3695 13.3275 13.2171 13.5999 13.1068C13.8723 12.9965 14.1577 12.9414 14.4561 12.9414C15.1047 12.9414 15.656 13.1684 16.11 13.6224C16.564 14.0765 16.791 14.6278 16.791 15.2764C16.791 15.925 16.564 16.4763 16.11 16.9303C15.656 17.3843 15.1047 17.6113 14.4561 17.6113ZM14.4561 5.1582C14.6766 5.1582 14.8614 5.08361 15.0106 4.93444C15.1598 4.78526 15.2344 4.60041 15.2344 4.37988C15.2344 4.15936 15.1598 3.97451 15.0106 3.82533C14.8614 3.67615 14.6766 3.60156 14.4561 3.60156C14.2355 3.60156 14.0507 3.67615 13.9015 3.82533C13.7523 3.97451 13.6777 4.15936 13.6777 4.37988C13.6777 4.60041 13.7523 4.78526 13.9015 4.93444C14.0507 5.08361 14.2355 5.1582 14.4561 5.1582ZM5.11621 10.6064C5.33674 10.6064 5.52159 10.5319 5.67076 10.3827C5.81994 10.2335 5.89453 10.0486 5.89453 9.82812C5.89453 9.6076 5.81994 9.42275 5.67076 9.27357C5.52159 9.12439 5.33674 9.0498 5.11621 9.0498C4.89569 9.0498 4.71084 9.12439 4.56166 9.27357C4.41248 9.42275 4.33789 9.6076 4.33789 9.82812C4.33789 10.0486 4.41248 10.2335 4.56166 10.3827C4.71084 10.5319 4.89569 10.6064 5.11621 10.6064ZM14.4561 16.0547C14.6766 16.0547 14.8614 15.9801 15.0106 15.8309C15.1598 15.6817 15.2344 15.4969 15.2344 15.2764C15.2344 15.0558 15.1598 14.871 15.0106 14.7218C14.8614 14.5726 14.6766 14.498 14.4561 14.498C14.2355 14.498 14.0507 14.5726 13.9015 14.7218C13.7523 14.871 13.6777 15.0558 13.6777 15.2764C13.6777 15.4969 13.7523 15.6817 13.9015 15.8309C14.0507 15.9801 14.2355 16.0547 14.4561 16.0547Z"
                        fill="url(#paint0_linear_3161_72280)" />
                    <defs>
                        <linearGradient id="paint0_linear_3161_72280" x1="2.78125" y1="9.82812" x2="16.791" y2="9.82812"
                            gradientUnits="userSpaceOnUse">
                            <stop stop-color="#5B378F" />
                            <stop offset="1" stop-color="#7C58B1" />
                        </linearGradient>
                    </defs>
                </svg>
            </div>
        </div>
    </div>
    <div class="toc-popup-mb">
        <?php if (!empty($content_data['toc'])): ?>
        <p class="blog-summary-title">Mục lục</p>
        <ul id="table-of-contents">
            <?php foreach ($content_data['toc'] as $item): ?>
            <li class="toc-level-<?php echo $item['level']; ?>">
                <span class="toc-item" data-target="<?php echo $item['anchor']; ?>">
                    <?php echo esc_html($item['title']); ?>
                </span>
            </li>
            <?php endforeach; ?>
        </ul>
        <?php endif; ?>
    </div>
    <div class="toc-popup-mb-overlay"></div>
    <?php endif; ?>

</section>

<section class="blog-related-posts">
    <div class="group__title" data-aos="fade-up" data-aos-offset="0" data-aos-duration="800">
        <h2 class="title">
            Tin Tức liên quan
        </h2>
        <a class="view__all" href="/coming-soon/">
            <p>Xem tất cả</p>
            <div class="line"></div>
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" width="43" height="44" viewBox="0 0 43 44" fill="none">
                    <path d="M19.6133 17.5723L24.0409 22.0497L19.6133 26.4276" stroke="white" stroke-width="1.5"
                        stroke-linecap="round" />
                </svg>
            </div>
        </a>
    </div>
    <?php

    if ($categories[0]) {
        $course_args = [
            'post_type'      => 'post',
            'posts_per_page' => 3,
            'orderby'        => 'ID',
            'order'          => 'DESC',
            'post__not_in'   => [get_the_ID()], // Loại trừ bài hiện tại
            'tax_query'      => [
                [
                    'taxonomy' => 'category',
                    'field'    => 'term_id',
                    'terms'    => $categories[0]->term_id,
                ],
            ],
        ];

        $course_query = new WP_Query($course_args);

        if ($course_query->have_posts()) :
            $i = 0;
            $next_four = [];
    ?>
    <div class="news__container" data-aos="fade-up" data-aos-offset="0" data-aos-duration="800">
        <?php
                while ($course_query->have_posts()) : $course_query->the_post();
                    $post_id = get_the_ID();
                    // 3 bài đầu: render new__item bên trong news__container
                ?>
        <div class="new__item">
            <div class="overlay__mb"></div>
            <div class="new__thumb">
                <span class="new__badge">NEWS</span>
                <a href="<?php the_permalink(); ?>">
                    <img src="<?php echo get_the_post_thumbnail_url($post_id, 'full'); ?>" alt="<?php the_title(); ?>">
                </a>
            </div>
            <div class="new__body">
                <a href="<?php the_permalink(); ?>" class="new__title"><?php the_title(); ?></a>
                <p class="new__body-excerpt">
                    <?= get_the_excerpt(); ?>
                </p>
                <div class="new__footer">
                    <div class="new__date">
                        <img class="icon" src="/wp-content/uploads/2025/05/Calendar_duotone.svg" alt="">
                        <p><?php echo get_the_date('d/m/Y'); ?></p>
                    </div>
                    <a href="<?php the_permalink(); ?>" class="new__link">
                        <p>Chi tiết bài viết</p>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" viewBox="0 0 27 27"
                                fill="none">
                                <path d="M11.9805 11.0264L14.7524 13.8294L11.9805 16.5702" stroke="#5B378F"
                                    stroke-width="1.5" stroke-linecap="round" />
                            </svg>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <?php
                    $i++;
                endwhile;
                ?>
    </div> <!-- đóng news__container -->
    <?php if (isMobileDevice()) : ?>
    <a class="view-more-mb" href="http://">Xem tất cả</a>
    <?php endif; ?>
    <?php
            wp_reset_postdata();
        endif;
    }
    ?>
</section>