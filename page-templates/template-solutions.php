<?php
/**
 * Template Name: Template: Solutions
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

// echo "<pre>";
// print_r(the_field('image'));
// echo "</pre>";
// die();

?>

<div class="top-section_two" id="top-solutions_section">
  <h2 id="main-nav-label" class="sr-only">
    <?php esc_html_e( 'Contact page', 'understrap' ); ?>
  </h2>

    <div class="inner-container">
      <div class="content-container">
      <?php 
        if( have_rows('top_section')) :
          while( have_rows('top_section') ): the_row();
      ?>
        <div class="content-column">
          <h2 class="title"><?php the_sub_field('title'); ?></h2>
          <p class="top-section-content info"><?php the_sub_field('content'); ?></p>
          <?php if (the_sub_field('cta_label')) : ?>
              <a href="<?php the_sub_field('cta_url'); ?>" class="btn btn-primary btn-custom"><?php the_sub_field('cta_label'); ?></a>
          <?php endif; ?>
        </div>
        <div class="img-column" style="background-image: url('<?php the_sub_field('background_image'); ?>')"></div>
      <?php 
          endwhile;
        endif;
      ?>
      <?php wp_reset_query();	 // Restore global post data stomped by the_post(). ?>
      </div>

    </div>

</div><!-- #Top Solutions End -->

<div class="staff-section" id="staff-section">

  <div class="container">
    <div class="inner-container">
      <div class="inner-slider ">
        <div class="team-slider">
          <?php 
            $teams = array(
              'post_type' => 'staff-testimonial',
              'posts_per_page' => -1,
              'order'				=> 'ASC',
            );
            // query
            $team_query = new WP_Query( $teams );
          ?>
  
            <?php foreach($team_query->posts as $team): ?>
              <div>
                <div class="our_team_slider">
                  <div class="content-container">
                  
                    <div class="staff-member">
                      <div class="name">
                        <h2 class="info"><?php echo get_field('name', $team->ID); ?></h2>
                        <p class="info"><?php echo get_field('position', $team->ID); ?></p>
                      </div>
                    </div>
                    <div class="staff-description">
                      <p class="info">                      
                        <?php               
                          $excerpt = wp_trim_words( get_field('content', $team->ID) );
                          echo $excerpt; 
                        ?> 
                      </p>
                    </div>
                  </div>
                  <div class="pic-container" style="background-image: url('<?php echo get_field('picture', $team->ID); ?>')"></div>
                </div>
              </div>
            <?php endforeach; ?>
          <?php wp_reset_query();	 // Restore global post data stomped by the_post(). ?>
        </div>
        <div id="our-team_arrows"></div>
      </div>
    </div>
  </div>
</div><!-- #Staff Section End -->
<?php if( have_rows('services')) :
    while( have_rows('services') ): the_row(); ?>
        <div class="services-section" id="services_section">
        <div class="container">
            <div class="inner-container">
                <div class="title-container">
                    <div class="title-wrapper">
                        <h2 class="title"><?=the_sub_field('service_title')?></h2>
                    </div>
                </div>
                <div class="content-grid">
                    <div class="content-container">
                        <?php
                        if( have_rows('icon_section')) :
                            while( have_rows('icon_section') ): the_row();
                                ?>
                                <div class="icon-card">
                                    <div class="icon-container">
                                        <?php the_sub_field('icon_image'); ?>
                                    </div>
                                    <div class="copy-container">
                                        <h2 class="title"><?php the_sub_field('title'); ?></h2>
                                        <p class="info"><?php the_sub_field('detail'); ?></p>
                                    </div>
                                </div>
                            <?php
                            endwhile;
                        endif;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- #Logo Section End -->
    <?php endwhile;
endif; ?>

<div class="case_study_section" id="case_study_section">
        <div class="container">
            <div class="inner-container">
                <h2 class="title text-center">Case Studies</h2>

                <div class="content-container case_study-slider">
                    <?php
                    // args
                    $args = array(
                        'post_type'		=> 'case-studies',
                        'posts_per_page' => -1,
                        'order'				=> 'ASC',
                    );
                    // query
                    $the_query = new WP_Query( $args );

                    ?>
                    <?php if( $the_query->have_posts() ): ?>
                        <?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>
                            <div class="case_study_slider-container">
                                <div class="case_study-card" style="background-image: url('<?php echo get_the_post_thumbnail_url( $post->ID, 'large' ); ?>');">
                                    <a href="<?php echo get_permalink(); ?>">
                                        <div class="case_study-content">
                                            <div class="brand_logo" >
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

                <!-- <div class="see-all text-sm-left text-md-center ">
       <a href="<?php echo get_post_type_archive_link( 'case_study' );?>" class="btn btn-outline-primary btn-custom-outline">See all</a>
     </div> -->

            </div>
        </div>
    </div><!-- #Case Study End -->

<div class="download_slider_container" id="download_slider_container">
  <?php 
    if( have_rows('download')) :
      while( have_rows('download') ): the_row();
      ?>

    <div class="download-sample" id="download-sample">
      <div class="outer-container">
        <div class="container">
          <div class="inner-container" id="download_slider">
            <div class="content_container">
              <div class="content-column">
                <h2 class="title"><?php the_sub_field('title'); ?></h2>
                <p class="info"><?php the_sub_field('content'); ?></p>
                <a href="<?php the_sub_field('download_url'); ?>" class="btn btn-outline-primary btn-custom-outline" download="<?php the_sub_field('download_url'); ?>" target="_blank"><?php the_sub_field('cta_label'); ?></a>
                <div id="download_arrows">
                  <div class="slick-prev"></div>
                  <div class="slick-next"></div>
                </div>
              </div>
              <div class="img-column">
                <img src="<?php the_sub_field('image'); ?>" alt="<?php the_sub_field('title'); ?>">
              </div>
            </div>

          </div>
        </div>

    </div><!-- #Verticals End -->
  </div>
  <?php 
      endwhile;
    endif;
  ?>
  <?php wp_reset_query();	 // Restore global post data stomped by the_post(). ?>
</div>

<?php get_template_part( 'global-templates/getStarted-section' ); ?><!-- #Get Started Section End -->

<?php
get_footer();
