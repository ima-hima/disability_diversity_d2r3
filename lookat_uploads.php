<?php
$directory = "/uploads/results";

echo "Initial contents:\n";
if (is_dir($directory)){
  if ($opendirectory = opendir($directory)) {
    while (($file = readdir($opendirectory)) !== false) {
      echo "filename:" . $file . "<br>";
    }
    closedir($opendirectory);
  } else {
      echo "$directory is missing!";
  }
}

echo "Now show individual direcory contents.\n"
$arr = ("initial_participants", "feedback", "answers")
foreach ($arr as $this_dir) {
    echo "this_dir:\n"
    $cur_dir = "$directory/$this_dir";
    if (is_dir($cur_dir)){
      if ($opendirectory = opendir($cur_dir)) {
        while (($file = readdir($opendirectory)) !== false) {
          echo "filename:" . $file . "<br>";
        }
        closedir($opendirectory);
      } else {
          echo "$cur_dir is missing!";
      }
    }
}
unset("$directory/initial_participants");

echo "\nNow delete initial_participants:\n";
if (is_dir($directory)){
  if ($opendirectory = opendir($directory)) {
    while (($file = readdir($opendirectory)) !== false) {
      echo "filename:" . $file . "<br>";
    }
    closedir($opendirectory);
  } else {
      echo "$directory is missing!";
  }
}

?>
