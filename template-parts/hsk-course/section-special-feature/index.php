<?php
$data = get_field('section_special_feature');
?>

<section class="special-feature">
    <?php if (!IS_MOBILE) : ?>
    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="1600" height="79"
        viewBox="0 0 1600 79" fill="none">
        <path
            d="M799.714 0.476563C1109.65 0.476555 1391.29 11.8811 1599.86 30.472L1599.86 78.1014L-0.4375 78.1014L-0.43457 30.472C208.139 11.8811 489.778 0.47657 799.714 0.476563Z"
            fill="#C3F0F0" />
    </svg>
    <?php else: ?>
    <svg xmlns="http://www.w3.org/2000/svg" width="376" height="37" viewBox="0 0 376 37" fill="none">
        <path
            d="M187.742 0.296875C260.37 0.296868 326.367 10.9825 375.242 28.4013V41.6442H0.242187L0.242188 28.4013C49.1175 10.9824 115.114 0.296882 187.742 0.296875Z"
            fill="#EBFFFF" />
    </svg>
    <?php endif; ?>

    <div class="special-feature__text-content">
        <h2 class="title">
            <?= esc_html($data['title']) ?>
        </h2>
        <p class="description">
            <?= esc_html($data['description']) ?>
        </p>
        <a href="<?= $data['button']['url'] ?>" target="<?= $data['button']['target'] ?>" class="main-banner__button">
            <span class="main-banner__button-text"><?= $data['button']['title'] ?></span>
            <span class="main-banner__button-icon"><img width="43" height="44"
                    src="/wp-content/uploads/2025/05/Frame-1618872316-white.svg"
                    class="attachment-thumbnail size-thumbnail" alt="" decoding="async"></span>
        </a>
    </div>
    <div class="special-feature__features">
        <?php foreach ($data['features'] as $item) : ?>
        <div class="feature-item">
            <?= wp_get_attachment_image($item['icon'], 'full', false) ?>
            <p><?= esc_html($item['name']) ?></p>
        </div>
        <?php endforeach; ?>
    </div>
</section>