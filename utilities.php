<?php
  function is_duplicate_ip($ip)
  {
    // Return true if IP has been seen before, false otherwise.
    if (!is_dir("results/answers")) {
        if (!@mkdir("results/answers")) {
            $error = error_get_last();
            echo $error['message'];
        }
    }

    if (!file_exists("ip_addresses.txt")) {
      file_put_contents("ip_addresses.txt", "\n$ip", FILE_APPEND);
    } else {
      foreach(file("ip_addresses.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
        if ($line === $ip) {
          return true;
        } else {
          file_put_contents("ip_addresses.txt", "\n$ip", FILE_APPEND);
        }
      }
    }
  }
?>
