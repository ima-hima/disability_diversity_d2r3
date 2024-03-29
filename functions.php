<?php
  ini_set('display_startup_errors', 1);
  ini_set('display_errors', 1);
  error_reporting(E_ALL);

  function clear_directory($dir_name) {
    if (is_dir($dir_name)) {
      if ($dir = opendir($dir_name)) {
        while (($file_name = readdir($dir)) !== false) {
          $file_path = "$dir_name/$file_name";
          // . & .. can't be cleared, but .htaccess must be, so special
          // logic here.
          if (is_dir($file_path) and substr($file_name, 0, 1) != '.') {
            clear_directory($file_path);
          } elseif (!is_dir($file_path)) {
            unlink($file_path);
          }
        }
        closedir($dir);
      }
      rmdir($dir_name);
    }
  }

  $sub_dirs = array('initial_participants' => 'Initial Participants',
                    'feedback' => 'IAT Feedback',
                    'answers' => 'Final output');
  $password_hash = '$2y$10$EuvvcNeKvie1HZcgqDMP6OyQz0yKkBOvViwEZ7VMudZloQFdp.0pu';
  $delete = false;
  // if ($_SERVER['HTTP_HOST'] == 'localhost') {
  //   $results_directory = 'uploads/results';
  // } else {
  //   $results_directory = '/uploads/results';
  // }
  $results_directory = '/uploads/results';
?>
