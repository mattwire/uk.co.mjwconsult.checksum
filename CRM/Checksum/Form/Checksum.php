<?php
/*
 +--------------------------------------------------------------------+
 | Copyright CiviCRM LLC. All rights reserved.                        |
 |                                                                    |
 | This work is published under the GNU AGPLv3 license with some      |
 | permitted exceptions and without any warranty. For full license    |
 | and copyright information, see https://civicrm.org/licensing       |
 +--------------------------------------------------------------------+
 */

/**
 * Class CRM_Checksum_Form_Checksum
 */
class CRM_Checksum_Form_Checksum extends CRM_Core_Form {

  public function buildQuickForm() {
    $contactId = CRM_Utils_Array::value('cid', $_GET, 0);

    $this->assign('contactId', $contactId);
    $this->assign('checksumExpiryDays', Civi::settings()->get('checksum_timeout'));
    $this->assign('userFramework', CRM_Core_Config::singleton()->userFramework);

    if (!empty($contactId)) {
      $cs = CRM_Contact_BAO_Contact_Utils::generateChecksum($contactId);
      $this->assign('checksum', $cs);
    }

    if (!empty($contactId)) {
      $recurs = civicrm_api3('ContributionRecur', 'get', ['contact_id' => $contactId]);
      foreach (CRM_Utils_Array::value('values', $recurs) as $recur) {
        if (!empty($recur['payment_processor_id'])) {

        }
      }
    }

    //$payment = new CRM_Core_Payment_Dummy();
    //$payment->subscriptionURL(NULL, NULL, 'cancel');

    $this->addButtons(array(
      array(
        'type' => 'submit',
        'name' => ts('Done'),
        'isDefault' => TRUE,
      ),
    ));

    parent::buildQuickForm();
  }

  public function postProcess() {
    parent::postProcess();
  }
}
