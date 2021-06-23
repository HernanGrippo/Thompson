<?php 

// Return requested news
function getNews(WP_REST_Request $request)
{
  // set of parameters:
  $parameters = $request->get_params();
  // define items per page
  $itemsPerPage = $request->get_param('per_page') ? (int) $request->get_param('per_page') : 9;
  // define pagination
  $paged = $request->get_param('page') ? (int) $request->get_param('page') : 1;
  // define search
  $search = $request->get_param('search') ? $request->get_param('search') : '';
  // define post object
  $postObj = array(
    'posts_per_page'   => $itemsPerPage,
    'post_type'        => array('post'),
    'suppress_filters' => false,
    'post_status'      => 'publish',
    'category_name'    => 'news',
    'orderby'          => 'date',
    'order'            => 'DESC',
    'paged'            => $paged,
    // 'category' => 12
  );

  if (!empty($search)) {
    $postObj['s'] = $search;
  }


  // // add response to cache if not exist for perfomance
  // if (false == ($multipleNews = get_transient('cmnews'))) {
  $res = new WP_Query($postObj);

  if ($res->have_posts()) {
    $index = 1;

    while ($res->have_posts()) {
      $res->the_post();

      $post_content = array_values(array_filter(explode("\n", str_replace(array(
        "\r",
        "&nbsp;"
      ), array("\n", ""), strip_tags($res->post->post_content))), function ($value) {
        if ($value != "" && $value != " ") {
          return $value;
        }
      }));

      if ($res->post->ID) { //if ($res->post->ID > '6967')

        $delimiter = "[vc_row][vc_column]";

        $post_content = array();

        $post_content_last = array();

        if (!empty($res->post->post_content)) {
          $post_content = array_values(array_filter(array_map("trim", explode($delimiter, str_replace(array(
            "\r",
            "\n",
            "&nbsp;"
          ), array("", "", " "), strip_tags($res->post->post_content)))), function ($value) {
            if ($value != "") {
              return true;
            }
          }));

          $post_content = array_map(function ($value) {
            $delimiter = "[vc_row][vc_column]";

            return $delimiter . $value;
          }, $post_content);

          $textCounter  = 1;
          $videoCounter = 1;
          $quoteCounter = 1;
          foreach ($post_content as $news_line) {
            if (strpos($news_line, 'vc_video') !== false) {
              $video_link                                    = preg_match('/link=\"([^\"]+)\"/', $news_line, $video_link_array);
              $video_title                                   = preg_match('/title=\"([^\"]+)\"/', $news_line, $video_title_array);
              /*$post_content_last['video_' . $videoCounter] = array(
                "title" => $video_title_array[1],
                "link"  => $video_link_array[1],
              );*/
              $videoCounter++;
            } elseif (strpos($news_line, 'vc_column_text') !== false) {
              $paragraph                                   = preg_match_all("/\[vc_column_text\]([^\]]*)\[\/vc_column_text\]/", $news_line, $paragraph_array);
              $post_content_last['text_' . $textCounter] = $paragraph_array[1][0];
              $textCounter++;
            } elseif (strpos($news_line, 'vc_coquote') !== false) {
              $quote_title                                   = preg_match('/quote_title=\"([^\"]+)\"/', $news_line, $quote_title_array);
              $quote_text                                    = preg_match('/quote_text=\"([^\"]+)\"/', $news_line, $quote_text_array);
              /*$post_content_last['quote_' . $quoteCounter] = array(
                "title" => $quote_title_array[1],
                "text"  => $quote_text_array[1],
              );*/
              $quoteCounter++;
            }
          }
        }

        $featured_image_detail = array();

        $news_excerpt = '';

        $news_gallery = array();

        $featured_image_detail['image'] = wp_get_attachment_image_src(get_post_thumbnail_id($res->post->ID), "full")[0];

        if (have_rows('tbp_featured_photo_settings', $res->post->ID)) :
          while (have_rows('tbp_featured_photo_settings', $res->post->ID)) : the_row();
            $featured_image_detail['credit'] = get_sub_field('tbp_featured_photo_credit', $res->post->ID);
            $featured_image_detail['desc']   = get_sub_field('tbp_featured_photo_description', $res->post->ID);
          endwhile;
        endif;

        if (have_rows('tbp_news_excerpt', $res->post->ID)) :
          while (have_rows('tbp_news_excerpt', $res->post->ID)) : the_row();
            $excerpt_location = get_sub_field('tbp_news_excerpt_location', $res->post->ID);
            $excerpt_date     = get_sub_field('tbp_news_excerpt_date', $res->post->ID);
            $excerpt_text     = get_sub_field('tbp_news_excerpt_text', $res->post->ID);

            $news_excerpt .= (!empty($excerpt_location)) ? $excerpt_location : "";
            $news_excerpt .= (!empty($excerpt_date)) ? " (" . $excerpt_date . ") " : "";
            $news_excerpt .= (!empty($excerpt_text)) ? $excerpt_text : "";

          endwhile;
        endif;

        $new_content = '';

        if ($post_content_last != '') {
          foreach ($post_content_last as $key => $content) {
            $new_content = $new_content . $content;
          }
        }

        $multipleNews[$index] = array(
          'id'       => $res->post->ID,
          //'slug'     => $res->post->post_name,
          //'url'      => get_site_url() . "/wp-json/tb/v1/news/" . $res->post->ID,
          //'time'     => get_the_date('g:i a', $res->post->ID),
          'name'     => $res->post->post_title,
          //'excerpt'  => $news_excerpt,
          'content'    => $new_content,
          'img_source' => $featured_image_detail != null ? $featured_image_detail['image'] : null,
          //'gallery'  => $news_gallery,
          'upload_time'     => get_the_date('F j, Y', $res->post->ID),
        );

        if (have_rows('tbp_news_gallery', $res->post->ID)) :
          $galleryCounter = 0;
          while (have_rows('tbp_news_gallery', $res->post->ID)) : the_row();
            $multipleNews[$index]['info_img' . ($galleryCounter !== 0 ? $galleryCounter : null)] = get_sub_field('tbp_news_gallery_photo', $res->post->ID);
            $galleryCounter++;
          endwhile;
        endif;

        $index++;
      } else {

        $multipleNews[] = array(
          'id'          => $res->post->ID,
          'postName'    => $res->post->post_name,
          'url'         => get_permalink(),
          'title'       => $res->post->post_title,
          //'content' => strip_tags(html_entity_decode($res[0]->post_content)),
          'content'     => $post_content,
          'htmlContent' => $res->post->post_content,
          'images'      => getImagesFromContent($res->post->post_content),
          'created'     => $res->post->post_date,
          'modified'    => $res->post->post_modified
        );
      }
    }

    wp_reset_query();
  }

  // cache for 10 mins
  //   $ctime = 60*10;
  //   set_transient('cmnews', $multipleNews, $ctime);
  // }

  return rest_ensure_response(array(
    'itemsPerPage' => $itemsPerPage,
    'pages'        => $res->max_num_pages,
    'page'         => $paged,
    'status'       => $multipleNews <> '' && $multipleNews <> false ? 200 : 404,
    'data'         => $multipleNews <> '' && $multipleNews <> false ? $multipleNews : null
  ));
}

