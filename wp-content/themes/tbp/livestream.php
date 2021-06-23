<?php
/**
 * Template Name: Livestream
 */
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Thompson Boxing Promotions - Livestream</title>
    <style>
      html, body {
        overflow: hidden;
        margin: 0;
        padding: 0;
      }
      iframe {
        width: 100%;
        height: 100vh;
      }
      <?php if(wp_is_mobile()): ?>
      iframe {
        width: 100%;
        height: 103vh;
      }
      <?php endif; ?>
    </style>
  </head>
  <body>
    <?php
      $livestream_iframe_src =trim(get_theme_mod('tb_present_livestream_video_source', ''));
    ?>
    <iframe src="<?php echo $livestream_iframe_src; ?>" frameborder="0" scrolling="no" allowfullscreen> </iframe>
    <script type="text/javascript" src="https://livestream.com/assets/plugins/referrer_tracking.js"></script>
    <script type="text/javascript" data-embed_id="ls_embed_1503705580" src="https://livestream.com/assets/plugins/referrer_tracking.js"></script>
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-99668590-1', 'auto');
      ga('send', 'pageview');

    </script>
  </body>
</html>




