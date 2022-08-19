            <div class="blog_slider-container col-md-6 col-sm-12">
              <div class="blog-card" style="max-height: 24.375rem; background-image: url('<?php echo get_the_post_thumbnail_url($post->ID, 'large'); ?>');">
                <a href="<?php echo get_permalink(); ?>">
                  <div class="blog-content">
                    <div class="blog-title">
                      <p>
                        <?php
                        $excerpt = wp_trim_words(get_the_title(), $num_words = 10, $more = '… ');
                        echo $excerpt;
                        ?>
                      </p>
                    </div>
                    <div class="blog-author">
                      <div class="author-pic">
                        <img src="<?php echo get_avatar_url(get_the_author_meta('ID'), $post->ID); ?>" alt="<?php echo get_the_author_meta('display_name', $userID); ?>">
                      </div>
                      <div class="author-name">
                        <p class="info"><?php echo get_the_author_meta('display_name', $userID); ?></p>
                      </div>
                    </div>
                    <div class="read-more">
                      <p>Read more</p>
                    </div>
                  </div>
                </a>
              </div>
            </div>