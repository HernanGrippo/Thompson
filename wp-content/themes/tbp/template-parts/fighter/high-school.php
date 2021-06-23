<div class="high-school">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <p class="high-school-header"><?php echo get_sub_field('header'); ?></p>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="high-school-container">
          <?php while (have_rows('items')) : the_row(); ?>
            <p class="high-school-text"><?php echo get_sub_field('text'); ?></p>
          <?php endwhile; ?>
        </div>
      </div>
    </div>
  </div>
</div>
