<?php

//API
require_once 'fighters.php';
require_once 'news.php';
require_once 'videos.php';
require_once 'pages.php';
require_once 'others.php';

/**
 * Rest API EXTEND FORM external use
 */

add_action('rest_api_init', 'register_api_hooks');

function contentFilterEmpty($item) {
  return !!$item;
}

function splitContentInParagraphs($content) {
  $content = str_replace("<br/>", "\n", $content);
  $content = str_replace("<br>", "\n", $content);
  $content = str_replace("\n\r", "\n", $content);
  $content = str_replace("\r\n", "\n", $content);
  $content = explode("\n", strip_tags($content));
  return array_filter($content, 'contentFilterEmpty');
}

// Define custom hooks
function register_api_hooks()
{
  // Add the data content to GET requests for required individual posts
  $preparedData = array(
    'get_callback' => 'prepareDataForRequiredContent',
  );

  if ($preparedData <> null) {
    register_rest_field('post', 'data', $preparedData);
  }

  // Custom Endpoints
  // Add api/v1/news route
  register_rest_route('tb/v1', '/news/', array(
    'methods'  => WP_REST_Server::READABLE,
    'callback' => 'getNews',
    'permission_callback' => '__return_true'
  ));

  // Add api/v1/news/:id route
  register_rest_route('tb/v1', '/news/(?P<id>\d+)', array(
    'methods'  => WP_REST_Server::READABLE,
    'callback' => 'getNewsById',
    'permission_callback' => '__return_true'
  ));

  // Add api/v1/fighters route
  register_rest_route('tb/v1', '/fighters/', array(
    'methods'  => WP_REST_Server::READABLE,
    'callback' => 'getFighters',
    'permission_callback' => '__return_true'
  ));

  // Add api/v1/fighter/:id route
  register_rest_route('tb/v1', '/fighters/(?P<id>\d+)', array(
    'methods'  => WP_REST_Server::READABLE,
    'callback' => 'getFighterById',
    'permission_callback' => '__return_true'
  ));

  // Add api/v1/videos route
  register_rest_route('tb/v1', '/videos/', array(
    'methods'  => WP_REST_Server::READABLE,
    'callback' => 'getVideos',
    'permission_callback' => '__return_true'
  ));
  
  // Add api/v1/videos route
  register_rest_route('tb/v2', '/videos/', array(
    'methods'  => WP_REST_Server::READABLE,
    'callback' => 'getVideosV2',
    'permission_callback' => '__return_true'
  ));

  // Add api/v1/video/:id route
  register_rest_route('tb/v1', '/video/(?P<id>\d+)', array(
    'methods'  => WP_REST_Server::READABLE,
    'callback' => 'getVideoById',
    'permission_callback' => '__return_true'
  ));

  // Add api/v1/gallery route
  register_rest_route('tb/v1', '/gallery/', array(
    'methods'  => WP_REST_Server::READABLE,
    'callback' => 'getGallery',
    'permission_callback' => '__return_true'
  ));

  // Add api/v1/products route
  register_rest_route('tb/v1', '/products/', array(
    'methods'  => WP_REST_Server::READABLE,
    'callback' => 'getProducts',
    'permission_callback' => '__return_true'
  ));

  // Add api/v1/product/:id route
  register_rest_route('tb/v1', '/product/(?P<id>\d+)', array(
    'methods'  => WP_REST_Server::READABLE,
    'callback' => 'getProductById',
    'permission_callback' => '__return_true'
  ));

  // Add api/v1/homeimage route
  register_rest_route('tb/v1', '/homeimage/', array(
    'methods'  => WP_REST_Server::READABLE,
    'callback' => 'getHomeImage',
    'permission_callback' => '__return_true'
  ));

  // Add api/v1/hashtags route
  register_rest_route('tb/v1', '/hashtags/', array(
    'methods'  => WP_REST_Server::READABLE,
    'callback' => 'getHashtags',
    'permission_callback' => '__return_true'
  ));

  // Add api/v1/about-thompson route
  register_rest_route('tb/v1', '/departments/', array(
    'methods'  => WP_REST_Server::READABLE,
    'callback' => 'getDepartmentsPage',
    'permission_callback' => '__return_true'
  ));

  // Add api/v1/about-thompson route
  register_rest_route('tb/v1', '/about-thompson/', array(
    'methods'  => WP_REST_Server::READABLE,
    'callback' => 'getAboutThompsonPage',
    'permission_callback' => '__return_true'
  ));

  // Add api/v1/homeimage route
  register_rest_route('tb/v1', '/livestream/', array(
    'methods'  => WP_REST_Server::READABLE,
    'callback' => 'getLiveStreamUrl',
    'permission_callback' => '__return_true'
  ));

  // Add api/v1/contact-form-id route
  register_rest_route('tb/v1', '/contact-form-id/', array(
    'methods'  => WP_REST_Server::READABLE,
    'callback' => 'getContactFormId',
    'permission_callback' => '__return_true'
  ));

  // Add api/v1/pages/:slug route
  register_rest_route('tb/v1', '/page-struct-types', array(
    'methods'  => WP_REST_Server::READABLE,
    'callback' => 'getPageStructTypes',
    'permission_callback' => '__return_true'
  ));

  // Add api/v1/pages/:slug route
  register_rest_route('tb/v1', '/pages/(?P<slug>\S+)', array(
    'methods'  => WP_REST_Server::READABLE,
    'callback' => 'getPageBySlug',
    'permission_callback' => '__return_true'
  ));
}

