<?php
/**
 * Template part for displaying Block of content with image
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package UnderStrap
 */

$block_of_text_with_list=$args;

$title = $block_of_text_with_list["title"];
$description = $block_of_text_with_list["description"];
$button = $block_of_text_with_list["button"];
$list = $block_of_text_with_list["list"];
$video = $block_of_text_with_list["video"];
?>

<section class="block_of_text_with_list">
  <div class="container">
    <div class="row align-items-center">
    <div class="col-md-6">
      <div class="block_of_text_with_list--content">
        <?php if($title):?>
          <h2  class="builder-subtitle"><?php echo $title;?></h2>
        <?php endif;?>
        <?php if($description):?>
          <div class="builder-text mb-4">
            <?php echo $description;?>
          </div>
        <?php endif;?>
        <?php if($button):?>
          <?php if($button["type"] == "Link" && $button["label"] ):?>
            <a href="<?php echo $button["link"]["url"];?>"  target="<?php echo $button["link"]["target"];?>" class="btn btn-primary"><?php echo $button["label"];?></a>
          <?php elseif($button["type"] == "Modal Video" && ($video["video_file"] || $video["video_url"]) && $button["label"]):?>
            <a href="#builder-modal-video" <?php echo ($video["type"] == "Self Host") ? 'data-url="'.$video["video_file"].'"': 'data-url="'.$video["video_url"].'"'  ;?>  data-type="<?php echo $video["type"];?>"  data-toggle="modal" data-target="#builder-modal-video" class="btn btn-primary"><?php echo $button["label"];?></a>
	      <?php elseif($button["type"] == "Modal video with paywall" && ($video["video_file"] || $video["video_url"])):?>
            <a href="#builder-modal-event-video" <?php echo ($video["type"] == "Self Host") ? 'data-url="'.$video["video_file"].'"': 'data-url="'.$video["video_url"].'"'  ;?>  data-type="<?php echo $video["type"];?>"  data-toggle="modal" data-target="#builder-modal-event-video" data-paywall-button-type="block-text-with-list" class="paywall-event-button btn btn-primary"><?php echo $button["label"];?></a>
          <?php endif;?>
          <?php endif;?>
      </div>
    </div>
    <div class="col-md-6">
      <div class="block_of_text_with_list--list">
      <?php if( $list ):?>
        <ul>
          <?php foreach ($list as $item) :?>
            <li><?php echo $item["text"];?></li>
         <?php endforeach;?>
        </ul>
      <?php endif;?>
      </div>
    </div>
    </div>
  </div>
</section>