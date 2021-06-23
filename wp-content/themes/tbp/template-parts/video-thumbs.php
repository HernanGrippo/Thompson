<?php while (have_rows('tbp_video_thumbs_options', 'home_options')) : the_row(); ?>
  <section class="<?php echo TBP_PREFIX; ?>-video-thumbs">
    <div class="container">
      <div class="row">
        <div class="col-12 text-center">
          <h4><?php echo get_sub_field('tbp_video_thumbs_header', 'home_options'); ?></h4>
          <div class="glide">
            <div data-glide-el="track" class="glide__track">
              <ul class="glide__slides">
                <?php while (have_rows('tbp_video_thumbs_content', 'home_options')) : the_row(); ?>
                  <li class="glide__slide <?php echo TBP_PREFIX; ?>-slick-content">
                    <a href="<?php echo get_sub_field('tbp_video_thumbs_content_video', 'home_options'); ?>" target="_blank" title="<?php echo get_sub_field('tbp_video_thumbs_content_alt_text', 'home_options'); ?>">
                      <div class="<?php echo TBP_PREFIX; ?>-slick-overlay"></div>
                      <img class="img-fluid" src="<?php echo get_sub_field('tbp_video_thumbs_content_image', 'home_options'); ?>" alt="<?php echo get_sub_field('tbp_video_thumbs_content_alt_text', 'home_options'); ?>" />
                      <h6><span><?php echo get_sub_field('tbp_video_thumbs_content_title', 'home_options'); ?></span></h6>
                    </a>
                  </li>
                <?php endwhile; ?>
              </ul>
            </div>
            <div class="glide__bullets" data-glide-el="controls[nav]">
              <?php $counter = 0;
              while (have_rows('tbp_video_thumbs_content', 'home_options')) : the_row(); ?>
                <button class="glide__bullet" data-glide-dir="=<?php echo $counter; ?>"></button>
              <?php $counter++;
              endwhile; ?>
            </div>
          </div>
          <p class="subText"><?php echo get_sub_field('tbp_video_thumbs_sub_text', 'home_options'); ?></p>
        </div>
      </div>
    </div>
  </section>
<?php endwhile; ?>
