<?php

/**
 * Template Name: Front Page
 */

global $post;

?>

<?php require_once TBP_THEME_PATH . '/template-parts/header.php'; ?>

<div class="<?php echo TBP_PREFIX; ?>-page <?php echo TBP_PREFIX; ?>-page-home">
  <div class="shape">

    <?php

    if (have_rows('homeContent')) :

      while (have_rows('homeContent')) : the_row();

        if (get_row_layout() == 'sponsorsBlock') :
          require TBP_THEME_PATH . '/template-parts/sponsors-partners.php';

        elseif (get_row_layout() == 'relatedPosts') :
          require TBP_THEME_PATH . '/template-parts/related.php';

        elseif (get_row_layout() == 'promotions') :
          if (get_sub_field('active') === true) :
            require TBP_THEME_PATH . '/template-parts/promotions.php';
          endif;

        elseif (get_row_layout() == 'event') :
          if (get_sub_field('show_countdown')) :
    ?>
            <div class="<?php echo TBP_PREFIX; ?>-inplayer-countdown">
              <div id="days" style="color: #fff;"></div>
              <div id="hours"></div>
              <div id="minutes"></div>
              <div id="seconds"></div>
            </div>
    <?php
          endif;
        elseif (get_row_layout() == 'slider_options') :
          require TBP_THEME_PATH . '/template-parts/slider.php';

        elseif (get_row_layout() == 'fighters_options') :
          require TBP_THEME_PATH . '/template-parts/fighters.php';

        elseif (get_row_layout() == 'instagram') :
          require TBP_THEME_PATH . '/template-parts/instagram.php';

        endif;

      endwhile;

    endif;


    ?>
  </div>
</div>

<?php require_once TBP_THEME_PATH . '/template-parts/footer.php'; ?>
<?php require_once TBP_THEME_PATH . '/template-parts/overlay.php'; ?>