<div class="fighter-gallery">
  <div class="container">
    <div class="row">
      <?php while (have_rows('images')) : the_row(); ?>
        <div class="col-6 col-lg-3">
          <a href="<?php echo get_sub_field('image'); ?>" data-fancybox="gallery-<?php the_ID(); ?>">
            <img
              class="img-fluid"
              src="<?php echo wp_get_attachment_image_src(attachment_url_to_postid(get_sub_field('image')), "fighter-gallery-square")[0]; ?>"
              alt="<?php echo get_sub_field('alt'); ?>">
          </a>
        </div>
      <?php endwhile; ?>
    </div>
  </div>
</div>
