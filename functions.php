<?php

function alertlock_enqueue_assets() {
  // CSS
  wp_enqueue_style('main-css', get_template_directory_uri() . '/assets/css/main.css');
  wp_enqueue_style('swiper-css', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css');

  // JS
  wp_enqueue_script('jquery');
  wp_enqueue_script('swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', [], null, true);
  wp_enqueue_script('three', 'https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js', [], null, true);
  wp_localize_script('main-js', 'alkData', ['homeUrl' => home_url('/')]);
  wp_enqueue_script('alk-fixes', get_template_directory_uri() . '/assets/js/alk-fixes.js', ['jquery'], time(), true);
  wp_enqueue_script('browser', get_template_directory_uri() . '/assets/js/browser.min.js', [], null, true);
  wp_enqueue_script('breakpoints', get_template_directory_uri() . '/assets/js/breakpoints.min.js', ['browser'], null, true);
  wp_enqueue_script('util', get_template_directory_uri() . '/assets/js/util.js', ['jquery', 'browser', 'breakpoints'], null, true);
  
  // ✅ Add these two plugins:
  wp_enqueue_script('scrolly', get_template_directory_uri() . '/assets/js/jquery.scrolly.min.js', ['jquery'], null, true);
  wp_enqueue_script('scrollex', get_template_directory_uri() . '/assets/js/jquery.scrollex.min.js', ['jquery'], null, true);
  wp_enqueue_script('main-js', get_template_directory_uri() . '/assets/js/main.js', ['jquery', 'browser', 'breakpoints', 'util', 'scrolly', 'scrollex'], null, true);

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
  $to      = 'timgarza@gmail.com'; // <-- 👈 Change this to your email
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



// ========== Careers form handler ==========
add_action('admin_post_nopriv_alk_careers_submit', 'alk_handle_careers_form');
add_action('admin_post_alk_careers_submit', 'alk_handle_careers_form');

function alk_handle_careers_form() {
    if ( ! isset($_POST['alk_careers_nonce_field']) || 
         ! wp_verify_nonce($_POST['alk_careers_nonce_field'], 'alk_careers_nonce') ) {
        wp_die('Security check failed.');
    }

    // ✅ Load Dompdf
    require_once WP_CONTENT_DIR . '/uploads/dompdf/autoload.inc.php';

    // ✅ Reference classes directly with full namespace
    $options = new Dompdf\Options();
    $options->set('isRemoteEnabled', true);

    $dompdf = new Dompdf\Dompdf($options);

    // ✅ Build the HTML
    $html = '<h2>Job Application</h2>';
    foreach ($_POST as $key => $value) {
        if (in_array($key, ['action','alk_careers_nonce_field','_wp_http_referer'])) continue;
        $clean_key = ucwords(str_replace('-', ' ', $key));
        $html .= "<p><strong>{$clean_key}:</strong> " . esc_html(is_array($value) ? implode(', ', $value) : $value) . "</p>";
    }

    // ✅ Render PDF
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    // ✅ Save PDF temporarily
    $upload_dir = wp_upload_dir();
    $pdf_path = $upload_dir['path'] . '/application-' . time() . '.pdf';
    file_put_contents($pdf_path, $dompdf->output());

    // ✅ Email PDF
    $to = 'timgarza@gmail.com';
    $subject = 'New Job Application';
    $body = 'A new job application has been submitted. PDF attached.';
    $headers = ['Content-Type: text/html; charset=UTF-8'];

    wp_mail($to, $subject, $body, $headers, [$pdf_path]);

    // ✅ Redirect after submit
    wp_redirect(home_url('/careers?form=success'));
    exit;
}
