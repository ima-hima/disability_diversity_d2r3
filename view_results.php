<?php
  require('header.php');
  require('functions.php');
  $form_action = 'view_results.php';
  $where = exec("which zip");
  echo "$where </br>";
  $where = exec("which gzip");
  echo "$where </br>";
  if (!isset($_GET['pass'])) {
    $submit_text = 'View';
    $form_head = '';
    $form_text = 'Enter password to view current results.';
    require('password_form.php');
     // I used password hash to encrypt password.
  } elseif (password_verify($_GET['pass'], $password_hash)) {
    $sub_dirs = array('initial_participants' => 'Initial Participants',
                      'feedback' => 'IAT Feedback',
                      'answers' => 'Final output');
    foreach ($sub_dirs as $sub_dir => $description) {
      echo "<h3>$description:</h3>";
      $cur_dir = "$results_directory/$sub_dir";
      if (is_dir($cur_dir)){
        if ($opendirectory = opendir($cur_dir)) {
          echo "<table><tr><th>File name</th><th>Creation date</th>";
          while (($file = readdir($opendirectory)) !== false) {
            if (substr($file, 0, 1) != '.') {
              $creation_time = date("F d, Y H:i", filectime("$results_directory/$sub_dir/$file"));
              echo "<tr><td>$file</td><td><span class=\"time\">$creation_time</span></td></tr>";
            }
          }
          echo "</table>";
          closedir($opendirectory);
        } else {
          echo "<em><strong>$cur_dir is missing!</strong></em>";
        }
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



