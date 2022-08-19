<?php

/**
 * Block template file: blocks/product-service-intro.php
 *
 * Intro Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'intro-' . $block['id'];
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-intro';
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

    .top-section_products .content-column p {
        font-size: 20px;
    }
</style>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($classes); ?>">
    <div id="top-products_section" class="top-section_products">
        <div class="container">
            <div class="inner-container">
                <div class="content-column">
                    <h2 class="title"><?php the_field('products_heading'); ?></h2>
                    <?php the_field('products_introduction'); ?>
                </div>

                <?php
                if (get_field('video_poster_image')) :
                    $poster = get_field('video_poster_image');
                endif;

                if (get_field('video')) :
                    $video = get_field('video');
                endif;
                ?>

                <div class="video-column" data-background="<?php echo $poster; ?>" style="background-image: url('<?php echo $poster; ?>');">
                    <div class="video-container hideVideo" id="video-controls"><video controls="true" class="video video_products" id="video_products" preload="metadata" poster="<?php echo $poster; ?>" width="100%" height="100%">
                            <source src="<?php echo $video; ?>" type="video/mp4">
                        </video></div>
                    <!----<div class="buttons-container">
                        <div class="playpause"> <input type="checkbox" value="None" id="playpause" name="check" data-np-invisible="1" data-np-checked="1"> <label for="playpause" tabindex="1"></label></div> <span class="play-copy">Play Video</span>
                        <div class="video_overlay" id="play-pause"></div>
                    </div>--->
                </div>

            </div>
        </div>
    </div>
</div>