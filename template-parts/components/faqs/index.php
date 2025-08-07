<?php
$faqs_fields = get_field('faqs_fields', 'option');
if (is_tax('category-course')) {
    $term = get_queried_object();
    $faqs_fields = get_field('faqs_fields', 'term_' . $term->term_id);
}
$title = $faqs_fields['title'];
$image = $faqs_fields['image'];
$faqs = $faqs_fields['faqs'];
?>

<section class="faq-section">
    <div class="faq-container">
        <!-- Left Side - Illustration -->
        <div class="illustration-section">
            <?= wp_get_attachment_image($image, 'full', false, [
                'class' => 'faq-illustration',
            ]) ?>
        </div>

        <!-- Right Side - FAQ Content -->
        <div class="faq-content">
            <h2 class="faq-title"><?= $title ?></h2>

            <div class="faq-list">
                <?php foreach ($faqs as $key => $faq) : ?>
                <div class="faq-item <?= $key == 0 ? 'expanded' : '' ?>">
                    <button class="faq-question">
                        <?= $faq['question'] ?>
                        <span class="faq-icon icon-plus"></span>
                    </button>
                    <div class="faq-answer">
                        <div class="faq-answer-content">
                            <?= $faq['answer'] ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>