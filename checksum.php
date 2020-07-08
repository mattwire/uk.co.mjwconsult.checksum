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

require_once 'checksum.civix.php';
use CRM_Checksum_ExtensionUtil as E;

/**
 * Implements hook_civicrm_config().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function checksum_civicrm_config(&$config) {
  _checksum_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_xmlMenu
 */
function checksum_civicrm_xmlMenu(&$files) {
  _checksum_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function checksum_civicrm_install() {
  _checksum_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_postInstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_postInstall
 */
function checksum_civicrm_postInstall() {
  _checksum_civix_civicrm_postInstall();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_uninstall
 */
function checksum_civicrm_uninstall() {
  _checksum_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function checksum_civicrm_enable() {
  _checksum_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_disable
 */
function checksum_civicrm_disable() {
  _checksum_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_upgrade
 */
function checksum_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _checksum_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_managed
 */
function checksum_civicrm_managed(&$entities) {
  _checksum_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types.
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function checksum_civicrm_caseTypes(&$caseTypes) {
  _checksum_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_angularModules
 */
function checksum_civicrm_angularModules(&$angularModules) {
  _checksum_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterSettingsFolders
 */
function checksum_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _checksum_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

function checksum_civicrm_summaryActions(&$actions, $contactID) {
  $actions['checksum'] = array(
    'title' => 'Contact Checksum',
    'weight' => 999,
    'ref' => 'checksum',
    'key' => 'checksum',
    'class' => 'crm-popup',
    'href' => CRM_Utils_System::url('civicrm/contact/checksum/generate', "reset=1&cid={$contactID}"));
}

/**
 * hook_civicrm_pageRun
 *
 * @param \CRM_Core_Page $page
 */
function checksum_civicrm_pageRun(&$page) {
  $fname = 'checksum_civicrm_pageRun_'.$page->getVar('_name');
  if (function_exists($fname)) {
    $fname($page);
  }
}

/*
 * Display extra info on the recurring contribution view
 */
function checksum_civicrm_pageRun_CRM_Contribute_Page_ContributionRecur($page) {
  // get the recurring contribution record or quit
  $crid = CRM_Utils_Request::retrieve('id', 'Integer', $page, FALSE);
  try {
    $recur = civicrm_api3('ContributionRecur', 'getsingle', ['id' => $crid]);
  }
  catch (CiviCRM_API3_Exception $e) {
    return;
  }

  $paymentProcessor = \Civi\Payment\System::singleton()->getById($recur['payment_processor_id']);
  $template = CRM_Core_Smarty::singleton();
  $cancelSubscriptionUrl = $paymentProcessor->subscriptionURL($recur['id'], 'recur', 'cancel');
  $updateSubscriptionBillingUrl = $paymentProcessor->subscriptionURL($recur['id'], 'recur', 'billing');
  $updateSubscriptionUrl = $paymentProcessor->subscriptionURL($recur['id'], 'recur', 'update');

  $checksum = '&cs=' . CRM_Contact_BAO_Contact_Utils::generateChecksum($recur['contact_id']);
  if ($cancelSubscriptionUrl) {
    $template->assign('cancelSubscriptionUrl', $cancelSubscriptionUrl . $checksum);
  }
  if ($updateSubscriptionBillingUrl) {
    $template->assign('updateSubscriptionBillingUrl', $updateSubscriptionBillingUrl . $checksum);
  }
  if ($updateSubscriptionUrl) {
    $template->assign('updateSubscriptionUrl', $updateSubscriptionUrl . $checksum);
  }

  CRM_Core_Region::instance('page-body')->add([
    'template' => 'CRM/Checksum/Form/ContributionRecur.tpl',
  ]);
}
