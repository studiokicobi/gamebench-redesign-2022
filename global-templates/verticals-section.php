<div class="verticals-section" id="verticals-section">
  <div class="container">
    <div class="inner-container">
        <div class="section-header">
          <?php 
            if( have_rows('verticals_section_copy', 'options')) :
              while( have_rows('verticals_section_copy', 'options') ): the_row();
          ?>
              <h2 class="title"><?php the_sub_field('vertical_title', 'options'); ?></h2>
              <p class="info"><?php the_sub_field('vertical_content', 'options'); ?></p>
              <?php endwhile; ?>
            <?php endif; ?>
          <?php wp_reset_query();	 // Restore global post data stomped by the_post(). ?>
        </div>
        <div class="verticals-grid">
            <?php 

            // args
            $args = array(
              'post_type'		=> 'vertical',
              'posts_per_page' => 6,
              'order'				=> 'ASC',
            );
            // query
            $the_query = new WP_Query( $args );
            

            ?>
              <?php if( $the_query->have_posts() ): ?>
                <?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>
                  <div class="verticals-card">
                    <div class="verticals-icon">
                      <?php the_field('icon'); ?>
                    </div>
                    <div class="verticals-title"><?php the_field('title'); ?></div>
                  </div>
                <?php endwhile; ?>
              <?php endif; ?>
            <?php wp_reset_query();	 // Restore global post data stomped by the_post(). ?>

        </div>
      
    </div>
  </div>
</div>