// Return single news if exist
function getNewsById(WP_REST_Request $request)
{
  // prepare id
  $cId = (int) $request->get_param('id');
  // define post object
  $postObj = array(
    'post_type'        => array('post'),
    'suppress_filters' => false,
    'post_status'      => array('publish', 'private'),
    'category_name'    => 'News',
    'include'          => $cId
  );

  $singleNews = null;
  $res        = get_posts($postObj);


  $post_content = array_values(array_filter(explode("\n", str_replace(array("\r", "&nbsp;", '"'), array(
    "\n",
    "",
    ''
  ), strip_tags($res[0]->post_content))), function ($value) {
    if ($value != "" && $value != " ") {
      return $value;
    }
  }));

  if (count($res)) {
    if ($res[0]->ID) { //($res[0]->ID > '6967')

      $delimiter = "[vc_row][vc_column]";

      $post_content = array();

      $post_content_last = array();

      if (!empty($res[0]->post_content)) {
        $post_content = array_values(array_filter(array_map("trim", explode($delimiter, str_replace(array(
          "\r",
          "\n",
          "&nbsp;"
        ), array("", "", " "), strip_tags($res[0]->post_content)))), function ($value) {
          if ($value != "") {
            return true;
          }
        }));

        $post_content = array_map(function ($value) {
          $delimiter = "[vc_row][vc_column]";

          return $delimiter . $value;
        }, $post_content);

        $textCounter  = 1;
        $videoCounter = 1;
        $quoteCounter = 1;
        foreach ($post_content as $news_line) {
          if (strpos($news_line, 'vc_video') !== false) {
            $video_link                                    = preg_match('/link=\"([^\"]+)\"/', $news_line, $video_link_array);
            $video_title                                   = preg_match('/title=\"([^\"]+)\"/', $news_line, $video_title_array);
            /*$post_content_last['video_' . $videoCounter] = array(
              "title" => $video_title_array[1],
              "link"  => $video_link_array[1],
            );*/
            $videoCounter++;
          } elseif (strpos($news_line, 'vc_column_text') !== false) {
            $paragraph                                   = preg_match_all("/\[vc_column_text\]([^\]]*)\[\/vc_column_text\]/", $news_line, $paragraph_array);
            $post_content_last['text_' . $textCounter] = $paragraph_array[1][0];
            $textCounter++;
          } elseif (strpos($news_line, 'vc_coquote') !== false) {
            $quote_title                                   = preg_match('/quote_title=\"([^\"]+)\"/', $news_line, $quote_title_array);
            $quote_text                                    = preg_match('/quote_text=\"([^\"]+)\"/', $news_line, $quote_text_array);
            /*$post_content_last['quote_' . $quoteCounter] = array(
              "title" => $quote_title_array[1],
              "text"  => $quote_text_array[1],
            );*/
            $quoteCounter++;
          }
        }
      }

      $featured_image_detail = array();

      $news_excerpt = '';

      $news_gallery = array();

      $featured_image_detail['image'] = wp_get_attachment_image_src(get_post_thumbnail_id($res[0]->ID), "full")[0];

      if (have_rows('tbp_featured_photo_settings', $res[0]->ID)) :
        while (have_rows('tbp_featured_photo_settings', $res[0]->ID)) : the_row();
          $featured_image_detail['credit'] = get_sub_field('tbp_featured_photo_credit', $res[0]->ID);
          $featured_image_detail['desc']   = get_sub_field('tbp_featured_photo_description', $res[0]->ID);
        endwhile;
      endif;

      if (have_rows('tbp_news_excerpt', $res[0]->ID)) :
        while (have_rows('tbp_news_excerpt', $res[0]->ID)) : the_row();
          $excerpt_location = get_sub_field('tbp_news_excerpt_location', $res[0]->ID);
          $excerpt_date     = get_sub_field('tbp_news_excerpt_date', $res[0]->ID);
          $excerpt_text     = get_sub_field('tbp_news_excerpt_text', $res[0]->ID);

          $news_excerpt .= (!empty($excerpt_location)) ? $excerpt_location : "";
          $news_excerpt .= (!empty($excerpt_date)) ? " (" . $excerpt_date . ") " : "";
          $news_excerpt .= (!empty($excerpt_text)) ? $excerpt_text : "";

        endwhile;
      endif;

      if (have_rows('tbp_news_gallery', $res[0]->ID)) :
        while (have_rows('tbp_news_gallery', $res[0]->ID)) : the_row();

          $news_gallery[] = array(
            'image'  => get_sub_field('tbp_news_gallery_photo', $res[0]->ID),
            'credit' => get_sub_field('tbp_news_gallery_credit', $res[0]->ID),
            'desc'   => get_sub_field('tbp_news_gallery_description', $res[0]->ID),
          );

        endwhile;
      endif;

      $new_content = '';

      if ($post_content_last != '') {
        foreach ($post_content_last as $key => $content) {
          $new_content = $new_content . $content;
        }
      }

      $singleNews = array(
        'id'       => $res[0]->ID,
        'slug'     => $res[0]->post_name,
        'url'      => get_site_url() . "/wp-json/tb/v1/news/" . $res[0]->ID,
        'time'     => get_the_date('g:i a', $res[0]->ID),
        'name'     => $res[0]->post_title,
        //'excerpt'  => $news_excerpt,
        'content'  => $new_content,
        'featured' => $featured_image_detail != null ? $featured_image_detail['image'] : null,
        //'gallery'  => $news_gallery,
        'upload_time'     => get_the_date('F j, Y', $res[0]->ID),
      );

      if (have_rows('tbp_news_gallery', $res[0]->ID)) :
        $galleryCounter = 0;
        while (have_rows('tbp_news_gallery', $res[0]->ID)) : the_row();
          $singleNews['info_img' . ($galleryCounter !== 0 ? $galleryCounter : null)] = get_sub_field('tbp_news_gallery_photo', $res[0]->ID);
          $galleryCounter++;
        endwhile;
      endif;
    } else {
      $singleNews = array(
        'id'          => $res[0]->ID,
        'postName'    => $res[0]->post_name,
        'url'         => get_permalink($res[0]->ID),
        'title'       => $res[0]->post_title,
        //      'content' => strip_tags(html_entity_decode($res[0]->post_content)),
        'content'     => $post_content,
        'htmlContent' => $res[0]->post_content,
        'images'      => getImagesFromContent($res[0]->post_content),
        'created'     => $res[0]->post_date,
        'modified'    => $res[0]->post_modified
      );
    }
  }

  return rest_ensure_response(array(
    'status' => $singleNews <> null ? 200 : 404,
    'data'   => $singleNews
  ));
}