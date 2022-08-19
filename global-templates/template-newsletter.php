<?php
/**
 * Template Name: Template: Newsletter
 *
 * Template for displaying a page without sidebar even if a sidebar widget is published.
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
$container = get_theme_mod( 'understrap_container_type' );

	$featuredNewsletter = get_field('featured_newsletter');

	//arg
	$newsletterArgs = array(
		'post_type' => 'newsletter',
		'post_status' => 'publish',
		'posts_per_page' => 1,
		'order' => 'DESC',
		'meta_key' => 'status',
		'meta_value' => 'Featured',
	);
	$featuredNewsletter = new WP_Query( $newsletterArgs );
	if( !empty($featuredNewsletter->posts) ){
		$featuredNewsletter = $featuredNewsletter->posts[0];
	}

	//arg
	$recentNewslettersArgs = array(
		'post_type' => 'newsletter',
		'post_status' => 'publish',
		'posts_per_page' => 6,
		'order' => 'DESC',
		'meta_key' => 'status',
		'meta_value' => 'Recent',
	);

	// query
	$recentNewsletters = new WP_Query( $recentNewslettersArgs );

?>

<section class="newsletter newsletter-main-section">
	<div class="container">
		<div class="inner-container">
			<div class="title-container d-flex justify-content-between align-items-center">
                <h1 class="title"><?= get_field( 'featured_newsletter_title' ) ?></h1>
			</div>
			<div class="content-container">
                <div class="row">
                    <div class="col-md-12">
	                    <?php
		                    if ( ! empty( $featuredNewsletter ) && have_rows( 'content', $featuredNewsletter->ID ) ) {
		                    while ( have_rows( 'content', $featuredNewsletter->ID ) ):
		                    the_row();

		                    $date = get_sub_field( 'date' )['date'];
	                    ?>
                        <div class="block_of_content_of_newsletter" data-detail-url="<?=get_sub_field( 'button' )['link']['url']?>" style="background: linear-gradient(
                                180deg,
                                rgb(21 23 31 / 0%),
                                rgb(21 23 31 / 80%)),
                                url(<?= get_sub_field( 'image' ) ?>);">
                            <div class="builder-text"> <?= $date ?></div>
                            <h3 class="builder-subtitle">
                                <?= get_sub_field( 'title' ) ?>
                            </h3>
                            <div class="builder-buttons">
                                <a href="<?=get_sub_field( 'button' )['link']['url']?>"><?=get_sub_field( 'button' )['label']?></a>
                            </div>
                        </div>
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

<div class="wrapper newsletter-list-section blog_list_section" id="index-wrapper">
        <div class="container" id="content" tabindex="-1">
            <div class="inner-container">
                <div id="heading-tool">
                    <h2><?= get_field( 'newsletter_list_title' ) ?></h2>
                    <div class="tools">
                        <div class="custom-input-wrapper">
                            <input id="search-word" data-page="newsletters" class="loadSearch input-searcher" placeholder="Search Newsletters..." value="" />
                            <button class="searchIcon loadSearch"></button>
                            <button class="clearSearch">X</button>
                        </div>

                    </div>
                </div>
                <div class="row blogContainer">
	                <?php
		                foreach ( $recentNewsletters->posts as $recentNewsletter ) {

			                if ( have_rows( 'content', $recentNewsletter->ID ) ) {

				                while ( have_rows( 'content', $recentNewsletter->ID ) ): the_row();
					                get_template_part('global-templates/recent-newsletter-listing');
				                endwhile;
			                }
		                }
	                ?>
                </div><!-- .row -->
				<?php
					wp_reset_query();
					// don't display the button if there are not enough posts
					if (  $recentNewsletters->max_num_pages > 1 )
						echo '<div id="loadMoreBtn" data-max-page="'.$recentNewsletters->max_num_pages.'" class="loadMoreBtn btn btn-custom-outline text-center">Load More</div>'; // you can use <a> as well
				?>
            </div>

        </div><!-- #content -->

    </div><!-- #blog-wrapper -->
    <script>
      jQuery(function ($) {
        $(document).ready(function (){
          $('.block_of_content_of_newsletter').click(function (){
            window.location.href = $(this).data('detail-url') ;
          });
        });
      });
    </script>
<?php
get_template_part('global-templates/getStarted-section');

get_footer();