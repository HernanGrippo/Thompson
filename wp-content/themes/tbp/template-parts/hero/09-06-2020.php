



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
<section id="<?php echo TBP_PREFIX; ?>-hero" class="<?php echo TBP_PREFIX; ?>-hero">
	<div class="wrapper">
		<div class="d-flex h-100 w-100 justify-content-center align-items-center">
			<div class="embed-responsive embed-responsive-21by9">
				<iframe id="ls_embed_1599411372"
					src="https://livestream.com/accounts/23289909/events/9280617/player?width=640&height=360&enableInfoAndActivity=true&defaultDrawer=&autoPlay=true&mute=false"
					width="640" height="360" frameborder="0" scrolling="no" allowfullscreen> </iframe>
				<script type="text/javascript" data-embed_id="ls_embed_1599411372"
					src="https://livestream.com/assets/plugins/referrer_tracking.js"></script>
			</div>
		</div>
	</div>
</section>


