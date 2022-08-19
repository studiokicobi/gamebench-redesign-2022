<?php
$recentEventDate = get_sub_field( 'date' )['date'];
$recentEventTime = get_sub_field( 'date' )['time'];
?>
<div class="col-md-6 builder-video-list-wrapper">
    <div>
        <div class="builder-video-list-item event-builder-video-list-item" data-detail-url="<?=get_sub_field( 'button' )['link']['url']?>"
             style="width: 100%; display: inline-block;">
            <div class="builder-video-list-item--inner"
                 style="background: linear-gradient(
                         180deg,
                         rgb(21 23 31 / 0%),
                         rgb(21 23 31 / 80%)),
                         url(<?= get_sub_field( 'image' ) ?>);">
                <div class="builder-video-list--text">
					<?php if(!empty($recentEventDate)):
			 			$time = ($recentEventTime)? ' at ' . $recentEventTime : "";
					?>
                    <h4><?= $recentEventDate.$time; ?></h4>
					<?php endif;?>
                    <h3><?= get_sub_field( 'title' ) ?></h3>
                    <div>
                        <a href="<?=get_sub_field( 'button' )['link']['url']?>"><?=get_sub_field( 'button' )['label']?></a>
                    </div>
                </div>
            </div>

            <?php if(!empty($recentEventDate)):
			 			$time = ($recentEventTime)? ' at ' . $recentEventTime : "";
					?>
                    <h4><?= $recentEventDate.$time; ?></h4>
					<?php endif;?>
            <h3><?= get_sub_field( 'title' ) ?> </h3>
        </div>
    </div>
</div>