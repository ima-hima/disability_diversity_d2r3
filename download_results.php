<?php
  require('functions.php');
  if (!isset($_POST['pass'])) {
    require('header.php');
    $form_action = 'download_results.php';
    $submit_text = 'Download';
    $form_head = '';
    $form_text = 'Enter password to download current results.';
    require('password_form.php');
          // I used password hash to encrypt password.
  } elseif (password_verify($_POST['pass'], $password_hash)) {
    $dt = new DateTime('NOW');
    $now = $dt->format('Y-m-d');
    $filename = "project-inclusive_results_$now.zip";
    exec("zip -r $results_directory/$filename $results_directory");

    header_remove();
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . basename($filename) . '"');
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Pragma: public');
    header('Content-Length: ' . filesize("$results_directory/$filename"));
    ob_clean();
    flush();
    readfile("$results_directory/$filename");

    unlink("$results_directory/$filename");

    // Remove files
    $sub_dirs = array('initial_participants' => 'Initial Participants',
                      'feedback' => 'IAT Feedback',
                      'answers' => 'Final output');
    foreach ($sub_dirs as $sub_dir => $description) {
      $cur_dir = "$results_directory/$sub_dir";
      if (is_dir($cur_dir)) {
        if ($opendirectory = opendir($cur_dir)) {
          while (($filename = readdir($opendirectory)) !== false) {
            if (substr($filename, 0, 1) != '.') {
              unlink("$cur_dir/$filename");
            }
          }
          closedir($opendirectory);
        }
      }
    }

  } else { // wrong password
    $form_head = 'Password incorrect';
    $form_text = 'Enter password to download current results';
    $submit_text = 'Download';
    require('password_form.php');
  }
  require('footer.php');
?>
