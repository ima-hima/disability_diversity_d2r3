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
    require('header.php'); // I can't send header except when there's
                           // no password; otherwise it'll play havoc
                           // with the download.
    require('password_form.php');
          // I used password hash to encrypt password.
  } elseif (password_verify($_GET['pass'], $password_hash)) {
    $archive_dir = "$results_directory/to_archive";
    $dt = new DateTime('NOW');
    $now = $dt->format('Y-m-d');
    $archive_filename = "project-inclusive_results_$now.tar.gz";
    $archive = "$results_directory/$archive_filename";
    exec("mkdir $results_directory/$archive_dir/");
    if (!is_dir($archive_dir)) {
      mkdir("$archive_dir");
    } else {
        // I have to do this because I *move* the files when I rename() them below.
        clear_directory($archive_dir);
    }
    foreach ($sub_dirs as $sub_dir => $description) {
      exec("mv $results_directory/$sub_dir $archive_dir");
    }
    exec("tar -zcvf $archive $archive_dir");

    if(is_readable($archive)) {
      header_remove();
      header('Content-Description: File Transfer');
      header('Content-Type: application/gzip');
      header('Content-Disposition: attachment; filename="' . "$archive_filename" . '"');
      header('Content-Transfer-Encoding: binary');
      header('Expires: 0');
      header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
      header('Pragma: public');
      header('Content-Length: ' . filesize($archive));
      readfile($archive);
      flush();
    } else {
      echo "$archive_file can't be read.<br />";
    }
    // Remove files
    unlink($archive);
    foreach ($sub_dirs as $sub_dir => $description) {
      $cur_archive_dir = "$archive_dir/$sub_dir";
      $cur_results_dir = "$results_directory/$sub_dir";
      if (is_dir($cur_archive_dir)) {
        clear_directory($cur_archive_dir);
      }
      if (is_dir($cur_results_dir)) {
        rename($cur_results_dir, $cur_archive_dir);
      } else {
        $errors .= "$cur_results_dir is missing.<br />";
      }
    }
    if ($errors) {
      require('header.php');
      echo $errors;
      die();
    }

  } else { // wrong password
    require('header.php');
    $form_head = 'Password incorrect';
    require('password_form.php');
  }
  require('footer.php');
?>
