<?php
  /* Prints all files. Any files other than .htaccess in uploads directory
   * are shown. Individual results subdirectories get their own tables.
   */
  require('header.php');
  require('functions.php');
  $form_action = 'view_results.php';
  $form_head = '';
  $form_text = 'Enter password to view current results.';
  $submit_text = 'View results';
  if (!isset($_GET['pass'])) {
    // Missing password
    require('password_form.php');
     // I used password hash to encrypt password.
  } elseif (!password_verify($_GET['pass'], $password_hash)) {
    # Wrong password
    $form_head = 'Password incorrect';
    $form_text = 'Enter password to view current results';
    $submit_text = 'View';
    require('password_form.php');
  } else {
    // First view any files that are in top level of uploads directory.
    // Because there are always folders present we need to look specifically
    // for files. Excluding .htaccess.
    $opendirectory = opendir($results_directory);
    $not_empty = false;
    while (($file = readdir($opendirectory)) !== false) {
      if (!is_dir("$results_directory/$file")) {
        $not_empty = true;
        break;
      }
    }
    closedir($opendirectory);
    if (is_dir("$results_directory/zipped/")) {
      echo "<h3>Files already copied to zipped directory:</h3>";
      foreach ($sub_dirs as $sub_dir => $description) {
        echo "<h4>$description:</h4>";
        $cur_results_dir = "$results_directory/zipped/$sub_dir";
        if (is_dir($cur_results_dir)) {
          if ($opendirectory = opendir($cur_results_dir)) {
            echo "<table><tr><th>File name</th><th>Creation date</th>";
            while (($file = readdir($opendirectory)) !== false) {
              if (substr($file, 0, 1) != '.') {
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
    }
    echo "</table>";
    if ($not_empty) {
      $opendirectory = opendir($results_directory);
      echo "<h3>Zip files:</h3>";
      echo "<table><tr><th>File name</th><th>Permissions</th><th>Size</th><th>Creation date</th>";
      while (($file = readdir($opendirectory)) !== false) {
        if (!is_dir("$results_directory/$file")) {
          $creation_time = date("F d, Y H:i", filectime("$results_directory/$file"));
          $filesize = filesize("$results_directory/$file");
          $perms = substr(decoct(fileperms("$results_directory/$file")),3);
          echo "<tr><td>$file</td><td>$perms</td><td>$filesize</td><td><span class=\"time\">$creation_time</span></td></tr>";
        }
      }
      echo "</table>";
      closedir($opendirectory);
    } else {
      echo '<p>There are no .zip files to download.</p>';
    }
    // Now display file info for all results from studies.
    foreach ($sub_dirs as $sub_dir => $description) {
      echo "<h3>$description:</h3>";
      $cur_results_dir = "$results_directory/$sub_dir";
      if (is_dir($cur_results_dir)) {
        if ($opendirectory = opendir($cur_results_dir)) {
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
          echo "<em><strong>$cur_results_dir is missing!</strong></em>";
        }
      } else {
        echo "$description directory is missing.";
      }
    }
  }
  require('footer.php');
?>



