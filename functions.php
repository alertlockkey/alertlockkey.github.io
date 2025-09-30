<?php

function alertlock_enqueue_assets() {
  // CSS
  wp_enqueue_style('main-css', get_template_directory_uri() . '/assets/css/main.css');
  wp_enqueue_style('swiper-css', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css');

  // JS
  wp_enqueue_script('swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', [], null, true);
  wp_enqueue_script('three', 'https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js', [], null, true);
  wp_enqueue_script('main-js', get_template_directory_uri() . '/assets/js/main.js', ['jquery'], null, true);
}
add_action('wp_enqueue_scripts', 'alertlock_enqueue_assets');

function alertlock_register_menus() {
  register_nav_menus([
    'main-menu' => __('Main Menu', 'alertlock'),
  ]);
}
add_action('init', 'alertlock_register_menus');
