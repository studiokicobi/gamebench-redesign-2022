<?php
/**
 * Template Name: Template: About
 *
 * Template for displaying a page without sidebar even if a sidebar widget is published.
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();

?>
    <div id="container-404-section" class="container home-hero-container">
        <div class="row gx-0">
            <div class="col-lg-6">
                <div class="left">
                    <h1>404</h1>
                    <h2>Oops! Something is missing.</h2>
                    <p>Looks like it’s game over. The page you’re trying to visit either doesn’t exist or was
                        deleted.</p>
                    <div class="ctas">
                        <button onclick="location.href='<?php echo home_url(); ?>';" class="btn-cta">Take me back home
                        </button>
                        <a href="mailto:support@gamebench.net ">Submit error</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="right-image">
                    <a href="#" style="cursor:auto">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/css/img/404-game-over.svg">
                    </a>
                </div>
            </div>
        </div>
    </div>


<?php get_template_part('global-templates/getStarted-section'); ?><!-- #Get Started Section End -->


<?php
get_footer();