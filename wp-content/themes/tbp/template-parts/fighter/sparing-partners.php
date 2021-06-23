<div class="sparring-partners">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <p class="partners-header"><?php echo get_sub_field('header'); ?></p>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <?php while (have_rows('items')) : the_row(); ?>
        <div class="ol-12 col-md-6 col-lg-4 partners-container">
          <div class="d-flex flex-columns align-items-center">
            <?php $image = !empty(get_sub_field('image')) ? get_sub_field('image') : TBP_THEME_URL . "/public/assets/images/default_avatar.jpg"; ?>
            <img src="<?php echo $image; ?>" alt="<?php echo get_sub_field('name'); ?>" class="rounded-circle">
            <span class="partners-text"><?php echo get_sub_field('name'); ?></span>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  </div>
</div>
