<? //while(have_rows('tbp_logo_options', 'home_options')): the_row(); ?>
<div class="row <?php echo TBP_PREFIX; ?>-logo">
  <div class="col-12">
    <?php /*
		<a href="<?php echo get_site_url(); ?>" aria-label="Home"><img class="img-fluid d-none d-sm-block mx-auto logo-desktop" src="<?php echo get_sub_field('tbp_logo', 'home_options'); ?>" alt="<?php echo get_sub_field('tbp_logo_alt_text', 'home_options'); ?>"></a>
    */ ?>
    <a href="<?php echo get_site_url(); ?>" aria-label="Home">
      <img class="img-fluid" src="<?php echo TBP_THEME_URL.'public/assets/images/logo-light.svg'; ?>" alt="<?php echo get_bloginfo( 'name' ); ?>">
    </a>
  </div>
</div>
<? //endwhile; ?>