<?php
// as original csv.php, but no uuid in file, and writes to initial_participants directory
    $_session_id = sha1(microtime().$_SERVER['REMOTE_ADDR']);
    $entityBody  = file_get_contents('php://input')."\n";
    $participants_dir = '/uploads/results/initial_participants';
    // make sure results exists and is not accessible from the web
    if (!is_dir($participants_dir)) {
        if (!@mkdir($participants_dir)) {
            $error = error_get_last();
            echo $error['message'];
        }
    }

    if (!file_exists("$participants_dir/.htaccess")) file_put_contents("$participants_dir/.htaccess", "
        # Apache 2.4
        <IfModule mod_authz_core.c>
            Require all denied
        </IfModule>

        # Apache 2.2
        <IfModule !mod_authz_core.c>
            Order Allow,Deny
            Deny from all
        </IfModule>
    ");

    file_put_contents("$participants_dir/participant.$_session_id.csv", $entityBody);
