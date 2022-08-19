<?php
/**
 * Template part for displaying Block of content with image
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package UnderStrap
 */

$list_of_expert=$args;

$title = $list_of_expert["title"];
$items = $list_of_expert["experts"];

?>

<section class="builder-list-of-expert">
  <div class="container">
    <?php if( $title ):?>
      <h2 class="builder-subtitle-2 text-center"><?php echo $title;?></h2>
    <?php endif;?>
    <?php if( $items ):?>
      <div class="row">
        <?php foreach ($items as $item) :?>
          <div class="col-md-6">
            <div class="builder-list-of-expert-item">
              <div class="builder-list-of-expert-item--inner">
                <?php if( $item["photo"] ):?>
                  <img class="builder-list-of-expert-item--img" src="<?php echo $item["photo"];?>" alt="<?php echo $item["label"];?>">
                <?php endif;?>
                <div class="builder-list-of-expert-item--text">
                  <?php if( $item["company"] ):?>
                    <h3><?php echo $item["company"];?></h3>
                  <?php endif;?>
                  <?php if( $item["name"] ):?>
                    <h4><?php echo $item["name"];?></h4>
                  <?php endif;?>
                  <?php if( $item["position"] ):?>
                    <p><?php echo $item["position"];?></p>
                  <?php endif;?>
                </div>

              </div>
            </div>

          </div>
          <?php endforeach;?>
      </div>
    <?php endif;?>
  </div>


</section>