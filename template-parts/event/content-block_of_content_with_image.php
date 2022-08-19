<?php
/**
 * Template part for displaying Block of content with image
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package UnderStrap
 */

$block_of_content_with_image=$args;

$image_position = $block_of_content_with_image["image_position"];
$image = $block_of_content_with_image["image"];
$title = $block_of_content_with_image["title"];
$subtitle = $block_of_content_with_image["subtitle"];
$description = $block_of_content_with_image["description"];
$buttons = $block_of_content_with_image["buttons"];
$video = $block_of_content_with_image["video"];

?>

<section class="block_of_content_with_image">
  <div class="container">
    <div class="row align-items-center <?php echo ($image_position == "Right") ? "image-position-right":"image-position-left";?>">
    <div class="col-md-5 block_of_content_with_image__text">
      <div class="block_of_content_with_image__text--inner">
        <?php if($title):?>
          <h2  class="builder-title"><?php echo $title;?></h2>
        <?php endif;?>
        <?php if($subtitle):?>
          <h3  class="builder-subtitle"><?php echo $subtitle;?></h3>
        <?php endif;?>
        <?php if($description):?>
          <div class="builder-text">
            <?php echo $description;?>
          </div>
        <?php endif;?>
        <?php if( $buttons ):?>
        <div class="builder-buttons">
          <?php foreach ($buttons as $item) :?>
            <?php if($item["type"] == "Button"):?>
              <a href="<?php echo $item["link"]["url"];?>"  target="<?php echo $item["link"]["target"];?>" class="btn btn-primary"><?php echo $item["label"];?></a>
            <?php elseif($item["type"] == "Modal video" && ($video["video_file"] || $video["video_url"])):?>
              <a href="#builder-modal-video" <?php echo ($video["type"] == "Self Host") ? 'data-url="'.$video["video_file"].'"': 'data-url="'.$video["video_url"].'"'  ;?>  data-type="<?php echo $video["type"];?>"  data-toggle="modal" data-target="#builder-modal-video" class="btn btn-primary"><?php echo $item["label"];?></a>
            <?php elseif($item["type"] == "Modal video with paywall" && ($video["video_file"] || $video["video_url"])):?>
              <a href="#builder-modal-event-video" <?php echo ($video["type"] == "Self Host") ? 'data-url="'.$video["video_file"].'"': 'data-url="'.$video["video_url"].'"'  ;?>  data-type="<?php echo $video["type"];?>"  data-toggle="modal" data-target="#builder-modal-event-video" data-paywall-button-type="content-with-image" class="paywall-event-button btn btn-primary"><?php echo $item["label"];?></a>
            <?php elseif($item["type"] == "Text"):?>
              <a href="<?php echo $item["link"]["url"];?>"  target="<?php echo $item["link"]["target"];?>" class=""><?php echo $item["label"];?></a>
            <?php endif;?>
          <?php endforeach;?>
        </div>
        <?php endif;?>
      </div>
    </div>
    <div class="col-md-7 block_of_content_with_image__image">
      <div class="block_of_content_with_image__image--inner">
        <?php if($image):?>
          <img src="<?php echo $image;?>" alt="<?php echo $subtitle;?>">
        <?php endif;?>
      </div>
    </div>
    </div>
  </div>
</section>