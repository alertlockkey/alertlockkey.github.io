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
      <li><a href="' . home_url('/') . '#three" class="scrolly">Services</a></li>
      <li><a href="' . home_url('/') . '#contact" class="scrolly">Contact</a></li>
      <li><a href="' . home_url('/careers') . '">Careers</a></li>
      <li><a href="' . home_url('/') . '#one" class="scrolly">About</a></li>
    </ul>
  ';
}

// Handle Contact Form Submission
function alk_handle_contact_form() {
  // Sanitize form data
  $name     = sanitize_text_field($_POST['demo-name'] ?? '');
  $email    = sanitize_email($_POST['demo-email'] ?? '');
  $category = sanitize_text_field($_POST['demo-category'] ?? '');
  $priority = sanitize_text_field($_POST['demo-priority'] ?? '');
  $message  = sanitize_textarea_field($_POST['demo-message'] ?? '');

  // Compose email
  $to      = 'tim@alertlock.net'; // <-- 👈 Change this to your email
  $subject = 'New Contact Form Message from ' . $name;
  $headers = ['Content-Type: text/html; charset=UTF-8', 'Reply-To: ' . $email];

  $body = "
    <h2>New Contact Form Submission</h2>
    <p><strong>Name:</strong> {$name}</p>
    <p><strong>Email:</strong> {$email}</p>
    <p><strong>Category:</strong> {$category}</p>
    <p><strong>Priority:</strong> {$priority}</p>
    <p><strong>Message:</strong><br>{$message}</p>
  ";

  // Send email
  wp_mail($to, $subject, $body, $headers);

  // Redirect back with success
  wp_redirect(home_url('/?form=success'));
  exit;
}
add_action('admin_post_send_contact_form', 'alk_handle_contact_form');
add_action('admin_post_nopriv_send_contact_form', 'alk_handle_contact_form');

