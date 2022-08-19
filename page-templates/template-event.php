<?php
/**
 * Template Name: Template: Event
 *
 * Template for displaying a page without sidebar even if a sidebar widget is published.
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
$container = get_theme_mod( 'understrap_container_type' );

	$featuredEvent = get_field('featured_events');
	$featuredEventActionButtonType = '';

	//arg
	$featuredEventArgs = array(
		'post_type' => 'event',
		'post_status' => 'publish',
		'posts_per_page' => 1,
		'order' => 'DESC',
		'meta_key' => 'status',
		'meta_value' => 'Upcoming',
	);

	$featuredEvent = new WP_Query( $featuredEventArgs );
	if( !empty($featuredEvent->posts) ){
		$featuredEvent = $featuredEvent->posts[0];
	}

	$featuredEventExist = !empty( $featuredEvent ) && have_rows( 'external_content', $featuredEvent->ID );

	//arg
	$eventsArgs = array(
		'post_type' => 'event',
		'post_status' => 'publish',
		'posts_per_page' => 4,
		'order' => 'DESC',
		'meta_key' => 'status',
		'meta_value' => 'Recent',
	);

	// query
	$recentEvents = new WP_Query( $eventsArgs );
?>

<section class="event event-main-section" <?= !$featuredEventExist ? 'style="padding: 67px 0 125px;"' : '' ?> >
    <?php
        if ( $featuredEventExist ) {
        ?>
            <div class="container">
                <div class="inner-container">
                    <div class="title-container d-flex justify-content-between align-items-center">
                        <h1 class="title"><?= get_field( 'featured_event_title' ) ?></h1>
                    </div>
                    <div class="content-container">
                        <div class="row">
                            <?php
                                while ( have_rows( 'external_content', $featuredEvent->ID ) ): the_row();

                                    $date = get_sub_field( 'date' )['date'];
                                    $time = get_sub_field( 'date' )['time'];
                                    ?>
                                    <div class="col-md-6">
                                        <div class="block_of_content_of_event">
                                            <div class="builder-text"> <?= $date . ' at ' . $time ?></div>
                                            <h3 class="builder-subtitle">
                                                <?= get_sub_field( 'title' ) ?>
                                            </h3>
                                            <div class="builder-text">
                                                <?= get_sub_field( 'description' ) ?>
                                            </div>
                                            <div class="builder-buttons">
                                                <?php
                                                    if( empty(get_sub_field('hubspot_form')['form_id']) || empty(get_sub_field('hubspot_form')['portal_id']) ){
                                                ?>
                                                    <a  href="<?= get_sub_field( 'button' )['link']['url'] ?>" class="btn btn-primary">
                                                        <?= get_sub_field( 'button' )['label'] ?>
                                                    </a>

                                                <? } else { ?>
                                                    <a  href="#" id="form-modal-button"
                                                        data-toggle="modal" data-target="#builder-modal-form"
                                                        class="btn btn-primary">
                                                        <?= get_sub_field( 'button' )['label'] ?>
                                                    </a>
                                                <? } ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 block_of_content_of_event_with_image" style="background: linear-gradient(
                                            180deg,
                                            rgb(21 23 31 / 0%),
                                            rgb(21 23 31 / 80%)),
                                            url(<?= get_sub_field( 'image' ) ?>);">
                                    </div>
                                    <?php
                                        if( !empty(get_sub_field('hubspot_form')['form_id']) && !empty(get_sub_field('hubspot_form')['portal_id']) ){
                                    ?>
                                        <!--[if lte IE 8]>
                                        <script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/v2-legacy.js"></script>
                                        <![endif]-->
                                        <script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/v2.js"></script>
                                        <!-- Form Modal -->
                                        <div class="modal fade" id="builder-modal-form" tabindex="-1" aria-labelledby="builder-modal-form" aria-hidden="true">
                                            <div class="modal-dialog modal-xl modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        <div class="modal-form-container">
                                                            <script>
                                                              hbspt.forms.create({
                                                                region: "na1",
                                                                portalId: "<?=trim(get_sub_field('hubspot_form')['portal_id'])?>",
                                                                formId: "<?=trim(get_sub_field('hubspot_form')['form_id'])?>",
                                                                onFormSubmit: function($form) {
                                                                  setTimeout(function () {
                                                                    jQuery('#builder-modal-form').modal('hide');
                                                                  }, 1500 );
                                                                },
                                                                cssClass: 'webinar-registration-form',
                                                                submitButtonClass: 'submit-button',
                                                              });
                                                            </script>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                            <?php
                                    }
                                endwhile;
                                wp_reset_query();
                            ?>
                        </div>
                    </div>
                </div>
            </div>
	<?php
		}
	?>
</section>
<section class="event event-recent-section">
    <div class="container">
        <div class="inner-container">
            <div class="title-container d-flex justify-content-between align-items-center">
                <h2 class="title"><?= get_field( 'event_list_title' ) ?></h2>
            </div>
            <div class="content-container">
                <div class="row blogContainer">
		            <?php
			            foreach ( $recentEvents->posts as $recentEvent ) {

				            if ( have_rows( 'external_content', $recentEvent->ID ) ) {

					            while ( have_rows( 'external_content', $recentEvent->ID ) ): the_row();
					                get_template_part('global-templates/recent-event-listing');
					            endwhile;
				            }
			            }
			            wp_reset_query();
		            ?>
                </div>
            </div>
        </div>
	    <?php
		    $maxpage     = $recentEvents->max_num_pages;
		    $currentpage = 1;

		    // don't display the button if there are not enough posts
		    if ( $maxpage > 1 ):
			    ?>
                <div id="loadMoreBtn" data-max-page="<?php echo $maxpage; ?>"
                     data-currentpage="<?php echo $currentpage; ?>"
                     class="loadMoreBtn btn btn-custom-outline text-center">Load More
                </div>
		    <?php endif; ?>
    </div>
</section>

<?php
	get_template_part('global-templates/getStarted-section');

?>

<!-- Modal -->
<div class="modal fade" id="builder-modal-event-video" tabindex="-1" aria-labelledby="builder-modal-event-video" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="builder-modal-video-container" style="display: none;">
                    <iframe src="" frameborder="0"></iframe>
                    <video autoplay  controls muted src=""></video>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();