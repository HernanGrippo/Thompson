<?php
$pages_fields_map = [
    'tbp_list_block' => [
        "type" => "tbp_list_block",
        "fields" => [
            [
                "name" => "list_type",
                "data_type" => "STRING"
            ],
            [
                "name" => "list",
                "data_type" => "ARRAY_STRING"
            ]
        ]
    ],
    'tbp_headline' => [
        "type" => "tbp_headline_block",
        "fields" => [
            [
                "name" => "title",
                "data_type" => "STRING"
            ]
        ]
    ],
    'tbp_paragraf' => [
        "type" => "tbp_paragraf",
        "fields" => [
            [
                "name" => "content",
                "data_type" => "ARRAY_STRING"
            ]
        ]
    ],
    'tbp_questions' => [
        'type'    => 'tbp_questions',
        'fields'  => [
            [
                "name" => "title",
                "data_type" => "STRING"
            ],
            [
                "name"=> "sub_title",
                "data_type"=> "STRING"
            ],
            [
                "name"=> "question",
                "data_type"=> "ARRAY_OBJECT",
                "fields"=> [
                    [
                        "name"=> "title",
                        "data_type"=> "STRING"
                    ],
                    [
                        "name"=>"text",
                        "data_type"=> "STRING"
                    ]
                ]
            ]
        ]
    ],
    'tbp_banner' => [
        "type" => "tbp_banner",
        "fields" => [
            [
                "name"=> "banner_720x90",
                "data_type"=> "STRING" // IMAGE URL
            ],
            [
                "name"=> "banner_720x90_alt_text",
                "data_type"=> "STRING"
            ],
            [
                "name"=> "banner_mobile_square",
                "data_type"=> "STRING"
            ],
            [
                "name"=> "banner_mobile_square_alt_text",
                "data_type"=> "STRING"
            ],
            [
                "name"=> "banner_link",
                "data_type"=> "STRING"
            ]
        ]
    ]
];

function getPageStructTypes(WP_REST_Request $request) {
    global $pages_fields_map;

    $cacheKey = 'tbp_page_struct_types';

    // add response to cache if not exist for performance
    if (false == ($response = get_transient($cacheKey))) {
        $response = array(
            'status'    => 200,
            'data'       => array_values($pages_fields_map)
        );
        // cache for 3 mins
        $ctime = 60 * 3;
        set_transient($cacheKey, $response, $ctime);
    }

    return rest_ensure_response($response);
}

function getPageBySlug(WP_REST_Request $request) {
  global $pages_fields_map;
  $response = array();
  // prepare slug
  $slug = $request->get_param('slug');
  $cacheKey = 'tbp_pages_page_' . $slug;

  // add response to cache if not exist for performance
  if (false == ($response = get_transient($cacheKey))) {
      // define post object
    $postObj = array(
        'post_type'         => array('page'),
        'name'              => $slug,
        'suppress_filters'  => false,
        'post_status'       => array('publish'),
        'numberposts'       => 1
    );

    $res        = get_posts($postObj);
    $data       = array();

    if ($res) {
        $rows = get_field('page_elements', $res[0]->ID);
    
        foreach($rows as $row) {
            $type = $row['acf_fc_layout'];
    
            unset($row['acf_fc_layout']);
            if ($type === 'tbp_questions') {
                foreach($row['question'] as $keyQuestion => $question) {
                    $row['question'][$keyQuestion]['text'] = strip_tags($question['text']);
                }
            } else if ($type === 'tbp_paragraf') {
                $row['content'] = strip_tags($row['content']);
            } else if ($type === 'tbp_list_block') {
                foreach($row['list'] as $keyQuestion => $item) {
                    $row['list'][$keyQuestion]['text'] = strip_tags($item['text']);
                }
            }
    
            $data[] = array(
                'type' => $type,
                'data' => $row
            );
        }
    }

    $response['data'] = $data;
    $response = array(
      'status'  => count($data) > 0 ? 200 : 404,
      'data'    => $data,
    );

    // cache for 1 min
    $ctime = 60;
    set_transient($cacheKey, $response, $ctime);
  }
  
  return rest_ensure_response($response);
}