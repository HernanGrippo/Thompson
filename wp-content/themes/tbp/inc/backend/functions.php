<?php

/**
 * Backend Fighter Settings
 */

require_once __DIR__ . '/../../library/goutte/vendor/autoload.php';

use Goutte\Client;

define("SITEPREFIX", 'tbp');

function tbp_login_to_boxrec($login_url, $username, $password)
{
  $client = new Client();
  $crawler = $client->request('GET', $login_url);
  $form    = $crawler->selectButton('login[go]')->form();
  $client->submit($form, array('_username' => $username, '_password' => $password));
}

function tbp_get_fighter_boxrec_ID_by_name($login_url, $username, $password, $fighter_fullname)
{

  $fighter_full_name_array = explode(" ", $fighter_fullname);

  $first_name = array_shift($fighter_full_name_array);

  $last_name = implode("+", $fighter_full_name_array);

  $search_url = 'https://boxrec.com/en/search?p%5Bfirst_name%5D=' . $first_name . '&p%5Blast_name%5D=' . $last_name . '&p%5Brole%5D=fighters&p%5Bstatus%5D=a&pf_go=go&p%5BorderBy%5D=&p%5BorderDir%5D=ASC';

  $client = new Client();
  $crawler = $client->request('GET', $login_url);
  $form    = $crawler->selectButton('login[go]')->form();
  $client->submit($form, array('_username' => $username, '_password' => $password));

  $crawler = $client->request('GET', $search_url);

  $fighter_boxrec_ID = null;

  $inactive = true;

  $crawler->filter('.drawRowBorder')->each(function ($fighter) use (&$fighter_boxrec_ID, &$fighter_fullname, &$inactive) {
    $fighter->filter('.personLink')->each(function ($personLink) use (&$fighter_boxrec_ID, &$fighter_fullname, &$inactive) {
      if (trim($personLink->text()) == trim($fighter_fullname)) {
        $link_array        = explode("/", $personLink->extract(array('href'))[0]);
        $fighter_boxrec_ID = end($link_array);
        $inactive = false;
      }
    });
  });


  if ($inactive) {
    $search_url = 'https://boxrec.com/en/search?p%5Bfirst_name%5D=' . $first_name . '&p%5Blast_name%5D=' . $last_name . '&p%5Brole%5D=fighters&p%5Bstatus%5D=&pf_go=go&p%5BorderBy%5D=&p%5BorderDir%5D=ASC';
    $crawler = $client->request('GET', $search_url);
    $crawler->filter('.drawRowBorder')->each(function ($fighter) use (&$fighter_boxrec_ID, &$fighter_fullname, &$inactive) {
      $fighter->filter('.personLink')->each(function ($personLink) use (&$fighter_boxrec_ID, &$fighter_fullname, &$inactive) {
        if (trim($personLink->text()) == trim($fighter_fullname)) {
          $link_array        = explode("/", $personLink->extract(array('href'))[0]);
          $fighter_boxrec_ID = end($link_array);
          $inactive = false;
        }
      });
    });
  }

  return $fighter_boxrec_ID;
}

