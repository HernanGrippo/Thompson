<div class="col-12">
  <div class="<?php echo TBP_PREFIX; ?>-fighter-header">
    <div class="fighter-header-inner">
      <div class="header-overlay"></div>
      <!-- We need to add another AFC for mobile images: 317x710 -->
      <div class="img-wrapper">
        <style>
          .img-bg {
            background-image: url(<?php echo wp_get_attachment_image_src(attachment_url_to_postid(get_sub_field('image')), "fighter-mobile-header")[0]; ?>);
            background-position: top;
            background-repeat: no-repeat;
            background-size: cover;
            min-height: 600px;
          }
          @media (min-width: 576px) {
            .img-bg {
              background-image: url(<?php echo wp_get_attachment_image_src(attachment_url_to_postid(get_sub_field('image')), "single-header-image")[0]; ?>);
              min-height: inherit;
            }
          }
        </style>
        <div class="img-bg">
          <div class="fighter-caption position-absolute">
            <p class="nickname"><?php echo get_sub_field("nickname"); ?></p>
            <h1><?php the_title(); ?></h1>
            <p class="records">
              <?php
              $fighter_id = get_the_ID();
              $fighter_records = tbp_get_fighter_records($fighter_id);
              ?>
              <?php echo $fighter_records['win']; ?> - <?php echo $fighter_records['lost']; ?>, <?php echo get_sub_field('ko_records'); ?>
            </p>
            <div class="squares">
              <?php echo tbp_print_fighters_square($fighter_id); ?>
            </div>
          </div>
        </div>
      </div>
      <input type="hidden" id="<?php echo TBP_PREFIX; ?>-current-url" value="<?php the_permalink(); ?>">
    </div>
  </div>
</div>
