<div class="news">
  <?php global $p_class; ?>
  <?php
  $args = array("posts_per_page" => -1, "post_status" => "publish", "post_type" => "post", "category" => "2", 'orderby' => 'date', 'order' => 'DESC');
  $temp_posts = get_posts($args);
  $featured_posts = array_slice($temp_posts, 0, 6);
  ?>
  <?php if (!empty($featured_posts)) : ?>
    <section class="<?php echo TBP_PREFIX; ?>-related-posts<?php echo $p_class; ?>">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="related-header">
              <h4>
                <?php echo get_sub_field('related_home_page_header'); ?>
              </h4>
            </div>
          </div>
        </div>
        <div class="grid" data-total-posts="<?php echo count($temp_posts); ?>">
          <div class="grid-sizer"></div>
          <?php foreach ($featured_posts as $key => $post) : setup_postdata($post); ?>
            <div class="grid-item">
              <div class="card-wrapper">
                <a class="card" title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
                  <img data-id="<?php echo $key; ?>" data-limit="6" src="<?php echo get_the_post_thumbnail_url(get_the_ID(), "related-post-image-one-col"); ?>" class="card-img-top" alt="<?php the_title(); ?>">
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
        <?php if (count($temp_posts) > 6) : ?>
          <div class="row justify-content-center">
            <a href="#" class="load-more" data-page="1">Load More</a>
          </div>
        <?php endif; ?>
      </div>
    </section>
  <?php endif; ?>
</div>