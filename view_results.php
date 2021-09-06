<?php
  require('header.php');
  require('functions.php');
  $form_action = 'view_results.php';
  if (!isset($_POST['pass'])) {
    $submit_text = 'View';
    $form_head = '';
    $form_text = 'Enter password to view current results.';
    require('password_form.php');
     // I used password hash to encrypt password.
  } elseif (password_verify($_POST['pass'], $password_hash)) {
    foreach ($sub_dirs as $sub_dir => $description) {
      echo "<h3>$description:</h3>";
      $cur_results_dir = "$results_directory/$sub_dir";
      if (is_dir($cur_results_dir)) {
        if ($opendirectory = opendir($cur_results_dir)) {
          echo "<table><tr><th>File name</th><th>Creation date</th>";
          while (($file = readdir($opendirectory)) !== false) {
            if (!is_dir("$cur_results_dir/$file")) {
              $creation_time = date("F d, Y H:i", filectime("$cur_results_dir/$file"));
              echo "<tr><td>$file</td><td><span class=\"time\">$creation_time</span></td></tr>";
            }
          }
          echo "</table>";
          closedir($opendirectory);
        } else {
          echo "<em><strong>$cur_results_dir is missing!</strong></em>";
        }
      } else {
        echo "$description directory is missing.";
      }
    }
  } else {
    $form_head = 'Password incorrect';
    $form_text = 'Enter password to view current results';
    $submit_text = 'View';
    require('password_form.php');
  }
  require('footer.php');
?>



