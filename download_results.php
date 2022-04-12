<?php
  /* Download all results. Copy everything to to_archive directory, zip
   * that, then download. Afterwards, delete resulting zip file and all
   * to_archive and empty subdirectories.
   */
  require('functions.php');
  $form_action = 'download_results.php';
  $submit_text = 'Download';
  $form_head = '';
  $form_text = 'Enter password to download current results.';
  if (!isset($_GET['pass'])) {
    // Missing password
    require('header.php');
    require('password_form.php');
          // I used password hash to encrypt password.
  } elseif (!password_verify($_GET['pass'], $password_hash)) {
    // Wrong password
    $form_head = 'Password incorrect';
    $form_text = 'Enter password to download current results';
    $submit_text = 'Download';
    require('password_form.php');
    require('footer.php');
  }
  $dt = new DateTime('NOW');
  $now = $dt->format('Y-m-d');
  $archive_filename = "project-inclusive_results_$now.tar.gz";
  $archive_file = "$results_directory/$archive_filename";
  exec("mkdir $results_directory/zipped/");
  foreach ($sub_dirs as $sub_dir => $description) {
    exec("cp -r $results_directory/$sub_dir $results_directory/zipped");
  }
  exec("tar -zcvf $archive_file $results_directory/zipped");

  header_remove();
  header('Content-Description: File Transfer');
  header('Content-Type: application/gzip');
  header('Content-Disposition: attachment; filename="' . "$archive_filename" . '"');
  header('Content-Transfer-Encoding: binary');
  header('Expires: 0');
  header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
  header('Pragma: public');
  header('Content-Length: ' . filesize($archive_file));
  flush();
  readfile($archive_file);
  // require('footer.php');
?>
