<?php
  $env_file_path = realpath(__DIR__."/.env");
  //Check .env file exists and is readable.
  if (!is_file($env_file_path) || !is_readable($env_file_path)) {
      http_response_code(500);
      header('Location: 500.html');
  }
  $API_TOKEN = '';
  $VALID_CODE = '';
  // Open the .en file using the reading mode
  $fopen = fopen($env_file_path, 'r');
  $env_arr = array();
  if ($fopen) {
    //Loop the lines of the file
    while (($line = fgets($fopen)) !== false) {
        // Check if line is a comment
        $env_ex = preg_split('/(\s?)\=(\s?)/', $line);
        $valid = $env_ex[0];
        $$valid = isset($env_ex[1]) ? trim($env_ex[1]) : "";
    }
    // Close the file
    fclose($fopen);
  }
?>
