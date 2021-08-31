<?php

/*
add_filter('https_ssl_verify', '__return_false');
add_filter('block_local_requests', '__return_false');
add_filter('https_local_ssl_verify', '__return_false');
function allow_unsafe_urls ( $args ) {
  $args['reject_unsafe_urls'] = false;
  return $args;
} ;
add_filter( 'http_request_args', 'allow_unsafe_urls' );
*/

// Defining Theme Constants
define("TBP_THEME_PATH", get_template_directory() . "/");
define("TBP_THEME_URL", get_template_directory_uri() . "/");
define("TBP_PREFIX", "tbp");
define("TBP_AJAX_FUNC_PREFIX", TBP_PREFIX.'_');
define('TBP_PLUGIN_CACHE_PATH', plugin_dir_path(__FILE__) . "cache");

require_once 'inc/functions.php';

add_theme_support('menus');
add_filter('upload_mimes', 'enable_extended_upload');

add_action('init', function () {
  remove_post_type_support('page', 'editor');

  add_action('wp_enqueue_scripts', 'tbp_maintenance_assets');
}, 99);

register_nav_menus(
  array(
    'tbp-menu' => 'Slide Menu',
    'footer-menu' => 'Footer Menu',
  )
);

add_filter('wp_nav_menu', function ($ulclass) {
  return preg_replace('/<a /', '<a class="item"', $ulclass);
});

function getGroupACFsubField($groupID, $subField, $optionID = true)
{
  $subFieldValue = '';
  if (have_rows($groupID, $optionID)) {
    while (have_rows($groupID, $optionID)) : the_row();
      $subFieldValue = get_sub_field($subField, $optionID);
    endwhile;
  }
  return $subFieldValue;
}

function enable_extended_upload($mime_types = array())
{
  $mime_types['jpg']  = 'image/jpeg';
  $mime_types['svg']  = 'image/svg';
  return $mime_types;
}

add_filter( 'rest_endpoints', 'remove_default_endpoints_smarter' );
  
function remove_default_endpoints_smarter( $endpoints ) {
  $prefixToDelete = array("batch", "oembed", "yoast", "regenerate-thumbnails", "wp");

  $droppedEndpoints = array();
  foreach ( $endpoints as $endpoint => $details ) {
    foreach( $prefixToDelete as $prefix) {
      if ( fnmatch( '/' . $prefix . '/*', $endpoint, FNM_CASEFOLD ) ) {
        $droppedEndpoints[$prefix] = true;
        unset( $endpoints[$endpoint] );
      }
    }
  }
 
  return $endpoints;
}

function theme_setup()
{
  add_theme_support('post-thumbnails');
  add_filter('show_admin_bar', '__return_false');
}
add_action('after_setup_theme', 'theme_setup');

function tbp_convert_to_time_ago($orig_time)
{
  $orig_time = strtotime($orig_time);
  return human_time_diff($orig_time, current_time('timestamp')) . ' ' . __('ago');
}

function tbp_maintenance_assets()
{

  $scriptDatas = array(
    'ajaxUrl' => admin_url('admin-ajax.php'),
    'security' => wp_create_nonce('tbp-security-nonce'),
    'emailRequiredText' => getGroupACFsubField('tbp_newsletter_options', 'tbp_email_required_warning', 'home_options'),
    'emailWrongText' => getGroupACFsubField('tbp_newsletter_options', 'tbp_wrong_email_warning', 'home_options'),
    'emailExistsText' => getGroupACFsubField('tbp_newsletter_options', 'tbp_email_exists_warning', 'home_options'),
    'emailSuccesText' => getGroupACFsubField('tbp_newsletter_options', 'sign_up_success', 'home_options'),
    'countDownDate' => getGroupACFsubField('tbp_hero_options', 'tbp_countdown_time', 'home_options'),
    'postsPerPageLimit' => 6,
    'event_status' => get_field("tbp_activation_of_event", "home_options"),
    'event_video' => get_field("tbp_activation_of_video", "home_options"),
    'fighters_status' => get_field("tbp_activation_of_fighters", "home_options"),
    'topBarText' => getGroupACFsubField('tbp_top_bar_options', 'tbp_top_bar_text', 'home_options'),
    'topBarHeroCloseButtonText' => getGroupACFsubField('tbp_top_bar_options', 'tbp_hero_close_button_text', 'home_options'),
    'topBarHeroClosedButtonText' => getGroupACFsubField('tbp_top_bar_options', 'tbp_hero_closed_button_text', 'home_options'),
  );

  if (have_rows('page_elements')) :

    while (have_rows('page_elements')) : the_row();

      if (get_row_layout() == 'tbp_form') :

        $scriptDatas['contactForm'] = array(
          "id" => get_sub_field('contact_form_id')[0],
          "firstname_required_text" => get_sub_field('first_name_required_text'),
          "lastname_required_text" => get_sub_field('last_name_required_text'),
          "email_required_text" => get_sub_field('email_required_text'),
          "email_validate_text" => get_sub_field('email_validate_text'),
          "message_required_text" => get_sub_field('message_required_text'),
          "success_message" => get_sub_field('thanks_message'),
          "failed_message" => get_sub_field('failed_message')
        );

      endif;

    endwhile;

  else :

    $scriptDatas['contactForm'] = array(
      "id" => "",
      "firstname_required_text" => "",
      "lastname_required_text" => "",
      "email_required_text" => "",
      "email_validate_text" => "",
      "message_required_text" => "",
      "success_message" => "",
      "failed_message" => ""
    );

  endif;

  $stylePath = get_template_directory() . '/public/assets/styles';
  foreach (new DirectoryIterator($stylePath) as $fileInfo) {
    if ($fileInfo->getFilename() == 'frontend.css') {
      wp_enqueue_style('tbp-maintenance-style', get_template_directory_uri() . '/public/assets/styles/' . $fileInfo->getFilename(), false);
    }
  }

  wp_enqueue_style('tbp-maintenance-style', get_template_directory_uri() . '/public/assets/styles/frontend.css', false);
  wp_enqueue_script('tbp-maintenance-script', get_template_directory_uri() . '/public/assets/scripts/frontend.js', false);

  wp_localize_script('tbp-maintenance-script', 'newsletterData', $scriptDatas);
}


add_action('acf/init', 'my_acf_op_init');
function my_acf_op_init() {

    // Check function exists.
    if( function_exists('acf_add_options_sub_page') ) {

        // Add parent.
        $parent = acf_add_options_page(array(
          'page_title'  => 'TBP Options',
          'menu_title'  => 'TBP Options',
          'menu_slug'   => 'tbp-options',
          'capability'  => 'manage_options',
          'icon_url'    => 'dashicons-admin-home',
          'post_id'     => 'home_options',
          'redirect'    => false
        ));

        // Add sub page.
        $child = acf_add_options_sub_page(array(
            'page_title'  => __('Api Settings'),
            'menu_title'  => __('Api Settings'),
            'parent_slug' => $parent['menu_slug'],
            'post_id'     => 'api_settings',
        ));
    }
}