// Return data content for posts
function prepareDataForRequiredContent($object, $field_name, $request)
{
  $res = null;

  $validTypes = array(
    //1 => 'uncategorized',
    10 => '2011',
    12 => 'news',
    13 => '2012',
    14 => 'homepage',
    15 => 'fighters',
    16 => 'gallery',
    17 => 'links',
    18 => 'events',
    19 => 'mobile-home'
  );

  $isValidType = isset($object['categories'])
    && count($object['categories'])
    && array_key_exists($object['categories'][0], $validTypes);

  if ($isValidType) {
    if ($object['categories'][0] == 12) {
      $res = array(
        'text' => strip_tags(html_entity_decode($object['content']['rendered']))
      );
    }
  }

  return $res;
}

// validate if string contains html tags
function isHTML($string)
{
  return preg_match("/<[^<]+>/", $string, $m) != 0;
}

// extract images from src tag on strings that contains HTML
function getImagesFromContent($content)
{
  $images = array();

  // validate string, it must be valid HTML
  if ($content != '' && isHTML($content)) {
    // also validate XML document, the html could be malformed
    $tempDoc                  = new DOMDocument();
    $tempDoc->validateOnParse = true;
    libxml_use_internal_errors(true);
    $tempDoc->loadHTML($content);
    $results = libxml_get_errors();
    libxml_clear_errors();

    // if no errors detected in string, it is valid html
    if (empty($results) && count($results) == 0) {
      $imageTags = $tempDoc->getElementsByTagName('img');
      foreach ($imageTags as $tag) {
        $images[] = array(
          'image'       => $tag->getAttribute('src'),
          'credit'      => 'Archive',
          'description' => $tag->getAttribute('alt')
        );
      }
    }

    $tempDoc = null;
  }

  return $images;
}

// convert associative array from simple array
function prepareImageData($img)
{
  if (!is_array($img)) {
    return $img;
  }

  return array(
    'url'    => $img[0],
    'width'  => $img[1],
    'height' => $img[2]
  );
}

// get related attachments to post
function getAttachmentsById($attachmentId)
{
  // define empty list of attachments
  $attachments = array();
  // not id provided
  if (empty($attachmentId)) {
    return $attachments;
  }

  $fullSizeImage      = wp_get_attachment_image_src($attachmentId, 'full');
  $thumbnailImage     = wp_get_attachment_image_src($attachmentId, 'thumbnail');
  $mediumImage        = wp_get_attachment_image_src($attachmentId, 'medium');
  $mediumLargeImage   = wp_get_attachment_image_src($attachmentId, 'medium_large');
  $largeImage         = wp_get_attachment_image_src($attachmentId, 'large');
  $shopThumbnailImage = wp_get_attachment_image_src($attachmentId, 'shop_thumbnail');
  $shopCatalogImage   = wp_get_attachment_image_src($attachmentId, 'shop_catalog');
  $shopSingleImage    = wp_get_attachment_image_src($attachmentId, 'shop_single');

  return array(
    'full'          => prepareImageData($fullSizeImage),
    'thumbnail'     => prepareImageData($thumbnailImage),
    'medium'        => prepareImageData($mediumImage),
    'mediumLarge'   => prepareImageData($mediumLargeImage),
    'large'         => prepareImageData($largeImage),
    'shopThumbnail' => prepareImageData($shopThumbnailImage),
    'shopCatalog'   => prepareImageData($shopCatalogImage),
    'shopSingle'    => prepareImageData($shopSingleImage)
  );
}

// get meta, validate values from metadata
function getMetaValue($value)
{
  if (!$value) return '';
  return count($value) ? $value[0] : '';
}

