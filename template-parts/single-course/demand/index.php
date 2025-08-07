<?php
$online_offline_courses = get_field('online_offline_courses');
$title = $online_offline_courses['title'];
$description = $online_offline_courses['description'];
$background_image_1 = $online_offline_courses['background_image_1'];
$online_courses = $online_offline_courses['online_courses'];
$offline_courses = $online_offline_courses['offline_courses'];
$background_image_2 = $online_offline_courses['background_image_2'];
$other_courses = $online_offline_courses['other_courses'];
?>
<section id="demand">
    <?php
    if (wp_is_mobile()) {
        echo wp_get_attachment_image(1089, 'full', false, [
            'class' => 'demand__bg--mb'
        ]);
    }
    ?>
    <?= wp_get_attachment_image(1083, 'full', false, [
        'class' => 'demand__bg'
    ]) ?>
    <?= wp_get_attachment_image(1086, 'full', false, [
        'class' => 'demand__flower'
    ]) ?>
    <picture class="demand__subtract">
        <source media="(max-width: 639px)" srcset="<?= wp_get_attachment_image_url(1085, 'full') ?>" />
        <?= wp_get_attachment_image(1084, 'full', false) ?>
    </picture>
    <div class="container">
        <h2 class="demand__title text-pc-36-b text-mb-22-b">
            <?= $title; ?>
        </h2>
        <p class="demand__description text-pc-18-bo text-mb-12-bo">
            <?= $description; ?>
        </p>
        <div class="demand__grid">
            <div class="demand__tabs">
                <div class="demand__tab__item active">Online</div>
                <div class="demand__tab__item">Offline</div>
                <div class="demand__tab__indicator"></div>
            </div>
            <div class="demand__card active">
                <div class="demand__card__header">
                    <?= wp_get_attachment_image(1088, 'full', false, [
                        'class' => 'card__header__icon'
                    ]) ?>
                    <span class="card__header__title">Hình thức Online</span>
                </div>
                <div class="demand__card__price">
                    <span class="price__number"><?= $online_courses['budget']; ?> </span>
                    <span class="price__unit">VND</span>
                </div>
                <form id="online-form" class="demand__form" action="">
                    <input type="hidden" name="course" value="<?= get_the_title() ?>">
                    <input type="hidden" name="type" value="Online">
                    <input type="hidden" name="link" value="<?= get_the_permalink() ?>">
                    <input class="demand__form__input" type="text" placeholder="Nhập số điện thoại tư vấn"
                        name="phone" />
                    <button type="submit" class="demand__form__btn">
                        <span>Đăng ký</span>
                        <div class="demand__form__btn__icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="43" height="44" viewBox="0 0 43 44"
                                fill="none">
                                <path d="M19.457 17.6582L23.8847 22.1356L19.457 26.5135" stroke="white"
                                    stroke-width="1.5" stroke-linecap="round" />
                            </svg>
                            <?= wp_get_attachment_image(1080, 'full', false) ?>
                        </div>
                    </button>
                </form>
                <div class="demand__interest">
                    <?= wp_get_attachment_image(1066, 'full', false) ?>
                    <span>Quyền lợi học viên</span>
                </div>
                <ul class="demand__interest__list">
                    <?php foreach ($online_courses['benefits'] as $benefit) : ?>
                    <li class="demand__interest__item">
                        <?= wp_get_attachment_image(1065, 'full', false) ?>
                        <span><?= $benefit['content']; ?></span>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="demand__card">
                <div class="demand__card__header">
                    <?= wp_get_attachment_image(1087, 'full', false, [
                        'class' => 'card__header__icon'
                    ]) ?>
                    <span class="card__header__title">Hình thức Offline</span>
                </div>
                <div class="demand__card__price">
                    <span class="price__number"><?= $offline_courses['budget']; ?> </span>
                    <span class="price__unit">VND</span>
                </div>
                <form id="offline-form" class="demand__form" action="">
                    <input type="hidden" name="course" value="<?= get_the_title() ?>">
                    <input type="hidden" name="type" value="Offline">
                    <input type="hidden" name="link" value="<?= get_the_permalink() ?>">
                    <input class="demand__form__input" type="text" placeholder="Nhập số điện thoại nhận tư vấn"
                        name="phone" />
                    <button type="submit" class="demand__form__btn">
                        <span>Đăng ký</span>
                        <div class="demand__form__btn__icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="43" height="44" viewBox="0 0 43 44"
                                fill="none">
                                <path d="M19.457 17.6582L23.8847 22.1356L19.457 26.5135" stroke="white"
                                    stroke-width="1.5" stroke-linecap="round" />
                            </svg>
                            <?= wp_get_attachment_image(1080, 'full', false) ?>
                        </div>
                    </button>
                </form>
                <div class="demand__interest">
                    <?= wp_get_attachment_image(1066, 'full', false) ?>
                    <span>Quyền lợi học viên</span>
                </div>
                <ul class="demand__interest__list">
                    <?php foreach ($offline_courses['benefits'] as $benefit) : ?>
                    <li class="demand__interest__item">
                        <?= wp_get_attachment_image(1065, 'full', false) ?>
                        <span><?= $benefit['content']; ?></span>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="demand__student">
                <?= wp_get_attachment_image($background_image_1, 'full', false, [
                    'class' => 'demand__student__img'
                ]) ?>
                <?= wp_get_attachment_image(1068, 'full', false, [
                    'class' => 'demand__student__icon__left__medium'
                ]) ?>
                <?= wp_get_attachment_image(1070, 'full', false, [
                    'class' => 'demand__student__icon__left__small'
                ]) ?>
                <?= wp_get_attachment_image(1072, 'full', false, [
                    'class' => 'demand__student__icon__right__large'
                ]) ?>
                <?= wp_get_attachment_image(1073, 'full', false, [
                    'class' => 'demand__student__icon__right__medium'
                ]) ?>
                <?= wp_get_attachment_image(1075, 'full', false, [
                    'class' => 'demand__student__icon__right__small'
                ]) ?>
            </div>
        </div>
        <div class="demand__course">
            <div hidden id="demand-form-data">
                <?= do_shortcode('[contact-form-7 id="3dab448" title="Tư vấn khóa học" html_id="demand-form"]') ?>
            </div>
            <div class="demand__course__content">
                <div class="demand__course__content__up">
                    <h2 class="demand__course__title text-pc-36-b text-mb-22-b">
                        <?= $other_courses['title']; ?>
                    </h2>
                    <p class="demand__course__description text-mb-12-bo">
                        <?= $other_courses['desciption']; ?>
                    </p>
                    <span class="demand__course__label">PHÙ HỢP VỚI:</span>
                    <ul class="demand__course__list">
                        <?php foreach ($other_courses['suitable_for'] as $suitable_for) : ?>
                        <li class="demand__course__item">
                            <?= wp_get_attachment_image(1065, 'full', false) ?>
                            <span><?= $suitable_for['content']; ?></span>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                    <?php if ($other_courses['link']) :
                        $link = $other_courses['link'];
                    ?>
                    <a class="demand__contact" href="<?= $link['url'] ?>" target="<?= $link['target'] ?>">
                        <span>Liên hệ đăng ký ngay</span>
                        <div class="demand__contact__icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="43" height="44" viewBox="0 0 43 44"
                                fill="none">
                                <path d="M19.457 17.6582L23.8847 22.1356L19.457 26.5135" stroke="white"
                                    stroke-width="1.5" stroke-linecap="round" />
                            </svg>
                            <?= wp_get_attachment_image(1080, 'full', false) ?>
                        </div>
                    </a>
                    <?php endif; ?>
                </div>
                <div class="demand__route">
                    <div data-aos-delay="100" data-aos="fade-up" class="demand__route__item">
                        <?= wp_get_attachment_image(1077, 'full', false, [
                            'class' => 'route__item__icon'
                        ]) ?>
                        <?= wp_get_attachment_image(1058, 'full', false, [
                            'class' => 'route__item__under'
                        ]) ?>
                        <h3 class="router__item__title">Lộ trình cá nhân hóa</h3>
                    </div>
                    <div data-aos-delay="400" data-aos="fade-up" class="demand__route__item">
                        <?= wp_get_attachment_image(1078, 'full', false, [
                            'class' => 'route__item__icon'
                        ]) ?>
                        <?= wp_get_attachment_image(1058, 'full', false, [
                            'class' => 'route__item__under'
                        ]) ?>
                        <h3 class="router__item__title">Thời gian chủ động</h3>
                    </div>
                    <div data-aos-delay="700" data-aos="fade-up" class="demand__route__item">
                        <?= wp_get_attachment_image(1079, 'full', false, [
                            'class' => 'route__item__icon'
                        ]) ?>
                        <?= wp_get_attachment_image(1058, 'full', false, [
                            'class' => 'route__item__under'
                        ]) ?>
                        <h3 class="router__item__title">Tiến bộ thần tốc</h3>
                    </div>
                </div>
                <div class="demand__route__mb">
                    <div class="demand__route__item">
                        <div class="demand__route__item__wrapper" data-aos-delay="100" data-aos="zoom-in">
                            <?= wp_get_attachment_image(1077, 'full', false, [
                                'class' => 'route__item__icon'
                            ]) ?>
                            <?= wp_get_attachment_image(1082, 'full', false, [
                                'class' => 'route__item__under'
                            ]) ?>
                            <h3 class="router__item__title">Lộ trình cá nhân hóa</h3>
                        </div>
                    </div>
                    <div class="demand__route__item no__wrapper" data-aos-delay="400" data-aos="zoom-in">
                        <?= wp_get_attachment_image(1078, 'full', false, [
                            'class' => 'route__item__icon'
                        ]) ?>
                        <?= wp_get_attachment_image(1082, 'full', false, [
                            'class' => 'route__item__under'
                        ]) ?>
                        <h3 class="router__item__title">Thời gian chủ động</h3>
                    </div>
                    <div class="demand__route__item no__wrapper" data-aos-delay="700" data-aos="zoom-in">
                        <?= wp_get_attachment_image(1079, 'full', false, [
                            'class' => 'route__item__icon'
                        ]) ?>
                        <?= wp_get_attachment_image(1082, 'full', false, [
                            'class' => 'route__item__under'
                        ]) ?>
                        <h3 class="router__item__title">Tiến bộ thần tốc</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="demand__teacher">
            <?= wp_get_attachment_image($background_image_2, 'full', false, [
                'class' => 'demand__teacher__img'
            ]) ?>
            <?= wp_get_attachment_image(1067, 'full', false, [
                'class' => 'teacher__left__large'
            ]) ?>
            <?= wp_get_attachment_image(1069, 'full', false, [
                'class' => 'teacher__left__medium'
            ]) ?>
            <?= wp_get_attachment_image(1071, 'full', false, [
                'class' => 'teacher__left__small'
            ]) ?>
            <?= wp_get_attachment_image(1074, 'full', false, [
                'class' => 'teacher__right__medium'
            ]) ?>
            <?= wp_get_attachment_image(1076, 'full', false, [
                'class' => 'teacher__right__small'
            ]) ?>
        </div>
    </div>
</section>