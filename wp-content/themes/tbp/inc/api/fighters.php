<?php

// Return requested news
function getFighters(WP_REST_Request $request)
{
  // define items per page
  $itemsPerPage = $request->get_param('per_page') ? (int) $request->get_param('per_page') : 9;
  // define pagination
  $paged = $request->get_param('page') ? (int) $request->get_param('page') : 1;
  // define order
  $order = $request->get_param('order') === 'DESC' ? 'DESC' : 'ASC';
  // define search
  $search = $request->get_param('search') ? $request->get_param('search') : '';
  // define filterByTheNewOne
  $isFilterByTheNewOne = $request->get_param('new_ones') === "true" ? true : false;
  
  // define post object
  $postObj = array(
    'posts_per_page'   => $itemsPerPage,
    'post_type'        => array('fighter'),
    'fighter_category' => $isFilterByTheNewOne ? 'new-one' : '',
    'suppress_filters' => false,
    'post_status'      => 'publish',
    'orderby'          => 'date',
    'order'            => $order,
    'paged'            => $paged,
    'meta_key'         => 'tbp_fighter_visibility',
    'meta_value'       => true
    // 'category' => 12
  );

  if (!empty($search)) {
    $postObj['s'] = $search;
  }

  $res = new WP_Query($postObj);

  if ($res->have_posts()) {
    $figherIndex = 0;

    while ($res->have_posts()) {
      $res->the_post();

      if ($res->post->ID) {

        $fighter_excerpt = '';

        $featured_image_detail = array(
          'image'       => wp_get_attachment_image_src(get_post_thumbnail_id($res->post->ID), "full")[0],
          'credit'      => '',
          'description' => ''
        );

        if (have_rows('tbp_f_featured_photo_settings', $res->post->ID)) :
          while (have_rows('tbp_f_featured_photo_settings', $res->post->ID)) : the_row();
            $featured_image_detail['credit'] = get_sub_field('tbp_f_featured_photo_credit', $res->post->ID);
            $featured_image_detail['description']   = get_sub_field('tbp_f_featured_photo_description', $res->post->ID);
          endwhile;
        endif;

        $fighter_excerpt = get_field('tbp_fighter_excerpt', $res->post->ID);

        // $fighter_records = array();

        $win  = 0;
        $draw = 0;
        $lost = 0;

        if (have_rows('tbp_fighter_records', $res->post->ID)) :
          $count = 0;
          while (have_rows('tbp_fighter_records', $res->post->ID)) : the_row();
            // $fighter_records[$count]['date']            = get_sub_field('tbp_fighter_records_date', $res->post->ID);
            // $fighter_records[$count]['opponent']        = get_sub_field('tbp_fighter_records_opponent', $res->post->ID);
            // $fighter_records[$count]['opponent_record'] = get_sub_field('tbp_fighter_records_opponent_record', $res->post->ID);
            // $fighter_records[$count]['location']        = get_sub_field('tbp_fighter_records_location', $res->post->ID);
            // $fighter_records[$count]['result']          = get_sub_field('tbp_fighter_records_result', $res->post->ID);

            if (get_sub_field('tbp_fighter_records_result') == 'Win') {
              $win++;
            } elseif (get_sub_field('tbp_fighter_records_result') == 'Lost') {
              $lost++;
            } elseif (get_sub_field('tbp_fighter_records_result') == 'Draw') {
              $draw++;
            }
            $count++;
          endwhile;
        endif;

        $fighter_profile_datas = array();

        if (have_rows('tbp_fighter_profile_datas', $res->post->ID)) :
          while (have_rows('tbp_fighter_profile_datas', $res->post->ID)) : the_row();
            $fighter_profile_datas['nickname']   = get_sub_field('tbp_fighter_profile_nickname', $res->post->ID);
            $fighter_profile_datas['birth_date']  = get_sub_field('tbp_fighter_profile_birthdate', $res->post->ID);
            $fighter_profile_datas['birth_place'] = get_sub_field('tbp_fighter_profile_birthplace', $res->post->ID);
            $fighter_profile_datas['record']     = $win . "-" . $lost . "-" . $draw;
            $fighter_profile_datas['division']   = get_sub_field('tbp_fighter_profile_division', $res->post->ID);
            $fighter_profile_datas['stance']     = get_sub_field('tbp_fighter_profile_stance', $res->post->ID);
            $fighter_profile_datas['height']     = get_sub_field('tbp_fighter_profile_height', $res->post->ID);
            $fighter_profile_datas['reach']      = get_sub_field('tbp_fighter_profile_reach', $res->post->ID);
          endwhile;
        endif;

        // $fighter_content = array(
        //   'intro'   => '',
        //   'quote'   => '',
        //   'text'    => '',
        // );

        // if (get_field('f_elements', $res->post->ID)) {
        //   foreach (get_field('f_elements', $res->post->ID) as $elements) {
        //     if ($elements['acf_fc_layout'] === 'content') {
        //       $fighter_content = array(
        //         'intro'     => strip_tags($elements['intro']),
        //         'quote'     => strip_tags($elements['quote']),
        //         'content'   => splitContentInParagraphs($elements['text']),
        //       );
        //     }
        //   }
        // }

        $name = explode(' ', $res->post->post_title);
        $first_name = '';
        $last_name = '';

        foreach ($name as $key => $value) {
          if ($key === 0) {
            $first_name = $value;
          } else {
            $last_name = $last_name . $value . (count($name) - 1 != $key ? ' ' : '');
          }
        }

        $multipleFighters[] = array(
          'id'            => $res->post->ID,
          'name'          => $first_name,
          'last_name'     => $last_name,
          'profile'       => $fighter_profile_datas,
          'feature_photo' => $featured_image_detail,
          "website_url"   => get_permalink(),
          "api_url"           => get_site_url() . "/wp-json/tb/v1/fighters/" . $res->post->ID,
          // 'content'         => $fighter_content,
          // 'records'       => $fighter_records,
          // 'gallery'       => $fighter_gallery,
          // 'content'       => $fighter_bio_last,
          // 'birth_date'   => $fighter_profile_datas ? $fighter_profile_datas['birthdate'] : null,
          // 'birth_place'  => $fighter_profile_datas ? $fighter_profile_datas['birthplace'] : null,
          // 'record'       => $fighter_profile_datas ? $fighter_profile_datas['record'] : null,
          // 'division'     => $fighter_profile_datas ? $fighter_profile_datas['division'] : null,
          // 'height'       => $fighter_profile_datas ? $fighter_profile_datas['height'] : null,
          // 'detail'       => $fighter_profile_datas ? $fighter_profile_datas['nickname'] : null,
          //'boxrec_id'    => get_field('tbp_fighter_boxrec_id', $res->post->ID),
          //'slug'         => $res->post->post_name,
          //'url'          => get_site_url() . "/wp-json/tb/v1/fighters/" . $res->post->ID,
          //'publish_date' => get_the_date('F j, Y', $res->post->ID),
          //'publish_time' => get_the_date('g:i a', $res->post->ID),
          //'excerpt'      => wp_filter_nohtml_kses($fighter_excerpt),
          // 'img_source'     => $featured_image_detail['image'],
        );

        // if (have_rows('tbp_fighter_gallery', $res->post->ID)) :
        //   $galleryCounter = 1;
        //   while (have_rows('tbp_fighter_gallery', $res->post->ID)) : the_row();
        //     $multipleFighters[$figherIndex]['img_source' . $galleryCounter] = get_sub_field('tbp_fighter_gallery_photo', $res->post->ID);
        //     $galleryCounter++;
        //   endwhile;
        // endif;

        $figherIndex++;

      } else {
        $fighterMeta        = get_post_meta($res->post->ID);
        $multipleFighters[] = prepareFighterData($res->post, $fighterMeta);
      }
    }
  }

  return rest_ensure_response(array(
    'itemsPerPage' => $itemsPerPage,
    'pages'        => $res->max_num_pages,
    'page'         => $paged,
    'status'       => $multipleFighters <> '' && $multipleFighters <> false ? 200 : 404,
    'data'         => $multipleFighters <> '' && $multipleFighters <> false ? $multipleFighters : null
  ));
}

