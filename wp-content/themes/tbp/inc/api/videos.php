<?php

// Return videos info
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
