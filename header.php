<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>

  <!-- Styles -->
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/main.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

  <!-- Head hooks -->
  <?php wp_head(); ?>
</head>
<body <?php body_class('landing is-preload'); ?>>

<div id="page-wrapper">
  <!-- Header -->
  <header id="header" class="alt">
    <h1><a href="<?php echo home_url(); ?>">Alert Lock & Key</a></h1>
    <nav id="nav">
      <?php
        wp_nav_menu([
          'theme_location' => 'main-menu',
          'container' => false,
          'menu_class' => 'menu',
          'fallback_cb' => false
        ]);
      ?>
    </nav>
  </header>
