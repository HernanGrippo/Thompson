<?php

use Ctct\ConstantContact;
use Ctct\Exceptions\CtctException;
use ct\Components\Contacts;
use Ctct\Components\Contacts\Contact;

function tbp_handle_constant_contact_data_callback()
{

  if (!check_ajax_referer('tbp-security-nonce', 'security')) {
    exit(wp_send_json_error('Invalid security token sent.'));
    die;
  }

  $scriptDatas = [];

  $scriptDatas['result'] = 'noAction';

  if ($_POST) {

    require TBP_THEME_PATH . '/library/constant-contact/vendor/autoload.php';

    $newsletterApiKey = TbpMaintenance::getGroupACFsubField('tbp_newsletter_options', 'tbp_constant_contact_api_key', 'home_options');
    $newsletterActivityID = TbpMaintenance::getGroupACFsubField('tbp_newsletter_options', 'tbp_campaing_activity_id', 'home_options');
    $newsletterTOKEN = TbpMaintenance::getGroupACFsubField('tbp_newsletter_options', 'tbp_constant_contact_token', 'home_options');
    $newsletterName = 'Thompson Boxing Newsletter';

    if (!empty($newsletterApiKey) && !empty($newsletterTOKEN)) {

      $cc = new ConstantContact($newsletterApiKey);
      $email = $_POST['email'];
      try {
        $tbpListContants = $cc->contactService->getContacts($newsletterTOKEN, array('email' => $email, 'status' => 'ACTIVE'));
        if(is_numeric($tbpListContants->results[0]->id)){
          echo json_encode(false);
        }else{
          $email = $_POST['email'];
          $allLists = $cc->listService->getLists($newsletterTOKEN);
          $listIndex = array_search($newsletterName, array_column($allLists, 'name'));
          $listId = $allLists[$listIndex]->id;
          $contact = new Contact();
          $contact->addEmail($email);
          $contact->addList($listId);
          $params = array(
            'action_by' => 'ACTION_BY_OWNER'
          );
          $result = $cc->contactService->addContact($newsletterTOKEN, $contact, $params);
          echo json_encode($result);
        }
      } catch (CtctException $e) {
        $scriptDatas['result'] = 'error';
        $scriptDatas['message'] = $e->getErrors();
        echo json_encode(false);
      }
    }
  }

  die;
}
