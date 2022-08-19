<?php
/**
 * Template Name: Template: Privacy and Terms
 *
 * Template for displaying a page without sidebar even if a sidebar widget is published.
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
$container = get_theme_mod( 'understrap_container_type' );

if ( is_front_page() ) {
	get_template_part( 'global-templates/hero' );
}

$pageid = get_the_id();
$content_post = get_post($pageid);
$content = $content_post->post_content;
$content = apply_filters('the_content', $content);
$content = str_replace(']]>', ']]&gt;', $content);
       
?>

<div class="privacy_section" id="privacy_section">
  <div class="container">
    <div class="inner-container">
      <?php echo $content; ?>
    </div>
  </div>
</div>


<?php get_template_part( 'global-templates/getStarted-section' ); ?><!-- #Get Started Section End -->

<?php
get_footer();