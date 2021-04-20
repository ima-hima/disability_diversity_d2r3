<!doctype html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Project Inclusive</title>
    <meta name="description" content="MinnoJS">
    <meta name="viewport" content="width=device-width">
    <meta name="viewport" content="user-scalable=no, minimum-scale=1.0, maximum-scale=1.0, initial-scale=1" />
    <meta name="pinterest" content="nopin" />

    <link rel="stylesheet" href="minno-css/main.css" />
    <link rel="stylesheet" href="minno-css/mine.css" />
  </head>
  <body>
    <div class="container ng-scope simple-skin" id="pi-app">
      <img class="pi-spinner ng-hide" ng-hide="1">
      <div pi-swap="" ng-class="{'pi-spinner':loading}" pi-manager="study/mgr.js?random=607cef919c0da" class="">
        <div pi-task="task" class="ng-scope ng-isolate-scope">
          <div pi-timer="" pi-quest="" class="ng-scope">
            <h3 ng-if="page.header" ng-bind-html="page.header" ng-style="page.headerStyle" class="ng-binding ng-scope">
              <div class="panel panel-info">
                <div class="panel-body">
                  <img src="./study/media/P-I_logo.png" class="p-i-logo" />
                  <h1>Clinical Decision-Making in the Prenatal Setting v6</h1>
<?php
  ini_set('display_startup_errors', 1);
  ini_set('display_errors', 1);
  error_reporting(-1);

  function clear_directory($directory, $sub_dir) {
    if ($opendirectory = opendir("$directory/initial_participants")) {
      while (($file = readdir($opendirectory)) !== false) {
        if (!unlink("$directory/initial_participants/$file")) {
          echo "Couldn’t delete $directory/initial_participants/$file.";
        }
      }
      closedir($opendirectory);
    } else {
      echo "Couldn't open $directory/initial_participants.";
    }
  }
  if (!isset($_POST['pass'])) {
?>
                  <form action="download_results.php" method=POST>
                    Enter password to download current results.<br />
                    <label for="pass">Password:</label><br />
                    <input id="pass" name="pass" type="password" /><br /><br />
                    <input type="submit" value="Download" />
                  </form>
<?php
          // I used password hash to encrypt password.
  } elseif (password_verify($_POST['pass'], '$2y$10$EuvvcNeKvie1HZcgqDMP6OyQz0yKkBOvViwEZ7VMudZloQFdp.0pu')) {
    $uploads_dir = 'uploads';

    // Check the password here. If wrong, bail.

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
?>
                  <h3>Password incorrect.</h3>
                  <form action="download_results.php" method=POST>
                    Enter password to download current results.<br />
                    <label for="pass">Password:</label><br />
                    <input id="pass" name="pass" type="password" /><br /><br />
                    <input type="submit" value="Download" />
                  </form>
<?php
  }
?>
                </div>
              </div>
            </h3>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
