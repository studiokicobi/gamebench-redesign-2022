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
defined('ABSPATH') || exit;

get_header();
$container = get_theme_mod('understrap_container_type');

//arg
$featuredPostArgs = array(
  'post_type' => 'post',
  'post_status' => 'publish',
  'posts_per_page' => 1,
  'orderby' => 'post_date',
  'order' => 'DESC',
  'cat' => get_category_by_slug('performance-iq')->term_id,
  'meta_key' => 'performance_iq_featured_bulletin',
  'meta_value' => '1',
);

$featuredPost = new WP_Query($featuredPostArgs);
if (!empty($featuredPost->posts)) {
  $featuredPost = $featuredPost->posts[0];
}

$haveFeaturedPost = !empty($featuredPost) && have_rows('performance_iq', $featuredPost->ID);

$postsArgs = array(
  'post_type' => 'post',
  'post_status' => 'publish',
  'posts_per_page' => 20,
  'orderby' => 'post_date',
  'order' => 'DESC',
  'cat' => get_category_by_slug('performance-iq')->term_id,
  'meta_key' => 'performance_iq_featured_bulletin',
  'meta_value' => '0',
);

// query
$recentPosts = new WP_Query($postsArgs);
?>

<?php if (get_field('hero_image')) : ?>
  <img src="<?php the_field('hero_image'); ?>" />
<?php endif ?>

<?php
// Need to specify the page id in order to connect the ACF fields
$page = 623;
?>

<style>
  .performance-iq-logo-container-heading-image {
    height: auto;
    width: 100%;
    max-width: 25rem;
  }

  /* Bandage the ridiculous negative margin issue on the Blog hero */
  body.blog .performance-iq-hero-section {
    padding: 125px 0 125px;
    margin-bottom: 220px;
  }
</style>

<section class="performance-iq performance-iq-hero-section" style="background-image: url('<?php the_field('hero_image', $page); ?>')">
  <div class="container">
    <div class="inner-container">
      <div class="content-container">
        <div class="row">
          <div class="col-md-12">
            <div class="block_of_content_of_event">
              <div class="builder-text">
                <div class="performance-iq-logo-container">
                  <!-- <img src="../wp-content/uploads/2022/04/gb-piq-bulletins-762x152-1.png" width="400" height="49" alt="Performance IQ Logo" /> -->
                  <?php if (get_field('hero_seo_heading', $page)) : ?>
                    <h1 class="visually-hidden"><?php the_field('hero_seo_heading', $page); ?></h1>
                  <?php endif ?>
                  <?php if (get_field('hero_heading_image', $page)) : ?>
                    <img class="performance-iq-logo-container-heading-image" src="<?php the_field('hero_heading_image', $page); ?>" />
                  <?php endif ?>
                </div>
                <div class="row">
                  <div class="col-md-7 performance-iq-hero-text">
                    <?php the_field('hero_copy', $page); ?>
                  </div>
                  <div class="col-md-5">
                    <div class="sign-up-container">
                      <!--[if lte IE 8]>
                                            <script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/v2-legacy.js"></script>
                                            <![endif]-->
                      <script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/v2.js"></script>
                      <script>
                        hbspt.forms.create({
                          region: "na1",
                          portalId: "2891910",
                          formId: "a7742cae-9c17-4df7-8524-bf56626c1357"
                        });
                      </script>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>


<section class="performance-iq performance-iq-main-section">
  <div class="container">
    <div class="inner-container">
      <div class="content-container">
        <div class="row">
          <?php
          if ($haveFeaturedPost) {
            while (have_rows('performance_iq', $featuredPost->ID)) : the_row();
          ?>
              <div class="col-md-6">
                <div class="block_of_content_of_event">
                  <div class="builder-text performance-iq-subtitle "> <?= get_sub_field('subtitle') ?></div>
                  <h3 class="builder-subtitle">
                    <?= $featuredPost->post_title ?>
                  </h3>
                  <div class="builder-text">
                    <?= get_sub_field('featured_bulletin_description') ?>
                  </div>
                  <div class="builder-buttons">
                    <a href="<?= get_permalink($featuredPost->ID) ?>" class="btn btn-primary">
                      <?= get_sub_field('button_text') ?>
                    </a>
                  </div>
                </div>
              </div>
              <div class="col-md-6 block_of_content_of_event_with_image" style="background: linear-gradient(
                                        180deg,
                                        rgb(21 23 31 / 0%),
                                        rgb(21 23 31 / 80%)),
                                        url(<?= get_sub_field('thumbnail') ?>);">
              </div>
          <?php
            endwhile;
          }
          wp_reset_query();
          ?>
        </div>
      </div>
    </div>
  </div>
</section>


<div class="wrapper blog_list_section" id="index-wrapper">
  <div class="<?php echo esc_attr($container); ?>" id="content" tabindex="-1">
    <div class="inner-container">
      <div id="heading-tool">
        <h2>Recent Bulletins</h2>
        <div class="tools">
          <div class="clear-tags loadSearch">Clear tags </div>

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
                  echo ' <span class="custom-option loadSearch" data-value="' . $tag->term_id . '">' . $tag->name . '</span>';
                }

                ?>
              </div>
            </div>
          </div>

          <div class="custom-input-wrapper">
            <input id="search-word" class="loadSearch input-searcher" placeholder="Search Bulletins..." value="" />
            <button class="searchIcon loadSearch"></button>
            <button class="clearSearch">X</button>
          </div>

        </div>
      </div>


      <div class="row blogContainer">

        <?php $blogPosts = new WP_Query('posts_per_page=6&offset=1');
        if (have_posts()) : while ($blogPosts->have_posts()) : $blogPosts->the_post();
            // if (!in_array('performance-iq', array_column(get_the_category($post->ID), 'slug'))) {
            get_template_part('global-templates/blog-listing');
            // }
        ?>

          <?php endwhile;
          wp_reset_query();
        else : ?>

        <?php endif; ?>

      </div><!-- .row -->
      <?php
      global $wp_query; // you can remove this line if everything works for you

      // don't display the button if there are not enough posts
      if ($wp_query->max_num_pages > 1)
        echo '<div id="loadMoreBtn" class="loadMoreBtn btn btn-custom-outline text-center">Load More</div>'; // you can use <a> as well
      ?>
    </div>
  </div><!-- #content -->
</div><!-- #blog-wrapper -->


<?php
// --------------------------------------------------
// Get Started
// --------------------------------------------------
if (get_field('use_get-started_global') == 1) :
  get_template_part('global-templates/getStarted-section');
else :
  // echo 'false'; 
  // TEMP – decrease distance to footer caused by removal of section 
  echo '<style>.blog_list_section { padding-bottom: 100px; }</style>';
endif;
?>


<?php
get_footer();
