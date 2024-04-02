<?php
// just for outputting iat feedback results
// reformats output from script into cleaner csv
    $entityBody = file_get_contents('php://input') . "\n";

    $results_dir = 'results';
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



    // Reformat string
    // Add in line returns. Each line is delimited by double quotes.
    $entityBody = preg_replace('/",/', "\n", $entityBody);
    // Remove extraneous brackets, then text before colons, then double quotes. Quotes *must* be removed last.
    $entityBody = preg_replace(array('/\{/', '/\}/', '/"[^:]*":"/', '/"/'), '', $entityBody);
    $input_arr = preg_split("/\n/", $entityBody);
    $uuid_arr = explode(',', $input_arr[1]);
    $which_iat = substr($input_arr[0], -6);

    // make sure results dir exists for specific IAT and that it's not accessible from the web.
    $results_dir .= "/$which_iat";
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


    file_put_contents("$results_dir/" . $uuid_arr[0] . ".csv", $entityBody);
