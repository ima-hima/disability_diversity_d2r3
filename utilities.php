<?php
  function getUserIpAddr()
  {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
      return $_SERVER['HTTP_CLIENT_IP'];
    }
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
      return $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    return $_SERVER['REMOTE_ADDR'];
  }

  function find_and_update_dupe_ips($API_TOKEN, $redcap_uid)
  {
    $this_ip = getUserIpAddr();
    echo("IP: $this_ip<br />");
    $ips_seen = get_ips($API_TOKEN, $redcap_uid);
    $dupes = array();
    $is_dupe = False;
    foreach ($ips_seen as $_ => $dict) {
      // If the other IP address starts with "dup" then get last 10 chars, else just
      // use the entire other ID string.
      // Recall that the first number in `substr()` is offset and if last argument
      // is left empty it will include through end of string.
      $other_ip = (substr($dict["client_ip"], 0, 3) === 'dup') ? substr($dict["client_ip"], 10) : $dict["client_ip"];
      $other_uid = $dict["record_id"];
      if ($other_ip === $this_ip and $redcap_uid !== $other_uid) {
        # Push JSON dict string with IP prepended with "duplicate_".
        array_push($dupes, "{\"record_id\": $other_uid, \"client_ip\": \"duplicate_$this_ip\"}");
        $is_dupe = True;
      }
    }
    if ($is_dupe) {
      # This IP is a dupe. Add it to list of duplicates, prepending "duplicate_"
      array_push($dupes, "{\"record_id\": $redcap_uid, \"client_ip\": \"duplicate_$this_ip\"}");
    } else {
      // If there are no duplicates we just add this record.
      $dupes[0] = "{\"record_id\": \"$redcap_uid\", \"client_ip\": \"$this_ip\"}";
    }
    update_ips($API_TOKEN, $dupes);
    return sizeof($dupes) > 1;
  }
?>
