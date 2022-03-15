<?php
  require('functions.php');
  if (!isset($_GET['pass'])) {
    require('header.php');
    $form_action = 'download_results.php';
    $submit_text = 'Download';
    $form_head = '';
    $form_text = 'Enter password to download current results.';
    require('password_form.php');
          // I used password hash to encrypt password.
  } elseif (password_verify($_GET['pass'], $password_hash)) {
    $sub_dirs = array('initial_participants' => 'Initial Participants',
                      'feedback' => 'IAT Feedback',
                      'answers' => 'Final output');
    $dt = new DateTime('NOW');
    $now = $dt->format('Y-m-d');
    $archive_filename = "project-inclusive_results_$now.tar.gz";
    exec("mkdir $results_directory/zipped/");
    foreach ($sub_dirs as $sub_dir => $description) {
      exec("mv $results_directory/$sub_dir $results_directory/zipped");
    }
    exec("tar -zcvf $results_directory/$archive_filename $results_directory/zipped");

    header_remove();
    header('Content-Description: File Transfer');
    header('Content-Type: application/gzip');
    header('Content-Disposition: attachment; filename="' . "$archive_filename" . '"');
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Pragma: public');
    header('Content-Length: ' . filesize("$results_directory/$archive_filename"));
    flush();
    readfile("$results_directory/$archive_filename");

    unlink("$results_directory/$archive_filename");

    // Remove files

    // foreach ($sub_dirs as $sub_dir => $description) {
    //   $cur_dir = "$results_directory/$sub_dir";
    //   if (is_dir($cur_dir)) {
    //     if ($opendirectory = opendir($cur_dir)) {
    //       while (($filename = readdir($opendirectory)) !== false) {
    //         if (substr($filename, 0, 1) != '.') {
    //           unlink("$cur_dir/$filename");
    //         }
    //       }
    //       closedir($opendirectory);
    //     }
    //   }
    // }

  } else { // wrong password
    $form_head = 'Password incorrect';
    $form_text = 'Enter password to download current results';
    $submit_text = 'Download';
    require('password_form.php');
  }
  require('footer.php');
?>