function tbp_get_boxer_boxrec_datas_by_boxrex_id($login_url, $username, $password, $fighter_boxrec_id)
{

  $client = new Client();
  $crawler = $client->request('GET', $login_url);

  $form    = $crawler->selectButton('login[go]')->form();

  $client->submit($form, array('_username' => $username, '_password' => $password));

  $url = "https://boxrec.com/en/boxer/" . $fighter_boxrec_id;
  $crawler = $client->request('GET', $url);

  $fighter_profile = array();

  $fighter_profile['tbp_fighter_boxrec_id'] = $fighter_boxrec_id;

  $crawler->filter('.singleColumn')->each(function ($table) use (&$fighter_profile) {
    $table->filter('td.profileTable')->each(function ($td) use (&$fighter_profile) {
      $td->filter('.rowTable')->each(function ($rowTable) use (&$fighter_profile) {
        $rowTable->filter('tr')->each(function ($tr) use (&$fighter_profile) {

          $items = $tr->filter('tr')->each(function ($tr, $i) {
            return $tr->filter('td')->each(function ($td, $k) {
              return trim($td->text());
            });
          });

          if (empty($items[0][0])) return false;
          if (empty($items[0][1])) return false;

          $plainlabel = $items[0][0];
          $plaintext  = $items[0][1];

          if ($plainlabel == 'alias') {
            $nickname = trim(preg_replace('/[^a-zA-Z]+/', ' ', $plaintext));
            $fighter_profile['tbp_fighter_profile_datas']['tbp_fighter_profile_nickname'] = $nickname;
          } elseif ($plainlabel == 'born') {
            if (strpos($plaintext, '/') !== false) {
              $birthday = substr($plaintext, 0, strpos($plaintext, '/', 1));
            } else {
              $birthday = $plaintext;
            }
            $formatted_birthday = date('F j, Y', strtotime($birthday));
            $fighter_profile['tbp_fighter_profile_datas']['tbp_fighter_profile_birthdate'] = $formatted_birthday;
          } elseif ($plainlabel == 'birth place') {
            $birthplace = trim(preg_replace('/\s+/', ' ', $plaintext));
            $fighter_profile['tbp_fighter_profile_datas']['tbp_fighter_profile_birthplace'] = $birthplace;
          } elseif ($plainlabel == 'division') {
            $division = ucwords(preg_replace('/[^a-zA-Z]+/', '', $plaintext));
            $fighter_profile['tbp_fighter_profile_datas']['tbp_fighter_profile_division'] = $division . 'weight';
          } elseif ($plainlabel == 'stance') {
            $stance = ucwords(preg_replace('/[^a-zA-Z]+/', '', $plaintext));
            $fighter_profile['tbp_fighter_profile_datas']['tbp_fighter_profile_stance'] = $stance;
          } elseif ($plainlabel == 'height') {
            $height = str_replace(array('′', '″'), array('\'', '"'), trim(html_entity_decode(preg_replace('/\s+/', ' ', str_replace('&nbsp;', '', $plaintext)))));
            $fighter_profile['tbp_fighter_profile_datas']['tbp_fighter_profile_height'] = $height;
          } elseif ($plainlabel == 'reach') {
            $reach = str_replace(array('′', '″'), array('\'', '"'), trim(html_entity_decode(preg_replace('/\s+/', ' ', str_replace('&nbsp;', '', $plaintext)))));
            $fighter_profile['tbp_fighter_profile_datas']['tbp_fighter_profile_reach'] = $reach;
          }
        });
      });
    });
  });

  $result = array(
    "L" => 'Lost',
    "W" => 'Win',
    "D" => 'Draw',
    "S" => 'SC',
  );

  $crawler->filter('.dataTable tbody tr.drawRowBorder')->each(function ($career_details) use (&$fighter_profile, &$result) {

    $c_date                                   = trim($career_details->filter('td')->eq(1)->text());
    $c_opponent                               = trim($career_details->filter('td')->eq(4)->text());
    $c_opponent_record                        = trim(str_replace('&nbsp;', '', $career_details->filter('td')->eq(6)->text()));
    $c_location                               = trim($career_details->filter('td')->eq(8)->text());
    $c_result                                 = trim($career_details->filter('td')->eq(9)->text());

    $fighter_profile['tbp_fighter_records'][] = array(
      'tbp_fighter_records_date'            => $c_date,
      'tbp_fighter_records_opponent'        => $c_opponent,
      'tbp_fighter_records_opponent_record' => str_replace(' ', '-', $c_opponent_record),
      'tbp_fighter_records_location'        => $c_location,
      'tbp_fighter_records_result'          => $result[$c_result],
    );
  });

  return $fighter_profile;
}

function tbp_admin_menu()
{
  add_menu_page('Fighter Settings', 'Fighter Settings', 'manage_options', 'co-fighter-settings', 'tbp_admin_menu_page');
}

add_action('admin_menu', 'tbp_admin_menu');

