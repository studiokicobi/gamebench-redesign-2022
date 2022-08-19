<?php

/**
 * Block template file: block/product-service.php
 *
 * Product Service Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'product-service-' . $block['id'];
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-product-service';
if (!empty($block['className'])) {
    $classes .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $classes .= ' align' . $block['align'];
}
?>

<style type="text/css">
    <?php echo '#' . $id; ?> {
        /* Add styles that use ACF values here */
    }

    .visually-hidden {
        clip: rect(0 0 0 0);
        clip-path: inset(50%);
        height: 1px;
        overflow: hidden;
        position: absolute;
        white-space: nowrap;
        width: 1px;
    }

    /* The wrapper controls the logo's max-width */
    .product-logo {
        max-width: 45rem;
        margin-bottom: 1rem;
    }

    /* This controls the logo's max-height */
    .product-logo img {
        max-height: 8rem;
        width: auto;
    }

    .product-card__intro {}

    .product-card__intro-info {}

    .product-card__intro-info p {
        font-size: 140%;
        max-width: 35rem;
    }

    .product-card__intro-image img {
        width: 100%;
        height: auto;
    }

    .product-card__list-heading {
        font-size: 1rem;
        font-weight: 700;
        text-align: left;
        margin-bottom: 1rem;
    }

    .product-card__list {
        margin-bottom: 2rem;
    }

    .product-card__list-item {
        max-width: 35rem;
    }

    .download-text {
        text-align: left;
    }

    .download-image {
        max-width: 16rem;
    }

    .download-text p {
        max-width: 35rem;
    }

    .download-button {
        margin: 2rem 0;
    }

    .download-button a {
        /* Styles pulled from original dev's work. Merge these. */
        height: 50px;
        line-height: calc(50px - (0.375rem * 2));
        min-width: 160px;
        border-radius: 0 !important;
    }

    .gpm-glance-section {
        padding: 70px 0 50px 0;
    }

    @media (max-width: 767px) {
        .gpm-glance-section .gpm-glance-grid.product-grid {
            display: block;
        }

        .gpm-glance-section .gpm-glance-grid .gpm-glance-card {
            margin-bottom: 1rem;
        }
    }
</style>


