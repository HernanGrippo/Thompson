<section class="<?php echo TBP_PREFIX; ?>-single-fighter">
  <div class="container">
    <div class="row">
      <?php
      if (have_rows('f_elements')) :
        while (have_rows('f_elements')) : the_row();
          if (get_row_layout() == 'header') :
            require_once TBP_THEME_PATH . '/template-parts/fighter/header.php';
          endif;
        endwhile;
      endif;
      ?>
      <div class="col-12">
        <div class="single-fighter-content">
          <div class="content-inner">
            <div class="d-none d-md-block">
              <?php require_once TBP_THEME_PATH . '/template-parts/social-share.php'; ?>
            </div>
            <?php
            if (have_rows('f_elements')) :
              while (have_rows('f_elements')) : the_row();
                if (get_row_layout() == 'fighters_meta') :
                  require_once TBP_THEME_PATH . '/template-parts/fighter/fighter-meta.php';

                elseif (get_row_layout() == 'content') :
                  require_once TBP_THEME_PATH . '/template-parts/fighter/texts.php';

                elseif (get_row_layout() == 'gallery') :
                  require_once TBP_THEME_PATH . '/template-parts/fighter/gallery.php';

                elseif (get_row_layout() == 'highlights') :
                  require_once TBP_THEME_PATH . '/template-parts/fighter/highlights.php';

                elseif (get_row_layout() == 'sparing_partners') :
                  require_once TBP_THEME_PATH . '/template-parts/fighter/sparing-partners.php';

                elseif (get_row_layout() == 'high_school') :
                  require_once TBP_THEME_PATH . '/template-parts/fighter/high-school.php';

                elseif (get_row_layout() == 'interests') :
                  require_once TBP_THEME_PATH . '/template-parts/fighter/interests.php';
                endif;

              endwhile;
            endif;
            ?>
            <?php require_once TBP_THEME_PATH . '/template-parts/social-share-fighter.php'; ?>
          </div>
        </div>
        <div class="fighters">
          <div class="container">
            <div class="row">
              <div class="col-12 title text-center">
                <h4 class="m-0">HERE ARE MORE FIGHTERS YOU MAY LIKE</h4>
              </div>
            </div>
          </div>
          <div class="container">
            <div class="row justify-content-md-center">
              <?php
              $temp_fighters = get_posts(array("posts_per_page" => -1, "post_status" => "publish", "post_type" => "fighter", "exclude" => array(get_the_ID()), 'orderby' => 'date', 'order' => 'DESC'));
              shuffle($temp_fighters);
              $featured_fighters = array_slice($temp_fighters, 0, 5);
              ?>
              <?php foreach ($featured_fighters as $key => $fighter) : setup_postdata($fighter);  ?>
                <div class="col-12 col-sm-6 col-lg-4 d-none d-sm-block">
                  <div class="fighter d-flex" style="background-repeat: no-repeat; background-image: url(<?php echo wp_get_attachment_image_src(attachment_url_to_postid(get_field('tbp_related_fighters_image', $fighter->ID)), "related-post-image")[0]; ?>); background-size: cover;">
                    <p class="name"><?php echo get_the_title($fighter->ID); ?></p>
                    <a href="<?php echo get_the_permalink($fighter->ID); ?>" class="link">Read More</a>
                  </div>
                </div>
                <div class="col-12 d-block d-sm-none">
                  <div class="fighter d-flex">
                    <div class="thumb" style="background-repeat: no-repeat; background-image: url(<?php echo wp_get_attachment_image_src(attachment_url_to_postid(get_field('tbp_related_fighters_image', $fighter->ID)), "related-post-image")[0]; ?>); background-size: cover;"></div>
                    <div class="overlay"></div>
                    <div class="d-flex flex-column align-items-center justify-content-center content">
                      <p class="name"><?php echo get_the_title($fighter->ID); ?></p>
                      <a href="<?php echo get_the_permalink($fighter->ID); ?>" class="link">Read More</a>
                    </div>
                  </div>
                </div>
              <?php endforeach;
              wp_reset_postdata(); ?>
            </div>
          </div>
        </div>
      </div>
      <!-- TODO: Need to add section "Here Are More Fighters You May Like" -->
    </div>
  </div>
</section>
