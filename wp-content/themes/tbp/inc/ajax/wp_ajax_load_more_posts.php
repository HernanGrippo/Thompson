<?php
function tbp_load_more_posts_callback()
{
  if (!check_ajax_referer('tbp-security-nonce', 'security')) {
    exit(wp_send_json_error('Invalid security token sent.'));
    die;
  }
  if ($_POST) {
    $page = $_POST['page'];
    $limit = $_POST['limit'];
    $newPosts = [];

    $args = array("posts_per_page" => $limit, "paged" => $page, "post_status" => "publish", "post_type" => "post", "cat" => "2", 'orderby' => 'date', 'order' => 'DESC');

    $postslist = new WP_Query($args);

    if ($postslist->have_posts()) :
      while ($postslist->have_posts()) : $postslist->the_post();
        $newPosts[] = array(
          'title' => get_the_title(),
          'slogan' => "3, 2, 1 Boxing",
          'img' => get_the_post_thumbnail_url(get_the_ID(), "related-post-image-one-col"),
          'date' => tbp_convert_to_time_ago(get_the_date()),
          'link' => get_the_permalink()
        );
      endwhile;
      wp_reset_postdata();
    endif;

    $result["result"] = "success";
    $result["posts"] = $newPosts;
    echo json_encode($result);
  }
  die;
}
