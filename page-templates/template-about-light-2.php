<?php

/**
 * Template Name: Template: About LIGHT 2
 *
 * Template for displaying a page without sidebar even if a sidebar widget is published.
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();
$container = get_theme_mod('understrap_container_type');

?>
<style>
  @media (max-width: 767.98px) {
    .our_team_section .team-container {
      display: flex !important;
      flex-wrap: wrap !important;
    }
  }

  #about_top_section {
    height: auto;
  }

  .about_top_section .title {
    font-size: 50px;
  }

  @media screen and (min-width:960px) {
    .about_top_section {
      padding: 20rem 0;
    }
  }

  .about_top_section .container,
  .about_top_section .main_slider .arrows-container,
  .main_slider .about_top_section .arrows-container {
    top: 55%;
  }

  @media screen and (max-width:960px) {

    .about_top_section .container,
    .about_top_section .main_slider .arrows-container,
    .main_slider .about_top_section .arrows-container {
      position: relative;
      top: 0;
      left: 0;
      transform: none;
    }
  }

  .light {
    color: #fff;
  }

  .big-hero-text {
    line-height: 1.3;
    font-size: 20px;
  }

  @media screen and (max-width:960px) {
    .big-hero-text {
      flex-direction: column;
    }
  }

  .why-section .container {
    padding-top: 70px;
  }

  .why-section .content-grid {
    margin-top: 70px;
  }

  .why-section .short-content {
    width: auto;
    justify-content: flex-start;
  }

  .why-section .short-content .title {
    font-weight: 400;
    text-align: left;
  }

  .why-section .short-content h2 {
    font-size: 32px;
    font-weight: 400;
  }

  @media screen and (max-width: 965.98px) {
    .why-section .short-content h2 {
      font-size: 30px;
    }
  }

  .why-section .short-content .info {
    text-align: left;
    max-width: 50ch;
  }

  .title.our-team-heading {
    margin-bottom: 2rem;
  }

  .why-section .short-content .title-wrapper {
    width: 100%;
  }

  @media screen and (max-width: 965.98px) {
    .why-section .short-content .title-wrapper {
      align-items: flex-start;
    }
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
      <?php
      if (have_rows('hero_content')) :
        while (have_rows('hero_content')) : the_row();
          echo '<h1 class="title">' . get_sub_field('main_heading') . '</h1>';
          if (get_sub_field('subheading')) :
            echo '<h2 class="light">' . get_sub_field('subheading') . '</h2>';
          endif;
          echo '<div class="row big-hero-text">';
          if (get_sub_field('first_column')) :
            echo '<div class="col">' . get_sub_field('first_column') . '</div>';
          endif;
          if (get_sub_field('second_column')) :
            echo '<div class="col">' . get_sub_field('second_column') . '</div>';
          endif;
          echo '</div>';
        endwhile;
      endif;
      ?>
    </div>
  </div>
</div>


<?php
// --------------------------------------------------
// Icon section
// --------------------------------------------------
if (get_field('use_icon_section') == 0) {
  // Do nothing.
} else {
  // Add a class to the wrapper to add padding.
  $why_class = ' why-spacing';
  // TEMP - move below style to SASS
  echo '<style>.why-spacing { margin-bottom: 70px; padding-bottom: 0; }</style>';
}

if (get_field('use_icon_section') == 1) : ?>
  <div class="why-section<?php echo $why_class; ?>" id="why_section">
    <div class="container">
      <div class="inner-container">
        <div class="short-content">
          <div class="title-container">
            <div class="title-wrapper">
              <h2 class="title"><?= the_field('icon_section_title') ?></h2>
            </div>
          </div>
          <p class="info"><?php the_field('icon_section_short_content') ?></p>
        </div>
        <div class="content-grid">
          <div class="content-container">
            <?php
            if (have_rows('icon_section')) :
              while (have_rows('icon_section')) : the_row();
            ?>
                <div class="icon-card">
                  <div class="icon-container">
                    <?php the_sub_field('icon_image'); ?>
                  </div>
                  <div class="copy-container">
                    <h3 class="title"><?php the_sub_field('title'); ?></h3>
                    <p class="info"><?php the_sub_field('detail'); ?></p>
                  </div>
                </div>
            <?php
              endwhile;
            endif;
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php
endif;
// Icon section end
?>


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
      <h2 class="text-left our-team-heading"><?php the_field('our_team_title'); ?></h2>
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
