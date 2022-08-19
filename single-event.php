<?php
	/**
	 * The template for displaying all Event
	 *
	 * @package UnderStrap
	 */

// Exit if accessed directly.
	defined( 'ABSPATH' ) || exit;

	get_header();
	$container = get_theme_mod( 'understrap_container_type' );
	global $post;

	$builder=get_field("builder",$post->ID);
?>
<?php
	if( $builder ):
		// Loop through rows.
		foreach ($builder as $block) :

			// Block of content with image
			if( $block['acf_fc_layout']== 'block_of_content_with_image' ):
				get_template_part( 'template-parts/event/content', 'block_of_content_with_image',$block);

			// Logos
            elseif( $block['acf_fc_layout']== 'logos' ):
				get_template_part( 'template-parts/event/content', 'logos',$block);

			// Block of text
            elseif( $block['acf_fc_layout']== 'block_of_text' ):
				get_template_part( 'template-parts/event/content', 'block_of_text',$block);

			// List of experts
            elseif( $block['acf_fc_layout']== 'list_of_experts' ):
				get_template_part( 'template-parts/event/content', 'list_of_experts',$block);

			// Block of text with list
            elseif( $block['acf_fc_layout']== 'block_of_text_with_list' ):
				get_template_part( 'template-parts/event/content', 'block_of_text_with_list',$block);

			// Video List
            elseif( $block['acf_fc_layout']== 'video_list' ):
				get_template_part( 'template-parts/event/content', 'video_list',$block);

			// Info Block
            elseif( $block['acf_fc_layout']== 'info_block' ):
				get_template_part( 'template-parts/event/content', 'info_block',$block);
			// Spacer
            elseif( $block['acf_fc_layout']== 'spacer' ):
				get_template_part( 'template-parts/event/content', 'spacer',$block);
			endif;
			// End loop.
		endforeach;
		// No value.
	endif;
?>

    <!-- Modal -->
    <div class="modal fade" id="builder-modal-video" tabindex="-1" aria-labelledby="builder-modal-video" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="builder-modal-video-container">
                        <iframe src="" frameborder="0"></iframe>
                        <video autoplay  controls muted src=""></video>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Paywall Modal -->
    <div class="modal fade" id="builder-modal-event-video" tabindex="-1" aria-labelledby="builder-modal-event-video" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="paywall-form-container" data-paywall-button-type="">
                        <!--[if lte IE 8]>
                        <script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/v2-legacy.js"></script>
                        <![endif]-->
                        <script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/v2.js"></script>
                        <script>
                          hbspt.forms.create({
                            region: "na1",
                            portalId: "2891910",
                            formId: "6859c41e-8e07-4d33-8a19-a951af5c26fd",
                            onFormSubmit: function($form) {
                              localStorage.setItem('eventPayWall', 'submitted');
                              setTimeout(function () {
                                showModalContent();
                              }, 1500 );
                            },
                            cssClass: 'webinar-registration-form',
                            submitButtonClass: 'submit-button',
                          });
                        </script>
                    </div>
                    <div class="builder-modal-video-container" style="display: none;">
                        <iframe src="" frameborder="0"></iframe>
                        <video autoplay  controls muted src=""></video>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>


      function showModalContent(e = null) {

        var url = '';
        var type = '';
        let payWallFormStatus = localStorage.getItem('eventPayWall');
        if( e != null ){
          if( payWallFormStatus == 'submitted' ){
            url = jQuery(e.relatedTarget).data('url');
            type = jQuery(e.relatedTarget).data('type');

          } else {
            jQuery('.paywall-form-container').attr('data-paywall-button-type', jQuery(e.relatedTarget).data('paywall-button-type'));
          }
        } else {
          let paywallRelatedEl = jQuery('.paywall-form-container').data('paywall-button-type');
          url = jQuery('.paywall-event-button[data-paywall-button-type="'+paywallRelatedEl+'"]').data('url');
          type = jQuery('.paywall-event-button[data-paywall-button-type="'+paywallRelatedEl+'"]').data('type');
        }

        let el = jQuery('#builder-modal-event-video');

        if( payWallFormStatus == 'submitted' ) {

          jQuery('.paywall-form-container').css('display', 'none');
          jQuery('#builder-modal-event-video .builder-modal-video-container').fadeIn('slow');

          if (type == "Self Host") {
            el.find(".builder-modal-video-container video").attr('src', url);
            el.find(".builder-modal-video-container video").fadeIn('slow');
            el.find(".builder-modal-video-container iframe").css('display', 'none');

          } else {
            el.find(".builder-modal-video-container iframe").attr('src', url);
            el.find(".builder-modal-video-container video").css('display', 'none');
            el.find(".builder-modal-video-container iframe").fadeIn('slow');
          }
        }
      }
    </script>
<?php
	get_footer();