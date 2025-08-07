<?php
$contact__form = get_field("contact_form") ?? [];
if (!$contact__form) {
    $contact__form = get_field("contact_form", 531) ?? [];
}
// Gán các giá trị từ $contact__form vào các biến riêng để dễ sử dụng
$form_title = $contact__form['form_title'] ?? '';
$form_message = $contact__form['mesage'] ?? ''; // Đảm bảo đúng key 'mesage'
$motion_image_id = get_field('extends_image_footer') ?? $contact__form['motion_image'];

if (is_tax()) {
        $motion_image_id = get_field('extends_image_footer', 'term_' . get_queried_object()->term_id) ?? 0;
}
?>
<section id="contact__advise" class="contact__advise">
    <?= wp_get_attachment_image(IS_MOBILE ? 1118 : 1117, 'full', false, array('class' => 'contact__advise__bg')) ?>
    <div class="contact__form">
        <h3 class="form__title"><?php echo esc_html($form_title); ?></h3>
        <p class="form__message"><?php echo esc_html($form_message); ?></p>

        <div class="form__bg">
            <div class="bg__girl no-aos-mobile" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200"
                data-aos-easing="my-custom-bounce">
                <?php echo wp_get_attachment_image($motion_image_id ?? 541, 'full', false, array('class' => '')) ?>
            </div>
            <div class="bg__round">
                <?php echo wp_get_attachment_image(1119, 'full', false, array('class' => '')) ?>
            </div>
        </div>
        <?php get_template_part('template-parts/contact/contact-form/index'); ?>
    </div>
</section>