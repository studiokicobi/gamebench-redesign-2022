<?php
/**
 * Template Name: Template: Home
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

    <div class="main_slider" id="full-width-page-wrapper">
        <div class="slick">
            <div class="slide-container">
                <?php
                if( have_rows('hero-images')) :
                    $i = 0;
                    while( have_rows('hero-images') ): the_row();
                        ?>

                        <div class="slide slide--1" style="background-image: url(<?php the_sub_field('hero-image');  ?>)">
                            <div class="container">
                                <div class="inner-container">
                                    <div class="content">
                                        <?php if(get_sub_field("logo_top")): ?>
                                            <div class="logo_top">
                                                <img src="<?php the_sub_field('logo_top');  ?>" alt=" <?php the_sub_field('title'); ?>">
                                            </div>
                                        <? endif; ?>
                                        <h1 id="main-title-<?php echo $i + 1;?>" data-main-title="<?php the_sub_field('title'); ?>" data-word-change="<?php the_sub_field('title_word_to_replace'); ?>" data-new-word="<?php the_sub_field('title_new_word'); ?>" class="title main-title_home">
                                            <?php the_sub_field('title'); ?>
                                        </h1>
                                        <p class="info"><?php the_sub_field('short_content'); ?></p>
                                        <?php if( get_sub_field("cta_label") != 'hidden'): ?>
                                            <a href="<?php the_sub_field('cta_url'); ?>" target="_blank" class="btn btn-primary btn-custom"><?php the_sub_field('cta_label'); ?></a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <?php
                        $i++;
                    endwhile;
                endif;
                ?>
            </div>
            <!-- <div class="overlay"></div> -->
            <div class="arrows-container"></div>


        </div>

    </div><!-- #Hero Slider End -->

    <div class="logo-section" id="logo_section">
        <div class="container">
            <div class="logo-row" id="logo_slider">
                <?php
                if( have_rows('logo_section')) :
                    while( have_rows('logo_section') ): the_row();
                        ?>
                        <div class="logo-container" style="width: 100%; display: inline-block;">
                            <img class="image-fluid" src="<?php the_sub_field('logo_image'); ?>" alt="Logos">
                        </div>
                    <?php
                    endwhile;
                endif;
                ?>
            </div>
        </div>
    </div><!-- #Logo Section End -->
    <div class="metrics-container-wrapper" style="visibility: hidden;">
        <div class="metrics-container">
            <?php
            if( have_rows('metrics')) :
                while( have_rows('metrics') ): the_row();
                    ?>
                    <div class="icon-card">
                        <div class="icon-container">
                            <?php the_sub_field('icon_metric'); ?>
                        </div>
                        <div class="copy-container">
                            <h5 class="title"><?php the_sub_field('title_metric'); ?></h5>
                            <p class="info"><?php the_sub_field('detail_metric'); ?></p>
                        </div>
                    </div>
                <?php
                endwhile;
            endif;
            ?>
        </div>
    </div>

    <div class="why-performance-section" style="visibility: hidden;">
        <div class="container">
            <div class="inner-container">
              <div class="content-grid">
                    <?php
                    if ( have_rows( 'why_perfomance_section' ) ) :
                        while ( have_rows( 'why_perfomance_section' ) ): the_row();
                            ?>
                            <div class="content-container">
                                <div class="short-content">
                                    <div class="title-container">
                                        <div class="title-wrapper">
                                            <?php the_sub_field('icon_image'); ?>
                                            <h2 class="title">
                                                <span class="white"><?= explode(' ', trim(get_sub_field('title')))[0]; ?></span>
                                                <span>
                                                        <?= substr(strstr( trim(get_sub_field('title')) ," "), 1); ?>
                                                    </span>
                                            </h2>
                                        </div>
                                    </div>
                                    <p class="info"><?php the_sub_field('content'); ?></p>
                                </div>
                            </div>

                            <div class="central-image-container">
                                <?php the_sub_field('central_image'); ?>
                            </div>
                        <?php
                        endwhile;
                    endif;
                    ?>
                </div>
            </div>

        </div>
    </div><!-- #Why Performance Section End -->


    <div class="why-section" id="why_section">
        <div class="container">
            <div class="inner-container">
                <div class="short-content">
                    <div class="title-container">
                        <div class="title-wrapper">
                            <h2 class="title"><?=the_field('icon_section_title')?></h2>
                            <?php
                            $logo = get_theme_mod( 'custom_logo' );
                            $logoImage = wp_get_attachment_image_src( $logo , 'full' );
                            $logo_url = $logoImage[0];
                            ?>
                            <div>
                                <img width="720" height="100" src="<?=$logo_url?>" alt=""><span><?=the_field('icon_section_title_mark')?></span>
                            </div>

                        </div>
                    </div>
                    <p class="info"><?php the_field('icon_section_short_content') ?></p>
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
                                        <h3 class="title"><?php the_sub_field('title'); ?></h3>
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
<?php get_template_part( 'global-templates/our-process' ); ?><!-- #Our Process Section End --> 

<?php
if( have_rows('perfomance_section') ):
    while( have_rows('perfomance_section') ): the_row();
        ?>
        <div class="performanceSec" id="performanceSec" style="background-image: url(<?php the_sub_field('background_image');  ?>)">
            <div class="container">
                <div class="inner-container">
                    <div class="content-box">
                        <h2 class="title"><?php the_sub_field("title"); ?></h2>
                        <p class="info"><?php the_sub_field("content"); ?></p>
                        <a href="<?php the_sub_field("cta_url"); ?>" class="btn btn-primary btn-custom"><?php the_sub_field("cta_label"); ?></a>
                    </div>
                </div>
            </div>
        </div>
    <?php endwhile; ?>
<?php endif; ?>
<?php wp_reset_query();	 // Restore global post data stomped by the_post(). ?>

<?php
if( have_rows('performance_sub_section') ):
    while( have_rows('performance_sub_section') ): the_row();
        if( get_sub_field('visible') ):
            ?>
            <div class="performance-monitoring" id="performance-monitoring">
                <div class="container">
                    <div class="inner-container">
                        <div class="content-container">
                            <div class="content-column">
                                <h2 class="title"><?php the_sub_field('title'); ?></h2>
                                <p class="info">
                                    <?php the_sub_field('content_detail'); ?>
                                </p>
                                <a href="<?php the_sub_field('cta_button_url'); ?>" class="btn btn-primary btn-custom"><?php the_sub_field('cta_button_label'); ?></a>
                                <p class="link">
                                    <a href="<?php the_sub_field('learn_link_url'); ?>" class="learn_link"><?php the_sub_field('learn_link_label'); ?></a>
                                </p>
                            </div>
                            <div class="image-column">
                                <img class="image-fluid" src="<?php the_sub_field('image'); ?>" alt="<?php the_sub_field('title'); ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        endif;
    endwhile;
    reset_rows();
endif;
?>

<?php
if( have_rows('perfomance_right_section') ):
    while( have_rows('perfomance_right_section') ): the_row();
        ?>
        <div class="performanceSec" id="performanceSecondary" style="background-image: url(<?php the_sub_field('background_image');  ?>)">
            <div class="container">
                <div class="inner-container">
                    <div class="right-box content-box">
                        <h2 class="title"><?php the_sub_field("title"); ?></h2>
                        <p class="info"><?php the_sub_field("content"); ?></p>
                        <a href="<?php the_sub_field("cta_url"); ?>" class="btn btn-primary btn-custom"><?php the_sub_field("cta_label"); ?></a>
                    </div>
                </div>
            </div>
        </div>
    <?php endwhile; ?>
<?php endif; ?>
<?php wp_reset_query();	 // Restore global post data stomped by the_post(). ?>
    <!-- #Performance Section End -->
<!----- Hide Verticals 
<?php get_template_part( 'global-templates/verticals-section' ); ?><!-- #Verticals Section End --> 
----->
<!---- Start Hide Testimonials 
<?php get_template_part( 'global-templates/testimonial-section' ); ?><!-- #Testimonial Section End -->
---->
    <div class="blog-section" id="blog-section">
        <div class="container">
            <div class="inner-container">
				<h2 class="title text-center"><a href="/performance-iq/">Our Latest Insights</a></h2>

                <div class="content-container blog-slider">
                    <?php
                    // args
                    $args = array(
                        'post_type'		=> 'post',
                        'posts_per_page' => -1,
                        'order'				=> 'DESC',
                    );
                    // query
                    $the_query = new WP_Query( $args );

                    $post_thumb = $the_query;
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

                <div class="see-all text-right text-sm-right text-md-center ">
                   <!---- <a href="<?php echo get_post_type_archive_link( 'post' );?>" class="btn btn-outline-primary btn-custom-outline">See all</a>---->
					<a href="/performance-iq/" class="btn btn-outline-primary btn-custom-outline">See all</a>
					
					
                </div>

            </div>
        </div>
    </div><!-- #Blog Section End -->
<!----- Start Hide Get Started 
<?php get_template_part( 'global-templates/getStarted-section' ); ?><!-- #Get Started Section End -->

<?php
get_footer();
