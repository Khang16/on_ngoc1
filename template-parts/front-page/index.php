<?php
get_template_part('template-parts/front-page/section-banner/index'); ?>
<section class="about-mission">
    <?php
    get_template_part('template-parts/front-page/section-about-us/index');
    ?>
    <div class="about-us__container__deco">
        <?= wp_get_attachment_image(wp_is_mobile() ? 321 : 187, 'full'); ?>
    </div>
    <?php
    get_template_part('template-parts/front-page/section-su-menh/index');
    ?>
</section>
<?php
get_template_part('template-parts/front-page/section-giao-an/index');
get_template_part('template-parts/front-page/section-co-so/index');
get_template_part('template-parts/front-page/section-chinh-phuc/index');
get_template_part('template-parts/front-page/section-news/index');