// Return fighter info if exist
function getFighterById(WP_REST_Request $request)
{
  // prepare id
  $cId = (int) $request->get_param('id');
  // define post object
  $postObj = array(
    'post_type'        => array('fighter'), //'post_type' => array('post'),
    'suppress_filters' => false,
    'post_status'      => array('publish', 'private'),
    'include'          => $cId
  );

  $singleFighter = null;
  $res           = get_posts($postObj);

  if (count($res)) {
    if (get_field('tbp_fighter_visibility', $res[0]->ID)) {

      // $delimiter = "[vc_row][vc_column]";

      // $fighter_bio = array();

      // $fighter_bio_last = array();

      // if (!empty($res[0]->post_content)) {
      //   $fighter_bio = array_values(array_filter(array_map("trim", explode($delimiter, str_replace(array(
      //     "\r",
      //     "\n",
      //     "&nbsp;"
      //   ), array("", "", " "), strip_tags($res[0]->post_content)))), function ($value) {
      //     if ($value != "") {
      //       return true;
      //     }
      //   }));

      //   $fighter_bio = array_map(function ($value) {
      //     $delimiter = "[vc_row][vc_column]";

      //     return $delimiter . $value;
      //   }, $fighter_bio);

      //   $textCounter  = 1;
      //   $videoCounter = 1;
      //   $quoteCounter = 1;
      //   $countIndex= 0;
      //   foreach ($fighter_bio as $fighter_line) {
      //     if (strpos($fighter_line, 'vc_video') !== false) {
      //       $video_link                                   = preg_match('/link=\"([^\"]+)\"/', $fighter_line, $video_link_array);
      //       $video_title                                  = preg_match('/title=\"([^\"]+)\"/', $fighter_line, $video_title_array);
      //       $fighter_bio_last[$countIndex]['video'] = array(
      //         "title" => $video_title_array[1],
      //         "link"  => $video_link_array[1],
      //       );
      //       $videoCounter++;
      //     } elseif (strpos($fighter_line, 'vc_column_text') !== false) {
      //       $paragraph                                  = preg_match_all("/\[vc_column_text\]([^\]]*)\[\/vc_column_text\]/", $fighter_line, $paragraph_array);
      //       $fighter_bio_last[$countIndex]['text'] = $paragraph_array[1][0];
      //       $textCounter++;
      //     } elseif (strpos($fighter_line, 'vc_coquote') !== false) {
      //       $quote_title                                  = preg_match('/quote_title=\"([^\"]+)\"/', $fighter_line, $quote_title_array);
      //       $quote_text                                   = preg_match('/quote_text=\"([^\"]+)\"/', $fighter_line, $quote_text_array);
      //       $fighter_bio_last[$countIndex]['quote'] = array(
      //         "title" => $quote_title_array[1],
      //         "text"  => $quote_text_array[1],
      //       );
      //     }
      //     $countIndex ++;
      //   }
      // }

      $featured_image_detail = array();

      $fighter_excerpt = '';

      $fighter_gallery = array();

      $featured_image_detail['image'] = wp_get_attachment_image_src(get_post_thumbnail_id($res[0]->ID), "full")[0];

      if (have_rows('tbp_f_featured_photo_settings', $res[0]->ID)) :
        while (have_rows('tbp_f_featured_photo_settings', $res[0]->ID)) : the_row();
          $featured_image_detail['credit'] = get_sub_field('tbp_f_featured_photo_credit', $res[0]->ID);
          $featured_image_detail['description']   = get_sub_field('tbp_f_featured_photo_description', $res[0]->ID);
        endwhile;
      endif;

      $fighter_excerpt = get_field('tbp_fighter_excerpt', $res[0]->ID);

      if (have_rows('tbp_fighter_gallery', $res[0]->ID)) :
        while (have_rows('tbp_fighter_gallery', $res[0]->ID)) : the_row();

          $fighter_gallery[] = array(
            'image'  => get_sub_field('tbp_fighter_gallery_photo', $res[0]->ID),
            'credit' => get_sub_field('tbp_fighter_gallery_credit', $res[0]->ID),
            'description'   => get_sub_field('tbp_fighter_gallery_description', $res[0]->ID),
          );

        endwhile;
      endif;

      $fighter_records = array();

      $win  = 0;
      $draw = 0;
      $lost = 0;

      if (have_rows('tbp_fighter_records', $res[0]->ID)) :
        $count = 0;
        while (have_rows('tbp_fighter_records', $res[0]->ID)) : the_row();
          $fighter_records[$count]['date']            = get_sub_field('tbp_fighter_records_date', $res[0]->ID);
          $fighter_records[$count]['opponent']        = get_sub_field('tbp_fighter_records_opponent', $res[0]->ID);
          $fighter_records[$count]['opponent_record'] = get_sub_field('tbp_fighter_records_opponent_record', $res[0]->ID);
          $fighter_records[$count]['location']        = get_sub_field('tbp_fighter_records_location', $res[0]->ID);
          $fighter_records[$count]['result']          = get_sub_field('tbp_fighter_records_result', $res[0]->ID);

          if (get_sub_field('tbp_fighter_records_result') == 'Win') {
            $win++;
          } elseif (get_sub_field('tbp_fighter_records_result') == 'Lost') {
            $lost++;
          } elseif (get_sub_field('tbp_fighter_records_result') == 'Draw') {
            $draw++;
          }
          $count++;
        endwhile;
      endif;

      $fighter_profile_datas = array();

      if (have_rows('tbp_fighter_profile_datas', $res[0]->ID)) :
        while (have_rows('tbp_fighter_profile_datas', $res[0]->ID)) : the_row();
          $fighter_profile_datas['nickname']   = get_sub_field('tbp_fighter_profile_nickname', $res[0]->ID);
          $fighter_profile_datas['birth_date']  = get_sub_field('tbp_fighter_profile_birthdate', $res[0]->ID);
          $fighter_profile_datas['birth_place'] = get_sub_field('tbp_fighter_profile_birthplace', $res[0]->ID);
          $fighter_profile_datas['record']     = $win . "-" . $lost . "-" . $draw;
          $fighter_profile_datas['division']   = get_sub_field('tbp_fighter_profile_division', $res[0]->ID);
          $fighter_profile_datas['stance']     = get_sub_field('tbp_fighter_profile_stance', $res[0]->ID);
          $fighter_profile_datas['height']     = get_sub_field('tbp_fighter_profile_height', $res[0]->ID);
          $fighter_profile_datas['reach']      = get_sub_field('tbp_fighter_profile_reach', $res[0]->ID);
        endwhile;
      endif;
      
      $fighter_content = new stdClass();
      if (get_field('f_elements', $res[0]->ID)) {
        foreach (get_field('f_elements', $res[0]->ID) as $elements) {
          if ($elements['acf_fc_layout'] === 'content') {
            $quote = $elements['quote'];
            $fighter_content = array(
              'intro'     => strip_tags($elements['intro']),
              'quote'     => array(
                'text'  => strip_tags($quote['quote_text']),
                'by'    => strip_tags($quote['quote_title'])
              ),
              'content'   => splitContentInParagraphs($elements['text']),
            );
          }
        }
      }

      $name = explode(' ', $res[0]->post_title);
      $first_name = '';
      $last_name = '';

      foreach ($name as $key => $value) {
        if ($key === 0) {
          $first_name = $value;
        } else {
          $last_name = $last_name . $value . (count($name) - 1 != $key ? ' ' : '');
        }
      }

      $singleFighter = array(
        'id'            => $res[0]->ID,
        'name'          => $first_name,
        'last_name'     => $last_name,
        "website_url"   => get_permalink($res[0]->ID),
        'api_url'       => get_site_url() . "/wp-json/tb/v1/fighters/" . $res[0]->ID,
        'featured'      => $featured_image_detail,
        'profile'       => $fighter_profile_datas,
        'content'       => $fighter_content,
        'records'       => $fighter_records,
        'gallery'       => $fighter_gallery,
        // 'intro'         => $fighter_bio_last,
        // 'birth_date'   => $fighter_profile_datas ? $fighter_profile_datas['birthdate'] : null,
        // 'birth_place'  => $fighter_profile_datas ? $fighter_profile_datas['birthplace'] : null,
        // 'record'       => $fighter_profile_datas ? $fighter_profile_datas['record'] : null,
        // 'division'     => $fighter_profile_datas ? $fighter_profile_datas['division'] : null,
        // 'height'       => $fighter_profile_datas ? $fighter_profile_datas['height'] : null,
        // 'detail'       => $fighter_profile_datas ? $fighter_profile_datas['nickname'] : null,
        // 'boxrec_id'    => get_field('tbp_fighter_boxrec_id', $res->post->ID),
        // 'slug'         => $res->post->post_name,
        // 'publish_date' => get_the_date('F j, Y', $res->post->ID),
        // 'publish_time' => get_the_date('g:i a', $res->post->ID),
        // 'excerpt'      => wp_filter_nohtml_kses($fighter_excerpt),
        // 'img_source'     => $featured_image_detail['image'],
      );

      if (have_rows('tbp_fighter_gallery', $res[0]->ID)) :
        $galleryCounter = 1;
        while (have_rows('tbp_fighter_gallery', $res[0]->ID)) : the_row();
          $multipleFighters[0]['img_source' . ($galleryCounter !== 0 ? $galleryCounter : null)] = get_sub_field('tbp_fighter_gallery_photo', $res[0]->ID);
          $galleryCounter++;
        endwhile;
      endif;
    } else {
      $fighterMeta   = get_post_meta($res[0]->ID);
      $singleFighter = prepareFighterData($res[0], $fighterMeta);
    }
  }

  return rest_ensure_response(array(
    'status' => $singleFighter <> null ? 200 : 404,
    'data'   => $singleFighter
  ));
}