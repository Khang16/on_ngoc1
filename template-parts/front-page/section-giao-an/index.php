<?php
$teaching = get_field('teaching');

$title = $teaching['title'];
$description = $teaching['description'];
$people = $teaching['people'];
$applications = $teaching['applications'];
$link = $teaching['button'];
$teachers_pc = $teaching['teachers_pc'];
$teachers_mb = $teaching['teachers_mb'];
$link_title = !empty($link['title']) ? $link['title'] : '';
$link_url = !empty($link['url']) ? $link['url'] : '';
$link_target = !empty($link['target']) ? $link['target'] : '_self';

$title_team = $teaching['title_team'];
$description_team = $teaching['description_team'];
$experience = $teaching['experience'];
$certificate = $teaching['certificate'];

$_BG_PC_PROJECT = 115;
$_BG_MB_PROJECT = 114;
$_BG_PC_TEAM = 369;
$_BG_MB_TEAM = 358;
$_MASK_PC = 362;
$_MASK_MB = 361;

$_UNDER_ICON = 124;
?>

  <section id="teaching">
    <div class="teaching__white__backup"></div>
    <picture>
      <!-- Ảnh dành cho màn hình nhỏ hơn 640px -->
      <?= '<source media="(max-width: 639px)" srcset="' . esc_url(wp_get_attachment_image_url($_BG_MB_PROJECT, 'full')) . '" />' ?>

      <!-- Ảnh mặc định (>= 640px) -->
      <?= '<img class="teachingProject__bg" src="' . esc_url(wp_get_attachment_image_url($_BG_PC_PROJECT, 'full')) . '" alt="">' ?>

    </picture>
    <div class="container teachingProject__main">
        <?php
            if ($title) {
              echo '<h2 class="text-pc-36-b color-text-title-main teachingProject__title">';
              echo $title;
              echo '</h2>';
            }
        ?>
      <p data-aos="fade-up" data-aos-duration="500" class=" teachingProject__description text-pc-18-bo color-text-500 text-mb-14-bo">
          <?= $description ?>
      </p>
      <?= wp_get_attachment_image($people['ID'], 'full', false, ['class' => 'teachingProject__people']) ?>
      <?php if (!empty($link_url) && !empty($link_title)) : ?>
        <a href="<?= esc_url($link_url); ?>" target="<?= esc_attr($link_target); ?>"
            class="main-banner__button">
            <span class="main-banner__button-text"> <?= esc_html($link_title); ?></span>
            <span class="main-banner__button-icon"><?= wp_get_attachment_image(87) ?></span>
        </a>
        <?php endif; ?>
      <?php if (!empty($applications) && is_array($applications)): ?>
          <?php foreach ($applications as $application): ?>
            <div class="teachingProject__marker" data-aos="fade-up" data-aos-duration="500">
                <div class="teachingProject__marker__icon">
                  <?= wp_get_attachment_image($application['icon']['ID'], 'full', false, ['class' => 'no_under']) ?>
                  <?= wp_get_attachment_image($_UNDER_ICON, 'full', false, ['class' => 'under']) ?>
                </div>
                <?php
                  if ($application['content']) {
                    echo '<span class="teachingProject__marker__content text-pc-14-r text-mb-10-r">';
                    echo $application['content'];
                    echo '</span>';
                  }
                ?>
              </div>
          <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <div class="teachingTeam">
      <?php if (!empty($link_url) && !empty($link_title)) : ?>
        <a href="<?= esc_url($link_url); ?>" target="<?= esc_attr($link_target); ?>"
            class="main-banner__button">
            <span class="main-banner__button-text"> <?= esc_html($link_title); ?></span>
            <span class="main-banner__button-icon"><?= wp_get_attachment_image(87) ?></span>
        </a>
        <?php endif; ?>
      <picture>
        <!-- Ảnh dành cho màn hình nhỏ hơn 640px -->
        <?= '<source media="(max-width: 639px)" srcset="' . esc_url(wp_get_attachment_image_url($_BG_MB_TEAM, 'full')) . '" />' ?>
        

        <!-- Ảnh mặc định (>= 640px) -->
        <?= '<img class="teachingTeam__bg" src="' . esc_url(wp_get_attachment_image_url($_BG_PC_TEAM, 'full')) . '" alt="">' ?>

      </picture>
      <picture>
        <!-- Ảnh dành cho màn hình nhỏ hơn 640px -->
       <?= '<source media="(max-width: 639px)" srcset="' . esc_url(wp_get_attachment_image_url($_MASK_MB, 'full')) . '" />' ?>

        <!-- Ảnh mặc định (>= 640px) -->
        <?= '<img class="teachingTeam__people__mask" src="' . esc_url(wp_get_attachment_image_url($_MASK_PC, 'full')) . '" alt="">' ?>
      </picture>
      <div class="container teachingTeam__main">
          <picture>
          <!-- Ảnh dành cho màn hình nhỏ hơn 640px -->
          <?= '<source media="(max-width: 639px)" srcset="' . esc_url(wp_get_attachment_image_url($teachers_mb['ID'], 'full')) . '" />' ?>

          <!-- Ảnh mặc định (>= 640px) -->
          <?= '<img class="teachingTeam__people" src="' . esc_url(wp_get_attachment_image_url($teachers_pc['ID'], 'full')) . '" alt="">' ?>
        </picture>
        <div class="teachingTeam__main__overlay"></div>
        <div class="teachingTeam__main__content">
          <?php
            if ($title_team) {
              echo '<h2 class="teachingTeam__title text-pc-36-b text-mb-22-b">';
              echo $title_team;
              echo '</h2>';
            }
          ?>
          <p class="teachingTeam__description text-pc-18-bo text-mb-14-bo">
            <?= $description_team ?>
          </p>
          <div class="teachingTeam__content__line"></div>
          <div class="stats-container teachingTeam__content__counter" data-counter-group="group1">
            <div class="stat-item">
              <div class="stat-number" data-counter-target="<?= $experience['number'] ?>" data-counter-duration="2500" data-counter-suffix="+"
                data-counter-delay="0">
                <span class="number">0</span><span class="suffix"><?= $experience['suffix'] ?></span>
              </div>
                <?php
                    if ($experience['content']) {
                      echo '<div class="stat-description text-pc-18-r text-mb-12-r">';
                      echo $experience['content'];
                      echo '</div>';
                    }
                ?>
            </div>

            <div class="stat-item">
              <div class="stat-number" data-counter-target="<?= $certificate['number'] ?>" data-counter-duration="2500" data-counter-suffix="%"
                data-counter-suffix-class="percent" data-counter-delay="300">
                <span class="number">0</span><span class="suffix percent"><?= $certificate['suffix'] ?></span>
              </div>
              <?php
                    if ($certificate['content']) {
                      echo '<div class="stat-description text-pc-18-r text-mb-12-r">';
                      echo $certificate['content'];
                      echo '</div>';
                    }
                ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
