<?php

/**
 * @var array $args
 */


?>

<?php //while(have_rows('tbp_intro_options', 'home_options')): the_row(); 
?>
<div class="container position-relative">
	<div class="row <?php echo TBP_PREFIX; ?>-intro">
		<div class="col-12">
			<h1><?php echo $args[0]; ?></h1>
		</div>
	</div>
</div>
<?php //endwhile; 
?>