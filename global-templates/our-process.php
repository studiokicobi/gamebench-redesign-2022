<div class="our-process_section" id="process">
  <div class="container">
    <div class="inner-container">
      <?php 
        if( have_rows('our_approach', 'options')) :
          while( have_rows('our_approach', 'options') ): the_row();
      ?>
      <div class="our-process_copy">
        <div class="content-container">
          <h2 class="title"><?php the_sub_field('our_approach_left_title'); ?></h2>
            <p class="info"><?php the_sub_field('short_content'); ?></p>
            <?php if( get_sub_field("cta_label") != 'hidden'): ?>
            <a href="<?php the_sub_field('cta_url'); ?>" class="btn btn-primary btn-custom"><?php the_sub_field('cta_label'); ?></a>
	        <?php endif; ?>
        </div>
      </div>
      <div class="tab-container">
        <div class="tabs_method">
          <div class="tablist_method" role="tablist_method" aria-label="Programming Languages">
            <?php 
              if( have_rows('tabs_repeater')) :
                $index = 1;
                while( have_rows('tabs_repeater') ): the_row();
                $index++;
                
            ?>
            <button role="tab_method" aria-selected="true" id="method-<?php echo $index - 1; ?>">
              <span class="only-desk"><?php the_sub_field('tab_title'); ?></span>
              <span class="only-mob">0<?php echo $index - 1; ?></span>
            </button>
            <?php 
                
                endwhile;
              endif;
            ?>
          </div>
          <div class="panels_container">
            <?php 
              if( have_rows('tabs_repeater')) :
                $index = 1;
                while( have_rows('tabs_repeater') ): the_row();
                $index++; 
                
            ?>
            <div class="panels hide" role="tabpanel_method" aria-labelledby="method-<?php echo $index - 1; ?>">
              <div class="tab-content">
                <div class="icon-container"><?php the_sub_field('tab_icon'); ?></div>
                <div class="title-container"><?php the_sub_field('tab_title'); ?></div>
                <div class="content">
                 <?php the_sub_field('tab_content'); ?>
                </div>
              </div>
            </div>
            
            <?php 
                endwhile;
              endif;
            ?>
          </div>
        </div>
      </div>
      <?php 
          endwhile;
        endif;
      ?>
      <?php wp_reset_query();	 // Restore global post data stomped by the_post(). ?>
    </div>
  </div>
</div><!-- #Our Process End -->