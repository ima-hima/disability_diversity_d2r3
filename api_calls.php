<?php
  function get_iat_choice($API_TOKEN, $redcap_uid)
  {
    // Figure out which IAT they're taking, which is stored as `randomize`,
    // and 1 = Physical Disability IAT and 2 = Developmental Disability IAT.
    $data = array(
        'token' => $API_TOKEN,
        'content' => 'record',
        'action' => 'export',
        'format' => 'json',
        'type' => 'flat',
        'csvDelimiter' => '',
        'records' => array($redcap_uid),
        'fields' => array('randomize'),
        'rawOrLabel' => 'raw',
        'rawOrLabelHeaders' => 'raw',
        'exportCheckboxLabel' => 'false',
        'exportSurveyFields' => 'false',
        'exportDataAccessGroups' => 'false',
        'returnFormat' => 'json'
    );

    $request = curl_init();
    curl_setopt($request, CURLOPT_URL, 'https://redcap.einsteinmed.org/api/');
    curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($request, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($request, CURLOPT_VERBOSE, 0);
    curl_setopt($request, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($request, CURLOPT_AUTOREFERER, true);
    curl_setopt($request, CURLOPT_MAXREDIRS, 10);
    curl_setopt($request, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($request, CURLOPT_FRESH_CONNECT, 1);
    curl_setopt($request, CURLOPT_POSTFIELDS, http_build_query($data, '', '&'));
    $json = curl_exec($request);
    curl_close($request);
    $arr = json_decode($json, true);
    $which_iat = $arr[0]['randomize'];
    return $which_iat;
  }

  function get_ips($API_TOKEN, $redcap_uid)
  {
    /*
    Get the ip address for every participant we've seen so far, i.e. every
    id < $redcap_uid.
    */
    $data = array(
      'token' => $API_TOKEN,
      'content' => 'record',
      'action' => 'export',
      'format' => 'json',
      'type' => 'flat',
      'csvDelimiter' => '',
      'records' => range(0, 300),
      'fields' => array('record_id', 'client_ip'),
      'rawOrLabel' => 'raw',
      'rawOrLabelHeaders' => 'raw',
      'exportCheckboxLabel' => 'false',
      'exportSurveyFields' => 'false',
      'exportDataAccessGroups' => 'false',
      'returnFormat' => 'json'
    );
    $request = curl_init();
    curl_setopt($request, CURLOPT_URL, 'https://redcap.einsteinmed.org/api/');
    curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($request, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($request, CURLOPT_VERBOSE, 0);
    curl_setopt($request, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($request, CURLOPT_AUTOREFERER, true);
    curl_setopt($request, CURLOPT_MAXREDIRS, 10);
    curl_setopt($request, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($request, CURLOPT_FRESH_CONNECT, 1);
    curl_setopt($request, CURLOPT_POSTFIELDS, http_build_query($data, '', '&'));
    $result = curl_exec($request);
    curl_close($request);
    echo("IP request result: $result <br />");
    $arr = json_decode($result, true);
    return $arr;
  }

  function get_confirmation_code($API_TOKEN, $redcap_uid)
  {
    $data = array(
      'token' => $API_TOKEN,
      'content' => 'record',
      'action' => 'export',
      'format' => 'json',
      'type' => 'flat',
      'csvDelimiter' => '',
      'records' => array($redcap_uid),
      'fields' => array('identity'),
      'rawOrLabel' => 'raw',
      'rawOrLabelHeaders' => 'raw',
      'exportCheckboxLabel' => 'false',
      'exportSurveyFields' => 'false',
      'exportDataAccessGroups' => 'false',
      'returnFormat' => 'json'
    );
    $request = curl_init();
    curl_setopt($request, CURLOPT_URL, 'https://redcap.einsteinmed.org/api/');
    curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($request, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($request, CURLOPT_VERBOSE, 0);
    curl_setopt($request, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($request, CURLOPT_AUTOREFERER, true);
    curl_setopt($request, CURLOPT_MAXREDIRS, 10);
    curl_setopt($request, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($request, CURLOPT_FRESH_CONNECT, 1);
    curl_setopt($request, CURLOPT_POSTFIELDS, http_build_query($data, '', '&'));
    $json = curl_exec($request);
    curl_close($request);
    $arr = json_decode($json, true);
    return $arr[0]['identity'];
  }


  function get_redirect_url($API_TOKEN, $redcap_uid)
  {
    // Get necessary url (surveyLink) to resume survey on REDCap.
    $data = array(
        'token' => $API_TOKEN,
        'content' => 'surveyLink',
        'format' => 'json',
        'instrument' => 'results',
        'event' => '',
        'record' => $redcap_uid,
        'returnFormat' => 'json'
    );
    $request = curl_init();
    curl_setopt($request, CURLOPT_URL, 'https://redcap.einsteinmed.org/api/');
    curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($request, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($request, CURLOPT_VERBOSE, 0);
    curl_setopt($request, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($request, CURLOPT_AUTOREFERER, true);
    curl_setopt($request, CURLOPT_MAXREDIRS, 10);
    curl_setopt($request, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($request, CURLOPT_FRESH_CONNECT, 1);
    curl_setopt($request, CURLOPT_POSTFIELDS, http_build_query($data, '', '&'));
    $result = curl_exec($request);
    curl_close($request);
    return $result;
  }

  function send_data($API_TOKEN, $redcap_uid, $iat_score)
  {
    $data = array(
      'token' => $API_TOKEN,
      'content' => 'record',
      'action' => 'import',
      'format' => 'json',
      'type' => 'flat',
      'overwriteBehavior' => 'normal',
      'forceAutoNumber' => 'false',
      'data' => "[{\"record_id\": $redcap_uid, \"iat_scor\": $iat_score}]",
      'returnContent' => 'count',
      'returnFormat' => 'json'
    );
    $request = curl_init();
    curl_setopt($request, CURLOPT_URL, 'https://redcap.einsteinmed.org/api/');
    curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($request, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($request, CURLOPT_VERBOSE, 0);
    curl_setopt($request, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($request, CURLOPT_AUTOREFERER, true);
    curl_setopt($request, CURLOPT_MAXREDIRS, 10);
    curl_setopt($request, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($request, CURLOPT_FRESH_CONNECT, 1);
    curl_setopt($request, CURLOPT_POSTFIELDS, http_build_query($data, '', '&'));
    $output = curl_exec($request);
    curl_close($request);
  }

  function update_ips($API_TOKEN, $dupes)
  {
    /*
      Build a JSON string such that each id/ip pair in $dupes is a dict of form
      {"record_id": id, "client_ip": "dupe <ip>"} and send resulting data to
      redcap to update.
    */
    $data = array(
      'token' => $API_TOKEN,
      'content' => 'record',
      'action' => 'import',
      'format' => 'json',
      'type' => 'flat',
      'overwriteBehavior' => 'normal',
      'forceAutoNumber' => 'false',
      'data' => "[" . implode(",", $dupes) . "]",
      'returnContent' => 'count',
      'returnFormat' => 'json'
    );
    echo("<br />Data to server:<br />");
    print_r($data);
    $request = curl_init();
    curl_setopt($request, CURLOPT_URL, 'https://redcap.einsteinmed.org/api/');
    curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($request, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($request, CURLOPT_VERBOSE, 0);
    curl_setopt($request, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($request, CURLOPT_AUTOREFERER, true);
    curl_setopt($request, CURLOPT_MAXREDIRS, 10);
    curl_setopt($request, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($request, CURLOPT_FRESH_CONNECT, 1);
    curl_setopt($request, CURLOPT_POSTFIELDS, http_build_query($data, '', '&'));
    $output = curl_exec($request);
    echo("<br />Records changed: ");
    echo(json_decode($output, true)["count"]);
    echo('<br /><br />');
    curl_close($request);
  }
?>
