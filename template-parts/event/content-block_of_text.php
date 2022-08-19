<?php
/**
 * Template part for displaying Block of content with image
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package UnderStrap
 */

$block_of_text=$args;

$title = $block_of_text["title"];
$description = $block_of_text["description"];

?>

<section class="block_of_text">
  <div class="container">
    <div class="row align-items-center">
    <div class="col-md-6">
      <div class="block_of_text--title">
        <?php if($title):?>
          <h2  class="builder-subtitle-2"><?php echo $title;?></h2>
        <?php endif;?>

      </div>
    </div>
    <div class="col-md-6">
      <div class="block_of_text--text">
      <?php if($description):?>
          <div class="builder-text">
            <?php echo $description;?>
          </div>
        <?php endif;?>
      </div>
    </div>
    </div>
  </div>
</section>