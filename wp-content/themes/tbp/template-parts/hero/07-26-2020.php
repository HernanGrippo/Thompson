<style>
	.tbp-hero {
		background-attachment: fixed;
		background-position: center;
		background-repeat: no-repeat;
		background-size: cover;
		display: flex;
		justify-content: center;
		padding-top: 60px;
		position: relative;
		text-align: center;
		top: 0;
		transition: all 0.5s ease-in-out;
		width: 100vw;
	}
	@media (min-width: 768px) {
		.tbp-hero.with-countdown {
			height: 880px;
		}
	}
	@media (min-width: 768px) {
		.tbp-hero.without-countdown {
			height: 805px;
		}
	}
	.tbp-hero.closed {
		height: 0;
		min-height: 0;
		top: -1000px;
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
	.tbp-hero .tbp-inplayer-top-logo {
		margin-top: 70px;
	}
	@media (min-width: 768px) {
		.tbp-hero .tbp-inplayer-top-logo {
			margin-top: 40px;
		}
	}
	.tbp-hero .tbp-inplayer-top-logo img {
		width: 180px;
	}
	@media (min-width: 768px) {
		.tbp-hero .tbp-inplayer-top-logo img {
			width: 240px;
		}
	}
	@media (min-width: 992px) {
		.tbp-hero .tbp-inplayer-top-logo img {
			width: 260px;
		}
	}
	.tbp-hero .tbp-inplayer-text {
		color: #a7a9ac;
		font-size: 12px;
		font-weight: bold;
		line-height: 18px;
		margin-bottom: 8px;
		margin-top: 10px;
		padding: 0;
	}
	@media (min-width: 768px) {
		.tbp-hero .tbp-inplayer-text {
			margin-bottom: 20px;
			margin-top: 20px;
		}
	}
	@media (min-width: 992px) {
		.tbp-hero .tbp-inplayer-text {
			margin-bottom: 14px;
		}
	}
	.tbp-hero .tbp-inplayer-main-logo img {
		width: 156px;
	}
	@media (min-width: 768px) {
		.tbp-hero .tbp-inplayer-main-logo img {
			width: 236px;
		}
	}
	@media (min-width: 992px) {
		.tbp-hero .tbp-inplayer-main-logo img {
			width: 236px;
		}
	}
	.tbp-hero .tbp-price {
		margin-bottom: 0;
		margin-top: 24px;
	}
	.tbp-hero .tbp-price strong,
	.tbp-hero .tbp-price span {
		font-size: 16px;
		line-height: 24px;
	}
	@media (min-width: 768px) {
		.tbp-hero .tbp-price strong,
	.tbp-hero .tbp-price span {
			font-size: 20px;
			line-height: 32px;
		}
	}
	.tbp-hero .tbp-price span {
		color: #a7a9ac;
		font-weight: normal;
	}
	.tbp-hero .tbp-inplayer-button {
		margin-top: 30px;
	}
	.tbp-hero .tbp-inplayer-button a {
		background-color: #be1e2d;
		color: #ffffff;
		display: inline-block;
		font-size: 18px;
		font-weight: bold;
		line-height: 28px;
		padding: 14px 19px;
		text-decoration: none;
		text-transform: uppercase;
	}
	.tbp-hero .tbp-inplayer-button a:before {
		border-color: transparent transparent transparent #ffffff;
		border-style: solid;
		border-width: 10px 0 10px 14px;
		content: "";
		display: inline-block;
		height: 0;
		line-height: 0px;
		margin-right: 13px;
		vertical-align: text-bottom;
		width: 0;
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
	.tbp-hero .tbp-inplayer-countdown > div {
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
		.tbp-hero .tbp-inplayer-countdown > div {
			font-size: 40px;
			line-height: 44px;
		}
	}
	.tbp-hero .tbp-inplayer-countdown > div:last-child {
		margin-right: 0;
	}
	.tbp-hero .tbp-inplayer-countdown > div span {
		color: #a7a9ac;
		font-size: 12px;
		font-weight: normal;
		letter-spacing: 0.01em;
		line-height: 18px;
		margin-left: 10px;
	}
	.tbp-hero .tbp-inplayer-detail {
		display: block;
		margin-top: 28px;
	}
	.tbp-hero .tbp-inplayer-detail > div {
		display: inline-block;
	}
	.tbp-hero .tbp-inplayer-detail > div.detail-left span {
		color: #a7a9ac;
	}
	.tbp-hero .tbp-inplayer-detail > div.detail-right {
		display: none;
	}
	.tbp-hero .tbp-inplayer-info {
		margin-top: 30px;
		padding-bottom: 40px;
	}
	@media (min-width: 768px) {
		.tbp-hero .tbp-inplayer-info {
			padding-bottom: inherit;
		}
	}
	.tbp-hero .tbp-inplayer-info img {
		height: inherit;
		padding-left: 40px;
		padding-right: 40px;
		width: 100%;
	}
	@media (min-width: 576px) {
		.tbp-hero .tbp-inplayer-info img {
			padding-left: 0;
			padding-right: 0;
			width: 340px;
		}
	}
	@media (min-width: 768px) {
		.tbp-hero .tbp-inplayer-info img {
			width: 540px;
		}
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
    class="<?php echo TBP_PREFIX; ?>-hero<?php if($p_closed) echo ' closed'; ?>"
    style="background-image: url(<?php echo get_site_url(); ?>/wp-content/uploads/2020/06/tbp_inplayer_banner-bg.png);">
    <div
      class="wrapper"
      style="background-image: url(<?php echo get_site_url(); ?>/wp-content/uploads/2020/06/tbp_inplayer_banner-faces.png);">
      <div class="d-xl-flex h-100 w-100 justify-content-center align-items-center">
        <div class="d-flex flex-column h-100">
          <div class="<?php echo TBP_PREFIX; ?>-inplayer-top-logo">
            <img src="<?php echo get_site_url(); ?>/wp-content/uploads/2020/06/tbp_inplayer_banner-321-logo.png" alt="">
          </div>
          <p class="<?php echo TBP_PREFIX; ?>-inplayer-text">PRESENTED BY</p>
          <div class="<?php echo TBP_PREFIX; ?>-inplayer-main-logo">
            <img src="<?php echo get_site_url(); ?>/wp-content/uploads/2020/06/tbp_inplayer_banner-tbp-logo.svg" alt="">
          </div>
          <p class="<?php echo TBP_PREFIX; ?>-price">
            <strong>$6.50</strong> <span>(US Territory)</span> <strong>$3.50</strong> <span>(Latin America)</span>
          </p>
          <?php if (!empty(trim(get_sub_field('tbp_livestream_id', 'home_options')))) : ?>
            <div class="<?php echo TBP_PREFIX; ?>-inplayer-button">
              <a href="javascript:;" data-src="#inplayer-video" data-fancybox="inplayer-1" class="inplayer-fancy"><?php echo get_sub_field('tbp_livestream_button_text', 'home_options'); ?></a>
            </div>
          <?php endif; ?>
          <div class="<?php echo TBP_PREFIX; ?>-inplayer-countdown">
            <div id="days"></div>
            <div id="hours"></div>
            <div id="minutes"></div>
            <div id="seconds"></div>
          </div>
          <div class="<?php echo TBP_PREFIX; ?>-inplayer-detail">
            <div class="detail-left">4:30 pm <span>PST</span> | 7:30 pm <span>EST</span> | 5:30 pm <span>CST</span></div>
            <div class="detail-right"><?php echo get_sub_field('tbp_alert_text', 'home_options'); ?></div>
          </div>
          <div class="<?php echo TBP_PREFIX; ?>-inplayer-info">
            <img src="<?php echo get_site_url(); ?>/wp-content/uploads/2020/06/tbp_inplayer_banner-info.png" alt="" class="img-fluid">
          </div>
          <div class="d-none d-md-block">
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
  </section>
  <?php require_once TBP_THEME_PATH . '/template-parts/inplayer-video.php'; ?>
<?php endwhile; ?>
