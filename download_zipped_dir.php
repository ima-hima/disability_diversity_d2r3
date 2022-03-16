<?php
    // require('header.php');
    $dt = new DateTime('NOW');
    $now = $dt->format('Y-m-d');
    $archive_filename = "project-inclusive_results_$now.tar.gz";
    // exec("tar -zcvf $results_directory/$archive_filename $results_directory/zipped");

    header_remove();
    header('Content-Description: File Transfer');
    header('Content-Type: application/gzip');
    header('Content-Disposition: attachment; filename="' . "$archive_filename" . '"');
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Pragma: public');
    header('Content-Length: ' . filesize("$results_directory/$archive_filename"));
    flush();
    readfile("$results_directory/$archive_filename");

  require('footer.php');
?>
