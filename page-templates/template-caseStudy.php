<?php
/**
 * Template Name: Template: Cases Studies
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

?>

<div class="blog_main_slider case_main_slider" id="case_main_slider">
  <div class="container">
    <div class="inner-container">
      <div class="title-container d-flex justify-content-between align-items-center">
        <h2 class="title">Case Studies</h2>
      </div>
      <div class="content-container">
        <?php 
          // args
          $args = array(
            'post_type'		=> 'case-studies',
            'posts_per_page' => 1,
            'meta_query' => array(
              array(
                  'key' => 'featured_post',
                  'value' => 1,
                  'compare' => 'LIKE'
                )
              )
          );
          // query
          $featured = new WP_Query( $args );
          // var_dump($featured);
        ?>
          <?php if( $featured->have_posts() ): ?>
            <?php while( $featured->have_posts() ) : $featured->the_post(); ?>
              <div class="blog_slider-container">
                <div class="blog-card" style="background-image: url('<?php echo get_the_post_thumbnail_url( $post->ID, 'large' ); ?>');">
                  <a href="<?php echo get_permalink(); ?>">
                    <div class="blog-content">
                      <div class="brand_logo mb-3">
                        <img src="<?php echo get_field('logo' ) ?>" alt="<?php echo get_field('title' ) ?>">
                      </div>
                      <div class="case_study-title">
                        <p>
                          <?php
                            $excerpt = wp_trim_words( get_post_field('post_content', $featured->ID ), $num_words = 10, $more = '… ' );
                            echo $excerpt;
                          ?>
                        </p>
                      </div>
                      <div class="read-more">
                        <p>Read more</p>
                      </div>
                    </div>
                  </a>
                </div>
              </div>
            <?php endwhile; ?>
          <?php endif; ?>
        <?php wp_reset_query();	 // Restore global post data stomped by the_post(). ?>
      </div>
      <div class="blog_main-arrows"></div>
    </div>
  </div>
</div>

<div class="wrapper blog_list_section" id="index-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

    <div class="inner-container">

    <div class="case-section" id="blog-section">
      <div class="container">
        <div class="inner-container">
        <div class="content-container blogContainer case-listing row">
          <?php 

            $args = array(
              'post_type'		=> 'case-studies',
              'posts_per_page' => 9,
              'order'				=> 'ASC',
            );

            // query
            $the_query = new WP_Query( $args );
          ?>
            <?php if( $the_query->have_posts() ): ?>
              <?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>
                <?php get_template_part( 'global-templates/cases-listing' ); ?>
              <?php endwhile; ?>
            <?php endif; ?>
          <?php wp_reset_query();	 // Restore global post data stomped by the_post(). ?>
        </div>
        <?php
          $maxpage = $the_query->max_num_pages;
          $currentpage = 1;
          
          // don't display the button if there are not enough posts
          if (  $the_query->max_num_pages > 1 ):
            
        ?>
          <div id="caseLoad" data-maxpage="<?php echo $maxpage; ?>" data-currentpage="<?php echo $currentpage; ?>" class="loadMoreBtn btn btn-custom-outline text-center">Load More</div>
        <?php endif; ?>

        </div>
      </div>
    </div><!-- #Blog Section End -->
    </div>

	</div><!-- #content -->

</div><!-- #blog-wrapper -->

<?php get_template_part( 'global-templates/getStarted-section' ); ?><!-- #Get Started Section End -->

<?php
get_footer();
