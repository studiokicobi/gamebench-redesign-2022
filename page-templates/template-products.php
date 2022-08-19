<?php
/**
 * Template Name: Template: Products
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

<div class="top-section_products" id="top-products_section">

  <div class="container">
    <div class="inner-container">

        <?php 
          if( have_rows('top_copy_and_video')) :
            while( have_rows('top_copy_and_video') ): the_row();
        ?>
        <div class="content-column">
          <h2 class="title"><?php the_sub_field('title'); ?></h2>
          <p class="info"><?php the_sub_field('content'); ?></p>
          <?php if ( the_sub_field('cta_url') ) : ?>
              <a href="<?php the_sub_field('cta_url'); ?>" class="btn btn-primary btn-custom"><?php the_sub_field('cta_label'); ?></a>
          <?php endif; ?>
        </div>
        <div class="video-column" data-background="<?php the_sub_field('video_image'); ?>">
          <div class="video-container hideVideo" id="video-controls">
            <?php if (get_sub_field('video_options') == 'Hosted Video'): ?>
              <video controls="true" width='100%' height='100%' class="video video_products" id="video_products" preload="metadata" poster="<?php the_sub_field('video_image'); ?>">
                <source src="<?php the_sub_field('video_url'); ?>" type="video/mp4"></source>
              </video>
            <?php endif; ?>
  
            <?php if (get_sub_field('video_options') == 'Youtube or Vimeo'): ?>
              <span id="videoSource" class="video_products" data-src="<?php the_sub_field('youtube_or_vimeo_embedded'); ?>"></span>
              <iframe id="gameBenchVideo" width="100%" height="500" src="" frameborder="0" allow="autoplay; fullscreen"></iframe>
            <?php endif; ?>
          </div>
          <div class="buttons-container">
            <!-- <div class="action-button"></div> -->
              <div class="playpause">
                <input type="checkbox" value="None" id="playpause" name="check" />
                <label for="playpause" tabindex=1></label>
              </div>
            <span class="play-copy">Play Video</span>
            <div class="video_overlay" id="play-pause"></div>
          </div> 
        </div>
        <?php 
            endwhile;
          endif;
        ?>
        <?php wp_reset_query();	 // Restore global post data stomped by the_post(). ?>
 
    </div>
  </div>

</div><!-- #Top Solutions End -->

<div class="game-performnance_section" id="game-performnance_section">

  <div class="container">
    <div class="inner-container">
      <div class="content-container">
        <?php 
          if( have_rows('products_icon_cards')) :
            while( have_rows('products_icon_cards') ): the_row();
        ?>
        <div class="product-icon_card">
          <div class="icon-container">
            <?php the_sub_field('icon'); ?>
          </div>
          <div class="copy-container">
            <h2 class="title"><?php the_sub_field('title'); ?></h2>
            <p class="info"><?php the_sub_field('content'); ?></p>
          </div>
        </div>
        <?php 
            endwhile;
          endif;
        ?>
        <?php wp_reset_query();	 // Restore global post data stomped by the_post(). ?>
      </div>
    </div>
  </div>

</div><!-- #Game performance Section End -->

<?php get_template_part( 'global-templates/our-process' ); ?><!-- #Our Process Section End -->

<?php if( have_rows('gpm_at_glance')) :
    while( have_rows('gpm_at_glance') ): the_row(); ?>
    <div class="gpm-glance-section" id="gpm-glance-section">
        <div class="container">
            <div class="inner-container">
                <div class="section-header">
                    <h2 class="title"><?php the_sub_field('gpm_title'); ?></h2>
                    <div class="info"><?php the_sub_field('gpm_description'); ?></div>
                </div>
                <div class="gpm-glance-grid">
                    <?php if( have_rows('icon_cards')) :
                        while( have_rows('icon_cards') ): the_row(); ?>
                            <div class="gpm-glance-card">
                                <div class="gpm-glance-card-header">
                                    <div class="gpm-glance-icon">
                                        <?php the_sub_field('icon'); ?>
                                    </div>
                                    <div class="gpm-glance-title">
                                        <?php the_sub_field('title'); ?>
                                    </div>
                                </div>
                                <div class="gpm-glance-list">
                                    <?php the_sub_field('list'); ?>
                                </div>
                            </div>
                        <?php endwhile;
                    endif; ?>
                </div>
                <div class="gpm-glance-slider">
                    <ul class="gpm-glance-list">
                    <?php
                    if( have_rows('icon_cards')) :
                        $count = 0;
                        while( have_rows('icon_cards') ): the_row(); ?>
                        <li class="gpm-glance-item <?= $count == 0 ? 'active' : 'hidden' ?>" dropdown-open="" data-item="<?= $count ?>">
                            <div class="gpm-glance-icon">
                                <?php the_sub_field('icon'); ?>
                            </div>
                            <div class="gpm-glance-icon dark">
                                <?php the_sub_field('icon_dark'); ?>
                            </div>
                            <div class="gpm-glance-title">
                                <?php the_sub_field('title'); ?>
                            </div>
                        </li>
                        <?php
                            $count++;
                        endwhile;
                    endif; ?>
                    </ul>
                    <div class="gpm-glance-list-container">
                        <?php if( have_rows('icon_cards')) :
                            $count = 0;
                            while( have_rows('icon_cards') ): the_row(); ?>
                                <div class="gpm-glance-item-content <?= $count == 0 ? 'active' : 'hidden' ?>" data-item="<?= $count ?>">
                                    <div class="gpm-glance-list">
                                        <?php the_sub_field('list'); ?>
                                    </div>
                                </div>
                            <?php
                                $count++;
                            endwhile;
                        endif; ?>
                    </div>
                    <div class="tab-arrow"> <span class="goToPrev"></span> <span class="goToNext"></span></div>
                </div>
            </div>
        </div>
    </div>
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

<?php get_template_part( 'global-templates/testimonial-section' ); ?><!-- #Testimonial Section End -->

<?php get_template_part( 'global-templates/getStarted-section' ); ?><!-- #Get Started Section End -->

<!-- The Modal -->
<div id="videoModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close-modal">&times;</span>
    <?php 
      if( have_rows('top_copy_and_video')) :
        while( have_rows('top_copy_and_video') ): the_row();
    ?>

    <?php if (get_sub_field('video_options') == 'Hosted Video'): ?>
      <video controls muted class="video" id="video_products" preload="metadata" poster="">
        <source src="<?php the_sub_field('video_url'); ?>" type="video/mp4"></source>
      </video>
    <?php endif; ?>

    <?php if (get_sub_field('video_options') == 'Youtube or Vimeo'): ?>
      <span id="videoSource" data-src="<?php the_sub_field('youtube_or_vimeo_embedded'); ?>"></span>
      <iframe id="gameBenchVideo" width="100%" height="500" src="" frameborder="0" allow="autoplay; fullscreen"></iframe>
    <?php endif; ?>

      <?php 
          endwhile;
        endif;
      ?>
      <?php wp_reset_query();	 // Restore global post data stomped by the_post(). ?>
  </div>

</div>

<?php
get_footer();
