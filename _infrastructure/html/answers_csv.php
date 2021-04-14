<?php
// as original csv.php, but no uuid in file, and writes to answers directory
    $_session_id = sha1(microtime().$_SERVER['REMOTE_ADDR']);
    $entityBody  = file_get_contents('php://input')."\n";

    // make sure results exists and is not accessible from the web
    if (!is_dir("results/answers")) {
        if (!@mkdir("results/answers")) {
            $error = error_get_last();
            echo $error['message'];
        }
    }

    if (!file_exists("results/answers/.htaccess")) file_put_contents("results/answers/.htaccess", "
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

    file_put_contents("results/answers/answers_result.$_session_id.csv", $entityBody);
