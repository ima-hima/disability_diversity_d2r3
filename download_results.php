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
    $archive_dir = "$results_directory/to_archive";
    if (!is_dir($archive_dir)) {
      mkdir("$archive_dir");
    }
    // exec("mkdir $results_directory/to_archive/");
    // Copy all of $sub_dirs into single directory to make it easier to archive.
    $errors = '';
    foreach ($sub_dirs as $sub_dir => $description) {
      $cur_archive_dir = "$archive_dir/$sub_dir";
      $cur_results_dir = "$results_directory/$sub_dir";
      if (!is_dir($cur_archive_dir)) {
        if (is_dir($cur_results_dir)) {
          rename($cur_results_dir, $cur_archive_dir);
        } else {
          $errors .= "$cur_results_dir is missing.<br />";
        }
      } else {
        $errors .= "$cur_archive_dir already exists.<br />";
      }
    }
    if ($errors) {
      require('header.php');
      echo $errors;
      die();
    }
    $archive_filename = "project-inclusive_results_$now.zip";
    $archive_path = "$results_directory/$archive_filename";
    $phar = new PharData($archive_path);
    // add all files in the project
    $phar->buildFromDirectory("$archive_dir", '/[^\.]$/');

    header_remove();
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . "$archive_filename" . '"');
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Pragma: public');
    header('Content-Length: ' . filesize($archive_path));
    // ob_clean();
    flush();
    readfile($archive_path);
    unlink($archive_path);

    // Remove files

    foreach ($sub_dirs as $sub_dir => $description) {
      clear_directory("$results_directory/$sub_dir");
    }
    clear_directory($archive_dir);

  } else { // wrong password
    require('header.php');
    $form_head = 'Password incorrect';
    require('password_form.php');
  }
  require('footer.php');
?>
