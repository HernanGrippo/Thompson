<?php global $p_closed; ?>
<?php while (have_rows('tbp_top_bar_options', 'home_options')) : the_row(); ?>
  <section class="<?php echo TBP_PREFIX; ?>-top-bar<?php if ($p_closed) echo ' closed'; ?>">
    <div class="container-fluid top-bar-wrapper">
      <div class="row">
        <div class="col-12 col-md-6">
          <div class="d-block d-md-none">
            <div class="d-flex justify-content-between">
              <div class="d-flex align-items-center">
                <img src="<?php echo get_sub_field('tbp_top_bar_icon', 'home_options'); ?>" alt="Star">
              </div>
              <p class="text-center"><?php echo get_sub_field('tbp_top_bar_text', 'home_options'); ?></p>
              <div class="d-flex align-items-center">
                <img src="<?php echo get_sub_field('tbp_top_bar_icon', 'home_options'); ?>" alt="Star">
              </div>
            </div>
          </div>
          <div class="d-none d-md-block h-100">
            <div class="h-100 d-flex align-items-center">
              <div class="d-flex align-items-center">
                <img src="<?php echo get_sub_field('tbp_top_bar_icon', 'home_options'); ?>" class="icon" alt="Star">
              </div>
              <p class="text-center"><?php echo get_sub_field('tbp_top_bar_text', 'home_options'); ?></p>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-6 p-0">
          <div class="d-none d-md-block h-100">
            <div class="d-flex align-items-center justify-content-end">
            <?php if($p_closed): ?>
              <a href="<?php echo TBP_PREFIX; ?>-hero" class="bar-close closed"><?php echo get_sub_field('tbp_hero_closed_button_text', 'home_options'); ?></a>
            <?php else: ?>
              <a href="<?php echo TBP_PREFIX; ?>-hero" class="bar-close"><?php echo get_sub_field('tbp_hero_close_button_text', 'home_options'); ?></a>
            <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
<?php endwhile; ?>


