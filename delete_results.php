<?php
  /* Delete all files in uploads directory and empty result subdirectories. */
  require('functions.php');
  $form_action = 'delete_results.php';
  $form_head = '';
  $form_text = 'Enter password to delete current results.';
  $submit_text = 'Delete results';
  $delete = 'delete';
  require('header.php');
  if (!isset($_POST['variable']['pass'])) {
    require('password_form.php');
          // I used password hash to encrypt password.
  } elseif (password_verify($_POST['pass'], $password_hash)
            and isset($_POST['agree'])
            and strcomp($_POST['agree'], 'delete') {
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
  } elseif (!password_verify($_POST['pass'], $password_hash)) { // wrong password
    $form_head = 'Password incorrect';
    require('password_form.php');
  } else { // Must not have affirmatively agreed to delete.
    $form_head = 'You must provide affirmative consent to delete all the files.';
    require('password_form.php');
  }
  require('footer.php');
?>
