<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

$container = get_theme_mod('understrap_container_type');
?>


<div class="wrapper footer_custom" id="wrapper-footer">
  <div class="<?php echo esc_attr($container); ?>">
    <div class="upper-footer">

      <div class="container">
        <div class="inner-container">
          <div class="footer-row">
            <div class="footer-column1">
              <?php dynamic_sidebar('logofooter'); ?>
            </div>
            <div class="footer-menu footer-flex">
              <?php dynamic_sidebar('column2footer'); ?>
            </div>

            <div class="footer-column3 footer-flex">
              <?php dynamic_sidebar('column3footer'); ?>
            </div>
          </div>
        </div>
      </div>

    </div>

    <div class="row">

      <div class="col-md-12">

        <footer class="site-footer" id="colophon">

          <div class="site-info ">
            <div id="subscribe" class="footer-right">
              <?php
              if (have_rows('footer_subscribe', 'options')) :
                while (have_rows('footer_subscribe', 'options')) : the_row();
              ?>
                  <p class="subscribe-copy text-center text-md-left"><?php the_sub_field('subscribe_title', 'options'); ?></p>
                  <?php the_sub_field('subscribe_script', 'options'); ?>
                <?php endwhile; ?>
              <?php endif; ?>
              <?php wp_reset_query();   // Restore global post data stomped by the_post(). 
              ?>
            </div>

            <div class="site-info_copy">
              <div class="privacy_container">
                <?php dynamic_sidebar('bottomfooterlinks'); ?>
              </div>
              <p class="info">© <?php echo date('Y'); ?> GameBench. All Rights Reserved.</p>
            </div>

          </div><!-- .site-info -->

        </footer><!-- #colophon -->

      </div>
      <!--col end -->

    </div><!-- row end -->

  </div><!-- container end -->

</div><!-- wrapper end -->

</div><!-- #page we need this extra closing tag here -->

<script>
  window.onscroll = function() {
    myFunction();
  }; // Get the navbar

  var navbar = document.getElementById("main-nav"); // Get the offset position of the navbar

  var sticky = navbar.offsetTop; // Add the sticky class to the navbar when you reach its scroll position. Remove "sticky" when you leave the scroll position

  function myFunction() {
    if (window.pageYOffset >= 30) {
      navbar.classList.add("sticky");
    } else {
      navbar.classList.remove("sticky");
    }
  }
</script>
<!-- Start of HubSpot Embed Code -->
<script type="text/javascript" id="hs-script-loader" async defer src="//js.hs-scripts.com/2891910.js"></script>
<!-- End of HubSpot Embed Code -->

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-57536677-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];

  function gtag() {
    dataLayer.push(arguments);
  }
  gtag('js', new Date());

  gtag('config', 'UA-57536677-1');
</script>


<?php wp_footer(); ?>

</body>

</html>