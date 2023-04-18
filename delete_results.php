<?php
  /* Delete all files in uploads directory and empty result subdirectories. */
  require('header.php');
  require('functions.php');
  $form_action = 'delete_results.php';
  $form_head = '';
  $form_text = 'Enter password to delete current results.';
  $submit_text = 'Delete results';
  $delete = true;
  if (!isset($_POST['pass'])) {
    // Missing password
    require('password_form.php');
          // I used password hash to encrypt password.
  } elseif (!password_verify($_POST['pass'], $password_hash)) {
    // Wrong password
    $form_head = 'Password incorrect';
    require('password_form.php');
  } elseif (!isset($_POST['delete'])) {
    $form_head = 'You left the delete line blank.';
  } elseif (strcmp($_POST['delete'], 'delete') !== 0) {
    // Affirmative consent missing
    $form_head = 'You spelled “delete” wrong: ' . $_POST['delete'];
    require('password_form.php');
  } else {
    // First, delete old zip files.
    $opendirectory = opendir($results_directory);
    while (($file = readdir($opendirectory)) !== false) {
      if (!is_dir("$results_directory/$file")) {
        unlink("$results_directory/$file");
      }
    }
    closedir($opendirectory);
    // Clear subdirectories
    foreach ($sub_dirs as $sub_dir => $description) {
      clear_directory("$results_directory/$sub_dir");
      echo "$results_directory/$sub_dir has been deleted.<br />";
    }
    // Clear zipped directory, where files are held before being compressed
    // and downloaded.
    clear_directory("$results_directory/zipped");

    echo "All files have been deleted.";
  }
  require('footer.php');
?>
