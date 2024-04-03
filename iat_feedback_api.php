<?php
    require("get_token.php");
    // Just for outputting iat feedback results.
    // Reformats output from script into cleaner array.
    // Now do API call.
    $entityBody = file_get_contents('php://input') . "\n";

    // Reformat string
    // Add in line returns. Each line is delimited by double quotes.
    $entityBody = preg_replace('/",/', "\n", $entityBody);
    // Remove extraneous brackets, then text before colons, then double quotes. Quotes *must* be removed last.
    $entityBody = preg_replace(array('/\{/', '/\}/', '/"[^:]*":"/', '/"/'), '', $entityBody);
    $input_arr = preg_split("/\n/", $entityBody);
    $uid_arr = explode(',', $input_arr[1]);
    $which_iat = substr($input_arr[0], -6);
    $iat_feedback = $input_arr[2];

    $pd_feedback_sextiles = array(
      "There were not enough trials to determine a result." => 0,  // 'No result',
      "There were too many fast trials to determine a result." => 0,  // 'No result',
      "Your data suggest a strong automatic preference for Physically disabled over Abled persons." => 1,  // 'Strong disabled',
      "Your data suggest a moderate automatic preference for Physically disabled over Abled persons." => 2,  // 'Moderate disabled',
      "Your data suggest a weak automatic preference for Physically disabled over Abled persons." => 3,  // 'Weak disabled',
      "Your data suggest a slight automatic preference for Physically disabled over Abled persons." => 4,  // 'Slight disabled',
      "Your data suggest no automatic preference between Abled persons and Physically disabled." => 5,  // 'No preference',
      "Your data suggest a slight automatic preference for Abled persons over Physically disabled." => 6,  // 'Slight abled',
      "Your data suggest a weak automatic preference for Abled persons over Physically disabled." => 7,  // 'Weak abled',
      "Your data suggest a moderate automatic preference for Abled persons over Physically disabled." => 8,  // 'Moderate abled',
      "Your data suggest a strong automatic preference for Abled persons over Physically disabled." => 9,  // 'Strong abled',
    );

    $dd_feedback_sextiles = array(
      "There were not enough trials to determine a result." => 0,  // 'No result',
      "There were too many fast trials to determine a result." => 0,  // 'No result',
      "Your data suggest a strong positive automatic attitude toward Intellectually disabled." => 1,  // 'Strong disabled',
      "Your data suggest a moderate positive automatic attitude toward Intellectually disabled." => 2,  // 'Moderate disabled',
      "Your data suggest a weak positive automatic attitude toward Intellectually disabled." => 3,  // 'Weak preference',
      'Your data suggest a slight positive automatic attitude toward Intellectually disabled.' => 4, // 'Slight disabled',
      "Your data suggest a neutral automatic attitude toward Intellectually disabled." => 5,  // 'No preference',
      'Your data suggest a slight negative automatic attitude toward Intellectually disabled.' => 6, // 'Slight abled',
      "Your data suggest a weak negative automatic attitude toward Intellectually disabled." => 7,  // 'Weak abled',
      "Your data suggest a moderate negative automatic attitude toward Intellectually disabled." => 8,  // 'Moderate abled',
      "Your data suggest a strong negative automatic attitude toward Intellectually disabled." => 9,  // 'Strong abled',
    );

    if ($which_iat == 1) {
      $iat_score = $pd_feedback_sextiles[$iat_feedback];
    } else {
      $iat_score = $dd_feedback_sextiles[$iat_feedback];
    }

    $data = array(
      'token' => $API_TOKEN,
      'content' => 'record',
      'action' => 'import',
      'format' => 'json',
      'type' => 'flat',
      'overwriteBehavior' => 'normal',
      'forceAutoNumber' => 'false',
      'data' => "[{'record_id': 1, 'iat_scor': '5', 'iat_verbal': 'test_feedback'}]",
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
    curl_close($request);

?>

<?php
$data = array(
    'token' => 'F817EAB4C7F28935AF6DA4B6BA690316',
    'content' => 'surveyLink',
    'format' => 'json',
    'instrument' => 'results',
    'event' => '',
    'record' => '',
    'returnFormat' => 'json'
);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://redcap.einsteinmed.org/api/');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_VERBOSE, 0);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_AUTOREFERER, true);
curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_FRESH_CONNECT, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data, '', '&'));
$output = curl_exec($ch);
print $output;
curl_close($ch);
?>
