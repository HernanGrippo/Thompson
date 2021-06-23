<?php if (!empty(trim(get_sub_field('tbp_livestream_id', 'home_options')))) : ?>
  <div id="<?php echo TBP_PREFIX; ?>-inplayer-video" class="<?php echo TBP_PREFIX; ?>-inplayer-video">
    <div class="stripe"></div>
    <div id="inplayer-<?php echo get_sub_field('tbp_livestream_id', 'home_options'); ?>" class="inplayer-paywall"></div>
    <script>
      var paywall = new InplayerPaywall('<?php echo get_sub_field('tbp_livestream_video_key', 'home_options'); ?>', [{
        id: <?php echo get_sub_field('tbp_livestream_id', 'home_options'); ?>
      }]);
    </script>
  </div>
<?php endif; ?>
