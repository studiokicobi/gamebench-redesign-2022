<?php

/**
 * Template Name: Template: Home v4
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

    /* Grid layout */
    .product-1-heading {
        grid-area: product-1-heading;
    }

    .product-2-heading {
        grid-area: product-2-heading;
    }

    .product-group-1-subheading {
        grid-area: product-group-1-subheading;
    }

    .product-1-group-1 {
        grid-area: product-1-group-1;
    }

    .product-2-group-1 {
        grid-area: product-2-group-1;
    }

    .product-1-group-2 {
        grid-area: product-1-group-2;
    }

    .product-2-group-2 {
        grid-area: product-2-group-2;
    }

    .product-group-2-subheading {
        grid-area: product-group-2-subheading;
    }

    .product-group-1-subheading-mobile {
        grid-area: product-group-1-subheading-mobile;
    }

    .product-group-2-subheading-mobile {
        grid-area: product-group-2-subheading-mobile;
    }

    .product_1 {
        grid-area: product_1;
    }

    .product_2 {
        grid-area: product_2;
    }

    .product_3 {
        grid-area: product_3;
    }

    .product_4 {
        grid-area: product_4;
    }

    /* .gpm-glance-section .gpm-glance-grid.product-grid { */
    body.home .product-grid {
        background-color: #1b1e28;
        padding: 4rem 0;
        margin-bottom: 3rem;
        display: grid;
        grid-template-columns: 1fr 1fr;
        grid-template-areas:
            "product-1-heading product-2-heading"
            "product-group-1-subheading product-group-1-subheading"
            "product-1-group-1 product-1-group-2"
            "product-group-2-subheading product-group-2-subheading"
            "product-2-group-1 product-2-group-2";
        grid-auto-rows: min-content;
        gap: 2rem;
    }

    /* Mobile grid layout */
    @media (max-width: 965.98px) {
        .gpm-glance-section .gpm-glance-grid.product-grid {
            display: grid;
            grid-template-columns: 1fr;
            grid-template-areas:
                "product-1-heading"
                "product-group-1-subheading"
                "product-1-group-1"
                "product-group-2-subheading"
                "product-2-group-1"
                "product-2-heading"
                "product-group-1-subheading-mobile"
                "product-1-group-2"
                "product-group-2-subheading-mobile"
                "product-2-group-2";
        }

        .product-2-heading {
            grid-area: product-2-heading;
            background-clip: padding-box;
            position: relative;
        }

        .product-2-heading .gpm-glance-icon {
            padding-top: 7rem;
        }

        .product-2-heading::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            z-index: 100;
            margin: 0 0 2rem 0;
            background: linear-gradient(281.86deg, rgba(47, 49, 60, 0.6) 9.65%, #2f313c 97.52%);
            height: 3rem;
            width: 100%;
            opacity: 97%;
            /* Blend with background as this isn't full-width like the bg gradient */
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

    @media screen and (min-width: 966px) {
        .product-2-heading {
            border-left: 1px solid #3e404a;
        }
    }

    @media screen and (max-width: 965.98px) {
        .product-section-h-1::after {
            display: none;
        }
    }

    .product-section-h-2 {
        margin-right: 59px;
    }

    .product-section-heading {
        margin-left: auto;
        margin-right: auto;
        display: flex;
        justify-content: center;
        flex-direction: column;
        text-align: center;
        padding: 0 6rem;
        width: 100%;
    }

    @media screen and (max-width: 965.98px) {
        .product-section-heading {
            padding: 0 2rem;
        }

        .product-section-subheading h3 {
            border-top: 1px solid #3e404a;
        }
    }

    .product-section-subheading h3 {
        text-align: center;
        border-bottom: 1px solid #3e404a;
        margin: 0 59px;
        padding-top: 1rem;
        padding-bottom: 1rem;
        font-weight: 300;
    }

    @media (max-width: 768px) {
        .product-section-subheading h3 {
            margin: 0 24px;
        }
    }

    .product-section-subheading-mobile {
        display: none;
    }

    @media screen and (max-width: 965.98px) {
        .product-section-subheading-mobile {
            display: block;
        }
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
<div class="gpm-glance-section" id="gpm-glance-section">
    <div class="container">
        <div class="inner-container">
            <div class="gpm-glance-grid product-grid">

                <!-- Heading 1 -->
                <div class="gpm-glance-card-header product-section-heading product-1-heading">
                    <div class="gpm-glance-icon"><?php the_field('network_products_heading_image'); ?></div>
                    <h2 class="gpm-glance-title"><?php the_field('networks_products_heading'); ?></h2>
                </div>

                <!-- Heading 2 -->
                <div class="gpm-glance-card-header product-section-heading product-2-heading">
                    <div class="gpm-glance-icon"><?php the_field('publisher_products_heading_image'); ?></div>
                    <h2 class="gpm-glance-title"><?php the_field('publishers_products_heading'); ?></h2>
                </div>

                <!-- Subheading 1 -->
                <div class="product-section-subheading product-group-1-subheading">
                    <h3><?php the_field('product_group_1_subheading'); ?></h3>
                </div>

                <!-- Subheading 2 -->
                <div class="product-section-subheading product-group-2-subheading">
                    <h3><?php the_field('product_group_2_subheading'); ?></h3>
                </div>

                <!-- Subheading 1-mobile -->
                <div class="product-section-subheading product-section-subheading-mobile product-group-1-subheading-mobile">
                    <h3><?php the_field('product_group_1_subheading'); ?></h3>
                </div>

                <!-- Subheading 2-mobile -->
                <div class="product-section-subheading product-section-subheading-mobile product-group-2-subheading-mobile">
                    <h3><?php the_field('product_group_2_subheading'); ?></h3>
                </div>

                <!-- Cards -->
                <?php if (have_rows('product_card')) : ?>
                    <?php while (have_rows('product_card')) : the_row(); ?>

                        <div class="gpm-glance-card product-col <?php the_sub_field('product_type'); ?>">
                            <div class="gpm-glance-list product-card-list">

                                <!-- Product title -->
                                <h3 class="product-card__list-heading"><?php the_sub_field('product_title'); ?></h3>

                                <!-- Bullet list -->
                                <?php if (have_rows('product_description')) : ?>
                                    <ul class="product-card__list">
                                        <?php while (have_rows('product_description')) : the_row(); ?>
                                            <li class="product-card__list-item"><?php the_sub_field('bullet_point'); ?></li>
                                        <?php endwhile; ?>
                                    </ul>
                                <?php endif; ?>

                                <!-- Second product -->
                                <?php if (get_sub_field('add_second_product') == 1) : ?>
                                    <!-- Product title -->
                                    <h3 class="product-card__list-heading"><?php the_sub_field('second_product_title'); ?></h3>
                                    <!-- Bullet list -->
                                    <?php if (have_rows('second_product_description')) : ?>
                                        <ul class="product-card__list">
                                            <?php while (have_rows('second_product_description')) : the_row(); ?>
                                                <li class="product-card__list-item"><?php the_sub_field('bullet_point'); ?></li>
                                            <?php endwhile; ?>
                                        </ul>
                                    <?php endif; ?>
                                <?php endif; ?>

                                <!-- Button -->
                                <?php $product_card_button_link = get_sub_field('product_card_button_link'); ?>
                                <?php if ($product_card_button_link) : ?>
                                    <a class="btn btn-primary product-card__list-btn" href="<?php echo esc_url($product_card_button_link['url']); ?>"><?php the_sub_field('product_card_button_text'); ?></a>
                                <?php endif; ?>

                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>

            </div>
        </div>
    </div>
</div>


<?php
get_footer();