function tbp_admin_menu_page()
{

  $scriptDatas = array(
    'ajaxUrl' => admin_url('admin-ajax.php'),
    'security' => wp_create_nonce('tbp-security-nonce'),
  );

  wp_enqueue_style('tbp-admin-style', get_template_directory_uri() . '/public/assets/styles/backend.css', false);
  wp_enqueue_script('tbp-admin-script', get_template_directory_uri() . '/public/assets/scripts/backend.js', false);
  wp_localize_script('tbp-admin-script', 'backendData', $scriptDatas);

  $postObj = array(
    'post_type'      => 'fighter',
    'posts_per_page' => -1,
    'orderby'        => 'post_id',
    'order'          => 'ASC',
    'post_status'    => 'publish'
  );

  $res = new WP_Query($postObj);

?>
  <div class="container">
    <div class="row text-center">
      <h2 class="mx-auto p-2">Fighters Table
        <button class="btn btn-primary update_all_records">Update All Datas</button>
      </h2>
    </div>
    <div class="row">
      <div class="tbp-model">
        <div class="progress w-100 mt-2 mb-2">
          <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%
          </div>
        </div>
        <div class="fighter-msg w-100"></div>
      </div>
    </div>
    <div class="row mt-0 mb-3">
      <div class="tbp-data-checkboxes mx-auto text-center">
        <label class="checkbox-inline mb-0">
          <input type="checkbox" class="check_profile_data" checked>Profile Data
        </label>
        <label class="checkbox-inline mb-0">
          <input type="checkbox" class="check_records" checked>Records
        </label>
      </div>
    </div>
    <div class="row">
      <table class="table table-bordered table-hover table-sm">
        <thead class="thead-light">
          <tr class="text-center">
            <th scope="col">No</th>
            <th scope="col">Boxrec ID</th>
            <th scope="col">Full Name</th>
            <th scope="col">Visible</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if ($res->have_posts()) {
            $num = 1;
            while ($res->have_posts()) {
              $res->the_post();
              $visible           = get_field('tbp_fighter_visibility');
              $fighter_fullname  = get_the_title();
              $fighter_id        = get_the_ID();
              $fighter_boxrec_id = get_field('tbp_fighter_boxrec_id');
          ?>
              <tr class="align-middle text-center">
                <th scope="row"><?php echo $num; ?>
                  <input type="hidden" id="boxer_name" value="<?php echo $fighter_fullname; ?>">
                  <input type="hidden" id="boxer_id" value="<?php echo $fighter_id; ?>">
                </th>
                <td class="boxrec-id"><a href="https://boxrec.com/en/boxer/<?php echo $fighter_boxrec_id ?>" target="_blank"><?php echo $fighter_boxrec_id ?></a></td>
                <td><a href="<?php echo get_permalink(); ?>" target="_blank"><?php echo $fighter_fullname; ?></a></td>
                <td>
                  <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="customSwitch<?php echo $fighter_id; ?>" <?php if ($visible) : ?> checked<?php endif; ?>>
                    <label class="custom-control-label" for="customSwitch<?php echo $fighter_id; ?>"></label>
                  </div>
                </td>
                <td>
                  <?php if (empty($fighter_boxrec_id)) : ?>
                    <button type="button" class="btn btn-primary get_fighter_boxrec_id" data-toggle="tooltip" data-placement="top" title="Get Boxrec ID">
                      <i class="fa fa-download"></i>
                    </button>
                  <?php endif; ?>
                  <?php if (!empty($fighter_boxrec_id)) : ?>
                    <button type="button" class="btn btn-danger check_fighter_boxrec_data" data-toggle="tooltip" data-placement="top" title="Check Fighter Boxrec Data">
                      <i class="fa fa-refresh"></i>
                    </button>
                  <?php endif; ?>
                </td>
              </tr>
          <?php
              $num++;
            }
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
  <div class="modal tbp-validate-model fade" tabindex="-1" role="dialog" aria-labelledby="tbpValidateModelLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="tbpValidateModelLabel">Warning</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Please Choose At Least One Fetch Data Type
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
<?php
}

add_action('wp_ajax_nopriv_get_fighter_boxrec_id', 'tbp_get_fighter_boxrec_id_function');
add_action('wp_ajax_get_fighter_boxrec_id', 'tbp_get_fighter_boxrec_id_function');

function tbp_get_fighter_boxrec_id_function()
{

  $result = array();

  $full_name = str_replace(array('á', 'ú', 'ñ'), array('a', 'u', 'n'), $_POST['full_name']);

  $full_name = str_replace(
    array(
      'Ruben Villa IV',
      'Jonathan Romero',
      'Christian Ayala',
      'Juan Ramon Reyes',
      'Miguel Madueno',
      'Louie Lopez',
      'Richard Brewart'
    ),
    array(
      'Ruben Villa',
      'Jhonatan Romero',
      'Cristian Ayala',
      'Juan Reyes',
      'Miguel Angel Madueno',
      'Luis Lopez',
      'Richard Brewart Jr'
    ),
    $full_name
  );


  $boxer_id = $_POST['boxer_id'];

  $login_url = 'https://boxrec.com/en/login';
  //$username  = 'kyguney';
  $username  = 'omerycll';
  //$password  = 'k1e9r8e5m';
  $password  = '99xJ$vQc@kWPziC';

  $boxer_boxrec_id = tbp_get_fighter_boxrec_ID_by_name($login_url, $username, $password, $full_name);

  if (!empty($boxer_boxrec_id)) {

    $result['boxrec_id'] = $boxer_boxrec_id;

    update_field('tbp_fighter_boxrec_id', $boxer_boxrec_id, $boxer_id);
  }


  echo json_encode($result);

  die();
}

add_action('wp_ajax_nopriv_change_boxer_visibility', 'tbp_change_boxer_visibility_function');
add_action('wp_ajax_change_boxer_visibility', 'tbp_change_boxer_visibility_function');

function tbp_change_boxer_visibility_function()
{

  $result = array();

  $boxer_id = $_POST['boxer_id'];

  $boxer_visibility = $_POST['visibility'];

  if (update_field('tbp_fighter_visibility', $boxer_visibility, $boxer_id)) {

    $result['message'] = 'success';
  }


  echo json_encode($result);

  die();
}

add_action('wp_ajax_nopriv_check_fighter_boxrec_data', 'tbp_check_fighter_boxrec_data_function');
add_action('wp_ajax_check_fighter_boxrec_data', 'tbp_check_fighter_boxrec_data_function');

function tbp_check_fighter_boxrec_data_function()
{

  $result = array();

  $messages = '';

  $boxer_id = $_POST['boxer_id'];

  $fighter_boxrec_id = $_POST['boxrec_id'];

  $check_profile_data = $_POST['check_profile_data'];

  $check_records = $_POST['check_records'];

  $login_url = 'https://boxrec.com/en/login';
  //$username  = 'kyguney';
  $username  = 'omerycll';
  //$password  = 'k1e9r8e5m';
  $password  = '99xJ$vQc@kWPziC';

  $fighter_name = get_the_title($boxer_id);

  $fighter_boxrec_datas = tbp_get_boxer_boxrec_datas_by_boxrex_id($login_url, $username, $password, $fighter_boxrec_id);

  if ($check_profile_data) {

    $fighter_profile_datas_key        = 'tbp_fighter_profile_datas';
    $fighter_profile_datas_new_values = $fighter_boxrec_datas['tbp_fighter_profile_datas'];

    update_field($fighter_profile_datas_key, $fighter_profile_datas_new_values, $boxer_id);

    $messages .= '<p style="text-align: center">' . $fighter_name . ' Profile Datas are fetched </p>' . "\n";
  }

  if ($check_records) {
    $fighter_records_key        = 'tbp_fighter_records';
    $fighter_records_new_values = $fighter_boxrec_datas['tbp_fighter_records'];

    update_field($fighter_records_key, $fighter_records_new_values, $boxer_id);

    $messages .= '<p style="text-align: center">' . $fighter_name . ' Records are fetched</p>';
  }

  $result['result'] = $messages;

  echo json_encode($result);

  die();
}

function searchArrayValueByKey(array $array, $search)
{
  foreach (new RecursiveIteratorIterator(new RecursiveArrayIterator($array)) as $key => $value) {
    if ($search === $key) {
      return $value;
    }
  }

  return false;
}

add_action('acf/save_post', 'get_theme_options_field', 5);

add_action('acf/save_post', 'on_home_options_save');

add_action('tbp_next_event_deactivation', 'next_event_deactivation');

$currentEventDate = '';

function get_theme_options_field($post_id)
{
  $GLOBALS['currentEventDate'] = getGroupACFsubField('tbp_hero_options', 'tbp_countdown_time', 'home_options');
}

function on_home_options_save()
{
  global $currentEventDate;
  $screen = get_current_screen();
  if (strpos($screen->id, "tbp-options") == true) {

    $newValues = get_fields('home_options');
    $newEventDate = $newValues['tbp_hero_options']["tbp_countdown_time"];
    $activationOfEvent = $newValues['tbp_activation_of_event'];
    $now = new DateTime("now", new DateTimeZone('America/Los_Angeles'));
    $eventDate = new DateTime($newEventDate, new DateTimeZone('America/Los_Angeles'));

    if (($eventDate->format('Y-m-d H:i:s') > $now->format('Y-m-d H:i:s')) && $activationOfEvent && !wp_next_scheduled('tbp_next_event_deactivation')) {
      $eventDate->modify('+ 12 hours');
      wp_schedule_event($eventDate->format('U'), 'hourly', 'tbp_next_event_deactivation');
    } elseif (($eventDate->format('Y-m-d H:i:s') > $now->format('Y-m-d H:i:s')) && $activationOfEvent && wp_next_scheduled('tbp_next_event_deactivation') && $currentEventDate !== $newEventDate) {
      $time_stamp = wp_next_scheduled('tbp_next_event_deactivation');
      wp_unschedule_event($time_stamp, 'tbp_next_event_deactivation');
      wp_clear_scheduled_hook('tbp_next_event_deactivation');
      $eventDate->modify('+ 12 hours');
      wp_schedule_event($eventDate->format('U'), 'hourly', 'tbp_next_event_deactivation');
    } elseif (($now->format('Y-m-d H:i:s') > $eventDate->format('Y-m-d H:i:s')) && $activationOfEvent && !wp_next_scheduled('tbp_next_event_deactivation')) {
      $time_stamp = wp_next_scheduled('tbp_next_event_deactivation');
      wp_unschedule_event($time_stamp, 'tbp_next_event_deactivation');
      wp_clear_scheduled_hook('tbp_next_event_deactivation');
      update_field('tbp_activation_of_event', false, 'home_options');
    } elseif (($now->format('Y-m-d H:i:s') > $eventDate->format('Y-m-d H:i:s')) && $activationOfEvent && wp_next_scheduled('tbp_next_event_deactivation') && $currentEventDate !== $newEventDate) {
      $time_stamp = wp_next_scheduled('tbp_next_event_deactivation');
      wp_unschedule_event($time_stamp, 'tbp_next_event_deactivation');
      wp_clear_scheduled_hook('tbp_next_event_deactivation');
      update_field('tbp_activation_of_event', false, 'home_options');
    } elseif (!$activationOfEvent) {
      $time_stamp = wp_next_scheduled('tbp_next_event_deactivation');
      wp_unschedule_event($time_stamp, 'tbp_next_event_deactivation');
      wp_clear_scheduled_hook('tbp_next_event_deactivation');
    }
  }
}

function next_event_deactivation()
{
  update_field('tbp_activation_of_event', false, 'home_options');
  $time_stamp = wp_next_scheduled('tbp_next_event_deactivation');
  wp_unschedule_event($time_stamp, 'tbp_next_event_deactivation');
  wp_clear_scheduled_hook('tbp_next_event_deactivation');
}
