<?php
$teacher = get_field('teacher');
$title = $teacher['title'];
$description = $teacher['description'];
$list = $teacher['list'];
$_VECTOR = 1950;
$_LEFT = 1951;
$_RIGHT = 1952;
$_EXCLUDE = 2348;
$_BG_POPUP = 2351;
$_BG_IMG_POPUP = 2350;
$_CERT_ICON_URL = 2349;
?>


<section class="teacher-about" id="teacher-about">
    <?= wp_get_attachment_image($_EXCLUDE, 'full', false, array('class' => 'teacher__exclude')) ?>
    <div class="teacher__main" data-aos="fade-down">
        <h2 class="text-pc-36-b text-mb-22-b color-text-title-main teacher__title"><?= $title ?></h2>
        <p class="text-pc-18-bo text-mb-14-bo teacher__description"><?= $description ?></p>
    </div>
    <div class="swiper teacher-swiper" data-aos="zoom-in">
        <?php $cert_icon = wp_get_attachment_image_url($_CERT_ICON_URL, 'full'); ?>
        <div class=" swiper-wrapper teacher__items">
            <?php foreach ($list as $index => $item):
                $image_id = $item['image'];
                $image_html = wp_get_attachment_image($image_id, 'full', false, ['class' => 'popup-image']);
                //certificate
                $certificates = $item['certificate'] ?? [];
                $cert_titles = array_map(function ($cert) {
                    return $cert['text'] ?? '';
                }, $certificates);
                $cert_json = esc_attr(json_encode($cert_titles));
            ?>
                <div class="swiper-slide teacher__item" data-name="<?= esc_attr($item['name']) ?>"
                     
                    data-hsk="<?= esc_attr($item['level']) ?>"
                    data-listen="<?= esc_attr($item['number_listen']) ?>" data-read="<?= esc_attr($item['number_read']) ?>"
                    data-write="<?= esc_attr($item['number_write']) ?>" data-certificates='<?= $cert_json ?>'
                    data-image-html="<?= esc_attr($image_html) ?>"
                    >
                    <div class="teacher__item__wrap">
                        <div class="teacher__item__img">
                            <?= wp_get_attachment_image($item['image'], 'full', false, array('class' => 'teacher--img')) ?>
                            <?= wp_get_attachment_image($_VECTOR, 'full', false, array('class' => 'teacher--vector')) ?>
                        </div>
                        <p class="teacher__item--position"><?= $item['position'] ?></p>
                        <h2 class="teacher__item--name"><?= $item['name'] ?></h2>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
        <!-- Navigation buttons -->
           <div class="teacher-swiper-buttons">
            <button
                class="swiper-button-prev"><?= wp_get_attachment_image($_LEFT, 'full', false, array('class' => 'icon-left')) ?></button>
            <div class="pagination__course teacher__pagination"></div>
            <button
                class="swiper-button-next"><?= wp_get_attachment_image($_RIGHT, 'full', false, array('class' => 'icon-right')) ?></button>
        </div>
    </div>
    </div>
    <div id="teacher-popup" class="teacher-popup hidden">
        <div class="popup-inner">
            <?= wp_get_attachment_image($_BG_POPUP, 'full', false, ['class' => 'popup-background', 'alt' => '']) ?>
            <span class="popup-close">×</span>
            <div class="popup-content">
                <div class="popup-left-wrap">
                    <?= wp_get_attachment_image($_BG_IMG_POPUP, 'full', false, ['class' => 'popup-background-img', 'alt' => '']) ?>
                    <div id="popup-image"> </div>
                </div>
                <div class="popup-right-wrap">
                    <h2 id="popup-name" class="popup-name"></h2>
                    <h3 id="popup-hsk" class="popup-hsk"></h3>
                    <div class="popup-skill-wrap">
                        <div class="popup-skill">
                            <p id="popup-listen" class="popup-number"></p>
                            <p class="popup-skill-text">Nghe</p>
                        </div>
                        <div class="popup-skill">
                            <p id="popup-read" class="popup-number"></p>
                            <p class="popup-skill-text">Đọc</p>
                        </div>
                        <div class="popup-skill">
                            <p id="popup-write" class="popup-number"></p>
                            <p class="popup-skill-text">Viết</p>
                        </div>
                    </div>
                    <div id="popup-certificates" class="popup-certificates"></div>
                </div>

            </div>
        </div>
    </div>
</section>





<script>


</script>