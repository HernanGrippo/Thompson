<?php require_once TBP_THEME_PATH . '/template-parts/header.php'; ?>

<div class="<?php echo TBP_PREFIX; ?>-page <?php echo TBP_PREFIX; ?>-page-single">
  <div class="shape">
    <?php require_once TBP_THEME_PATH . '/template-parts/news/content.php'; ?>
    <div class="news">
      <div class="row">
        <div class="col-12 text-center">
          <?php while (have_rows('tbp_related_posts', 'home_options')) : the_row(); ?>
            <h5><?php echo get_sub_field('tbp_related_single_page_header', 'home_options'); ?></h5>
          <?php endwhile; ?>
        </div>
      </div>
      <?php require_once TBP_THEME_PATH . '/template-parts/related-fixed.php'; ?>
    </div>
  </div>
</div>

<?php require_once TBP_THEME_PATH . '/template-parts/footer.php'; ?>
<?php require_once TBP_THEME_PATH . '/template-parts/overlay.php'; ?>
