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
  $response = array();
  $cacheKey = 'tbp_livestream';
  // add response to cache if not exist for performance
  if (false == ($response = get_transient($cacheKey))) {
    $livestreamUrl = get_field('livestream_video', 'api_settings');
    $livestreamDateTime = getGroupACFsubField('tbp_hero_options', 'tbp_countdown_time', 'home_options');
    $livestreamActive = get_field('tbp_activation_of_event', 'home_options');
    $livestreamImage = getGroupACFsubField('tbp_hero_options', 'tbp_hero_mobile_app_image', 'home_options');

    $response = array(
      'status' => $livestreamUrl ? 200 : 404,
      'data'   => array(
        'url'             => $livestreamUrl,
        'event_datetime'  => $livestreamDateTime,
        'active'          => $livestreamActive,
        "poster"          => $livestreamImage
      )
    );
    // cache for 1 minute
    $ctime = 60;
    set_transient($cacheKey, $response, $ctime);
  }

  return rest_ensure_response($response);
}

function getDepartmentsPage() {
  $response = array();
  $cacheKey = 'tbp_departments';

  // add response to cache if not exist for performance
  if (false == ($response = get_transient($cacheKey))) {
    $departments = array();

    if (have_rows('contact_form_departments', 'api_settings')) {
      while (have_rows('contact_form_departments', 'api_settings')) {
        the_row();
        $departments[] = get_sub_field('contact_form_departments_department');
      }
    }
    
    $response = array(
      'status' => $departments <> null ? 200 : 404,
      'data'   => $departments
    );

    // cache for 10 minutes
    $ctime = 60 * 10;
    set_transient($cacheKey, $response, $ctime);
  }
  return rest_ensure_response($response);
}

function getContactFormId() {
  $response = array();
  $cacheKey = 'tbp_contact_form_id';

  // add response to cache if not exist for performance
  if (false == ($response = get_transient($cacheKey))) {
    // Contact Form ID
    $newsletterContactFormId = getGroupACFsubField('tbp_newsletter_options', 'contact_form_id', 'home_options');
    
    $contactFormId = array(
      'contactFormId' => $newsletterContactFormId,
    );
    $response = array(
      'status' => $newsletterContactFormId <> null ? 200 : 404,
      'data'   => $contactFormId
    );

    // cache for 10 minutes
    $ctime = 60 * 10;
    set_transient($cacheKey, $response, $ctime);
  }
  return rest_ensure_response($response);
}

// Return About Thompson Boxing Page Details
function getAboutThompsonPage()
{
  $response = array();
  $cacheKey = 'tbp_about_thompson';

  // add response to cache if not exist for performance
  if (false == ($response = get_transient($cacheKey))) {

    // prepare id
    $pId = 5801;
    // define page object
    $page = get_post($pId);

    // Contact Form ID
    $newsletterContactFormId = getGroupACFsubField('tbp_newsletter_options', 'contact_form_id', 'home_options');

    $output = array();

    $output['contact_form_id'] = $newsletterContactFormId;

    $address       = get_field('tbp_contact_address', $pId);
    $address_array = explode("\n", $address);

    foreach ($address_array as $address_line) {
      $output['adress'][] = str_replace("\r", "", $address_line);
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

    $response = array(
      'status' => $output <> null ? 200 : 404,
      'data'   => $output
    );

    // cache for 30 minutes
    $ctime = 60 * 30;
    set_transient($cacheKey, $response, $ctime);
  }

  return rest_ensure_response($response);
}

// Return current active home page image
function getHomeImage()
{
  $response = null;
  $cacheKey = 'tbp_home_image';

  // add response to cache if not exist for performance
  if (false == ($response = get_transient($cacheKey))) {
    $response = get_field('tbp_home_regular_image', 'home_options');

    // cache for 30 minutes
    $ctime = 60 * 10;
    set_transient($cacheKey, $response, $ctime);
  }

  return rest_ensure_response(array(
    'status' => $response ? 200 : 404,
    'data'   => array(
      'image' => $response
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
