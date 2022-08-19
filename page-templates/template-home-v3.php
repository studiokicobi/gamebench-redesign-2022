<?php

/**
 * Template Name: Template: Home v3
 *
 * Template for displaying a page without sidebar even if a sidebar widget is published.
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();
$container = get_theme_mod('understrap_container_type');

if (is_front_page()) {
    get_template_part('global-templates/hero');
}
?>


<?php
// --------------------------------------------------
// Basic Hero section
// --------------------------------------------------
if (get_field('use_basic_hero') == 1) : ?>

    <style>
        .main-title-basic {
            max-width: 58rem;
            margin-right: auto;
            margin-left: auto;
        }

        .main-title-basic strong {
            color: #ff7300;
            font-weight: 400;
        }

        .info.info-basic {
            font-size: 1.5rem;
            line-height: 1.2;
            margin-left: auto;
            margin-right: auto;
            max-width: 58rem;
        }

        .main_slider {
            position: relative;
            height: auto;
        }

        .logo-section {
            margin: 0;
            padding: 0;
            position: absolute;
            bottom: 1rem;
        }

        .btn {
            border-radius: 0;
        }

        .gpm-glance-card .btn {
            margin-top: 1rem;
        }

        .gpm-glance-section {
            padding: 70px 0 30px 0;
        }

        @media (max-width: 767px) {
            .gpm-glance-section .gpm-glance-grid {
                display: grid;
            }
        }

        .logo-section--heading {
            color: #ff7300;
            text-transform: uppercase;
            width: 100%;
            text-align: center;
            position: absolute;
            bottom: 7rem;
        }

        .main_slider .content {
            max-width: 1130px;
            width: 100%;
            position: relative;
            top: 0;
            left: 0;
            padding: 0;
            -webkit-transform: none;
            -moz-transform: none;
            -ms-transform: none;
            -o-transform: none;
            transform: none;
            z-index: 2;
            text-align: center;
            color: #fff;
        }

        .main_slider .content {
            top: auto;
            padding-top: 12rem;
            padding-bottom: 12rem;
            margin: auto;
        }

        .main_slider .slide {
            height: auto;
        }
    </style>

    <div class="main_slider" id="full-width-page-wrapper">
        <div class="slick">
            <div class="slide-container">
                <?php
                if (have_rows('basic_hero')) :
                    $i = 0;
                    while (have_rows('basic_hero')) : the_row();
                ?>
                        <div class="slide slide--1" style="background-image: url(<?php the_sub_field('hero-image');  ?>)">
                            <div class="container">
                                <div class="inner-container">
                                    <div class="content">
                                        <?php
                                        if (get_sub_field('hero_heading')) {
                                            echo '<h1 class="main-title main-title-basic">' . get_sub_field('hero_heading') . '</h1>';
                                        }
                                        if (get_sub_field('hero_text')) {
                                            echo '<p class="info info-basic">' . get_sub_field('hero_text') . '</p>';
                                        }
                                        ?>
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
        </div>

        <?php
        // --------------------------------------------------
        // Logo section
        // --------------------------------------------------
        if (get_field('use_logo_section') == 1) : ?>

            <!-- New logo heading -->
            <div class="logo-section--heading">Trusted by market leaders</div>

            <div class="logo-section" id="logo_section">
                <div class="container">
                    <div class="logo-row" id="logo_slider">
                        <?php
                        if (have_rows('logo_section')) :
                            while (have_rows('logo_section')) : the_row();
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
            </div>
        <?php
        endif;
        // Logo section end 
        ?>
    </div>
<?php
endif;
// Basic Hero section end
?>


<?php
// --------------------------------------------------
// Hero Images section
// --------------------------------------------------
if (get_field('use_hero_images') == 1) : ?>
    <div class="main_slider" id="full-width-page-wrapper">
        <div class="slick">
            <div class="slide-container">
                <?php
                if (have_rows('hero-images')) :
                    $i = 0;
                    while (have_rows('hero-images')) : the_row();
                ?>
                        <div class="slide slide--1" style="background-image: url(<?php the_sub_field('hero-image');  ?>)">
                            <div class="container">
                                <div class="inner-container">
                                    <div class="content">
                                        <?php if (get_sub_field("logo_top")) : ?>
                                            <div class="logo_top">
                                                <img src="<?php the_sub_field('logo_top');  ?>" alt=" <?php the_sub_field('title'); ?>">
                                            </div>
                                        <? endif; ?>
                                        <h1 id="main-title-<?php echo $i + 1; ?>" data-main-title="<?php the_sub_field('title'); ?>" data-word-change="<?php the_sub_field('title_word_to_replace'); ?>" data-new-word="<?php the_sub_field('title_new_word'); ?>" class="title main-title_home">
                                            <?php the_sub_field('title'); ?>
                                        </h1>
                                        <p class="info"><?php the_sub_field('short_content'); ?></p>
                                        <?php if (get_sub_field("cta_label") != 'hidden') : ?>
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
    </div>
<?php
endif;
// Hero Images section end
?>


<?php
// --------------------------------------------------
// Metrics section
// --------------------------------------------------
if (get_field('use_metrics_section') == 1) : ?>
    <div class="metrics-container-wrapper" style="visibility: hidden;">
        <div class="metrics-container">
            <?php
            if (have_rows('metrics')) :
                while (have_rows('metrics')) : the_row();
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
<?php
endif;
// Metrics section end
?>


<?php
// --------------------------------------------------
// Why Performance Section
// --------------------------------------------------
if (get_field('use_why_performance_section') == 1) : ?>
    <div class="why-performance-section" style="visibility: hidden;">
        <div class="container">
            <div class="inner-container">
                <div class="content-grid">
                    <?php
                    if (have_rows('why_perfomance_section')) :
                        while (have_rows('why_perfomance_section')) : the_row();
                    ?>
                            <div class="content-container">
                                <div class="short-content">
                                    <div class="title-container">
                                        <div class="title-wrapper">
                                            <?php the_sub_field('icon_image'); ?>
                                            <h2 class="title">
                                                <span class="white"><?= explode(' ', trim(get_sub_field('title')))[0]; ?></span>
                                                <span>
                                                    <?= substr(strstr(trim(get_sub_field('title')), " "), 1); ?>
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
    </div>
<?php
endif;
// Why Performance section end
?>

<?php
// --------------------------------------------------
// Icon section
// --------------------------------------------------
if (get_field('use_icon_section') == 0) {
    // Do nothing.
} else {
    // Add a class to the wrapper to add padding.
    $why_class = ' why-spacing';
    // TEMP - move below style to SASS
    echo '<style>.why-spacing { margin-bottom: 7rem; padding-bottom: 2rem; }</style>';
}

if (get_field('use_icon_section') == 1) : ?>
    <div class="why-section<?php echo $why_class; ?>" id="why_section">
        <div class="container">
            <div class="inner-container">
                <div class="short-content">
                    <div class="title-container">
                        <div class="title-wrapper">
                            <h2 class="title"><?= the_field('icon_section_title') ?></h2>
                            <?php
                            $logo = get_theme_mod('custom_logo');
                            $logoImage = wp_get_attachment_image_src($logo, 'full');
                            $logo_url = $logoImage[0];
                            ?>
                            <div>
                                <img width="720" height="100" src="<?= $logo_url ?>" alt=""><span><?= the_field('icon_section_title_mark') ?></span>
                            </div>
                        </div>
                    </div>
                    <p class="info"><?php the_field('icon_section_short_content') ?></p>
                </div>
                <div class="content-grid">
                    <div class="content-container">
                        <?php
                        if (have_rows('icon_section')) :
                            while (have_rows('icon_section')) : the_row();
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
    </div>
<?php
endif;
// Icon section end
?>


<?php
// --------------------------------------------------
// Our Approach
// --------------------------------------------------
if (get_field('use_our_approach_global') == 1) :
    get_template_part('global-templates/our-process');
else :
// echo 'false'; 
endif;
?>


<?php
// --------------------------------------------------
// Performance section
// --------------------------------------------------
if (get_field('use_performance_section') == 1) : ?>
    <?php
    if (have_rows('perfomance_section')) :
        while (have_rows('perfomance_section')) : the_row();
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
    <?php wp_reset_query(); // Restore global post data stomped by the_post(). 
    ?>

    <?php
    if (have_rows('performance_sub_section')) :
        while (have_rows('performance_sub_section')) : the_row();
            if (get_sub_field('visible')) :
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
    if (have_rows('perfomance_right_section')) :
        while (have_rows('perfomance_right_section')) : the_row();
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
    <?php wp_reset_query(); // Restore global post data stomped by the_post(). 
    ?>
<?php
endif;
// Performance section end
?>


<?php
// --------------------------------------------------
// Verticals
// --------------------------------------------------
if (get_field('use_verticals_global') == 1) :
    get_template_part('global-templates/verticals-section');
else :
// echo 'false'; 
endif;
?>


<?php
// --------------------------------------------------
// Testimonials
// --------------------------------------------------
if (get_field('use_testimonials_global') == 1) :
    get_template_part('global-templates/testimonial-section');
else :
// echo 'false'; 
endif;
?>


<?php
// --------------------------------------------------
// Product overview cards
// --------------------------------------------------
?>

<style>
    .gpm-glance-card-header {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .gpm-glance-title {
        font-size: 230%;
    }

    .product-overview-card-columns {
        display: flex;
        justify-content: space-between;
        flex-wrap: nowrap;
        flex: 0 1 auto;
        align-items: stretch;
    }

    /* .product-overview-card-column {} */

    .gpm-glance-section .gpm-glance-grid .gpm-glance-card.product-overview--card {
        text-align: left;
        padding: 47px 60px 17px 60px;
    }

    .product-card__list-heading {
        font-weight: 300;
    }

    .product-card__list-heading em {
        color: #ff7300;
        font-style: normal;
    }

    .product-card__list {
        margin-bottom: 2rem;
    }

    /* .gpm-glance-section .gpm-glance-grid .gpm-glance-card.product-overview--card:nth-child(n + 3) {
        padding-bottom: 3rem;
    } */

    /* Grid layout */
    .product-grid {
        display: grid;
        gap: 0;
        grid-template-columns: repeat(1, 1fr);
        background-color: #1b1e28;
        padding: 4rem 0;
        margin-bottom: 3rem;
    }

    @media (min-width: 965.98px) {
        .product-grid {
            grid-template-columns: 1fr 1fr;
            grid-template-rows: 1fr 1fr 1fr 1fr 1fr;
        }
    }

    .fullWidth,
    .product-section-subheading-1,
    .product-section-subheading-2,
    .product-card-row-1,
    .product-card-row-2 {
        /* Allow element to span all columns */
        grid-column: 1 / -1;
    }

    .product-section-h-1 {
        margin-left: 59px;
        position: relative;
    }

    .product-section-h-1::after {
        content: '';
        display: block;
        position: absolute;
        top: -15%;
        right: -13px;
        height: 130%;
        border-right: 1px solid #3e404a;
    }

    @media screen and (max-width: 965.98px) {
        .product-section-h-1::after {
            display: none;
        }
    }

    .product-section-h-2 {
        margin-right: 59px;
    }

    @media screen and (max-width: 965.98px) {

        .product-section-h-1,
        .product-section-h-2 {
            margin-left: auto;
            margin-right: auto;
            display: flex;
            justify-content: center;
            flex-direction: column;
            text-align: center;
        }
    }

    .product-section-subheading-1 h3,
    .product-section-subheading-2 h3 {
        text-align: center;
        border-bottom: 1px solid #3e404a;
        margin: 0 59px;
        padding-top: 1rem;
        padding-bottom: 1rem;
        font-weight: 300;
    }

    /* Product row */
    .product-card-row-1,
    .product-card-row-2 {
        display: grid;
        grid-template-columns: 1fr 1fr;
        grid-template-rows: 1fr;
    }

    @media screen and (max-width: 965.98px) {

        .product-card-row-1,
        .product-card-row-2 {
            grid-template-columns: 1fr;

            /* Arrange grid on small screens */
            /* grid-template-areas:
                "row-1"
                "row-2"
                "row-3"
                "row-4"; */
        }

        .product-section-h-1 {
            /* grid-area: row-1; */
        }

    }

    .product-card-row-1,
    .product-card-row-2 {
        transform: translateY(-22px);
    }

    .gpm-glance-section .gpm-glance-grid .gpm-glance-card.product-col {
        text-align: left;
    }

    .gpm-glance-section .gpm-glance-grid .gpm-glance-card.product-col {
        padding-bottom: 2rem;
    }

    .product-col:nth-of-type(even) {
        border-left: 1px solid #3e404a;
    }

    .product-card-list {
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .gpm-glance-card .btn.product-card__list-btn {
        margin-top: auto;
        width: fit-content;
        align-self: center;
    }
</style>

<!-- New Product card section -->

<?php if (have_rows('product_card_section')) : ?>
    <div class="gpm-glance-section" id="gpm-glance-section">
        <div class="container">
            <div class="inner-container">
                <div class="gpm-glance-grid product-grid">

                    <?php while (have_rows('product_card_section')) : the_row(); ?>

                        <!-- Heading 1 -->
                        <div class="gpm-glance-card-header product-section-h-1">
                            <div class="gpm-glance-icon"><?php the_sub_field('first_heading_icon'); ?></div>
                            <h2 class="gpm-glance-title"><?php the_sub_field('first_column_heading'); ?></h2>
                        </div>

                        <!-- Heading 2 -->
                        <div class="gpm-glance-card-header product-section-h-2">
                            <div class="gpm-glance-icon"><?php the_sub_field('second_heading_icon'); ?></div>
                            <h2 class="gpm-glance-title"><?php the_sub_field('second_column_heading'); ?></h2>
                        </div>

                        <!-- Subheading 1 -->
                        <div class="product-section-subheading-1">
                            <h3><?php the_sub_field('first_subheading'); ?></h3>
                        </div>

                        <?php if (have_rows('first_card_row')) : ?>
                            <div class="product-overview--card product-card-row-1">

                                <?php while (have_rows('first_card_row')) : the_row(); ?>
                                    <?php if (have_rows('card')) : ?>
                                        <?php while (have_rows('card')) : the_row(); ?>
                                            <div class="gpm-glance-card product-col">
                                                <div class="gpm-glance-list product-card-list">

                                                    <!-- Product title -->
                                                    <h3 class="product-card__list-heading"><?php the_sub_field('product_title'); ?></h3>
                                                    <!-- Bullet list -->
                                                    <?php if (have_rows('bullet_points')) : ?>
                                                        <ul class="product-card__list">
                                                            <?php while (have_rows('bullet_points')) : the_row(); ?>
                                                                <li class="product-card__list-item"><?php the_sub_field('list_item'); ?></li>
                                                            <?php endwhile; ?>
                                                        </ul>
                                                    <?php endif; ?>

                                                    <!-- Second product -->
                                                    <?php if (get_sub_field('add_second_product') == 1) : ?>
                                                        <!-- Product title -->
                                                        <h3 class="product-card__list-heading"><?php the_sub_field('second_product_title'); ?></h3>
                                                        <!-- Bullet list -->
                                                        <?php if (have_rows('second_product_bullet_points')) : ?>
                                                            <ul class="product-card__list">
                                                                <?php while (have_rows('second_product_bullet_points')) : the_row(); ?>
                                                                    <li class="product-card__list-item"><?php the_sub_field('list_item'); ?></li>
                                                                <?php endwhile; ?>
                                                            </ul>
                                                        <?php endif; ?>
                                                    <?php endif; ?>

                                                    <!-- Button -->
                                                    <?php if (have_rows('button')) : ?>
                                                        <?php while (have_rows('button')) : the_row(); ?>
                                                            <?php $button_link_2 = get_sub_field('button_link_2'); ?>
                                                            <?php if ($button_link_2) : ?>
                                                                <a class="btn btn-primary product-card__list-btn" href="<?php echo esc_url($button_link_2['url']); ?>"><?php the_sub_field('button_text'); ?></a>
                                                            <?php endif; ?>
                                                        <?php endwhile; ?>
                                                    <?php endif; ?>

                                                </div>
                                            </div>
                                        <?php endwhile; ?>
                                    <?php endif; ?>
                                <?php endwhile; ?>

                            </div>
                        <?php endif; ?>

                        <!-- Subheading 2 -->
                        <div class="product-section-subheading-1">
                            <h3><?php the_sub_field('second_subheading'); ?></h3>
                        </div>

                        <?php if (have_rows('second_card_row')) : ?>
                            <div class="product-overview--card product-card-row-2">

                                <?php while (have_rows('second_card_row')) : the_row(); ?>
                                    <?php if (have_rows('card')) : ?>
                                        <?php while (have_rows('card')) : the_row(); ?>
                                            <div class="gpm-glance-card product-col">
                                                <div class="gpm-glance-list product-card-list">

                                                    <!-- Product title -->
                                                    <h3 class="product-card__list-heading"><?php the_sub_field('product_title'); ?></h3>
                                                    <!-- Bullet list -->
                                                    <?php if (have_rows('bullet_points')) : ?>
                                                        <ul class="product-card__list">
                                                            <?php while (have_rows('bullet_points')) : the_row(); ?>
                                                                <li class="product-card__list-item"><?php the_sub_field('list_item'); ?></li>
                                                            <?php endwhile; ?>
                                                        </ul>
                                                    <?php endif; ?>

                                                    <!-- Button -->
                                                    <?php if (have_rows('button')) : ?>
                                                        <?php while (have_rows('button')) : the_row(); ?>
                                                            <?php $button_link = get_sub_field('button_link'); ?>
                                                            <?php if ($button_link) : ?>
                                                                <a class="btn btn-primary product-card__list-btn" href="<?php echo esc_url($button_link['url']); ?>"><?php the_sub_field('button_text'); ?></a>
                                                            <?php endif; ?>
                                                        <?php endwhile; ?>
                                                    <?php endif; ?>

                                                </div>
                                            </div>

                                        <?php endwhile; ?>
                                    <?php endif; ?>
                                <?php endwhile; ?>
                            </div>
                </div>

            <?php endif; ?>
        <?php endwhile; ?>

            </div>
        </div>
    </div>
<?php endif; ?>


<?php
// --------------------------------------------------
// Get Started
// --------------------------------------------------
if (get_field('use_get-started_global') == 1) :
    get_template_part('global-templates/getStarted-section');
else :
    // echo 'false'; 
    // TEMP – decrease distance to footer caused by removal of section 
    echo '<style>.blog-section { padding-bottom: 4rem; }</style>';
endif;
?>


<?php
get_footer();
