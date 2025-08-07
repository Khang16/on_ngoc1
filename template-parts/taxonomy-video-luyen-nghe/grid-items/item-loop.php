<?php
$fallback_img_id = 985; // ID of the fallback image
$terms = get_the_terms(get_the_ID(), 'categories-extends');
?>

<div class="video-card">
    <a href="<?= get_the_permalink() ?>" class="video-card__thumb">
		<?php if (has_post_thumbnail()) : ?>
            <?= get_the_post_thumbnail(get_the_ID(), 'full', array('class' => 'video-card__thumb-img')) ?>
        <?php else : ?>
            <?= wp_get_attachment_image($fallback_img_id, 'full', false, array('class' => 'video-card__thumb-img')) ?>
        <?php endif; ?>
        <span class="video-card__badge">
            <?= array_key_exists(1, $terms) ? $terms[1]->name : $terms[0]->name ?>
        </span>
    </a>
    <div class="video-card__content">
        <span class="video-card__label">
            <?= array_key_exists(0, $terms) ? $terms[0]->name : '' ?>
        </span>
        <h3 class="video-card__title">
            <a href="<?= get_the_permalink() ?>"><?= get_the_title() ?></a>
        </h3>
        <?php if (get_the_excerpt()) : ?>
        <p class="video-card__desc"><?= get_the_excerpt() ?></p>
        <?php endif; ?>
        <div class="video-card__meta">
            <span class="video-card__date">
                <?= wp_get_attachment_image(2276, 'full', false, array('class' => 'video-card__date-icon')) ?>
                <span class="video-card__date-text"><?= get_the_date('d/m/Y') ?></span>
            </span>
            <a href="<?= get_the_permalink() ?>" class="video-card__cta">
                <span class="video-card__cta-text">Chi tiết video</span>
                <span class="video-card__cta-icon">
                    <?= wp_get_attachment_image(1147, 'full', false) ?>
                </span>
            </a>
        </div>
    </div>
</div>