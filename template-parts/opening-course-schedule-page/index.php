<?php 
get_template_part('template-parts/components/compound-banner/index'); 
get_template_part('template-parts/opening-course-schedule-page/popup-discount/index'); 
get_template_part('template-parts/opening-course-schedule-page/course-detail-drawer/index'); 
get_template_part('template-parts/opening-course-schedule-page/section-opening-course-schedule-by-month/index'); 
?>


<?php
// section contact


$title__advise = get_field("title_advise") ?? get_field("title_advise", 531) ?? "Liên hệ tư vấn";
$contact__form = get_field("contact_form") ?? get_field("contact_form", 531) ?? [];

$form_title = $contact__form['form_title'] ?? '';
$form_message = $contact__form['mesage'] ?? '';
$motion_image_id = $contact__form['motion_image'] ?? 0;

$motion_image_url = $motion_image_id ? wp_get_attachment_image_url($motion_image_id, 'full') : '';

?>

<div id="contact" style="padding-top: 0;">
  <div class="bg__contact" style="background-color: #e8f8fd;">
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
        <div class="bg__girl" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200" data-aos-easing="my-custom-bounce">
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