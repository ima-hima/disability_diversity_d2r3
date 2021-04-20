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
                  <h1>Clinical Decision-Making in the Prenatal Setting v8</h1>
<?php
  ini_set('display_startup_errors', 1);
  ini_set('display_errors', 1);
  error_reporting(-1);

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
    $arr = array('initial_participants', 'feedback', 'answers');
    foreach ($arr as $this_dir) {
      echo "<h3>$this_dir:</h3>";
      $cur_dir = "$directory/$this_dir";
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



