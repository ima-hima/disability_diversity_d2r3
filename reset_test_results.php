<?php
  /* Delete uploads/to_archive.
   * Copy three "test results" folders from ./test_results to uploads.
   */
  require('functions.php');
  $form_action = 'reset_test_results.php';
  $form_head = '';
  $form_text = 'Enter password to reset all test results.';
  $submit_text = 'Reset results';
  require('header.php');
  if (!isset($_GET['pass'])) {
    require('password_form.php');
      // I used password hash to encrypt password.
  } elseif (password_verify($_GET['pass'], $password_hash)) {
    // Remove to_archive directory.
    clear_directory("$results_directory/to_archive");
    // Copy each directory of test results into uploads.
    // First, remove copy already in uploads.
    foreach ($sub_dirs as $sub_dir => $description) {
      $source_dir_name = 'test_results/' . $sub_dir;
      $dest_dir_name = "$results_directory/$sub_dir";
      if (is_dir($source_dir_name)) {
        clear_directory($dest_dir_name);
        mkdir($dest_dir_name);
        if ($source_dir = opendir($source_dir_name)) {
          while (($file = readdir($source_dir)) !== false) {
            if (!is_dir("$source_dir_name/$file")) {
              if(!copy("$source_dir_name/$file", "$dest_dir_name/$file")) {
                echo "<h4>$file failed to copy.</h4>";
              } else {
                echo "$file has been copied.<br />";
              }
            }
          }
        }
        echo '<em>' . $source_dir_name . ' has been copied.</em><br /><br />';
      } else {
        echo "<h4>$source_dir_name is missing.</h4>";
      }
    }
    echo 'Test data has been reset.';
  } else { // wrong password
    $form_head = 'Password incorrect';
    require('password_form.php');
  }
  require('footer.php');
?>
