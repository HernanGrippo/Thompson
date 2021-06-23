<?php while (have_rows('tbp_navigation_options', 'home_options')) : the_row(); ?>
  <section id="<?php echo TBP_PREFIX; ?>-navigation" class="<?php echo TBP_PREFIX; ?>-navigation">
    <div class="top">
      <button class="nav-close" id="<?php echo TBP_PREFIX; ?>-navigation-icon-close">
        <img src="<?php echo TBP_THEME_URL; ?>public/assets/images/navigation-close.svg" alt="Navigation Close Button" />
      </button>
    </div>
    <?php
    wp_nav_menu(
      array(
        'theme_location'  => 'tbp-menu',
        'menu' => 'tbp-menu',
        'container' => '',
        'items_wrap' => '<ul class="list-unstyled ' . TBP_PREFIX . '-menu">%3$s</ul>',
      )
    );
    ?>
    <div class="<?php echo TBP_PREFIX; ?>-contact">
      <h3 class="label"><?php echo get_sub_field('tbp_contact_title'); ?></h3>
      <?php echo get_sub_field('tbp_contact_text'); ?>
    </div>
    <div class="<?php echo TBP_PREFIX; ?>-social">
      <?php while (have_rows('tbp_footer_options', 'home_options')) : the_row(); ?>
        <h3 class="label"><?php echo get_sub_field('tbp_footer_social_media_title'); ?></h3>
      <?php endwhile; ?>
      <ul class="list-unstyled <?php echo TBP_PREFIX; ?>-social">
        <?php
        $socialMediaOptions = [];

        while (have_rows('tbp_social_media_options', 'home_options')) : the_row();
          $socialMediaOptions['tbp_social_media_follow_text'] = get_sub_field('tbp_social_media_follow_text', 'home_options');
          $socialMediaOptions['tbp_social_media_email_text'] = get_sub_field('tbp_social_media_email_text', 'home_options');
          $socialMediaOptions['tbp_social_media_email_address'] = get_sub_field('tbp_social_media_email_address', 'home_options');

          $counter = 0;
          while (have_rows('tbp_social_media_items', 'home_options')) : the_row();
            $socialMediaOptions['tbp_social_medias'][$counter]['tbp_social_media_item_alt_text'] = get_sub_field('tbp_social_media_item_alt_text', 'home_options');
            $socialMediaOptions['tbp_social_medias'][$counter]['tbp_social_media_item_link'] = get_sub_field('tbp_social_media_item_link', 'home_options');
            $counter++;
          endwhile;
        endwhile;
        ?>
        <?php foreach ($socialMediaOptions['tbp_social_medias'] as $socialMediaItem) : ?>
          <li>
            <a href="<?php echo $socialMediaItem['tbp_social_media_item_link']; ?>" title="<?php echo $socialMediaItem['tbp_social_media_item_alt_text']; ?>" class="item" target="_blank">
              <?php echo $socialMediaItem['tbp_social_media_item_alt_text']; ?>
            </a>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </section>
<?php endwhile; ?>