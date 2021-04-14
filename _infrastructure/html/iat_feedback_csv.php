<?php
// just for outputting iat feedback results
// reformats output from script into cleaner csv
    $_session_id = sha1(microtime().$_SERVER['REMOTE_ADDR']);
    // $entityBody = '{"header":"uuid, pd iat, id iat","uuid":"0.8662154812092789"}';
    $entityBody = file_get_contents('php://input') . "\n";

    // make sure results exists and is not accessible from the web
    if (!is_dir("results/feedback")) {
        if (!@mkdir("results/feedback")) {
            $error = error_get_last();
            echo $error['message'];
        }
    }

    if (!file_exists("results/feedback/.htaccess")) file_put_contents("results/feedback/.htaccess", "
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

    // reformat string
    // add in line returns
    $entityBody = preg_replace('/",/', "\n", $entityBody);
    // remove extraneous brackets, then text before colons, then double quotes. Quotes *must* be removed last.
    $entityBody = preg_replace(array('/\{/', '/\}/', '/"[^:]*":"/', '/"/'), '', $entityBody);

    // echo $entityBody;
    file_put_contents("results/feedback/iat_feedback.$_session_id.csv", $entityBody);
