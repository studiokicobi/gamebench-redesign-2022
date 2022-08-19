<?php
/**
 * The template for displaying all single posts
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
    $container = get_theme_mod( 'understrap_container_type' );
    $classes = get_body_class();

	$post_id = get_the_ID();
	$cat_ids = array();
	$categories = get_the_category( $post_id );
	if(!empty($categories) && !is_wp_error($categories)):
		foreach ($categories as $category):
			array_push($cat_ids, $category->term_id);
		endforeach;
	endif;
	$current_post_type = get_post_type($post_id);
	$query_args = array(
		'category__in'   => $cat_ids,
		'post_type'      => $current_post_type,
		'post__not_in'    => array($post_id),
		'posts_per_page'  => '3',
	);

	$related_cats_post = new WP_Query( $query_args );


	$isPerformanceIQPost = false;

	foreach ( $categories as $category ) {
		if( $category->slug == 'performance-iq' ){
			$isPerformanceIQPost = true;
		}
	}

?>


<div class="single_top_section <?php if( $isPerformanceIQPost ){ echo 'performance-iq-single-top-section'; } ?>" id="single_top_section" style="background-image: url('<?php echo get_the_post_thumbnail_url( $post->ID, 'large' ); ?>');">

</div>


<div class="single_blog_section" id="single_blog_section">
  <div class="container">

  <?php if (in_array('single-case-studies',$classes)): ?>
    <div class="inner-container">
      
      <div class="brand_logo" >
        <img src="<?php echo get_field('logo' ) ?>" alt="<?php echo get_field('title' ) ?>">
      </div>

      <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

      <div class="social-share">
        <?php echo do_shortcode("[Sassy_Social_Share]" ); ?>
      </div>
    </div>
  <?php else: ?>
    <div class="inner-container <?php if( $isPerformanceIQPost ){ echo 'performance-iq-blog-container'; } ?>">
      <?php if( $isPerformanceIQPost ){ ?>
          <div class="performance-iq-blog-header-wrapper">
              <div class="performance-iq-logo-container">
                  <img src="<?php echo get_template_directory_uri(); ?>/css/img/performance-iq-logo.png" width="400" height="49" alt="Performance IQ Logo" />
              </div>
              <div class="social-share">
                  <?php echo do_shortcode('[Sassy_Social_Share align="right" right="500"]' ); ?>
              </div>
          </div>
      <?php } else { ?>
        <div class="social-share">
			<?php echo do_shortcode('[Sassy_Social_Share align="right" right="500"]' ); ?>
        </div>
        <?php } ?>

		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
      
      <?php 
        // args
        $args = array(
          'post_type'		=> 'post',
          'order'				=> 'ASC',
        );
        // query
        $the_query = new WP_Query( $args );

        $author_id = get_post_field ('post_author', $cause_id);
        $display_name = get_the_author_meta( 'display_name' , $author_id ); 

      ?>
      <?php if( $the_query->have_posts() ): $the_query->the_post(); ?>

      <div class="blog-author">
        <div class="author-pic">
          <img src="<?php echo get_avatar_url( $author_id  ); ?>" alt="<?php echo $display_name; ?>">
        </div>
        <div class="author-name">
          <p class="info"><?= $isPerformanceIQPost ? get_field('performance_iq', $post_id)['subtitle'] : $display_name; ?></p>
        </div>
      </div>
      
        <?php endif; ?>
      <?php wp_reset_query();	 // Restore global post data stomped by the_post(). ?>
    </div>
  <?php endif; ?>
  </div>

</div>

<div class="single_blog_content" id="single_blog_content">
  <div class="container">
    <?php if (in_array('single-case-studies',$classes)):  ?>
      <div class="case_subtitles" id="subTitlesContainer"></div>
    <?php endif; ?>

    <div class="inner-container <?php if (in_array('single-case-studies',$classes)): ?> add_inner <?php endif; ?> <?php if( $isPerformanceIQPost ){ echo 'performance-iq-blog-content-container'; } ?>" id="getSubtitle">
      <?php the_content(); ?>
    </div>
  </div>
</div>

<?php if (in_array('single-case-studies',$classes)): ?>
  <?php get_template_part( 'global-templates/getStarted-section' ); ?><!-- #Get Started Section End -->
<?php else: ?>
  <div class="related_post_section" id="related_post_section">
    <div class="container">
        <div class="inner-container">
          <h2 class="title text-center">Related Articles </h2>
            <div class="content-container related_post_slider">
    
              <?php if($related_cats_post->have_posts()):
                  while($related_cats_post->have_posts()): $related_cats_post->the_post();
	                  $isRelatedPerformanceIQPost = has_category('performance-iq',$post->ID);
              ?>

                  <div class="blog_slider-container">
                    <div class="blog-card" style="background-image: url('<?php echo get_the_post_thumbnail_url( $post->ID, 'large' ); ?>');">
                      <a href="<?php echo get_permalink(); ?>">
                        <div class="blog-content">
                          <div class="blog-title">
                          <?php if (in_array('single-case-studies',$classes)): ?>
                              <div class="brand_logo mb-3">
                                <img src="<?php echo get_field('logo' ) ?>" alt="<?php echo get_field('title' ) ?>">
                              </div>
                              <p>
                                <?php
                                  $excerpt = wp_trim_words( get_post_field('post_content', $featured->ID ), $num_words = 10, $more = '… ' );
                                  echo $excerpt;
                                ?>
                              </p>
                              <?php else: ?>
                              <p>
                                <?php the_title(); ?>
                              </p>
                            <?php endif; ?>
                          </div>
                          <?php if (in_array('single-post',$classes)): ?>
                            <div class="blog-author">
                              <?php if( !$isRelatedPerformanceIQPost ): ?>
                                  <div class="author-pic">
                                    <img src="<?php echo get_avatar_url( get_the_author_meta( 'ID' ), $post->ID ); ?>" alt="<?php echo get_the_author_meta( 'display_name', $userID ); ?>">
                                  </div>
                              <?php endif; ?>
                              <div class="author-name" <?= $isRelatedPerformanceIQPost ? 'style="padding-left: 0;"' : '' ?> >
                                <p class="info">
                                    <?php
                                        echo $isRelatedPerformanceIQPost ? get_field('performance_iq', $post->ID)['subtitle'] : get_the_author_meta( 'display_name', $userID );
                                    ?>
                                </p>
                              </div>
                            </div>
                          <?php endif; ?>
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
        </div>
        <div class="see-all text-right text-md-center ">
          <a href="<?php echo $isPerformanceIQPost ? '/performance-iq' : get_post_type_archive_link( 'post' );?>" class="btn btn-outline-primary btn-custom-outline">See all</a>
        </div>
        <div class="related-arrows"></div>
      
    </div>
  </div>
<?php endif; ?>


<?php
get_footer();
