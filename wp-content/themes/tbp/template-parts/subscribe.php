<?php while (have_rows('tbp_subscribe_options', 'home_options')) : the_row(); ?>
  <section class="<?php echo TBP_PREFIX; ?>-subscribe">
    <div class="container">
      <div class="row">
        <div class="col-12 text-center <?php if(empty(get_sub_field('tbp_subscribe_logo', 'home_options'))): ?>without-logo<?php endif; ?>">
          <?php if(!empty(get_sub_field('tbp_subscribe_logo', 'home_options'))): ?>
          <img src="<?php echo get_sub_field('tbp_subscribe_logo', 'home_options'); ?>" class="img-fluid" alt="TBP Subscribe Logo" />
          <?php endif; ?>
          <h4><?php echo get_sub_field('tbp_subscribe_title', 'home_options'); ?></h4>
          <p><?php echo get_sub_field('tbp_subscribe_sub_text', 'home_options'); ?></p>
          <form id="<?php echo TBP_PREFIX; ?>-subscribe-form" class="form-inline" name="<?php echo TBP_PREFIX; ?>-subscribe-form">
            <div class="input-group col-9 mx-auto">
              <input type="text" class="form-control" placeholder="<?php echo get_sub_field('tbp_subscribe_input_placeholder', 'home_options'); ?>" name="email_address" id="email_address" />
              <span class="input-group-btn">
                <button class="btn <?php echo TBP_PREFIX; ?>-subscribe-btn my-auto" type="submit"><img src="<?php echo TBP_THEME_URL; ?>public/assets/images/envelop-icon.svg" /></button>
              </span>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
<?php endwhile; ?>
