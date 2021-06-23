<section class="<?php echo TBP_PREFIX; ?>-single-container">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-12">
        <div class="d-flex justify-content-between">
          <div class="d-flex align-items-center">
            <?php echo get_avatar(get_the_author_meta('ID'), 42, '', '', array('class' => 'avatar')); ?>
            <span class="fullname"><?php echo get_the_author(); ?></span>
          </div>
          <div class="d-flex align-items-center">
            <?php
            if (have_rows('tbp_news_excerpt')) :
              while (have_rows('tbp_news_excerpt')) : the_row();
                $excerpt_location = get_sub_field('tbp_news_excerpt_location');
              endwhile;
            endif;
            ?>
            <p class="m-0">
              <?php if (!empty($excerpt_location)) : ?><span class="location"><?php echo $excerpt_location; ?> - </span><?php endif; ?>
              <span class="post-date"><?php the_date('M j, Y'); ?></span>
            </p>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="<?php echo TBP_PREFIX; ?>-single-title">
          <h4><?php the_title(); ?></h4>
          <input type="hidden" id="<?php echo TBP_PREFIX; ?>-current-url" value="<?php the_permalink(); ?>">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="img-wrapper w-100">
          <?php the_post_thumbnail( "single-header-image", array( "class" => "img-fluid w-100" )); ?>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="<?php echo TBP_PREFIX; ?>-single-content d-flex align-items-center">
          <?php require_once TBP_THEME_PATH . '/template-parts/social-share.php'; ?>
          <div class="content-inner w-100">
            <?php the_content(); ?>
            <?php if (have_rows('tbp_news_gallery')) : ?>
              <div class="clearfix gallery">
                <?php $counter = 0;
                while (have_rows('tbp_news_gallery')) : the_row(); ?>
                  <?php if ($counter == 0) : ?>
                    <a href="<?php echo get_sub_field('tbp_news_gallery_photo'); ?>" title="<?php echo get_sub_field('tbp_news_gallery_description'); ?>" class="main-thumb float-left" data-fancybox="gallery-<?php the_ID(); ?>" style="background-image: url('<?php echo wp_get_attachment_image_src(attachment_url_to_postid(get_sub_field('tbp_news_gallery_photo')), "single-gallery-first")[0]; ?>')">
                    </a>
                  <?php else : ?>
                    <a href="<?php echo get_sub_field('tbp_news_gallery_photo'); ?>" title="<?php echo get_sub_field('tbp_news_gallery_description'); ?>" class="sub-thumb float-left" data-fancybox="gallery-<?php the_ID(); ?>" style="background-image: url('<?php echo wp_get_attachment_image_src(attachment_url_to_postid(get_sub_field('tbp_news_gallery_photo')), "single-gallery-other")[0]; ?>')">
                    </a>
                  <?php endif; ?>
                  <?php $counter++; ?>
                <?php endwhile; ?>
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
