<?php

/**
 * ContactChecksum.Validate API specification (optional)
 * This is used for documentation and validation.
 *
 * @param array $spec description of fields supported by this API call
 * @return void
 * @see http://wiki.civicrm.org/confluence/display/CRMDOC/API+Architecture+Standards
 */
function _civicrm_api3_contact_checksum_Validate_spec(&$spec) {
  $spec['id']['api.required'] = 1;
  $spec['checksum']['api.required'] = 1;
}

/**
 * ContactChecksum.Validate API
 *
 * @param array $params
 * @return array API result descriptor
 * @see civicrm_api3_create_success
 * @see civicrm_api3_create_error
 * @throws API_Exception
 */
function civicrm_api3_contact_checksum_Validate($params) {
  if ((array_key_exists('id', $params) && !empty($params['id']))
    && (array_key_exists('checksum', $params) && !empty($params['checksum']))) {
    $cs = CRM_Contact_BAO_Contact_Utils::validChecksum($params['id'], $params['checksum']);
    $returnValues = array(
      'id' => $params['id'],
      'checksum' => $cs,
    );

    // Makes no sense to use sequential mode
    if (isset($params['sequential'])) {
      unset($params['sequential']);
    }

    // Spec: civicrm_api3_create_success($values = 1, $params = array(), $entity = NULL, $action = NULL)
    return civicrm_api3_create_success($returnValues, $params, 'ContactChecksum', 'validate');
  }
  else {
    throw new API_Exception(/*errorMessage*/ 'Contact ID and checksum must be specified', /*errorCode*/ 1);
  }
}
