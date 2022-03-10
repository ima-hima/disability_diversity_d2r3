<?php
  /* Delete all files in uploads directory and empty result subdirectories. */
  require('functions.php');
  $form_action = 'delete_results.php';
  $form_head = '';
  $form_text = 'Enter password to delete current results.';
  $submit_text = 'Delete results';
  require('header.php');
  if (!isset($_GET['pass'])) {
    require('password_form.php');
          // I used password hash to encrypt password.
  } elseif (password_verify($_GET['pass'], $password_hash)) {
    $archive_dir = "$results_directory/to_archive";
    clear_directory($archive_dir);
    echo "$archive_dir has been deleted.<br />";
    if ($dir = opendir($results_directory)) {
      while (($file_name = readdir($dir)) !== false) {
        $file_path = "$results_directory/$file_name";
        // . & .. can't be cleared, but .htaccess must be, so special
        // logic here.
        if (substr($file_name, -4) == '.zip' or substr($file_name, -4) == '.txt') {
          unlink($file_path);
          echo "$file_name has been deleted.<br />";
        }
      }
      closedir($dir);
    }
    foreach ($sub_dirs as $sub_dir => $description) {
      $cur_dir = "$results_directory/$sub_dir";
      if (is_dir($cur_dir)) {
        if ($opendirectory = opendir($cur_dir)) {
          while (($file = readdir($opendirectory)) !== false) {
            if (substr($file, 0, 1) != '.') {
              unlink("$cur_dir/$file");
            }
          }
        closedir($opendirectory);
        echo "All results in $description have been deleted.<br />";
        }
      }
    }
  } else { // wrong password
    require('header.php');
    $form_head = 'Password incorrect';
    require('password_form.php');
  }
  require('footer.php');
?>
