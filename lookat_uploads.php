<?php
$directory = "/uploads/results";

echo "<h1>Initial contents:</h1>";
if (is_dir($directory)){
  if ($opendirectory = opendir($directory)) {
    while (($file = readdir($opendirectory)) !== false) {
      echo "filename: $file<br />";
    }
    closedir($opendirectory);
  } else {
      echo "$directory is missing!";
  }
}

echo "<h1>Now show individual directories' contents.</h1>";
$arr = array("initial_participants", "feedback", "answers");
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


echo "<h1>Now delete initial_participants:</h1>";
// Have to delete individual files, then delete directory.
if ($opendirectory = opendir("$directory/initial_participants")) {
    while (($file = readdir($opendirectory)) !== false) {
      unlink($file);
    }
} else {
    echo "Couldn't open $directory/initial_participants.";
}
rmdir("$directory/initial_participants");

// Show contents after deletion of initial participants.
if ($opendirectory = opendir($directory)) {
while (($file = readdir($opendirectory)) !== false) {
  echo "directory: $file<br />";
}
closedir($opendirectory);
} else {
  echo "<em><strong>$directory is missing!</strong></em>";
}

?>
