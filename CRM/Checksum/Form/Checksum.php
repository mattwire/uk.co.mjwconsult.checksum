<?php

/**
 * Form controller class
 *
 * @see https://wiki.civicrm.org/confluence/display/CRMDOC/QuickForm+Reference
 */
class CRM_Checksum_Form_Checksum extends CRM_Core_Form {
  public function buildQuickForm() {
    $contactId = CRM_Utils_Array::value('cid', $_GET, 0);

    $this->assign('contactId', $contactId);
    $this->assign('checksumExpiryDays', Civi::settings()->get('checksum_timeout'));

    if (!empty($contactId)) {
      $cs = CRM_Contact_BAO_Contact_Utils::generateChecksum($contactId);
      $this->assign('checksum', $cs);
    }

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
