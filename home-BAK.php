<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

$container = get_theme_mod( 'understrap_container_type' );
?>

<?php if ( is_front_page() && is_home() ) : ?>
	<?php get_template_part( 'global-templates/hero' ); ?>
<?php endif; ?>

<div class="blog_main_slider" id="blog_main_slider">
  <div class="container">
    <div class="inner-container">
      <div class="title-container d-flex justify-content-between align-items-center">
        <h2 class="title">Blogs</h2>
        <div class="contact-data_social">
          <?php echo do_shortcode( strval(get_field('social_widget_id', 'options')) ); ?>
        </div>
      </div>
      <div class="content-container blog_top_slider">
        <?php 
          // args
          $args = array(
            'post_type'		=> 'post',
            'posts_per_page' => -1,
            'order'				=> 'DESC',
            'meta_query' => array(
              array(
                  'key' => 'sticky_post',
                  'value' => 1,
                  'compare' => 'LIKE'
                )
            )
          );
          // query
          $the_query = new WP_Query( $args );
        ?>
          <?php if( $the_query->have_posts() ): ?>
            <?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>
              <div class="blog_slider-container">
                <div class="blog-card" style="background-image: url('<?php echo get_the_post_thumbnail_url( $post->ID, 'large' ); ?>');">
                  <a href="<?php echo get_permalink(); ?>">
                    <div class="blog-content">
                      <div class="blog-title">
                        <p>
                          <?php the_title(); ?>
                        </p>
                      </div>
                      <div class="blog-author">
                        <div class="author-pic">
                          <img src="<?php echo get_avatar_url( get_the_author_meta( 'ID' ), $post->ID ); ?>" alt="<?php echo get_the_author_meta( 'display_name', $userID ); ?>">
                        </div>
                        <div class="author-name">
                          <p class="info"><?php echo get_the_author_meta( 'display_name', $userID ); ?></p>
                        </div>
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
        <div id="heading-tool">
            <h2>Recent Blogs</h2>
            <div class="tools">
                <div class="clear-tags loadSearch">Clear tags  </div>

                <div class="custom-select-wrapper">
                    <div class="custom-select">
                        <div class="custom-select__trigger"><span class="title-search-tag">Tags</span>
                            <div class="arrow"></div>
                        </div>
                        <div class="custom-options">
                            <span class="custom-option selected tags" data-value="tags">Tags</span>
                            <?php
                            $tags = get_tags(array(
                                'hide_empty' => false
                            ));

                            foreach ($tags as $tag) {
                                echo ' <span class="custom-option loadSearch" data-value="'.$tag->term_id.'">'.$tag->name.'</span>';
                            }

                            ?>
                        </div>
                    </div>
                </div>

                <div class="custom-input-wrapper">
                    <input id="search-word" class="loadSearch input-searcher" placeholder="Search Blogs..." value="" />
                    <button class="searchIcon loadSearch"></button>
                    <button class="clearSearch">X</button>
                </div>

            </div>
        </div>

      <div class="row blogContainer">

        <?php if( have_posts() ) : while (have_posts() ) : the_post();

            if( !in_array('performance-iq', array_column(get_the_category($post->ID), 'slug') ) ) {
	            get_template_part( 'global-templates/blog-listing' );
            }

          ?>

        <?php endwhile; else : ?>

        <?php endif; ?>

      </div><!-- .row -->
      <?php
        global $wp_query; // you can remove this line if everything works for you
        
        // don't display the button if there are not enough posts
        if (  $wp_query->max_num_pages > 1 )
          echo '<div id="loadMoreBtn" class="loadMoreBtn btn btn-custom-outline text-center">Load More</div>'; // you can use <a> as well
      ?>
    </div>

	</div><!-- #content -->

</div><!-- #blog-wrapper -->

<?php get_template_part( 'global-templates/getStarted-section' ); ?><!-- #Get Started Section End -->

<?php
get_footer();
