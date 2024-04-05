<?php
    require("get_token.php");
    require("api_calls.php");
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
      '1' => 'Your result: 1 = Strong preference: persons with physical disability',
      '2' => 'Your result: 2 = Moderate preference: persons with physical disability',
      '3' => 'Your result: 3 = Slight preference: persons with physical disability',
      '4' => 'Your result: 4 = No preference',
      '5' => 'Your result: 5 = Slight preference: persons without physical disability',
      '6' => 'Your result: 6 = Moderate preference: persons without physical disability',
      '7' => 'Your result: 7 = Strong preference: persons without physical disability',
      '9' => 'Your result: There were too many errors made to determine a result.',
      '10' => 'Your result: There were too many fast trials to determine a result.',
      '11' => 'Your result: There were not enough trials to determine a result.',
    );

    $dd_feedback_sextiles = array(
      '1' => 'Your result: 1 = Strongly positive towards persons with DD',
      '2' => 'Your result: 2 = Moderately positive towards persons with DD',
      '3' => 'Your result: 3 = Slightly positive towards persons with DD',
      '4' => 'Your result: 4 = Neutral',
      '5' => 'Your result: 5 = Slightly negative towards persons with DD',
      '6' => 'Your result: 6 = Moderately negative towards persons with DD',
      '7' => 'Your result: 7 = Strongly negative towards persons with DD',
      '9' => 'Your result: There were too many errors made to determine a result.',
      '10' => 'Your result: There were too many fast trials to determine a result.',
      '11' => 'Your result: There were not enough trials to determine a result.',
    );

    if ($which_iat == 1) {
      $explanation =
          'Physical Disability IAT scores range from:'
          . ' 1 = “Strongly prefer persons with physical disability”'
          . ' to 7 = “Strongly prefer persons without physical disability.”';
      $iat_text = $explanation . '\n\n' . $pd_feedback_sextiles[$iat_feedback];
    } else {
      // Developmental disability
      $explanation =
          'Developmental Disability (DD) IAT scores range from:'
          . ' 1 = “Strongly positive towards persons with DD”'
          . ' to 7 = “Strongly negative towards persons with DD.”';
      $iat_text = $explanation . '\n\n' . $dd_feedback_sextiles[$iat_feedback];
    }
    send_data($API_TOKEN, $redcap_uid, $iat_score, $iat_text);
?>
