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
    $cur_ip = getUserIpAddr();
    $ips_seen = get_ips($API_TOKEN, $redcap_uid, );
    foreach ($ips as $_ => $dict) {
      $dupes = array();
      $is_dupe = False;
      $other_ip = (strlen($dict["client_ip"]) == 15) ? $dict["client_ip"] : substr($dict["client_ip"], 10);
      $other_id = $dict["record_id"];
      if ($other_ip == $ip and $redcap_uid != $dict["record_id"]) {
        array_append($dupes, "{\"record_id\": $other_id, \"client_ip\": duplicate_$ip}");
        $is_dupe = True;
      }
    }
    if ($is_dupe) {
      array_append($dupes, "{\"record_id\": $redcap_uid, \"client_ip\": duplicate_$ip}");
    }
    return sizeof($dupes);
  }
?>
