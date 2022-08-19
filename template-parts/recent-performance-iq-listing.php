<?php
/**
 * @var array $args
 */

?>
<div class="col-md-6 builder-video-list-wrapper">
    <div>
        <div class="builder-video-list-item event-builder-video-list-item" data-detail-url="<?=get_permalink($args['recentPost']->ID)?>"
             style="width: 100%; display: inline-block;">
            <div class="builder-video-list-item--inner"
                 style="background: linear-gradient(
                         180deg,
                         rgb(21 23 31 / 0%),
                         rgb(21 23 31 / 80%)),
                         url(<?= get_sub_field( 'thumbnail' ) ?>);">
                <div class="builder-video-list--text">
                    <h4 class="performance-iq-subtitle"><?= get_sub_field( 'subtitle' ) ?></h4>
                    <h3><?= $args['recentPost']->post_title ?></h3>
                    <div>
                        <a href="<?=get_permalink($args['recentPost']->ID)?>"><?= get_sub_field( 'button_text' ) ?></a>
                    </div>
                </div>
            </div>

            <h4 class="performance-iq-subtitle"><?= get_sub_field( 'subtitle' ) ?></h4>
            <h3><?= $args['recentPost']->post_title ?> </h3>
        </div>
    </div>
</div>