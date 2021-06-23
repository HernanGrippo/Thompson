<?php require_once TBP_THEME_PATH . '/template-parts/subscribe.php'; ?>
</div>
<?php while (have_rows('tbp_footer_options', 'home_options')) : the_row(); ?>
  <footer id="<?php echo TBP_PREFIX; ?>-footer">
    <div class="container">
      <div class="row no-gutters justify-content-md-center">
        <div class="col-12 col-md-12 col-lg-4 mb-lg-0 mb-4">
          <img src="<?php echo get_sub_field('tbp_footer_logo', 'home_options'); ?>" class="img-fluid mx-lg-0 mx-auto logo" alt="Thompson Boxing Promotions" />
          <p class="copyright d-lg-block d-none"><?php echo get_sub_field('tbp_footer_copyright_text', 'home_options'); ?></p>
        </div>
        <div class="col-12 col-md-6 col-lg-6">
          <div class="contact">
            <h4><?php echo get_sub_field('tbp_footer_contact_title', 'home_options'); ?></h4>
            <?php echo get_sub_field('tbp_footer_contact_content', 'home_options'); ?>
          </div>
        </div>
        <div class="col-12 col-md-3 col-lg-2">
          <div class="social">
            <h4><?php echo get_sub_field('tbp_footer_social_media_title', 'home_options'); ?></h4>
            <?php
              $socialMediaOptions = [];

              while (have_rows('tbp_social_media_options', 'home_options')) : the_row();
                $socialMediaOptions['tbp_social_media_follow_text'] = get_sub_field('tbp_social_media_follow_text', 'home_options');
                $socialMediaOptions['tbp_social_media_email_text'] = get_sub_field('tbp_social_media_email_text', 'home_options');
                $socialMediaOptions['tbp_social_media_email_address'] = get_sub_field('tbp_social_media_email_address', 'home_options');

                $counter = 0;
                while (have_rows('tbp_social_media_items', 'home_options')) : the_row();
                  $socialMediaOptions['tbp_social_medias'][$counter]['tbp_social_media_item_alt_text'] = get_sub_field('tbp_social_media_item_alt_text', 'home_options');
                  $socialMediaOptions['tbp_social_medias'][$counter]['tbp_social_media_item_link'] = get_sub_field('tbp_social_media_item_link', 'home_options');
                  $counter++;
                endwhile;
              endwhile;
            ?>
            <ul>
              <?php foreach ($socialMediaOptions['tbp_social_medias'] as $socialMediaItem) : ?>
                <li><a href="<?php echo $socialMediaItem['tbp_social_media_item_link']; ?>" title="<?php echo $socialMediaItem['tbp_social_media_item_alt_text']; ?>" target="_blank"><?php echo $socialMediaItem['tbp_social_media_item_alt_text']; ?></a></li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>
      </div>
      <div class="row no-gutters justify-content-md-center">
        <div class="col-lg-4 d-none d-md-block"></div>
        <div class="footer-alt-container col-12 col-md-9 col-lg-8">
          <div class="footer-alt-menu text-center text-md-center">
            <?= wp_nav_menu('footer-menu'); ?>
          </div>
          <p class="copyright d-lg-none"><?php echo get_sub_field('tbp_footer_copyright_text', 'home_options'); ?></p>
        </div>
      </div>
    </div>
  </footer>
<?php endwhile; ?>
</main>
<script>
  (function(i, s, o, g, r, a, m) {
    i['GoogleAnalyticsObject'] = r;
    i[r] = i[r] || function() {
      (i[r].q = i[r].q || []).push(arguments)
    }, i[r].l = 1 * new Date();
    a = s.createElement(o),
      m = s.getElementsByTagName(o)[0];
    a.async = 1;
    a.src = g;
    m.parentNode.insertBefore(a, m)
  })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

  ga('create', 'UA-99668590-1', 'auto');
  ga('send', 'pageview');
</script>
<?php wp_footer(); ?>
</body>

</html>