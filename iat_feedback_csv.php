<?php
// just for outputting iat feedback results
// reformats output from script into cleaner csv
    $_session_id = sha1(microtime().$_SERVER['REMOTE_ADDR']);
    $entityBody = file_get_contents('php://input') . "\n";
    $results_dir = '/results';
    if (!is_dir($results_dir)) {
        mkdir($results_dir);
        if (!file_exists("$results_dir/.htaccess")) {
            file_put_contents("$answers_dir/.htaccess", "
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
        }
    }

    // make sure results exists and is not accessible from the web
    if (!is_dir($results_dir)) {
        if (!@mkdir($results_dir)) {
            $error = error_get_last();
            echo $error['message'];
        }
    }

    if (!file_exists("$results_dir/.htaccess")) file_put_contents("$results_dir/.htaccess", "
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
    file_put_contents("$results_dir/iat_feedback.$_session_id.csv", $entityBody);