// current hardcoded videos, I will suggest to improve it
function tbHardcodedVideos($itemsPerPage, $page, $cId = null)
{
  $first_video = array(
    'id'    => 1,
    'title' => get_theme_mod('tb_present_video_title_1', ''),
    'image' => get_theme_mod('tb_present_video_thumb_1', ''),
    'url'   => get_theme_mod('tb_present_video_url_1', '')
  );

  $second_video = array(
    'id'    => 2,
    'title' => get_theme_mod('tb_present_video_title_2', ''),
    'image' => get_theme_mod('tb_present_video_thumb_2', ''),
    'url'   => get_theme_mod('tb_present_video_url_2', '')
  );

  $third_video = array(
    'id'    => 3,
    'title' => get_theme_mod('tb_present_video_title_3', ''),
    'image' => get_theme_mod('tb_present_video_thumb_3', ''),
    'url'   => get_theme_mod('tb_present_video_url_3', '')
  );

  $videos = array(
    0 => $first_video,
    $second_video,
    $third_video
  );

  if ($cId <> null) {
    return $videos[$cId - 1];
  }

  $pages = ceil(count($videos) / $itemsPerPage);
  $paged = $page > $pages ? count($videos) + 1 : ($page - 1) * $itemsPerPage;

  return array(
    'pages' => $pages,
    'data'  => array_slice($videos, $paged, $itemsPerPage)
  );
}

// normalize fighter response
function prepareFighterData($info, $metaInfo)
{
  $name = explode(' ', $info->post_title);
  $first_name = '';
  $last_name = '';

  foreach ($name as $key => $value) {
    if ($key === 0) {
      $first_name = $value;
    } else {
      $last_name = $last_name . $value . (count($name) - 1 != $key ? ' ' : '');
    }
  }

  $images = getAttachmentsById(getMetaValue($metaInfo['_thumbnail_id']));

  $featured_image_detail = array(
    'image'       => $images[0],
    'credit'      => 'Archive',
    'description' => ''
  );

  $gallery = array_reduce($images, function($imgGallery, $value) {
    $imgGallery[] = array(
      'image'       => $value['url'],
      'credit'      => 'Archive',
      'description' => ''
    );
    return $imgGallery;
  }, array());

  $gallery = array_merge($gallery, getImagesFromContent($info->post_content));

  $fighter_profile_datas = array(
    'nickname'    => getMetaValue($metaInfo['nickname']),
    'birth_date'  => getMetaValue($metaInfo['Born']),
    'birth_place' => getMetaValue($metaInfo['Birth place']),
    'record'      => getMetaValue($metaInfo['record']),
    'division'    => getMetaValue($metaInfo['Division']),
    'stance'      => getMetaValue($metaInfo['stance']),
    'height'      => getMetaValue($metaInfo['height']),
    'reach'       => getMetaValue($metaInfo['reach'])
  );

  return array(
    'id'            => $info->ID,
    'name'          => $first_name,
    'last_name'     => $last_name,
    'featured'      => $featured_image_detail,
    'profile'       => $fighter_profile_datas,
    'intro'         => '',
    'content'       => array(
      'intro' => '',
      'quote' => '',
      'text'  => strip_tags(html_entity_decode($info->post_content))
    ),
    'records'       => array(),
    'gallery'       => $gallery,
    // 'age'            => getMetaValue($metaInfo['Age']),
    // 'shortTitle'     => getMetaValue($metaInfo['short_title'])
    // 'weightDivision' => getMetaValue($metaInfo['Weight Division']),
    // 'homePageThumb'  => getMetaValue($metaInfo['home_page_thumb']),
    // 'slideTemplate' => getMetaValue($metaInfo['slide_template']),
    // 'picture'        => getMetaValue($metaInfo['sm-pic'])
    // 'created'        => $info->post_date,
    // 'modified'       => $info->post_modified
  );
}

// normalize fighter response
function prepareProductData($info, $metaInfo)
{
  $maxQ  = (int) getMetaValue($metaInfo['max_quantity']);
  $minQ  = (int) getMetaValue($metaInfo['min_quantity']);
  $price = count($metaInfo['_price']) && count($metaInfo['_price']) == 1 ? (float) $metaInfo['_price'][0]
    : array_map('floatval', $metaInfo['_price']);

  return array(
    //'jo' => $metaInfo,
    'id'          => $info->ID,
    'title'       => $info->post_title,
    'price'       => $price,
    'maxQuantity' => $maxQ == 0 ? false : $maxQ,
    'minQuantity' => $minQ == 0 ? false : $minQ,
    'manageStock' => getMetaValue($metaInfo['_manage_stock']),
    'stockStatus' => getMetaValue($metaInfo['_stock_status']),
    'stock'       => getMetaValue($metaInfo['_stock']),
    'postName'    => $info->post_name,
    'url'         => get_permalink(),
    'images'      => getAttachmentsById(getMetaValue($metaInfo['_thumbnail_id'])),
    'content'     => strip_tags(html_entity_decode($info->post_content)),
    'htmlContent' => $info->post_content,
    'created'     => $info->post_date,
    'modified'    => $info->post_modified
  );
}
