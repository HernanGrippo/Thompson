<style>
  .tbp-hero {
    background-position: top;
    background-repeat: no-repeat;
    background-size: cover;
    display: flex;
    justify-content: center;
    margin-top: 0;
    opacity: 1;
    position: relative;
    text-align: center;
    transition: visibility 0.25s, opacity 0.5s linear;
    visibility: visible;
    width: 100vw;
    z-index: 100;
  }

  .tbp-hero.closed {
    opacity: 0;
    visibility: hidden;
    position: absolute;
    transition: visibility 0.075s, opacity 0.125s linear;
  }

  .tbp-hero .wrapper {
    background-position: top;
    background-repeat: no-repeat;
    background-size: contain;
    display: flex;
    height: 100%;
    width: 100%;
  }

  @media (min-width: 992px) {
    .tbp-hero .wrapper {
      background-position: center;
      background-size: cover;
    }
  }

  @media (min-width: 1200px) {
    .tbp-hero .wrapper {
      align-self: center;
    }
  }
</style>

<?php global $p_closed; ?>
<?php while (have_rows('tbp_hero_options', 'home_options')) : the_row(); ?>
  <section id="<?php echo TBP_PREFIX; ?>-hero" class="<?php echo TBP_PREFIX; ?>-hero<?php if ($p_closed) echo ' closed'; ?>">
    <div class="wrapper">
      <?php if (get_sub_field('tbp_hero_type') == 'image') : ?>
        <div class="d-xl-flex h-100 w-100 justify-content-center align-items-center">
          <div class="position-relative w-100 d-block d-md-none">
            <img src="<?php echo get_sub_field('tbp_hero_mobile_image', 'home_options'); ?>" class="w-100 img-fluid">
          </div>
          <div class="position-relative w-100 d-none d-md-block">
            <img src="<?php echo get_sub_field('tbp_hero_desktop_image', 'home_options'); ?>" class="w-100 img-fluid">
          </div>
        </div>
      <?php elseif (get_sub_field('tbp_hero_type') == 'video') : ?>
        <div class="d-flex h-100 w-100 justify-content-center align-items-center">
          <div class="embed-responsive embed-responsive-21by9">
            <iframe id="ls_embed_<?php echo get_sub_field('tbp_hero_embed_id', 'home_options'); ?>" src="https://livestream.com/accounts/23289909/events/<?php echo get_sub_field('tbp_hero_video_id', 'home_options'); ?>/player?width=640&height=360&enableInfoAndActivity=true&defaultDrawer=&autoPlay=true&mute=false" width="640" height="360" frameborder="0" scrolling="no" allowfullscreen> </iframe>
            <script type="text/javascript" data-embed_id="ls_embed_<?php echo get_sub_field('tbp_hero_embed_id', 'home_options'); ?>" src="https://livestream.com/assets/plugins/referrer_tracking.js"></script>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </section>
  <?php require_once TBP_THEME_PATH . '/template-parts/inplayer-video.php'; ?>
<?php endwhile; ?>
