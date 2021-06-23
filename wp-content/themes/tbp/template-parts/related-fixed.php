<?php global $p_class; ?>
<?php while (have_rows('tbp_related_posts', 'home_options')) : the_row(); ?>
  <?php
  $temp_posts = get_posts(array("posts_per_page" => -1, "post_status" => "publish", "post_type" => "post", "category" => "2", "exclude" => array(get_the_ID()), 'orderby' => 'date', 'order' => 'DESC'));
  shuffle($temp_posts);
  $featured_posts = array_slice($temp_posts, 0, 3);
  ?>
  <?php if (!empty($featured_posts)) : ?>
    <section class="<?php echo TBP_PREFIX; ?>-related-posts-fixed<?php echo $p_class; ?>">
      <div class="container">
        <div class="row">
          <?php foreach ($featured_posts as $key => $post) : setup_postdata($post); ?>
            <div class="col-md-4">
              <div class="card-wrapper">
                <a class="card" title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
                  <div class="img-wrapper">
                    <div class="img-bg" style="background: url(<?php echo get_the_post_thumbnail_url(get_the_ID(), "related-post-image-one-col"); ?>) no-repeat top; background-size: cover;"></div>
                  </div>
                  <div class="card-body">
                    <p class="card-title">3, 2, 1 Boxing</p>
                    <p>
                      <?php the_title(); ?>
                    </p>
                    <small class="publication-date text-muted"><?php echo tbp_convert_to_time_ago($post->post_date); ?></small>
                  </div>
                </a>
              </div>
            </div>
          <?php endforeach;
          wp_reset_postdata(); ?>
        </div>
      </div>
    </section>
  <?php endif; ?>
<?php endwhile; ?>
