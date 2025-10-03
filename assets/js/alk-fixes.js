(function($) {
  $(function() {

    // ==========================================================
    // 1. Ensure #menu is at <body> level (HTML5UP requirement)
    // ==========================================================
    var $menu = $('#menu');
    if ($menu.length && !$menu.parent().is('body')) {
      $menu.appendTo('body');
    }

    // ==========================================================
    // 2. Toggle Menu Open/Close
    // ==========================================================
    $(document).off('.alkMenu'); // clean previous bindings

    $(document).on('click.alkMenu', '.menuToggle', function(e) {
      e.preventDefault();
      $('body').toggleClass('is-menu-visible');
    });

    // ==========================================================
    // 3. Close when clicking outside
    // ==========================================================
    $(document).on('click.alkMenu', function(e) {
      if (!$(e.target).closest('#menu, .menuToggle').length) {
        $('body').removeClass('is-menu-visible');
      }
    });

    // ==========================================================
    // 4. Close when pressing ESC
    // ==========================================================
    $(document).on('keydown.alkMenu', function(e) {
      if (e.key === 'Escape' || e.keyCode === 27) {
        $('body').removeClass('is-menu-visible');
      }
    });

    // ==========================================================
    // 5. Swipe-to-close (mobile)
    // ==========================================================
    let touchStartX = null;
    let touchStartY = null;

    $(document).on('touchstart.alkMenu', function(e) {
      const touch = e.originalEvent.touches[0];
      touchStartX = touch.clientX;
      touchStartY = touch.clientY;
    });

    $(document).on('touchmove.alkMenu', function(e) {
      if (touchStartX === null || touchStartY === null) return;

      const touch = e.originalEvent.touches[0];
      const deltaX = touch.clientX - touchStartX;
      const deltaY = touch.clientY - touchStartY;

      // Only consider mostly horizontal swipes
      if (Math.abs(deltaX) < 50 || Math.abs(deltaX) < Math.abs(deltaY)) return;

      // Swipe left closes the menu
      if (deltaX < -50 && $('body').hasClass('is-menu-visible')) {
        $('body').removeClass('is-menu-visible');
        touchStartX = null;
        touchStartY = null;
      }
    });

    // ==========================================================
    // 6. Auto-close on anchor click + smooth scroll
    // ==========================================================
    $(document).on('click.alkMenu', '#menu a[href^="#"]', function(e) {
      const target = $(this).attr('href');
      if (target.length > 1) {
        e.preventDefault(); // stop default jump
        $('body').removeClass('is-menu-visible');

        // Wait for menu slide-out to finish
        setTimeout(() => {
          const $targetEl = $(target);
          if ($targetEl.length) {
            // Prefer jQuery animate (or .scrolly plugin)
            if ($.fn.scrolly) {
              $([document.documentElement, document.body]).scrolly(
                { scrollTop: $targetEl.offset().top - 60 },
                800,
                'swing'
              );
            } else {
              // Fallback: native smooth scroll
              window.scrollTo({
                top: $targetEl.offset().top - 60,
                behavior: 'smooth'
              });
            }
          }
        }, 450); // delay ~0.45s for smooth UX
      }
    });

    // ==========================================================
    // 7. Initialize .scrolly() globally (optional site-wide)
    // ==========================================================
    if ($.fn.scrolly) {
      $('.scrolly').scrolly({
        speed: 800,
        offset: 60
      });
    }

  });
})(jQuery);
