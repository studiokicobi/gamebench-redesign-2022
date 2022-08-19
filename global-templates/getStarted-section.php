<?php 
  if( have_rows('get_started_section', 'options')) :
    while( have_rows('get_started_section', 'options') ): the_row();
?>
  <div class="getStarted-section" id="getStarted-section" style="background-image: url('<?php the_sub_field('background_image'); ?>');">
    <div class="container">
      <div class="inner-container">
        <div class="content-container">
          <h2 class="title"><?php the_sub_field('title'); ?></h2>
          <p class="info"><?php the_sub_field('content'); ?></p>
          <p>
            <a href="<?php the_sub_field('cta_url'); ?>" class="btn btn-primary btn-custom "><?php the_sub_field('cta_label'); ?></a>
          </p>
        </div>
      </div>
    </div>
  </div>
<?php 
    endwhile;
    reset_rows();
  endif;
?>