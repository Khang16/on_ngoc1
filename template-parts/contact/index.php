<?php

// Lấy dữ liệu từ ACF, cung cấp giá trị mặc định nếu không có.
$title__advise = get_field("title_advise") ?? "Liên hệ tư vấn";
$contact__form = get_field("contact_form") ?? [];

// Gán các giá trị từ $contact__form vào các biến riêng để dễ sử dụng
$form_title = $contact__form['form_title'] ?? '';
$form_message = $contact__form['mesage'] ?? ''; // Đảm bảo đúng key 'mesage'
$motion_image_id = $contact__form['motion_image'] ?? 0;

// Lấy URL ảnh nếu motion_image_id tồn tại
$motion_image_url = $motion_image_id ? wp_get_attachment_image_url($motion_image_id, 'full') : '';

?>
<div id="contact">
    <div class="contact__breadcrumb">
        <ul class="breadcrumb__list">
            <li class="breadcrumb__item">
                <a href="/" class="breadcrumb__item__link">Trang chủ</a>
            </li>
            <li class="breadcrumb__item">
                <a href="#contact__advise" class="breadcrumb__item__link"> • Liên hệ tư vấn</a>
            </li>
        </ul>
    </div>
    <div class="bg__contact">
        <?php echo wp_get_attachment_image(575, 'full', false, array('class' => '')) ?>
        <div class="bg__girl">
            <?php echo wp_get_attachment_image(576, 'full', false, array('class' => '')) ?>
        </div>
        <div class="bg__round">
            <?php echo wp_get_attachment_image(577, 'full', false, array('class' => '')) ?>
        </div>
    </div>
    <section id="contact__advise" class="contact__advise">
        <h2 class="title">
            <?php echo esc_html($title__advise); ?>
        </h2>

        <div class="contact__form">
            <h3 class="form__title"><?php echo esc_html($form_title); ?></h3>
            <p class="form__message"><?php echo esc_html($form_message); ?></p>

            <div class="form__bg">
                <div class="bg__girl no-aos-mobile" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200"
                    data-aos-easing="my-custom-bounce">
                    <?php echo wp_get_attachment_image($motion_image_id ?? 541, 'full', false, array('class' => '')) ?>
                </div>
                <div class="bg__round">
                    <?php echo wp_get_attachment_image(542, 'full', false, array('class' => '')) ?>
                </div>
            </div>
            <?php get_template_part('template-parts/contact/contact-form/index'); ?>
        </div>
    </section>

    <?php get_template_part('template-parts/contact/branches/index'); ?>
</div>