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

	.tbp-hero .tbp-inplayer-countdown {
		align-items: center;
		display: none;
		justify-content: center;
		margin-top: 28px;
	}

	@media (min-width: 768px) {
		.tbp-hero .tbp-inplayer-countdown {
			display: flex;
		}
	}

	.tbp-hero .tbp-inplayer-countdown>div {
		align-items: center;
		color: #ffffff;
		display: flex;
		float: left;
		font-size: 38px;
		font-weight: normal;
		line-height: 42px;
		justify-content: center;
		margin-right: 50px;
	}

	@media (min-width: 992px) {
		.tbp-hero .tbp-inplayer-countdown>div {
			font-size: 40px;
			line-height: 44px;
		}
	}

	.tbp-hero .tbp-inplayer-countdown>div:last-child {
		margin-right: 0;
	}

	.tbp-hero .tbp-inplayer-countdown>div span {
		color: #a7a9ac;
		font-size: 12px;
		font-weight: normal;
		letter-spacing: 0.01em;
		line-height: 18px;
		margin-left: 10px;
	}

	.tbp-hero .tbp-inplayer-scroll-down {
		margin-top: 34px;
	}

	.tbp-hero .tbp-inplayer-scroll-down a {
		animation-duration: 3s;
		animation-iteration-count: infinite;
		animation-name: pulse;
		display: block;
		text-decoration: none;
	}

	@keyframes pulse {
		from {
			transform: scale(1);
		}

		50% {
			transform: scale(0.95);
		}

		to {
			transform: scale(1);
		}
	}

	.tbp-hero .tbp-inplayer-scroll-down a img {
		margin-bottom: 20px;
	}

	.tbp-hero .tbp-inplayer-scroll-down a .scroll-text {
		color: #d4d4d5;
		font-size: 12px;
		font-weight: normal;
		letter-spacing: 0.7em;
		line-height: 18px;
		margin-bottom: 0;
	}
</style>

<?php global $p_closed; ?>
<?php while (have_rows('tbp_hero_options', 'home_options')) : the_row(); ?>
  <section
    id="<?php echo TBP_PREFIX; ?>-hero"
    class="<?php echo TBP_PREFIX; ?>-hero<?php if($p_closed) echo ' closed'; ?>">
    <div class="wrapper">
      <div class="d-xl-flex h-100 w-100 justify-content-center align-items-center">
        <div class="position-relative w-100">
          <img src="<?php echo get_site_url(); ?>/wp-content/uploads/2020/09/hero-set-09-26-2020.jpg" class="w-100">
          <div class="position-absolute" style="bottom: 20px; left: 50%; transform: translateX(-50%);">
            <div class="d-none">
              <div class="<?php echo TBP_PREFIX; ?>-inplayer-scroll-down">
                <a href="#">
                  <img width="20" src="<?php echo MNT_PLUGIN_URL; ?>/dist/assets/images/hero/tbp_inplayer_banner-arrow.svg" alt="Scroll Down">
                  <p class="scroll-text"><?php echo get_sub_field('tbp_scroll_text', 'home_options'); ?></p>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php require_once TBP_THEME_PATH . '/template-parts/inplayer-video.php'; ?>
<?php endwhile; ?>
