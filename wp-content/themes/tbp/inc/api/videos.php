<?php

define('LIVESTREAM_ACCOUNT_ID', 23289909);

function callAPI($method, $url, $data = array()) {
  $response = '';
  $cacheKey = serialize(array( 'method' => $method, 'url' => $url, 'data' => $data));

  if (false == ($response = get_transient($cacheKey))) {
    $baseUrl = 'https://livestreamapis.com/v3';
    /** @TODO move this secret key out of here */
    $secretKey = 'MGxJdEd0VThQSzVMa2EyZ2ZSYmlxd0VrNE9DSDJ4Nmg6';
    $curl = curl_init();

    switch ($method){
      case "POST":
          curl_setopt($curl, CURLOPT_POST, 1);

          if ($data) {
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
          }
          break;
      case "PUT":
          curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");

          if ($data) {
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
          }
          break;
      default:
          if ($data) {
            $url = sprintf("%s?%s", $url, http_build_query($data));
          }
    }

    // OPTIONS:
    curl_setopt($curl, CURLOPT_URL, $baseUrl . $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
      'Authorization: Basic ' . $secretKey,
      'Content-Type: application/json',
    ));

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

    // EXECUTE:
    $response = curl_exec($curl);

    if (!$response) {
      die("LivestreamAPI Connection Failure");
    }

    curl_close($curl);

    // cache for 2 seconds
    $ctime = 10;
    set_transient($cacheKey, $response, $ctime);
  }
  return $response;
}

// UPCOMING EVENTS API CALL -- NOT IN USE
function getUpcomingEvents($itemsPerPage = 10, $page = 1, $order = 'asc') {
  $url = "/accounts/" . LIVESTREAM_ACCOUNT_ID . '/upcoming_events';
  $params = array(
    'page'      => $page,
    'maxItems'  => $itemsPerPage,
    'order'     => $order
  );
  $response = callAPI('GET', $url, $params);

  return json_decode($response);
}
// END UPCOMING EVENTS API CALL  -- NOT IN USE

function getPastEvents($itemsPerPage = 10, $page = 1, $order = 'desc') {
  $url = "/accounts/" . LIVESTREAM_ACCOUNT_ID . '/past_events';
  $params = array(
    'page'      => $page,
    'maxItems'  => $itemsPerPage,
    'order'     => $order
  );
  $response = callAPI('GET', $url, $params);

  return json_decode($response);
}

// Return videos info
function getVideosV2(WP_REST_Request $request)
{
  // define items per page
  $itemsPerPage = $request->get_param('per_page') ? (int) $request->get_param('per_page') : 10;
  // define pagination
  $paged = $request->get_param('page') ? (int) $request->get_param('page') : 1;
  // define order
  $order = $request->get_param('order') ? (int) $request->get_param('order') : 'desc';
  // define response
  $dataPastEvents = getPastEvents($itemsPerPage, $paged, $order);

  $response = $dataPastEvents->data;
  $statusCode = $response ? 200 : 404;

  if ($dataPastEvents->code && $dataPastEvents->code !== 200) {
    $response = null;
    $statusCode = $dataPastEvents->code;
  }

  $totalPages = $dataPastEvents->total ? ceil($dataPastEvents->total / $itemsPerPage) : 0;

  return rest_ensure_response(array(
    'itemsPerPage' => $itemsPerPage,
    'pages'        => $totalPages,
    'page'         => $paged,
    'status'       => $statusCode,
    'data'         => $statusCode === 200 ? $response : null,
  ));
}

function getVideos(WP_REST_Request $request)
{

  $videos = array();

  if (get_field('video', 'api_settings')) :

    while (have_rows('video', 'api_settings')) : the_row();

      $image = get_sub_field_object('image', 'api_settings')['value']['url'];

      $videos[] = array(
        'id'            => get_row_index(),
        'image'         => $image,
        'type'          => get_sub_field('type', 'api_settings'),
        'name'          => get_sub_field('name', 'api_settings'),
        'date'          => get_sub_field('date', 'api_settings'),
        'detail'        => get_sub_field('detail', 'api_settings'),
        'source'        => get_sub_field('source', 'api_settings'),
        'time_duration' => get_sub_field('time_duration', 'api_settings'),
        'viewers'       => get_sub_field('viewers', 'api_settings'),
      );

    endwhile;

  endif;

  return rest_ensure_response(array(
    'status'       => $videos ? 200 : 404,
    'data'         => $videos ? $videos : null
  ));
}

// Return video info
function getVideoById(WP_REST_Request $request)
{
  // prepare id
  $cId = (int) $request->get_param('id');

  $videos = array();

  if (get_field('video', 'api_settings')) :

    while (have_rows('video', 'api_settings')) : the_row();

      $image = get_sub_field_object('image', 'api_settings')['value']['url'];

      $videos[] = array(
        'id'            => get_row_index(),
        'image'         => $image,
        'type'          => get_sub_field('type', 'api_settings'),
        'name'          => get_sub_field('name', 'api_settings'),
        'date'          => get_sub_field('date', 'api_settings'),
        'detail'        => get_sub_field('detail', 'api_settings'),
        'source'        => get_sub_field('source', 'api_settings'),
        'time_duration' => get_sub_field('time_duration', 'api_settings'),
        'viewers'       => get_sub_field('viewers', 'api_settings'),
      );

    endwhile;

  endif;

  $video = searchArray($cId, 'id', $videos);

  return rest_ensure_response(array(
    'status'       => $video ? 200 : 404,
    'data'         => $video
  ));
}


function searchArray($value, $key, $array)
{
  foreach ($array as $k => $val) {
    if ($value == $val[$key]) {
      return $val;
    }
  }
  return null;
}
