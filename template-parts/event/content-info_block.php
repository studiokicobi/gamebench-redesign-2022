<?php
/**
 * Template part for displaying Block of content with image
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package UnderStrap
 */

$info_block=$args;

$title = $info_block["title"];
$description = $info_block["description"];
$button = $info_block["button"];
$background = $info_block["background"];
$video = $info_block["video"];
?>

<section class="builder-info_block" style="background-image:url(<?php echo $background;?>);">

  <div class="container">
    <div class="builder-info_block--content text-center" >
        <?php if($title):?>
          <h2  class="builder-subtitle-2 text-center"><?php echo $title;?></h2>
        <?php endif;?>
        <?php if($description):?>
          <div class="builder-text mb-4 text-center">
            <?php echo $description;?>
          </div>
        <?php endif;?>
        <?php if($button):?>
          <?php if($button["type"] == "Link"):?>
            <a href="<?php echo $button["link"]["url"];?>"  target="<?php echo $button["link"]["target"];?>" class="btn btn-primary"><?php echo $button["label"];?></a>
          <?php elseif($button["type"] == "Modal Video" && ($video["video_file"] || $video["video_url"])):?>
            <a href="#builder-modal-video" <?php echo ($video["type"] == "Self Host") ? 'data-url="'.$video["video_file"].'"': 'data-url="'.$video["video_url"].'"'  ;?>  data-type="<?php echo $video["type"];?>"  data-toggle="modal" data-target="#builder-modal-video" class="btn btn-primary"><?php echo $button["label"];?></a>
          <?php elseif($button["type"] == "Modal video with paywall" && ($video["video_file"] || $video["video_url"])):?>
            <a href="#builder-modal-event-video" <?php echo ($video["type"] == "Self Host") ? 'data-url="'.$video["video_file"].'"': 'data-url="'.$video["video_url"].'"'  ;?>  data-type="<?php echo $video["type"];?>"  data-toggle="modal" data-target="#builder-modal-event-video" data-paywall-button-type="info-block" class="paywall-event-button btn btn-primary"><?php echo $button["label"];?></a>
          <?php endif;?>
        <?php endif;?>
      </div>
  </div>
</section>