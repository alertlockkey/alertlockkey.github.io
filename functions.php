<?php

function alertlock_enqueue_assets() {
  // CSS
  wp_enqueue_style('main-css', get_template_directory_uri() . '/assets/css/main.css');
  wp_enqueue_style('swiper-css', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css');

  // JS
  wp_enqueue_script('jquery');
  wp_enqueue_script('swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', [], null, true);
  wp_enqueue_script('three', 'https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js', [], null, true);
  wp_enqueue_script('main-js', get_template_directory_uri() . '/assets/js/main.js', ['jquery', 'browser', 'breakpoints', 'util', 'scrolly', 'scrollex'], null, true);
  wp_enqueue_script('alk-fixes', get_template_directory_uri() . '/assets/js/alk-fixes.js', ['jquery'], time(), true);
  wp_enqueue_script('browser', get_template_directory_uri() . '/assets/js/browser.min.js', [], null, true);
  wp_enqueue_script('breakpoints', get_template_directory_uri() . '/assets/js/breakpoints.min.js', ['browser'], null, true);
  wp_enqueue_script('util', get_template_directory_uri() . '/assets/js/util.js', ['jquery', 'browser', 'breakpoints'], null, true);
  
  // ✅ Add these two plugins:
  wp_enqueue_script('scrolly', get_template_directory_uri() . '/assets/js/jquery.scrolly.min.js', ['jquery'], null, true);
  wp_enqueue_script('scrollex', get_template_directory_uri() . '/assets/js/jquery.scrollex.min.js', ['jquery'], null, true);

  // ✅ main.js must now wait for all of the above

  // External Libraries
}
add_action('wp_enqueue_scripts', 'alertlock_enqueue_assets');

function alertlock_register_menus() {
  register_nav_menus([
    'main-menu' => __('Main Menu', 'alertlock'),
  ]);
}
add_action('init', 'alertlock_register_menus');

// Fallback menu output (for development / staging)
function alk_default_menu() {
  echo '
    <ul>
      <li><a href="' . home_url('/') . '">Home</a></li>
      <li><a href="#three" class="scrolly">Services</a></li>
      <li><a href="#contact" class="scrolly">Contact</a></li>
      <li><a href="' . home_url('/careers') . '">Careers</a></li>
      <li><a href="#one" class="scrolly">About</a></li>
    </ul>
  ';
}
