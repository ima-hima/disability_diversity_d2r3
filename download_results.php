<?php require('header.php'); ?>

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
