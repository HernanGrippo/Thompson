<?php

use Instagram\Api;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

require_once TBP_THEME_PATH . 'library/instagram-user-feed/vendor/autoload.php';

$instagramUsername = get_sub_field('username');
$lastMedias = [];
if (!empty($instagramUsername)) {
  $cachePool = new FilesystemAdapter('Instagram', 0, TBP_PLUGIN_CACHE_PATH);
  $api = new Api($cachePool);
  $api->login("kyguney", "20MaYiS2016");
  $profile = $api->getProfile($instagramUsername);
  $lastMedias = $profile->getMedias();
  $limit = 9;
}
?>

<section class="<?php echo TBP_PREFIX; ?>-instagram">
  <!-- <div class="<?php // echo TBP_PREFIX; 
                    ?>-instagram-shape"></div> -->
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h4><?php echo get_sub_field('title'); ?></h4>
      </div>
    </div>
    <div class="row">
      <?php /* ?>
        <div class="<?php echo TBP_PREFIX; ?>-inst-social col-5 <?php echo TBP_PREFIX; ?>-inst-desktop">
          <?php foreach ($socialMediaOptions['tbp_social_medias'] as $socialMediaItem) : ?>
            <?php
            $iconClass = '';
            if ($socialMediaItem['tbp_social_media_item_alt_text'] == 'YouTube') {
              $iconClass = 'fa-youtube';
            } elseif ($socialMediaItem['tbp_social_media_item_alt_text'] == 'Twitter') {
              $iconClass = 'fa-twitter';
            } elseif ($socialMediaItem['tbp_social_media_item_alt_text'] == 'Instagram') {
              $iconClass = 'fa-instagram';
            } elseif ($socialMediaItem['tbp_social_media_item_alt_text'] == 'Facebook') {
              $iconClass = 'fa-facebook';
            }
            ?>
            <a href="<?php echo $socialMediaItem['tbp_social_media_item_link']; ?>" title="<?php echo $socialMediaItem['tbp_social_media_item_alt_text']; ?>" target="_blank"><i class="fab <?php echo $iconClass; ?>"></i></a>
          <?php endforeach; ?>
        </div>
        <?php */ ?>
    </div>

    <?php if (!empty($lastMedias)) : ?>
      <?php
      $arrContextOptions = array(
        "ssl" => array(
          "verify_peer" => false,
          "verify_peer_name" => false,
        ),
      );
      ?>
      <div class="row <?php echo TBP_PREFIX; ?>-inst-feed">
        <?php for ($i = 0; $i < $limit; $i++) { ?>
          <div class="col-4 grid-col">
            <a href="<?php echo $lastMedias[$i]->getLink() ?>" target="_blank" title="">
              <?php if ($lastMedias[$i]->getTypeName() == "GraphVideo") : ?>
                <div class="<?php echo TBP_PREFIX; ?>-video-overlay">
                  <img src="<?php echo TBP_THEME_URL; ?>public/assets/images/video-overlay.png" />
                </div>
              <?php endif; ?>
              <img class="img-fluid" src="data:image/jpg;base64,<?php echo base64_encode(file_get_contents($lastMedias[$i]->getThumbnailSrc(), false, stream_context_create($arrContextOptions))); ?>" />
            </a>
          </div>
        <?php } ?>
      </div>
    <?php endif; ?>

    <!-- <div class="row <?php echo TBP_PREFIX; ?>-inst-mobile">
        <div class="<?php echo TBP_PREFIX; ?>-inst-social col-12">
          <?php foreach ($socialMediaOptions['tbp_social_medias'] as $socialMediaItem) : ?>
            <?php
            $iconClass = '';
            if ($socialMediaItem['tbp_social_media_item_alt_text'] == 'YouTube') {
              $iconClass = 'fa-youtube';
            } elseif ($socialMediaItem['tbp_social_media_item_alt_text'] == 'Twitter') {
              $iconClass = 'fa-twitter';
            } elseif ($socialMediaItem['tbp_social_media_item_alt_text'] == 'Instagram') {
              $iconClass = 'fa-instagram';
            } elseif ($socialMediaItem['tbp_social_media_item_alt_text'] == 'Facebook') {
              $iconClass = 'fa-facebook';
            }
            ?>
            <a href="<?php echo $socialMediaItem['tbp_social_media_item_link']; ?>" title="<?php echo $socialMediaItem['tbp_social_media_item_alt_text']; ?>" target="_blank"><i class="fab <?php echo $iconClass; ?>"></i></a>
          <?php endforeach; ?>
        </div>
      </div> -->
  </div>
</section>