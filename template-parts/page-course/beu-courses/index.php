<?php
$page_course_list_course = get_field('page_course_list_course');
$title = $page_course_list_course['title'];
$description = $page_course_list_course['description'];
$list_course = $page_course_list_course['list_course'];
?>

<section class="course-list">
    <?php if (!IS_MOBILE) : ?>
    <div class="course-list__bg-left">
        <?= wp_get_attachment_image(853, 'full', false, [
                'class' => 'course-list__bg-left-img',
            ]) ?>
    </div>
    <div class="course-list__bg-right">
        <?= wp_get_attachment_image(854, 'full', false, [
                'class' => 'course-list__bg-right-img',
            ]) ?>
    </div>
    <?php endif; ?>
    <div class="course-list__container">
        <div class="course-list__header">
            <h2 class="course-list__title">
                <?= $title ?>
            </h2>
            <p class="course-list__description">
                <?= $description ?>
            </p>
        </div>
        <div class="course-list__grid">
            <?php foreach ($list_course as $course) :
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
                <div class="course-card__image">
                    <?= wp_get_attachment_image($featured_image, 'full', false, [
                            'class' => 'course-card__image-img',
                        ]) ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>