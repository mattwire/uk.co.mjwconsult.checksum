<?php

/**
 * ContactChecksum.Gettimeoutdays API specification (optional)
 * This is used for documentation and validation.
 *
 * @param array $spec description of fields supported by this API call
 * @return void
 * @see http://wiki.civicrm.org/confluence/display/CRMDOC/API+Architecture+Standards
 */
function _civicrm_api3_contact_checksum_Gettimeoutdays_spec(&$spec) {
}

/**
 * ContactChecksum.Gettimeoutdays API
 *
 * @param array $params
 * @return array API result descriptor
 * @see civicrm_api3_create_success
 * @see civicrm_api3_create_error
 * @throws API_Exception
 */
function civicrm_api3_contact_checksum_Gettimeoutdays($params) {
  $days = Civi::settings()->get('checksum_timeout');

  $returnValues = array(
      // OK, return several data rows
      'days' => $days,
  );

  // Makes no sense to use sequential mode
  if (isset($params['sequential'])) {
    unset($params['sequential']);
  }

  // Spec: civicrm_api3_create_success($values = 1, $params = array(), $entity = NULL, $action = NULL)
  return civicrm_api3_create_success($returnValues, $params, 'ContactChecksum', 'gettimeoutdays');
}
