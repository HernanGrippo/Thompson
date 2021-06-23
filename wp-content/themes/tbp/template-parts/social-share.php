<?php while (have_rows('tbp_social_share_options', 'home_options')) : the_row(); ?>
  <div class="single-social-share">
    <ul>
      <?php while (have_rows('tbp_social_medias', 'home_options')) : the_row(); ?>
        <li><a href="#" data-toggle="popover" title="<?php echo get_sub_field('title', 'home_options'); ?>" id="<?php echo get_sub_field('id', 'home_options'); ?>" target="_blank"><img src="<?php echo get_sub_field('icon', 'home_options'); ?>" alt="<?php echo get_sub_field('title', 'home_options'); ?>"></a></li>
      <?php endwhile; ?>
    </ul>
    <span class="share-title"><?php echo get_sub_field('tbp_share_text', 'home_options'); ?></span>
  </div>
<?php endwhile; ?>
