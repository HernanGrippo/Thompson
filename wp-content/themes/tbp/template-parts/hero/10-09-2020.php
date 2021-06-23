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
      <div class="d-xl-flex h-100 w-100 justify-content-center align-items-center">
        <!-- <div class="position-relative w-100 d-block d-md-none">
          <img src="<?php echo get_site_url(); ?>/wp-content/uploads/2020/10/hero-mobile-11-01-2020.jpg" class="w-100 img-fluid">
        </div>
        <div class="position-relative w-100 d-none d-md-block"> -->
          <img src="<?php echo get_site_url(); ?>/wp-content/uploads/2020/10/hero-large-10-09-2020.jpg" class="w-100 img-fluid">
        <!-- </div> -->
      </div>
    </div>
  </section>
  <?php require_once TBP_THEME_PATH . '/template-parts/inplayer-video.php'; ?>
<?php endwhile; ?>
