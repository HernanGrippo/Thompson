<?php if (get_sub_field('activation_of_fighters') === true) : ?>
  <section class="<?php echo TBP_PREFIX; ?>-fighters">
    <div class="container">
      <!-- <div class="row">
        <div class="col-12">
          <h4 id="fighter-header">
            <?php // echo get_sub_field('tbp_fighters_header'); ?>
          </h4>
        </div>
      </div> -->
      <div class="row fighter-row justify-content-start">
        <?php while (have_rows('s')) : the_row(); ?>
          <a href="<?php echo get_sub_field('link'); ?>" class="col-12 col-md-6 col-lg-4">
            <div class="fighter-container">
              <div class="image-wrapper mx-auto">
                <img src="<?php echo get_sub_field('image')['url']; ?>" alt="<?php echo get_sub_field('full_name'); ?>" class="img-fluid rounded-circle">
                <div class="image-overlay"></div>
                <!-- TODO: Do NOT remove this tag. It will be enabled once we have fighters videos -->
                <!-- <div class="play"></div> -->
              </div>
              <div class="fighter-meta">
                <div class="status">
                  <?php
                  $fighter_id = get_sub_field('fighter_id');
                  $fighter_records = tbp_get_fighter_records($fighter_id);
                  ?>
                  <?php echo tbp_print_fighters_square($fighter_id, 'home'); ?>
                  <span class="bio-text"><?php echo $fighter_records['win']; ?> - <?php echo $fighter_records['lost']; ?>, <?php echo get_sub_field('ko_records'); ?></span>
                </div>
              </div>
              <div class="fighter-name">
                <?php echo get_sub_field('full_name'); ?>
              </div>
              <div class="nickname">
                <?php echo get_sub_field('nickname'); ?>
              </div>
              <div class="fighter-bio-excerpt">
                <?php echo get_sub_field('text'); ?>
              </div>
              <span href="" class="bio-read-more"><?php echo get_sub_field('link_text'); ?></span>
            </div>
          </a>
        <?php endwhile; ?>
      </div>
    </div>
  </section>
<?php endif; ?>