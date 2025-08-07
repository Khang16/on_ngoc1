<?php
/*
Template Name: Coming Soon Page
*/
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <main id="main" class="main">
    <?php get_template_part('template-parts/coming-soon-page/index'); ?>
  </main>
  <?php wp_footer(); ?>
</body>

</html>