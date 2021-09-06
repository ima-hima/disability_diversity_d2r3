<?php
  require('functions.php');
    $form_action = 'download_results.php';
    $submit_text = 'Download';
    $form_head = '';
    $form_text = 'Enter password to download current results.';
  if (!isset($_POST['pass'])) {
    require('header.php');
    require('password_form.php');
          // I used password hash to encrypt password.
  } elseif (password_verify($_POST['pass'], $password_hash)) {
    $sub_dirs = array('initial_participants' => 'Initial Participants',
                      'feedback' => 'IAT Feedback',
                      'answers' => 'Final output');
    $dt = new DateTime('NOW');
    $now = $dt->format('Y-m-d');
    $archive_filename = "project-inclusive_results_$now.zip";
    exec("mkdir $results_directory/zipped/");
    // Copy all of $sub_dirs into single directory to make it easier to archive.
    foreach ($sub_dirs as $sub_dir => $description) {
      if (is_dir("$results_directory/$sub_dir")) {
        rename("$results_directory/$sub_dir", "$results_directory/zipped/$sub_dir");
      }
    }
    $phar = new PharData("$results_directory/$archive_filename");
    // add all files in the project
    $phar->buildFromDirectory("$results_directory/zipped", '/[^\.]$/');
    // exec("tar -zcvf $results_directory/$archive_filename $results_directory/zipped");

    header_remove();
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . "$archive_filename" . '"');
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Pragma: public');
    header('Content-Length: ' . filesize("$results_directory/$archive_filename"));
    // ob_clean();
    flush();
    readfile("$results_directory/$archive_filename");

    // unlink("$results_directory/$archive_filename");

    // // Remove files

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
    require('header.php');
    $form_head = 'Password incorrect';
    require('password_form.php');
  }
  require('footer.php');
?>
