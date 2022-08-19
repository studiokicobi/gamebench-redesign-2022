<div class="blog_slider-container col-md-4 col-sm-12">
  <div class="case_study-card" style="background-image: url('<?php echo get_the_post_thumbnail_url( $post->ID, 'large' ); ?>');">
    <a href="<?php echo get_permalink(); ?>">
      <div class="case_study-content">
        <div class="brand_logo" >
          <img src="<?php echo get_field('logo' ) ?>" alt="<?php echo get_field('title' ) ?>">
        </div>
        <div class="case_study-title">
          <p>
            <?php
              $excerpt = wp_trim_words( get_post_field('post_content', $featured->ID ), $num_words = 10, $more = '… ' );
              echo $excerpt;
            ?>
          </p>
        </div>

        <div class="read-more">
          <p>Read more</p>
        </div>
      </div>
    </a>
  </div>
</div>