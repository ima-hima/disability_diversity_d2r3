<?php
  function clear_directory($directory, $sub_dir) {
    if ($opendirectory = opendir("$directory/initial_participants")) {
      while (($file = readdir($opendirectory)) !== false) {
        if (!unlink("$directory/initial_participants/$file")) {
          echo "Couldn’t delete $directory/initial_participants/$file.";
        }
      }
      closedir($opendirectory);
    } else {
      echo "Couldn't open $directory/initial_participants.";
    }
  }

  $password_hash = '$2y$10$EuvvcNeKvie1HZcgqDMP6OyQz0yKkBOvViwEZ7VMudZloQFdp.0pu';
  ini_set('display_startup_errors', 1);
  ini_set('display_errors', 1);
  error_reporting(-1);
  if ($_SERVER['HTTP_HOST'] == 'localhost') {
    $results_directory = 'uploads/results';
  } else {
    $results_directory = '/uploads/results';
  }
?>