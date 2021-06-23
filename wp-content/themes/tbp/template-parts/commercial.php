<?php while (have_rows('tbp_commercial_options', 'home_options')) : the_row(); ?>
  <?php if (!empty(get_sub_field('text', 'home_options')) && !empty(get_sub_field('logo', 'home_options'))) : ?>
    <section class="<?php echo TBP_PREFIX; ?>-commercial">
      <div class="container">
        <div class="row">
          <div class="col-12 text-center">
            <h5><?php echo get_sub_field('text', 'home_options'); ?></h5>
            <p><?php echo get_sub_field('tbp_logo_header', 'home_options'); ?></p>
				    <hr>
            <img src="<?php echo get_sub_field('logo', 'home_options'); ?>" alt="Commercial Logo">
          </div>
        </div>
      </div>
    </section>
  <?php endif; ?>
<?php endwhile; ?>
