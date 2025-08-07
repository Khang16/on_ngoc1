<?php
$data = get_field('section_study_schedule');


?>

<script>
const studyScheduleData = <?php echo json_encode($data); ?>;
</script>

<section class="study-schedule">
    <div class="study-schedule__bg">
        <?php if (!IS_MOBILE) : ?>
        <svg xmlns="http://www.w3.org/2000/svg" width="1600" height="2052" viewBox="0 0 1600 2052" fill="none">
            <path
                d="M800.105 0.488281C1110.04 0.488274 1391.68 12.4568 1600.25 31.9672L1600.25 2052H-0.046875L-0.0429687 31.9672C208.53 12.4568 490.169 0.488289 800.105 0.488281Z"
                fill="url(#paint0_linear_3167_119341)" />
            <path
                d="M800.105 0.488281C1110.04 0.488274 1391.68 12.4568 1600.25 31.9672L1600.25 2052H-0.046875L-0.0429687 31.9672C208.53 12.4568 490.169 0.488289 800.105 0.488281Z"
                fill="url(#paint1_linear_3167_119341)" />
            <defs>
                <linearGradient id="paint0_linear_3167_119341" x1="1038.01" y1="-178.161" x2="1038.01" y2="884.039"
                    gradientUnits="userSpaceOnUse">
                    <stop stop-color="#5B378F" />
                    <stop offset="0.65" stop-color="#FFE6F8" />
                </linearGradient>
                <linearGradient id="paint1_linear_3167_119341" x1="800.103" y1="0.488281" x2="800.103" y2="1409.88"
                    gradientUnits="userSpaceOnUse">
                    <stop stop-color="#5B378F" />
                    <stop offset="1" stop-color="#9774C9" />
                </linearGradient>
            </defs>
        </svg>
        <?php else: ?>
        <svg xmlns="http://www.w3.org/2000/svg" width="375" height="1453" viewBox="0 0 375 1453" fill="none">
            <path
                d="M187.5 0.625C260.128 0.624994 326.125 10.3417 375 26.1813V1452.62H0V26.1813C48.8753 10.3417 114.872 0.625006 187.5 0.625Z"
                fill="url(#paint0_linear_3508_28685)" />
            <path
                d="M187.5 0.625C260.128 0.624994 326.125 10.3417 375 26.1813V1452.62H0V26.1813C48.8753 10.3417 114.872 0.625006 187.5 0.625Z"
                fill="url(#paint1_linear_3508_28685)" />
            <defs>
                <linearGradient id="paint0_linear_3508_28685" x1="243.248" y1="-198.788" x2="243.248" y2="986.867"
                    gradientUnits="userSpaceOnUse">
                    <stop stop-color="#5B378F" />
                    <stop offset="0.65" stop-color="#FFE6F8" />
                </linearGradient>
                <linearGradient id="paint1_linear_3508_28685" x1="187.5" y1="0.625" x2="187.5" y2="747.343"
                    gradientUnits="userSpaceOnUse">
                    <stop stop-color="#5B378F" />
                    <stop offset="1" stop-color="#9774C9" />
                </linearGradient>
            </defs>
        </svg>
        <?php endif; ?>
    </div>

    <h2 class="study-schedule__title"><?php echo esc_html($data['title']); ?></h2>
    <?php if (!IS_MOBILE) : ?>
    <div class="study-schedule__level">
        <!-- 766 -->
        <?= wp_get_attachment_image(766, 'full', false) ?>
        <!--<img src="https://onngocbeuvinvi.edu.vn/wp-content/uploads/2025/07/bgb.webp" alt="" srcset="">-->

        <div class="current-level">
            <p>Trình độ của tôi</p>
            <div class="level-item-container for-current-level">
                <div class="level-item" data-level="0">
                    Mới Bắt Đầu
                    <svg xmlns="http://www.w3.org/2000/svg" width="35" height="34" viewBox="0 0 35 34" fill="none">
                        <circle cx="17.231" cy="16.9341" r="11.3149" fill="white" stroke="#5B378F"
                            stroke-width="11.2384" />
                    </svg>
                </div>
                <?php foreach ($data['courses'] as $index => $item) : ?>
                <?php if ($index < count($data['courses']) - 1): ?>
                <div class="level-item" data-level="<?= $index + 1 ?>">
                    <?php echo esc_html($item['level']); ?>
                    <svg xmlns="http://www.w3.org/2000/svg" width="35" height="34" viewBox="0 0 35 34" fill="none">
                        <circle cx="17.231" cy="16.9341" r="11.3149" fill="white" stroke="#5B378F"
                            stroke-width="11.2384" />
                    </svg>
                </div>
                <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="target-level">
            <p>Mục tiêu của tôi</p>
            <div class="level-item-container for-target-level">
                <?php foreach ($data['courses'] as $index => $item) : ?>
                <div class="level-item" data-level="<?= $index + 1 ?>">
                    <?php echo esc_html($item['level']); ?>
                    <svg xmlns="http://www.w3.org/2000/svg" width="35" height="34" viewBox="0 0 35 34" fill="none">
                        <circle cx="17.231" cy="16.9341" r="11.3149" fill="white" stroke="#5B378F"
                            stroke-width="11.2384" />
                    </svg>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php else: ?>
    <div class="study-schedule__level">
        <img src="/wp-content/uploads/2025/07/vector_79.webp" class="line-mb" alt="">
        <div class="current-level">
            <p>Trình độ của tôi</p>
            <div class="lever-item-trigger">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25" fill="none">
                    <circle cx="12.4922" cy="12.1484" r="8.01807" fill="white" stroke="#5B378F"
                        stroke-width="7.96386" />
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" width="11" height="9" viewBox="0 0 11 9" fill="none">
                    <path
                        d="M6.44723 7.63641C6.047 8.16073 5.25769 8.16073 4.85746 7.63641L0.549426 1.99275C0.0470502 1.33462 0.516349 0.385984 1.34431 0.385984L9.96038 0.385985C10.7883 0.385985 11.2576 1.33462 10.7553 1.99275L6.44723 7.63641Z"
                        fill="#5B378F" />
                </svg>
                <span></span>
            </div>
        </div>
        <div class="target-level">
            <p>Mục tiêu của tôi</p>
            <div class="lever-item-trigger">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25" fill="none">
                    <circle cx="12.4922" cy="12.1484" r="8.01807" fill="white" stroke="#5B378F"
                        stroke-width="7.96386" />
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" width="11" height="9" viewBox="0 0 11 9" fill="none">
                    <path
                        d="M6.44723 7.63641C6.047 8.16073 5.25769 8.16073 4.85746 7.63641L0.549426 1.99275C0.0470502 1.33462 0.516349 0.385984 1.34431 0.385984L9.96038 0.385985C10.7883 0.385985 11.2576 1.33462 10.7553 1.99275L6.44723 7.63641Z"
                        fill="#5B378F" />
                </svg>
                <span></span>
            </div>
        </div>
    </div>

    <div class="level-item-container for-current-level">
        <div class="level-item" data-level="0">
            Mới Bắt Đầu
            <svg xmlns="http://www.w3.org/2000/svg" width="35" height="34" viewBox="0 0 35 34" fill="none">
                <circle cx="17.231" cy="16.9341" r="11.3149" fill="white" stroke="#5B378F" stroke-width="11.2384" />
            </svg>
        </div>
        <?php foreach ($data['courses'] as $index => $item) : ?>
        <?php if ($index < count($data['courses']) - 1): ?>
        <div class="level-item" data-level="<?= $index + 1 ?>">
            <?php echo esc_html($item['level']); ?>
            <svg xmlns="http://www.w3.org/2000/svg" width="35" height="34" viewBox="0 0 35 34" fill="none">
                <circle cx="17.231" cy="16.9341" r="11.3149" fill="white" stroke="#5B378F" stroke-width="11.2384" />
            </svg>
        </div>
        <?php endif; ?>
        <?php endforeach; ?>
    </div>
    <div class="level-item-container for-target-level">
        <?php foreach ($data['courses'] as $index => $item) : ?>
        <div class="level-item" data-level="<?= $index + 1 ?>">
            <?php echo esc_html($item['level']); ?>
            <svg xmlns="http://www.w3.org/2000/svg" width="35" height="34" viewBox="0 0 35 34" fill="none">
                <circle cx="17.231" cy="16.9341" r="11.3149" fill="white" stroke="#5B378F" stroke-width="11.2384" />
            </svg>
        </div>
        <?php endforeach; ?>
    </div>
    <? endif; ?>

    <div class="study-schedule__content">
        <div class="study-schedule-slide-thumb swiper">
            <div class="swiper-wrapper">
            </div>
        </div>
        <div class="study-schedule__slide">
            <div class="swiper-wrapper">
            </div>
        </div>
        <div class="study-schedule-action">
            <div class="study-schedule-button-prev">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25" fill="none">
                    <path
                        d="M5.50125 12.5977L11.0013 18.0977L12.0612 17.0377L7.84225 12.8177L20.0313 12.8177L20.0313 11.3177L7.84225 11.3177L12.0613 7.09766L11.0013 6.03765L5.50125 11.5377L4.97025 12.0677L5.50125 12.5977Z"
                        fill="#5B378F" />
                </svg>
            </div>
            <div class="study-schedule-pagination"></div>
            <div class="study-schedule-button-next">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25" fill="none">
                    <path
                        d="M18.5613 12.5977L13.0612 18.0977L12.0013 17.0377L16.2202 12.8177L4.03125 12.8177L4.03125 11.3177L16.2202 11.3177L12.0012 7.09766L13.0612 6.03765L18.5613 11.5377L19.0923 12.0677L18.5613 12.5977Z"
                        fill="#5B378F" />
                </svg>
            </div>
        </div>
        <!-- img deco -->
        <?php if (!IS_MOBILE) : ?>
        <!-- 769 -->
        <!--<img src="https://onngocbeuvinvi.edu.vn/wp-content/uploads/2025/07/bg-tp-scaled.webp" class="tp" alt="">-->
        <!-- 768 -->
        <!--<img src="https://onngocbeuvinvi.edu.vn/wp-content/uploads/2025/07/bg-tron.webp" class="tron" alt="">-->
        <!-- 773 -->
        <!--<img src="https://onngocbeuvinvi.edu.vn/wp-content/uploads/2025/07/union-1-scaled.webp" class="union" alt="">-->
        <?= wp_get_attachment_image(769, 'full', false, ['class' => 'tp']) ?>
        <?= wp_get_attachment_image(768, 'full', false, ['class' => 'tron']) ?>
        <?= wp_get_attachment_image(773, 'full', false, ['class' => 'union']) ?>
        <?php else: ?>
        <!-- 1061 -->
        <!--<img src="https://onngocbeuvinvi.edu.vn/wp-content/uploads/2025/07/frame_2147260234.webp" class="tp-mb" alt="">-->
        <!-- 1062 -->
        <!--<img src="https://onngocbeuvinvi.edu.vn/wp-content/uploads/2025/07/slice_1.webp" class="union-mb" alt="">-->
        <?= wp_get_attachment_image(1061, 'full', false, ['class' => 'tp-mb']) ?>
        <?= wp_get_attachment_image(1062, 'full', false, ['class' => 'union-mb']) ?>
        <?php endif; ?>
    </div>
</section>