<?php
  require('header.php');
  $form_action = 'delete_results.php';

  if (!isset($_POST['pass'])) {
    $submit_text = 'Delete';
    $form_head = '';
    $form_text = 'Enter password to remove all results.';
    require('password_form.php');
          // I used password hash to encrypt password.
  } elseif (password_verify($_POST['pass'], $password_hash)) {
    $sub_dirs = array('initial_participants' => 'Initial Participants',
                      'feedback' => 'IAT Feedback',
                      'answers' => 'Final output');
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
        echo "<h4>All results in $description have been deleted.</h4>";
        }
      }
    }
  } else { // wrong password
    $form_head = 'Password incorrect';
    $form_text = 'Enter password to remove all results';
    $submit_text = 'Download';
    require('password_form.php');
  }
  require('footer.php');
?>
