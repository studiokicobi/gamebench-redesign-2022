<?php
/**
 * Template Name: Template: Contact
 *
 * Template for displaying a page without sidebar even if a sidebar widget is published.
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
$container = get_theme_mod( 'understrap_container_type' );

if ( is_front_page() ) {
	get_template_part( 'global-templates/hero' );
}

// echo "<pre>";
// print_r(the_field('image'));
// echo "</pre>";
// die();

?>

<div class="contact_section" id="full-width-page-wrapper">
 
  <div class="container">
    <div class="inner-container">
      
      <div class="top-container">
        <div class="content-column">
          <div class="contact-copy">
            <h2 class="title"><?php the_field('main_title'); ?></h2>
            <p class="info"><?php the_field('main_copy'); ?></p>
          </div>
          <div class="contact-data">
          <?php 
            if( have_rows('icon_&_text_box')) :
              while( have_rows('icon_&_text_box') ): the_row();
          ?>

          <?php if( get_sub_field('mail_icon') or get_sub_field('email_contact') ): ?>
            <div class="contact-data_info">
              <div class="icon"><?php the_sub_field('mail_icon'); ?></div>
              <a href="<?php the_sub_field('email_contact'); ?>"><?php the_sub_field('email_contact'); ?></a>
            </div>
          <?php endif; ?>

           <?php if( get_sub_field('phone_icon') or get_sub_field('phone_contact') ): ?>
            <div class="contact-data_info">
              <div class="icon"><?php the_sub_field('phone_icon'); ?></div>
              <a href="<?php the_sub_field('phone_contact'); ?>"><?php the_sub_field('phone_contact'); ?></a>
            </div>
          <?php endif; ?>
        
          <?php 
              endwhile;
            endif;
          ?>
          <?php wp_reset_query();	 // Restore global post data stomped by the_post(). ?>
            <div class="contact-data_social">
               <?php echo do_shortcode( strval(get_field('social_widget_id')) ); ?>
            </div>
          </div>
        </div>
        <div class="form-column">

          <div id="hubspotForm_container" class="form-container">
            <div id="initialForm" class="initialForm">
              <h2 class="title d-none d-sm-none d-md-block">What do you need help with?</h2>
              <h2 class="title  d-md-none">What do you<br /> need help with?</h2>
              <label class="form-select">
                <input name="hubspot-check" type="radio" value="sales">Sales Inquiry
                <span class="checkmark"></span>
              </label>
              <label class="form-select">
                <input name="hubspot-check" type="radio" value="tech">Technical Support
                <span class="checkmark"></span>
              </label>
              <label class="form-select">
                <input name="hubspot-check" type="radio" value="other">Other
                <span class="checkmark"></span>
              </label>
            </div>

            <div id="thank-you" class="initialForm hubspotFormsHidden">
              <div class="success"></div>
              <h2 class="title text-center">Your inquiry was submitted successfully!</h2>
              <p class="info">Thank you for submitting your inquiry, one of our team<br /> members will get back to you as soon as we can.</p>
            </div>

            <div class="hubspotFormsHidden" id="sales">
              <h2 class="title text-center">Sales Inquiry</h2>
              <?php echo get_field('sales_form'); ?>
            </div>
            <div class="hubspotFormsHidden" id="tech">
              <h2 class="title">Technical Support</h2>
              <?php echo get_field('technical_form'); ?>
            </div>
            <div class="hubspotFormsHidden" id="other">
              <h2 class="text-center title">Other Inquiry</h2>
             <?php echo get_field('other_form'); ?>
            </div>
           
          </div>

        </div>
      </div>
      
    </div>
  </div>

  <div class="contact-map_section" style="background-image: url('<?php the_field('background_map'); ?>')">
    <div class="container">
      <div class="inner-container">
        <div class="map-container">

          <div class="contact-cards">

                <?php 
                  if( have_rows('contact_map_cards')) :
                    while( have_rows('contact_map_cards') ): the_row();
                ?>
                  <div class="contact-box">
          
                    <h2 class="title"><?php the_sub_field('title'); ?></h2>
                    <?php 
                      if( have_rows('icon_&_text')) :
                        while( have_rows('icon_&_text') ): the_row();
                    ?>
                      <div class="contact-data_info">
                        <div class="icon"><?php the_sub_field('address_icon'); ?></div>
                        <p><?php the_sub_field('address'); ?></p>
                      </div>
                      <div class="contact-data_info">
                        <div class="icon"><?php the_sub_field('email_icon'); ?></div>
                        <a href="mailto:<?php the_sub_field('email'); ?>"><?php the_sub_field('email'); ?></a>
                      </div>
                    <?php 
                        endwhile;
                      endif;
                    ?>
                    
                  </div>
                <?php 
                    endwhile;
                  endif;
                ?>
                <?php wp_reset_query();	 // Restore global post data stomped by the_post(). ?>

          </div>

        </div>
      </div>
    </div>
  </div>



</div><!-- #Contact End -->




<?php
get_footer();
