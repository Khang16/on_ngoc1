<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <?php wp_head(); ?>
    <meta name="google-site-verification" content="Gm1o6DWlL5XeIixltoEOgIVW4NwxAQjIwO-ayB-Eulk" />
</head>

<body <?php body_class(); ?>>
    <?php
    if (IS_MOBILE) {
        get_template_part('template-parts/header/header-mobile');
    } else {
        get_template_part('template-parts/header/header');
    } ?>
    <?php get_template_part('template-parts/header/popup-search'); ?>
    <main id="main" class="main">