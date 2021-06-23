<?php $body_class = isset($body_class) ? $body_class : ''; ?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="ie ie-no-support" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>         <html class="ie ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>         <html class="ie ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9]>         <html class="ie ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 9]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->

<head>
  <meta charset="<?php bloginfo('charset'); ?>" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title><?php wp_title(); ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--[if lt IE 9]>
    <script src="<?php echo get_template_directory_uri(); ?>/js/html5shiv.js"></script>
  <![endif]-->
  <?php wp_head(); ?>
  <script type="text/javascript" src="https://assets.inplayer.com/paywall/latest/paywall.min.js"></script>
</head>

<body <?php body_class($body_class); ?>>

  <?php
  $social_visibility = !empty(get_field('tbp_fix_social_visibility', get_the_ID())) && get_field('tbp_fix_social_visibility', get_the_ID()) === true ? false : true;
  ?>

  <main role="main">
    <?php
    //$TbpMaintenance = new TbpMaintenance();
    //$TbpMaintenance->setSocialMediaOptions();
    //$socialMediaOptions = $TbpMaintenance->getSocialMediaOptions();
    $p_class = false;
    $headerClass = false;
    if (is_front_page()) {
      $p_class = " home";
    } else {
      $p_class = " single";
      $p_closed = true;
    }
    if (is_singular('fighter')) {
      $headerClass = " header-fighter";
    }
    ?>
    <?php require_once TBP_THEME_PATH . '/template-parts/navigation.php'; ?>

    <?php if (get_field("tbp_activation_of_event", "home_options")) : ?>

      <?php require_once TBP_THEME_PATH . '/template-parts/top-bar.php'; ?>

      <?php require_once TBP_THEME_PATH . '/template-parts/hero/common-hero.php'; ?>

    <?php endif; ?>

    <div id="yield">

      <?php if ($social_visibility) : ?>
        <?php require_once TBP_THEME_PATH . '/template-parts/fix-social.php'; ?>
      <?php endif; ?>

      <header class="text-center d-flex<?php echo $headerClass; ?>" id="<?php echo TBP_PREFIX; ?>-header">
        <div class="container position-relative">

          <?php require_once TBP_THEME_PATH . '/template-parts/navigation-icon-open.php'; ?>

          <?php require_once TBP_THEME_PATH . '/template-parts/logo.php'; ?>

          <?php while (have_rows("tbp_podcast_options", "home_options")) : the_row(); ?>
            <?php if (get_sub_field('tbp_podcast_visibility', "home_options")) : ?>
              <div class="row">
                <div class="col-12">
                  <div class="mb-5">
                    <div class="embed-responsive embed-responsive-16by9">
                      <iframe id="<?php echo get_sub_field('embed_id', "home_options"); ?>" class="embed-responsive-item" frameborder="0" scrolling="no" src="<?php echo get_sub_field('src', "home_options"); ?>" allowfullscreen></iframe>
                    </div>
                    <script type="text/javascript" data-embed_id="<?php echo get_sub_field('embed_id', "home_options"); ?>" src="https://livestream.com/assets/plugins/referrer_tracking.js"></script>
                  </div>
                </div>
              </div>
            <?php endif; ?>
          <?php endwhile; ?>

          <?php if (is_front_page()) :
            if (have_rows('homeContent')) :
              while (have_rows('homeContent')) : the_row();
                if (get_row_layout() == 'intro') :
                  get_template_part('template-parts/intro', null, array(get_sub_field('title')));
                endif;
              endwhile;
            endif;
          endif; ?>
        </div>
      </header>