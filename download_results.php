<?php
  require('header.php');
  $form_action = 'download_results.php';

  if (!isset($_POST['pass'])) {
    $submit_text = 'Download';
    $form_head = '';
    $form_text = 'Enter password to download current results.';
    require('password_form.php');
          // I used password hash to encrypt password.
  } elseif (password_verify($_POST['pass'], $password_hash)) {
    $dt = new DateTime('NOW');
    $now = $dt->format('Y-m-d');
    $filename = "project-inclusive_results_$now.zip";
    echo "<br />Zip file: $filename";

    exec("zip -r $uploads_dir/$filename $uploads_dir/results");

    header("Content-Type: application/zip");
    header("Content-Transfer-Encoding: Binary");
    header("Content-Length: " . filesize("$uploads_dir/$filename"));
    header("Content-Disposition: attachment; filename=$filename");
    readfile("$uploads_dir/$filename");

    // unlink("$uploads_dir/$filename");

  } else { // wrong password
    $form_head = 'Password incorrect';
    $form_text = 'Enter password to download current results';
    $submit_text = 'Download';
    require('password_form.php');
  }
  require('footer.php');
?>
