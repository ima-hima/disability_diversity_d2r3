<?php
    require("get_token.php");
    require("api_calls.php");
    // Just for outputting iat feedback results.
    // Reformats output from script into cleaner array.
    // Now do API call.
    $entityBody = file_get_contents('php://input') . "\n";

    // Reformat string. Original string is thus, including quote marks and brackets.
    // Note that headers are between first set of quotes and vals in second:
    // {"header":"uid, iat_score","contents":"23, 7"}

    // Add in line returns. Keys will be on first line, vals in second.
    $entityBody = preg_replace('/",/', "\n", $entityBody);

    // Remove extraneous brackets, then text before colons, then double quotes.
    // Quotes *must* be removed last.
    $entityBody = preg_replace(array('/\{/', '/\}/', '/"[^:]*":"/', '/"/'), '', $entityBody);

    // Split so vals will be on second line.
    $input_arr = preg_split("/\n/", $entityBody);
    // Explode second line to separate vals. Order will be redcap_uid, score.
    [$redcap_uid, $iat_score] = explode(',', $input_arr[1]);

    send_data($API_TOKEN, $redcap_uid, $iat_score);
?>
