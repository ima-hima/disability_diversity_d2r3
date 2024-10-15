<?php
  function getUserIpAddr()
  {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
      $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
      $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
      $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
  }

  function find_and_update_dupe_ips($API_TOKEN, $redcap_uid)
  {
    $this_ip = getUserIpAddr();
    $ips_seen = get_ips($API_TOKEN, $redcap_uid);
    $dupes = array();
    $is_dupe = False;
    foreach ($ips_seen as $_ => $dict) {
      // If the other IP address starts with "dup" then get last 10 chars, else just
      // use the entire other ID string.
      $other_ip = (substr($dict["client_ip"], 3) === 'dup') ? substr($dict["client_ip"], 10) : $dict["client_ip"];
      $other_id = $dict["record_id"];
      if ($other_ip === $this_ip and $redcap_uid !== $other_id) {
        array_push($dupes, "{\"record_id\": $other_id, \"client_ip\": \"duplicate_$this_ip\"}");
        $is_dupe = True;
      }
    }
    if ($is_dupe) {
      # These will be added to REDCap via the API. I'm prepending "duplicate_" here
      # because in the `else` I'll put in the bare IP for this record.
      array_push($dupes, "{\"record_id\": $redcap_uid, \"client_ip\": \"duplicate_$this_ip\"}");
    } else {
      // If there are no duplicates we just add this record
      $dupes[0] = "{\"record_id\": $redcap_uid, \"client_ip\": \"$this_ip\"}";
    }
    update_ips($API_TOKEN, $dupes);
    return sizeof($dupes) > 1;
  }
?>
