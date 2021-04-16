<?php
$directory = "/uploads/results";

// Open a directory, and read its contents
if (is_dir($directory)){
  if ($opendirectory = opendir($directory)){
    while (($file = readdir($opendirectory)) !== false){
      echo "filename:" . $file . "<br>";
    }
    closedir($opendirectory);
  }
}

// $myfile = fopen("$directory/testfile.txt", "w");
// $txt = "John Doe\n";
// fwrite($myfile, $txt);
// $txt = "Jane Doe\n";
// fwrite($myfile, $txt);
// fclose($myfile);


// if (is_dir($directory)){
//   if ($opendirectory = opendir($directory)){
//     while (($file = readdir($opendirectory)) !== false){
//       echo "filename:" . $file . "<br>";
//     }
//     closedir($opendirectory);
//   }
// }

?>