<div class="gpm-glance-section" id="gpm-glance-section">
    <div class="container">
        <div class="inner-container">
            <div class="section-header">
                <div class="product-card__intro gpm-glance-grid">
                    <div class="info product-card__intro-info">

                        <!-- Product/Service logo-->
                        <?php $productservice_logo = get_field('productservice_logo'); ?>
                        <?php $size = 'full'; ?>
                        <?php if ($productservice_logo) : ?>
                            <div class="product-logo">
                                <?php echo wp_get_attachment_image($productservice_logo, $size); ?>
                            </div>
                        <?php endif; ?>
                        <!-- Product/Service name-->
                        <h2 class="title visually-hidden"><?php the_field('productservice_name'); ?></h2>

                        <!-- Product/Service intro text-->
                        <?php the_field('introduction_text'); ?>
                    </div>
                    <div class="product-card__intro-image">
                        <!-- Product/Service image-->
                        <?php if (get_field('introduction_image')) : ?>
                            <img src="<?php the_field('introduction_image'); ?>" />
                        <?php endif ?>
                    </div>
                </div>
            </div>

            <div class="gpm-glance-grid product-grid">
                <!-- Glance card: Snapshot -->
                <div class="gpm-glance-card">
                    <div class="gpm-glance-card-header">
                        <div class="gpm-glance-icon">
                            <!-- Snapshot SVG -->
                            <svg width="55" height="61" viewBox="0 0 55 61" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g>
                                    <path d="M6.63867 13.2759L9.4835 16.1207" stroke="#FF7300" stroke-width="1.5" stroke-miterlimit="10" />
                                    <path d="M27.4999 59.7413C41.6403 59.7413 53.1034 48.2783 53.1034 34.1379C53.1034 19.9975 41.6403 8.53442 27.4999 8.53442C13.3595 8.53442 1.89648 19.9975 1.89648 34.1379C1.89648 48.2783 13.3595 59.7413 27.4999 59.7413Z" stroke="#A8ABB2" stroke-width="1.5" stroke-miterlimit="10" />
                                    <path d="M27.5001 8.53445C29.595 8.53445 31.2932 6.83622 31.2932 4.74135C31.2932 2.64647 29.595 0.948242 27.5001 0.948242C25.4053 0.948242 23.707 2.64647 23.707 4.74135C23.707 6.83622 25.4053 8.53445 27.5001 8.53445Z" stroke="#A8ABB2" stroke-width="1.5" stroke-miterlimit="10" />
                                    <path d="M27.4998 21.8103C34.3084 21.8103 39.8274 27.3293 39.8274 34.1379C39.8274 40.9465 34.3084 46.4655 27.4998 46.4655C24.0955 46.4655 21.0136 45.081 18.7852 42.8525" stroke="#FF7300" stroke-width="1.5" stroke-miterlimit="10" />
                                    <path d="M27.5 11.3794V13.2759" stroke="#A8ABB2" stroke-width="1.5" stroke-miterlimit="10" />
                                    <path d="M25.6039 36.0344L14.2246 47.4137" stroke="#A8ABB2" stroke-width="1.5" stroke-miterlimit="10" />
                                    <path d="M4.74121 34.1379H6.63776" stroke="#A8ABB2" stroke-width="1.5" stroke-miterlimit="10" />
                                    <path d="M50.2589 34.1379H48.3623" stroke="#A8ABB2" stroke-width="1.5" stroke-miterlimit="10" />
                                    <path d="M27.5 56.8966V55" stroke="#A8ABB2" stroke-width="1.5" stroke-miterlimit="10" />
                                    <path d="M27.5001 36.9827C29.0713 36.9827 30.3449 35.7091 30.3449 34.1379C30.3449 32.5668 29.0713 31.2931 27.5001 31.2931C25.9289 31.2931 24.6553 32.5668 24.6553 34.1379C24.6553 35.7091 25.9289 36.9827 27.5001 36.9827Z" stroke="#A8ABB2" stroke-width="1.5" stroke-miterlimit="10" />
                                    <path d="M6.64394 7.58214L0.951172 13.2749L3.7942 16.1179L9.48697 10.4252L6.64394 7.58214Z" stroke="#FF7300" stroke-width="1.5" stroke-miterlimit="10" stroke-linejoin="round" />
                                    <path d="M48.3624 13.2759L45.5176 16.1207" stroke="#A8ABB2" stroke-width="1.5" stroke-miterlimit="10" />
                                    <path d="M48.3626 7.5891L45.5195 10.4321L51.2123 16.1249L54.0553 13.2819L48.3626 7.5891Z" stroke="#A8ABB2" stroke-width="1.5" stroke-miterlimit="10" stroke-linejoin="round" />
                                    <path d="M27.5 16.1206C37.4474 16.1206 45.5172 24.1904 45.5172 34.1378C45.5172 44.0853 37.4474 52.1551 27.5 52.1551C22.5215 52.1551 18.0267 50.1447 14.7646 46.8827" stroke="#A8ABB2" stroke-width="1.5" stroke-miterlimit="10" />
                                    <path d="M8.53516 34.1379H10.4317" stroke="#A8ABB2" stroke-width="1.5" stroke-miterlimit="10" />
                                    <path d="M12.3281 34.1379H14.2247" stroke="#A8ABB2" stroke-width="1.5" stroke-miterlimit="10" />
                                    <path d="M16.1211 34.1379H18.0176" stroke="#A8ABB2" stroke-width="1.5" stroke-miterlimit="10" />
                                    <path d="M19.9141 34.1379H21.8106" stroke="#A8ABB2" stroke-width="1.5" stroke-miterlimit="10" />
                                    <path d="M27.5 8.53456V4.74146" stroke="#A8ABB2" stroke-width="1.5" stroke-miterlimit="10" />
                                </g>
                                <defs>
                                    <clipPath id="clip0">
                                        <rect width="55" height="60.6897" fill="white" />
                                    </clipPath>
                                </defs>
                            </svg>
                        </div>
                        <?php if (have_rows('snapshot_card')) : ?>
                            <?php while (have_rows('snapshot_card')) : the_row(); ?>
                                <h2 class="gpm-glance-title"><?php the_sub_field('heading'); ?></h2>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </div>

                    <div class="gpm-glance-list">
                        <?php if (have_rows('snapshot_card')) : ?>
                            <?php while (have_rows('snapshot_card')) : the_row(); ?>
                                <?php if (have_rows('snapshot_list')) : ?>
                                    <?php while (have_rows('snapshot_list')) : the_row(); ?>
                                        <?php if (get_sub_field('optional_heading')) {
                                            // The heading and list
                                            echo '<h3 class="product-card__list-heading">' . get_sub_field('optional_heading') . '</h3>';
                                        } ?>

                                        <?php if (have_rows('list_items')) : ?>
                                            <ul class="product-card__list">
                                                <?php while (have_rows('list_items')) : the_row(); ?>
                                                    <li class="product-card__list-item"><?php the_sub_field('list_item'); ?></li>
                                                <?php endwhile; ?>
                                            </ul>
                                        <?php else : ?>
                                            <?php // No rows found 
                                            ?>
                                        <?php endif; ?>
                                    <?php endwhile; ?>
                                <?php else : ?>
                                    <?php // No rows found 
                                    ?>
                                <?php endif; ?>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </div>
                </div><!-- /Snapshot card-->


                <!-- Glance card: Download -->
                <div class="gpm-glance-card">
                    <?php if (get_field('card_choice') == 1) :
                        // Download card is selected 
                    ?>
                        <div class="gpm-glance-card-header">
                            <div class="gpm-glance-icon">
                                <!-- Download SVG icon -->
                                <svg width="60" height="53" viewBox="0 0 60 53" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g>
                                        <path d="M55.3125 51.5625H4.6875L0.9375 47.8125V45.9375H23.4375L25.3125 47.8125H34.6875L36.5625 45.9375H59.0625V47.8125L55.3125 51.5625Z" stroke="#A8ABB2" stroke-width="1.5" stroke-miterlimit="10" stroke-linejoin="round" />
                                        <path d="M14.0625 12.1875H7.5C5.94375 12.1875 4.6875 13.4438 4.6875 15V43.125" stroke="#A8ABB2" stroke-width="1.5" stroke-miterlimit="10" stroke-linejoin="round" />
                                        <path d="M55.3125 43.125V15C55.3125 13.4438 54.0562 12.1875 52.5 12.1875H45.9375" stroke="#A8ABB2" stroke-width="1.5" stroke-miterlimit="10" stroke-linejoin="round" />
                                        <path d="M25.3125 40.3125H27.1875" stroke="#FF7300" stroke-width="1.5" stroke-miterlimit="10" stroke-linejoin="round" />
                                        <path d="M21.5625 40.3125H23.4375" stroke="#FF7300" stroke-width="1.5" stroke-miterlimit="10" stroke-linejoin="round" />
                                        <path d="M29.0625 40.3125H30.9375" stroke="#FF7300" stroke-width="1.5" stroke-miterlimit="10" stroke-linejoin="round" />
                                        <path d="M32.8125 40.3125H34.6875" stroke="#FF7300" stroke-width="1.5" stroke-miterlimit="10" stroke-linejoin="round" />
                                        <path d="M36.5625 40.3125H38.4375" stroke="#FF7300" stroke-width="1.5" stroke-miterlimit="10" stroke-linejoin="round" />
                                        <path d="M45.9375 15.9375H51.5625V40.3125H40.3125" stroke="#A8ABB2" stroke-width="1.5" stroke-miterlimit="10" stroke-linejoin="round" />
                                        <path d="M19.6875 40.3125H8.4375V15.9375H14.0625" stroke="#A8ABB2" stroke-width="1.5" stroke-miterlimit="10" stroke-linejoin="round" />
                                        <path d="M43.125 27.1875L30 36.5625L16.875 27.1875V0.9375L24.375 3.75L27.1875 0.9375H32.8125L35.625 3.75L43.125 0.9375V27.1875Z" stroke="#A8ABB2" stroke-width="1.5" stroke-miterlimit="10" stroke-linejoin="round" />
                                        <path d="M24.375 3.75V7.5" stroke="#A8ABB2" stroke-width="1.5" stroke-miterlimit="10" stroke-linejoin="round" />
                                        <path d="M35.625 3.75V7.5" stroke="#A8ABB2" stroke-width="1.5" stroke-miterlimit="10" stroke-linejoin="round" />
                                        <path d="M33.75 15.9375L29.0625 20.625L26.25 17.8125" stroke="#FF7300" stroke-width="1.5" stroke-miterlimit="10" stroke-linejoin="round" />
                                        <path d="M30 25.3125C34.1421 25.3125 37.5 21.9546 37.5 17.8125C37.5 13.6704 34.1421 10.3125 30 10.3125C25.8579 10.3125 22.5 13.6704 22.5 17.8125C22.5 21.9546 25.8579 25.3125 30 25.3125Z" stroke="#FF7300" stroke-width="1.5" stroke-miterlimit="10" stroke-linejoin="round" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0">
                                            <rect width="60" height="52.5" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
                            </div>
                            <h2 class="gpm-glance-title">Download the Fact Sheet</h2>
                        </div>

                        <?php if (get_field('download_text')) : ?>
                            <div class="download-text">
                                <?php the_field('download_text'); ?>
                            </div>
                        <?php endif; ?>

                        <?php if (get_field('downloadable_file')) : ?>
                            <div class="builder-buttons download-button">
                                <a href="<?php the_field('downloadable_file'); ?>" class="btn btn-primary">Download Now</a>
                            </div>
                        <?php endif; ?>

                        <?php $download_image = get_field('download_image'); ?>
                        <?php $size = 'full'; ?>
                        <?php if ($download_image) : ?>
                            <div class="download-image">
                                <?php echo wp_get_attachment_image($download_image, $size); ?>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>


                    <?php if (get_field('card_choice') == 0) :
                        // List card is selected 
                    ?>
                        <?php if (have_rows('snapshot_card_2')) : ?>
                            <div class="gpm-glance-list">
                                <?php while (have_rows('snapshot_card_2')) : the_row(); ?>
                                    <?php if (have_rows('snapshot_list')) : ?>
                                        <?php while (have_rows('snapshot_list')) : the_row(); ?>
                                            <?php if (get_sub_field('optional_heading')) {
                                                // The heading and list
                                                echo '<h3 class="product-card__list-heading">' . get_sub_field('optional_heading') . '</h3>';
                                            } ?>

                                            <?php if (have_rows('list_items')) : ?>
                                                <ul class="product-card__list">
                                                    <?php while (have_rows('list_items')) : the_row(); ?>
                                                        <li class="product-card__list-item"><?php the_sub_field('list_item'); ?></li>
                                                    <?php endwhile; ?>
                                                </ul>
                                            <?php endif; ?>
                                        <?php endwhile; ?>
                                    <?php endif; ?>
                                <?php endwhile; ?>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>

                </div><!-- /Download card-->

            </div>
        </div>
    </div>
</div>