  <!-- Footer -->
  <footer id="footer">
    <ul class="icons">
      <li><a href="#" class="icon brands fa-yelp"><span class="label">Yelp</span></a></li>
      <li><a href="#" class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>
      <li><a href="#" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
      <li><a href="#" class="icon brands fa-facebook-f"><span class="label">Facebook</span></a></li>
      <li><a href="#" class="icon solid fa-envelope"><span class="label">Email</span></a></li>
    </ul>
    <ul class="copyright">
      <li>&copy; 2020-<?php echo date('Y'); ?></li>
      <li><a href="<?php echo home_url(); ?>">Alert Lock & Key</a></li>
      <li>LIC. #B11924</li>
    </ul>
  </footer>

</div> <!-- /page-wrapper -->

<!-- Scripts -->

<script>
jQuery(document).ready(function($) {
  // Close menu when clicking outside it
  $(document).on('click', function(e) {
    if (!$(e.target).closest('#menu, .menuToggle').length) {
      $('#menu').removeClass('visible');
    }
  });

  // Toggle open/close on click
  $('.menuToggle').on('click', function(e) {
    e.preventDefault();
    $('#menu').toggleClass('visible');
  });

  // Optional: Close when clicking a menu item
  $('#menu a').on('click', function() {
    $('#menu').removeClass('visible');
  });
});
</script>

<?php wp_footer(); ?>
<script>
document.addEventListener("DOMContentLoaded", function () {
  document.body.classList.remove("is-preload");
});
</script>
<script>
document.addEventListener('wpcf7submit', function(event) {
  // Re-show radios & checkboxes after CF7 refresh
  const inputs = document.querySelectorAll(
    '.wpcf7 input[type="radio"], .wpcf7 input[type="checkbox"]'
  );
  inputs.forEach(el => {
    el.style.display = 'inline-block';
    el.style.opacity = '1';
    el.style.visibility = 'visible';
  });
}, false);
</script>
</body>
</html>
