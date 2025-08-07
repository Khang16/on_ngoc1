<?php
$facilities = get_field('facilities');

$title = $facilities['title'];
$description1 = $facilities['description_1'];
$description2 = $facilities['description_2'];
$thumbnails = $facilities['thumbnails'];

$_BG_PC = 126;
$_BG_MB = 125;

$_CIRCLE_GREEN_ICON = 127;
$_CIRCLE_VIOLET_ICON = 128;
?>

<section id="facilities">
    <picture>
      <!-- Ảnh dành cho màn hình nhỏ hơn 640px -->
      <?= '<source media="(max-width: 639px)" srcset="' . esc_url(wp_get_attachment_image_url($_BG_MB, 'full')) . '" />' ?>

      <!-- Ảnh mặc định (>= 640px) -->
      <?= '<img class="facilities__bg" src="' . esc_url(wp_get_attachment_image_url($_BG_PC, 'full')) . '" alt="">' ?>
    </picture>
    <div class="container facilities__main">
      <?php
          if ($title) {
            echo '<h2 class="text-pc-36-b color-text-title-main facilities__title text-mb-22-b">';
            echo $title;
            echo '</h2>';
          }
        ?>
      <p class="text-pc-18-bo color-text-500 facilities__description text-mb-14-bo">
        <?= $description1 ?>
      </p>
      <p class="text-pc-18-bo color-text-500 facilities__description text-mb-14-bo">
        <?= $description2 ?>
      </p>
    </div>
    
    <?php if (!empty($thumbnails) && is_array($thumbnails)): ?>
      <?php foreach ($thumbnails as $thumbnail): ?>
        <?= wp_get_attachment_image($thumbnail['image']['ID'], 'full', false, [
            'class' => 'facilities__thumbnail__item',
            'data-aos' => 'fade-up',
            'data-aos-duration' => '500',
            'data-aos-delay' => '100',
        ]) ?>
      <?php endforeach; ?>
    <?php endif; ?>

    <picture>
      <!-- Ảnh dành cho màn hình nhỏ hơn 640px -->
      <?= '<source media="(max-width: 639px)" srcset="' . esc_url(wp_get_attachment_image_url($_CIRCLE_GREEN_ICON, 'full')) . '" />' ?>

      <!-- Ảnh mặc định (>= 640px) -->
      <?= '<img class="facilities__circle__violet" src="' . esc_url(wp_get_attachment_image_url($_CIRCLE_VIOLET_ICON, 'full')) . '" alt="">' ?>
    </picture>

    <picture>
      <!-- Ảnh dành cho màn hình nhỏ hơn 640px -->
      <?= '<source media="(max-width: 639px)" srcset="' . esc_url(wp_get_attachment_image_url($_CIRCLE_VIOLET_ICON, 'full')) . '" />' ?>

      <!-- Ảnh mặc định (>= 640px) -->
      <?= '<img class="facilities__circle__green" src="' . esc_url(wp_get_attachment_image_url($_CIRCLE_GREEN_ICON, 'full')) . '" alt="">' ?>
    </picture>

  </section>