<?php

//Backend
require_once 'backend/functions.php';

//Api
require_once 'api/functions.php';

function includeAjaxFunc()
{
  if (is_dir(TBP_THEME_PATH . 'inc/ajax')) {
    foreach (glob(TBP_THEME_PATH . 'inc/ajax/*.php') as $file) :
      require TBP_THEME_PATH . 'inc/ajax/' . basename($file);
      add_action(basename($file, ".php"), str_replace('wp_ajax_', TBP_AJAX_FUNC_PREFIX, basename($file, ".php")) . "_callback");
      add_action('wp_ajax_nopriv_' . str_replace('wp_ajax_', '', basename($file, ".php")), str_replace('wp_ajax_', TBP_AJAX_FUNC_PREFIX, basename($file, ".php")) . "_callback");
    endforeach;
  }
}

add_action('init', 'includeAjaxFunc');