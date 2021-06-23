<div class="fighter-content">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <?php while (have_rows('items')) : the_row(); ?>
          <p><?php echo get_sub_field('text'); ?></p>
        <?php endwhile; ?>
      </div>
    </div>
  </div>
</div>
