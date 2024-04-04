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
      "There were not enough trials to determine a result." => 0,  // 'No result',
      "There were too many fast trials to determine a result." => 0,  // 'No result',
      "Your data suggest a strong automatic preference for Disabled person over Abled person." => 1,  // 'Strong disabled',
      "Your data suggest a moderate automatic preference for Disabled person over Abled person." => 2,  // 'Moderate disabled',
      "Your data suggest a weak automatic preference for Disabled person over Abled person." => 3,  // 'Weak disabled',
      "Your data suggest a slight automatic preference for Disabled person over Abled person." => 3,  // 'Slight disabled',
      "Your data suggest no automatic preference between Abled person and Disabled person." => 4,  // 'No preference',
      "Your data suggest a slight automatic preference for Abled person over Disabled person." => 5,  // 'Slight abled',
      "Your data suggest a weak automatic preference for Abled person over Disabled person." => 5,  // 'Weak abled',
      "Your data suggest a moderate automatic preference for Abled person over Disabled person." => 6,  // 'Moderate abled',
      "Your data suggest a strong automatic preference for Abled person over Disabled person." => 7,  // 'Strong abled',
    );

    $dd_feedback_sextiles = array(
      "There were not enough trials to determine a result." => 0,  // 'No result',
      "There were too many fast trials to determine a result." => 0,  // 'No result',
      "Your data suggest a strong positive automatic attitude toward Developmentally disabled." => 1,  // 'Strong disabled',
      "Your data suggest a moderate positive automatic attitude toward Developmentally disabled." => 2,  // 'Moderate disabled',
      "Your data suggest a weak positive automatic attitude toward Developmentally disabled." => 3,  // 'Weak preference',
      'Your data suggest a slight positive automatic attitude toward Developmentally disabled.' => 3, // 'Slight disabled',
      "Your data suggest a neutral automatic attitude toward Developmentally disabled." => 4,  // 'No preference',
      'Your data suggest a slight negative automatic attitude toward Developmentally disabled.' => 5, // 'Slight abled',
      "Your data suggest a weak negative automatic attitude toward Developmentally disabled." => 5,  // 'Weak abled',
      "Your data suggest a moderate negative automatic attitude toward Developmentally disabled." => 6,  // 'Moderate abled',
      "Your data suggest a strong negative automatic attitude toward Developmentally disabled." => 7,  // 'Strong abled',
    );

    if ($which_iat == 1) {
      $iat_score = $pd_feedback_sextiles[$iat_feedback];
    } else {
      $iat_score = $dd_feedback_sextiles[$iat_feedback];
    }
    echo "IAT feedback: $iat_feedback<br>IAT score: $iat_score";
    send_data($API_TOKEN, $redcap_uid, $iat_score);
?>
