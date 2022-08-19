<?php

/**
 * Template Name: Template: Performance IQ
 *
 * Template for displaying a page without sidebar even if a sidebar widget is published.
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
<section class="performance-iq performance-iq-hero-section" <?= 'style="background-image: url(' . get_field('hero_image') . ')"'; ?>>
    <div class="container">
        <div class="inner-container">
            <div class="content-container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="block_of_content_of_event">
                            <div class="builder-text">
                                <div class="performance-iq-logo-container">
                                    <img src="<?php echo get_template_directory_uri(); ?>/css/img/performance-iq-logo.png" width="400" height="49" alt="Performance IQ Logo" />
                                </div>
                                <div class="row">
                                    <div class="col-md-7 performance-iq-hero-text">
                                        <?php the_content(); ?>
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

<section class="performance-iq performance-iq-recent-section">
    <div class="container">
        <div class="inner-container">
            <div class="title-container d-flex justify-content-between align-items-center">
                <h2 class="title">Recent Bulletins</h2>
            </div>
            <div class="content-container">
                <div class="row blogContainer">
                    <?php
                    foreach ($recentPosts->posts as $recentPost) {

                        if (have_rows('performance_iq', $recentPost->ID)) {

                            while (have_rows('performance_iq', $recentPost->ID)) : the_row();
                                get_template_part('template-parts/recent-performance-iq-listing', null, ['recentPost' => $recentPost]);
                            endwhile;
                        }
                    }
                    wp_reset_query();
                    ?>
                </div>
            </div>
        </div>
        <?php
        $maxpage     = $recentPosts->max_num_pages;
        $currentpage = 1;

        // don't display the button if there are not enough posts
        if ($maxpage > 1) :
        ?>
            <div id="loadMoreBtn" data-max-page="<?php echo $maxpage; ?>" data-currentpage="<?php echo $currentpage; ?>" class="loadMoreBtn btn btn-custom-outline text-center">Load More
            </div>
        <?php endif; ?>
    </div>
</section>

<?php
get_template_part('global-templates/getStarted-section');

?>

<?php
get_footer();
