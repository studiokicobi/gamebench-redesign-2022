<?php

/**
 * Template Name: Template: About LIGHT
 *
 * Template for displaying a page without sidebar even if a sidebar widget is published.
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();
$container = get_theme_mod('understrap_container_type');

if (is_front_page()) {
  get_template_part('global-templates/hero');
}

?>
<style>
  @media (max-width: 767.98px) {
    .our_team_section .team-container {
      display: flex !important;
      flex-wrap: wrap !important;
    }
  }

  .about_top_section {
    margin-bottom: 7rem;
  }
</style>

<?php
// --------------------------------------------------
// Hero
// --------------------------------------------------
?>
<div class="about_top_section" id="about_top_section" style="background-image: url(<?php the_field('big_background_image');  ?>)">
  <div class="container">
    <div class="inner-container">
      <div class="content-container">
        <h1 class="title"><?php the_field('top_title'); ?></h1>
        <p class="info"><?php the_field('top_content'); ?></p>
        <?php if (get_field('cta_url')) : ?>
          <a href="<?php the_field('cta_url'); ?>" class="btn btn-primary btn-custom"><?php the_field('cta_label'); ?></a>
        <?php endif; ?>
      </div>
    </div>
  </div>

</div>


<?php
// --------------------------------------------------
// Our Core Values
// --------------------------------------------------
if (get_field('use_core_values_section') == 1) : ?>
  <div class="our_core_section" id="our_core_section">
    <div class="container">
      <?php
      if (have_rows('core_values')) :
        while (have_rows('core_values')) : the_row();
      ?>
          <div class="inner-container">
            <h2 class="title text-center"><?php the_sub_field('title'); ?></h2>
            <div class="card_container">
              <?php
              if (have_rows('cards')) :
                while (have_rows('cards')) : the_row();
              ?>
                  <div class="icon-card">
                    <div class="icon-container">
                      <?php the_sub_field('icon'); ?>
                    </div>
                    <div class="copy-container">
                      <h2 class="title"><?php the_sub_field('title'); ?></h2>
                      <p class="info"><?php the_sub_field('content'); ?></p>
                    </div>
                  </div>
              <?php
                endwhile;
              endif;
              ?>
              <?php wp_reset_query();   // Restore global post data stomped by the_post(). 
              ?>

            </div>
          </div>
      <?php
        endwhile;
      endif;
      ?>
      <?php wp_reset_query();   // Restore global post data stomped by the_post(). 
      ?>
    </div>
  </div>
<?php else : ?>
  <style>
    /* Add spacing to the Our Team section if we're not using the Core Values section */
    .our-team-heading {
      margin-top: 1rem;
    }
  </style>
<?php endif; ?>


<?php
// --------------------------------------------------
// Our Team
// --------------------------------------------------
?>
<div class="our_team_section" id="our_team_section">
  <div class="container">
    <div class="inner-container">
      <?php
      //arg
      $deparmentQ = array(
        'post_type' => 'department',
        'posts_per_page' => -1,
        'order'        => 'ASC',
      );

      // query
      $department_query = new WP_Query($deparmentQ);

      $teams = array(
        'post_type' => 'our-team',
        'posts_per_page' => -1,
        'order'        => 'ASC',
      );
      // query
      $team_query = new WP_Query($teams);
      ?>
      <h2 class="title text-left our-team-heading"><?php the_field('our_team_title'); ?></h2>
      <?php foreach ($department_query->posts as $department) : ?>
        <h3 class="title text-centre"><?php echo get_field('department_name', $department->ID); ?></h3>

        <div class="team-container">
          <?php foreach ($team_query->posts as $team) : ?>

            <?php if (get_field("department", $team->ID) == $department->ID) : ?>
              <?php
              $orderPosition = 0;
              switch (get_field('name', $team->ID)) {
                case "Philip Swinstead";
                  $orderPosition = 1;
                  break;
                case "Alex Mullaly";
                  $orderPosition = 2;
                  break;
                case "Adrian Leu";
                  $orderPosition = 3;
                  break;
                case "Karthik Hariharakrishnan";
                  $orderPosition = 4;
                  break;
                case "Adam Gilbey";
                  $orderPosition = 5;
                  break;
                case "Cem Cesmig";
                  $orderPosition = 6;
                  break;
              }

              ?>
              <div class="team-card" style="order: <?php echo $orderPosition; ?>" data-picture='<?php echo get_field('picture', $team->ID); ?>' data-name='<?php echo get_field('name', $team->ID); ?>' data-position='<?php echo get_field('position', $team->ID); ?>' data-general='<?php echo get_field('general_info', $team->ID); ?>'>
                <div class="team-header">
                  <div class="team-pic">
                    <img src="<?php echo get_field('picture', $team->ID); ?>" alt="<?php echo get_field('name', $team->ID); ?>">
                  </div>
                  <div class="name-position">
                    <p class="team-name"><?php echo get_field('name', $team->ID); ?></p>
                    <p class="team-position"><?php echo get_field('position', $team->ID); ?></p>
                  </div>
                </div>
                <div class="team-content">
                  <?php
                  $linkText = "... <span class='team-link'>Read more</span>";
                  ?>

                  <p class="info">
                    <?php
                    $excerpt = wp_trim_words(get_field('content', $team->ID), $num_words = 10, $more = $linkText);
                    echo $excerpt;
                    ?>
                  </p>
                </div>
              </div>
            <? endif; ?>
          <?php endforeach; ?>
        </div>

      <?php endforeach; ?>

    </div>
  </div>
</div>


<?php
// --------------------------------------------------
// Get Started
// --------------------------------------------------
if (get_field('use_get-started_global') == 1) :
  get_template_part('global-templates/getStarted-section');
else :
  // echo 'false'; 
  // TEMP – decrease distance to footer caused by removal of section 
  echo '<style>.our_team_section { padding-bottom: 0; }</style>';
endif;
?>


<?php // get_template_part('global-templates/getStarted-section'); 
?>


<!-- The Modal -->
<div id="teamModal" class="modal hideModal">

  <!-- Modal content -->
  <div class="modal-content team_modal-content">
    <span class="close-team">&times;</span>
    <div class="modal-team_header">
      <div class="modal-team_pic"></div>
      <div class="modal-name-pos">
        <div class="modal-team_name"></div>
        <div class="modal-team_position"></div>
      </div>
    </div>
    <div class="modal-team_data">
      <div class="modal-team_title"></div>
      <div class="modal-team_content"></div>
    </div>
  </div>

</div>

<?php
get_footer();
