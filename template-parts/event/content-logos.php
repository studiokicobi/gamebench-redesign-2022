<?php
/**
 * Template part for displaying Block of content with image
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package UnderStrap
 */

$logos=$args;

$items = $logos["items"];
$slider = $logos["slider"];
?>

<section class="builder-logos">
  <?php if( $items ):?>
    <div class="builder-logos-container <?php echo ($slider == "Activated") ? "logo_slider":"";?>">
      <?php foreach ($items as $item) :?>
		
        <a href="<?php echo $item["link"];?>" style="<?php echo ($item["link"])?"":"cursor: default;";?>">
          <img src="<?php echo $item["image"];?>" alt="<?php echo $item["label"];?>">
        </a>
		
        <?php endforeach;?>
    </div>
  <?php endif;?>

</section>