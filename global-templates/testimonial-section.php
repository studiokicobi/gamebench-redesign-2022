<div class="testionial-section" id="testimonial-section">
  <div class="container">
    <div class="inner-container">
        
        <div class="content-container">
          <div class="content-column ">
            <h2 class="title"><?php the_field('testimonial_title', 'options'); ?></h2>
            <p class="info">
             <?php the_field('testimonial_copy', 'options'); ?>
            </p>
      
          </div>

          <div class="image-column over-slider">
            
            <div class="testimonial_container">
              <?php 
                // args
                $args = array(
                  'post_type'		=> 'testimonial',
                  'posts_per_page' => -1,
                  'order'				=> 'ASC',
                );
                // query
                $the_query = new WP_Query( $args );
                
              ?>
                <?php if( $the_query->have_posts() ): ?>
                  <?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>
                    <div class="testimonial-card">
                      <div class="testimonial-header">
                        <div class="testimonial-pic">
                          <img src="<?php the_field('testimonial_pic'); ?>" alt="<?php the_field('testimonial_name'); ?>">
                        </div>
                        <div class="text-header">
                          <p class="testimonial-logo_name"><?php the_field('logo_name'); ?></p>
                          <p class="testimonial-name"><?php the_field('testimonial_name'); ?></p>
                          <p class="testimonial-position"><?php the_field('testimonial_postion'); ?></p>
                        </div>
                      </div>
                      <div class="testimonial-content">
                        <p class="info"><?php the_field('testimonial_content'); ?></p>
                      </div>
                    </div>
                  <?php endwhile; ?>
                <?php endif; ?>
              <?php wp_reset_query();	 // Restore global post data stomped by the_post(). ?>
            </div>

            <div class="testimonial-arrows"></div>
          </div>

        </div>
     

    </div>
  </div>
</div>