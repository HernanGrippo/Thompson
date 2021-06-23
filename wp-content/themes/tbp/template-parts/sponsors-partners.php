<section class="<?php echo TBP_PREFIX; ?>-sponsors">
  <div class="container">
    <?php while (have_rows('special_sponsors')) : the_row(); ?>
      <div class="row sponsors-row">
        <div class="col-12">
          <p class="sponsors-header"><?php echo get_sub_field('title'); ?></p>
          <hr>
          <div class="logo-container">
            <?php while (have_rows('logos')) : the_row(); ?>
              <img src="<?php echo get_sub_field('logo')['url']; ?>" width="<?php echo get_sub_field('width'); ?>" alt="<?php echo get_sub_field('logo')['title']; ?>" />
            <?php endwhile; ?>
          </div>
        </div>
      </div>
    <?php endwhile; ?>
    <?php while (have_rows('media_partners')) : the_row(); ?>
      <div class="row partners-row">
        <div class="col-12">
          <p class="partners-header"><?php echo get_sub_field('title'); ?></p>
          <div class="logo-container">
            <?php while (have_rows('logos')) : the_row(); ?>
              <a href="<?php echo get_sub_field('url'); ?>" title="<?php echo get_sub_field('logo')['title']; ?>" target="_blank">
                <img src="<?php echo get_sub_field('logo')['url']; ?>" width="<?php echo get_sub_field('width'); ?>" alt="<?php echo get_sub_field('logo')['title']; ?>" />
              </a>
            <?php endwhile; ?>
          </div>
        </div>
      </div>
    <?php endwhile; ?>
  </div>
</section>