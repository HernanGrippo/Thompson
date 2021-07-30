<?php

// Return gallery info
function getGallery(WP_REST_Request $request)
{

  $gallery = array();

  if (get_field('gallery', 'api_settings')) :

    while (have_rows('gallery', 'api_settings')) : the_row();

      $images = array();

      if (get_sub_field('images')) :
        foreach (get_sub_field('images', 'api_settings') as $key => $image) :
          $images[] = $image['image']['url'];
        endforeach;
      endif;

      $gallery[] = array(
        'id'            => get_row_index(),
        'title'         => get_sub_field('title', 'api_settings'),
        'photographer'  => get_sub_field('photographer', 'api_settings'),
        'line'          => get_sub_field('line', 'api_settings'),
        'description'   => get_sub_field('description', 'api_settings'),
        'img_source'    => $images
      );

    endwhile;

  endif;

  return rest_ensure_response(array(
    'status'       => $gallery ? 200 : 404,
    'data'         => $gallery ? $gallery : null
  ));
}

// Return Livestream Url
function getLivestreamUrl()
{

  $livestreamUrl = get_field('livestream_video', 'api_settings');
  $livestreamDateTime = getGroupACFsubField('tbp_hero_options', 'tbp_countdown_time', 'home_options');
  $livestreamActive = get_field('tbp_activation_of_event', 'home_options');
  // $livestreamVideoId = getGroupACFsubField('tbp_hero_options', 'tbp_hero_video_id', 'home_options');
  // $livestreamUrl = "https://livestream.com/accounts/23289909/events/" . $livestreamVideoId . "/player?width=640&height=360&enableInfoAndActivity=true&defaultDrawer=&autoPlay=true&mute=false";
  $livestreamImage = getGroupACFsubField('tbp_hero_options', 'tbp_hero_mobile_app_image', 'home_options');

  return rest_ensure_response(array(
    'status' => $livestreamUrl ? 200 : 404,
    'data'   => array(
      'url'             => $livestreamUrl,
      'event_datetime'  => $livestreamDateTime,
      'active'          => $livestreamActive,
      "poster"          => $livestreamImage
    )
  ));
}

function getDepartmentsPage() {
  $departments = array();
  
  if (have_rows('contact_form_departments', 'api_settings')) {
    while (have_rows('contact_form_departments', 'api_settings')) {
      the_row();
      $departments[] = get_sub_field('contact_form_departments_department');
    }
  }
  return rest_ensure_response(array(
    'status' => $departments <> null ? 200 : 404,
    'data'   => $departments
  ));
}

// Return About Thompson Boxing Page Details
function getAboutThompsonPage()
{
  // prepare id
  $pId = 5801;
  // define page object
  $page = get_post($pId);

  // Contact Form ID
  $newsletterContactFormId = getGroupACFsubField('tbp_newsletter_options', 'contact_form_id', 'home_options');

  $output = array();

  $output['contact_form_id'] = $newsletterContactFormId;

  $adress       = get_field('tbp_contact_address', $pId);
  $adress_array = explode("\n", $adress);

  foreach ($adress_array as $adress_line) {
    $output['adress'][] = str_replace("\r", "", $adress_line);
  }

  $output['phone'] = get_field('tbp_contact_phone', $pId);
  $output['fax'] = get_field('tbp_contact_fax', $pId);
  $output['email'] = get_field('tbp_contact_email', $pId);

  if (have_rows('tbp_contact_teams', $pId)) {
    while (have_rows('tbp_contact_teams', $pId)) {
      the_row();
      $output['team'][] = array(
        'name' => get_sub_field('tbp_contact_member_name'),
        'title' => get_sub_field('tbp_contact_member_title'),
        'email' => get_sub_field('tbp_contact_member_email'),
      );
    }
  }

  $content = str_replace("\r\n", "", explode("\r\n\r\n", str_replace(array("&nbsp;", '“', '”', "‘", "’"), array("", "'", "'", "'", "'"), strip_tags($page->post_content))));

  $output['content'] = $content;

  return rest_ensure_response(array(
    'status' => $output <> null ? 200 : 404,
    'data'   => $output
  ));
}

// Return current active home page image
function getHomeImage()
{
  $desktopImg = get_theme_mod('desktop_hero_image');
  $mobileImg  = get_theme_mod('mobile_hero_image');

  return rest_ensure_response(array(
    'status' => $desktopImg || $mobileImg ? 200 : 404,
    'data'   => array(
      'desktop' => $desktopImg,
      'mobile'  => $mobileImg
    )
  ));
}

// Return current active home page image
function getHashtags()
{
  $hashtagSettings = get_option('cod_hashtag_settings');
  $selectedHashtags = $hashtagSettings['selectedHashtags'];

  return rest_ensure_response(array(
    'status' => $selectedHashtags ? 200 : 404,
    'data'   => array(
      'hashtags' => $selectedHashtags
    )
  ));
}
