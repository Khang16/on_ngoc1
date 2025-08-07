<?php
$students_fields = get_field('students_fields', 'option');
$title = $students_fields['title'];
$gallery = $students_fields['gallery'];
$students = $students_fields['students'];
?>

<section id="language">
    <div class="language__content">
        <?= wp_get_attachment_image(1090, 'full', false, [
            'class' => 'language__content__bg'
        ]) ?>
        <h2 class="language__content__title">
            <?= $title; ?>
        </h2>
        <?php
        foreach ($gallery as $item) {
            echo wp_get_attachment_image($item, 'full', false, [
                'class' => 'language__content__staff'
            ]);
        }
        ?>
    </div>
    <div class="language__slide">
        <div class="swiper language__swiper">
            <div class="swiper-wrapper">
                <?php foreach ($students as $student): ?>
                <div class="swiper-slide">
                    <div class="swiper__slide__wrapper">
                        <?= wp_get_attachment_image(1092, 'full', false, [
                                'class' => 'slide__union'
                            ]) ?>
                        <div class="slide__tag__wrapper">
                            <div class="slide__tag">
                                <?= wp_get_attachment_image(1091, 'full', false) ?>
                                <span>
                                    <?= $student['rank']; ?>
                                </span>
                            </div>
                        </div>
                        <div class="slide__content">
                            <span class="slide__content__position">
                                <?= $student['role']; ?>
                            </span>
                            <span class="slide__content__name">
                                <?= $student['name']; ?>
                            </span>
                            <p class="slide__content__description">
                                <?= $student['quote']; ?>
                            </p>
                        </div>
                        <?= wp_get_attachment_image($student['avatar'], 'full', false, [
                                'class' => 'slide__people'
                            ]) ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="language__swiper__tools">
                <div class="swiper-button-prev">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="15" viewBox="0 0 18 15" fill="none">
                        <path d="M15.9153 7.28125L1.77344 7.28125" stroke="#063E2B" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M7.55875 13.0667L1.77344 7.2814L7.55875 1.49609" stroke="#063E2B" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <div class="swiper-pagination"></div>
                <div class="swiper-button-next">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="15" viewBox="0 0 18 15" fill="none">
                        <path d="M2.63154 7.28125H16.7734" stroke="#063E2B" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M10.9881 1.49579L16.7734 7.2811L10.9881 13.0664" stroke="#063E2B" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
            </div>
        </div>
    </div>
</section>