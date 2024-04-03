<?php
  $env_file_path = realpath(__DIR__."/.env");
  //Check .env file exists and is readable.
  if (!is_file($env_file_path) || !is_readable($env_file_path)) {
    http_response_code(500);
    echo 'Token not available. Please contact the server administrator with this message.';
    exit();
  }
  $API_TOKEN = '';
  // Open the .en file using the reading mode
  $fopen = fopen($env_file_path, 'r');
  if ($fopen) {
    //Loop the lines of the file
    while (($line = fgets($fopen)) !== false) {
        // Check if line is a comment
        $env_ex = preg_split('/(\s?)\=(\s?)/', $line);
        $env_value = isset($env_ex[1]) ? trim($env_ex[1]) : "";
        $API_TOKEN = $env_value;
    }
    // Close the file
    fclose($fopen);
  }
?>
