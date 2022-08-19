<?php
/**
 * Template part for displaying Block of content with image
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package UnderStrap
 */

$video_list=$args;

$title = $video_list["title"];
$items = $video_list["videos"];
$enablePaywall = $video_list["enable_paywall"];

?>

<section class="builder-video-list">
  <div class="container">
    <?php if( $title ):?>
      <h2 class="builder-subtitle-2"><?php echo $title;?></h2>
    <?php endif;?>
    <?php if( $items ):?>
      <div class="builder-video-list-slider">
        <?php foreach ($items as $index => $item) :
            
            $videoAttributes = "";
            
            if( $enablePaywall ){
	            $videoAttributes = 'class="paywall-event-button builder-video-list-item"';
	            $videoAttributes .= ($item["video_type"] == "Self Host") ? 'data-url="'.$item["video_file"].'"': 'data-url="'.$item["video_url"].'"';
	            $videoAttributes.= ' data-type="'.$item["video_type"].'" data-toggle="modal" data-paywall-button-type="video-list-'.$index.'" data-target="#builder-modal-event-video"';
            } else {
                $videoAttributes = 'class="builder-video-list-item"';
	            $videoAttributes .= ($item["video_type"] == "Self Host") ? 'data-url="'.$item["video_file"].'"': 'data-url="'.$item["video_url"].'"';
	            $videoAttributes.= ' data-type="'.$item["video_type"].'" data-toggle="modal" data-target="#builder-modal-video"';
            }
        ?>
            
            <div <?=$videoAttributes?>>
              <div class="builder-video-list-item--inner" style="background-image:url(<?php echo $item["image"];?>);">

                <div class="builder-video-list--text">
                  <?php if( $item["title"] ):?>
                    <h3><?php echo $item["title"];?></h3>
                  <?php endif;?>
                  <div>
                    <span></span>
                    <?php echo $item["button_text"];?>
                  </div>

                </div>
              </div>
              <?php if( $item["extra_text"] ):?>
                <h4><?php echo $item["extra_text"];?></h4>
              <?php endif;?>
              <?php if( $item["title"] ):?>
                <h3><?php echo $item["title"];?></h3>
              <?php endif;?>
            </div>
          <?php endforeach;?>
      </div>
    <?php endif;?>
  </div>


</section>