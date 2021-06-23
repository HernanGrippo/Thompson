<?php require_once TBP_THEME_PATH . '/template-parts/header.php'; ?>
<?php $social_visibility = !empty(get_field('tbp_fix_social_visibility', get_the_ID())) && get_field('tbp_fix_social_visibility', get_the_ID()) === true ? false : true; ?>

<div class="<?php echo TBP_PREFIX; ?>-page <?php echo TBP_PREFIX; ?>-page-single">

  <div class="container">
    <div class="<?php echo TBP_PREFIX; ?>-page-title">
      <h4><?php the_title(); ?></h4>
    </div>
  </div>

  <div class="shape">

    <?php

    if (have_rows('page_elements')) :

      while (have_rows('page_elements')) : the_row();

        if (get_row_layout() == 'tbp_questions') :
          require TBP_THEME_PATH . '/template-parts/page/questions.php';

        elseif (get_row_layout() == 'tbp_banner') :
          require TBP_THEME_PATH . '/template-parts/page/banner-728x90.php';

        elseif (get_row_layout() == 'tbp_form') :
          require TBP_THEME_PATH . '/template-parts/page/ask.php';

        elseif (get_row_layout() == 'tbp_headline_block') :
          require TBP_THEME_PATH . '/template-parts/page/headline.php';

        elseif (get_row_layout() == 'tbp_paragraf') :
          require TBP_THEME_PATH . '/template-parts/page/paragraf.php';

        elseif (get_row_layout() == 'tbp_list_block') :
          require TBP_THEME_PATH . '/template-parts/page/list-block.php';

        endif;

      endwhile;

    endif;
    ?>

  </div>
</div>

<?php require_once TBP_THEME_PATH . '/template-parts/footer.php'; ?>
<?php require_once TBP_THEME_PATH . '/template-parts/overlay.php'; ?>
