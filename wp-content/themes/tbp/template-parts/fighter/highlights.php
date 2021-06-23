<div class="amateur-highlights">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <p class="highlight-header text-center"><?php echo get_sub_field('header'); ?></p>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <?php $counter = 1; ?>
      <?php $count_of_items = count(get_sub_field('items')); ?>
      <?php while (have_rows('items')) : the_row(); ?>
        <!-- TODO: Need to explain Cholde why this change has been done of this way -->
        <div class="highlight-container col-12 col-lg-6">
          <div class="d-flex flex-column flex-md-row">
            <div> <img src="<?php echo get_sub_field('icon'); ?>" alt="Medal"></div>
            <div class="d-flex flex-column">
            <p class="highlight-title"><?php echo get_sub_field('title'); ?></p>
            <p class="highlight-text" ><?php echo get_sub_field('text'); ?></p>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  </div>
</div>
