<section class="<?php echo TBP_PREFIX; ?>-promotions">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<h4 class="title"><?php echo get_sub_field('title'); ?></h4>
			</div>
			<div class="col-12">
				<div class="glide promotions-glide">
					<div class="glide__track" data-glide-el="track">
						<ul class="glide__slides">
							<!-- <li class="glide__slide d-flex align-self-center">
                <div class="h-100">
                  <img src="<?php echo get_site_url(); ?>/wp-content/uploads/2020/10/slide1.jpg" alt="slide #1" class="w-100 img-fluid">
                </div>
							</li>
							<li class="glide__slide d-flex align-self-center">
                <div class="h-100">
                  <img src="<?php echo get_site_url(); ?>/wp-content/uploads/2020/10/slide2.jpg" alt="slide #2" class="w-100 img-fluid">
                </div>
              </li> -->
					    <?php while (have_rows('slide')) : the_row(); ?>
								<li class="glide__slide d-flex align-self-center">
									<div class="h-100">
										<a href="<?php echo get_sub_field('link'); ?>" title="<?php echo get_sub_field('link'); ?>">
											<img src="<?php echo get_sub_field('image')['url']; ?>" alt="<?php echo get_sub_field('link'); ?>" class="w-100 img-fluid">
										</a>
									</div>
								</li>
							<?php endwhile; ?>
						</ul>
					</div>
					<!-- <div class="glide__bullets" data-glide-el="controls[nav]">
						<button class="glide__bullet" data-glide-dir="=0"></button>
            <button class="glide__bullet" data-glide-dir="=1"></button>
            <button class="glide__bullet" data-glide-dir="=2"></button>
					</div> -->
				</div>
			</div>
		</div>
	</div>
</section>
