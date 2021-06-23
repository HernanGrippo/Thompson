<?php while (have_rows('tbp_quote_options', 'home_options')) : the_row(); ?>
<section class="<?php echo TBP_PREFIX; ?>-quote text-center">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<blockquote>
					<i class="fas fa-quote-right <?php echo TBP_PREFIX; ?>-b-left"></i>
					<?php echo get_sub_field('tbp_quote_text', 'home_options'); ?>
					<i class="fas fa-quote-right <?php echo TBP_PREFIX; ?>-b-right"></i>
				</blockquote>
			</div>
		</div>
	</div>
</section>
<?php endwhile; ?>
