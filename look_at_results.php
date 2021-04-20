<?php
  require('header.php');
  if (!isset($_POST['pass'])) {
?>
                  <form action="lookat_uploads.php" method=POST>
                    Enter password to view current results.<br />
                    <label for="pass">Password:</label><br />
                    <input id="pass" name="pass" type="password" /><br /><br />
                    <input type="submit" value="View" />
                  </form>
<?php
          // I used password hash to encrypt password.
  } elseif (password_verify($_POST['pass'], '$2y$10$EuvvcNeKvie1HZcgqDMP6OyQz0yKkBOvViwEZ7VMudZloQFdp.0pu')) {
    $sub_dirs = array('initial_participants', 'feedback', 'answers');
    foreach ($sub_dirs as $sub_dir) {
      echo "<h3>$sub_dir:</h3>";
      $cur_dir = "$results_directory/$sub_dir";
      if (is_dir($cur_dir)){
        if ($opendirectory = opendir($cur_dir)) {
          while (($file = readdir($opendirectory)) !== false) {
            echo "filename: $file<br />";
          }
          closedir($opendirectory);
        } else {
            echo "<em><strong>$cur_dir is missing!</strong></em>";
        }
      }
    }

  }

  require('footer.php');




