<?php
while (have_rows('tbp_fix_social_media_options', 'home_options')) : the_row();
?>
  <div class="<?php echo TBP_PREFIX; ?>-fix-social d-none d-lg-flex">
    <a href="mailto:info@thompsonboxing.com" target="_blank">
      <img src="<?php echo get_sub_field('tbp_email_us_image', 'home_options'); ?>" alt="email us" class="email-us" />
    </a>
    <ul class="socials">
      <?php
      while (have_rows('tbp_social_medias', 'home_options')) : the_row();
      ?>
        <li>
          <a href="<?php echo get_sub_field('link', 'home_options'); ?>" title="<?php echo get_sub_field('title', 'home_options'); ?>">
            <img src="<?php echo get_sub_field('icon', 'home_options'); ?>" alt="<?php echo sanitize_title(get_sub_field('title', 'home_options')); ?>" />
          </a>
        </li>
      <?php endwhile; ?>
    </ul>
    <img src="<?php echo get_sub_field('tbp_find_us_at_image', 'home_options'); ?>" alt="find us at" class="find-us-at" />
  </div>
<?php endwhile; ?>
