<!DOCTYPE html>
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" > <!--<![endif]-->
<?php
  require('get_token.php');
  require('api_calls.php');
  require('utilities.php');

  if (isset($_GET) and isset($_GET['uuid']) and isset($_GET['code'])) {
    $redcap_uid = $_GET['uuid'];
    $url_code = $_GET['code'];
  } else {
    // Missing uuid or a code.
    http_response_code(401);
    echo '<h2>401</h2> <strong>Error 101</strong>: You are forbidden from accessing this resource.';
    exit();
  }
  $confirmation_code = get_confirmation_code($API_TOKEN, $redcap_uid);
  if ($_GET['code'] != $confirmation_code) {
    // Confirmation code does not match code in url parameter.
    http_response_code(401);
    echo '<h2>401</h2> <strong>Error 102</strong>: You are forbidden from accessing this resource.';
    exit();
  }
  // Check if this IP address has already been set in RedCap. If so, fail with
  // ambiguous message.
  $are_dupes = find_and_update_dupe_ips($API_TOKEN, $redcap_uid);
  if ($are_dupes) {
    // This IP has been logged before.
    http_response_code(401);
    echo '<h2>401</h2> <strong>Error 103</strong>: You are forbidden from accessing this resource.<br />';
    echo 'If you believe you are receiving this message in error, please ';
    echo '<a href="mailto:patrick.georgeiii@einsteinmed.edu">contact Patrick George</a> and ';
    echo 'report error code 103.';
    exit();
  }

  $redirect_url = get_redirect_url($API_TOKEN, $redcap_uid);
  $touch_fail_url = "https://redcap.einsteinmed.org/d2r3v2/index.php?uuid=$redcap_uid&code=$confirmation_code";
  $which_iat = get_iat_choice($API_TOKEN, $redcap_uid);

  if (!isset($which_iat) || empty($which_iat)) {
      // If REDCap's allocation table for this location gets entirely consumed, then
      // it won't assign an IAT for the participant, in which case there will be an error.
    http_response_code(401);
    echo '<h2>401</h2><strong>Error 104</strong>We’re sorry, but we cannot accomodate any more participants ';
    echo 'from your institution.<br />If you think you’re getting this message in error, please ';
    echo '<a href="mailto:patrick.georgeiii@einsteinmed.edu">contact Patrick George</a>, report ';
    echo 'error 104 and explain that you received this message. Please include the name of your institution.';
    exit();
  }
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>D2R3</title>
    <meta name="description" content="MinnoJS">
    <meta name="viewport" content="width=device-width">
    <meta name="viewport" content="user-scalable=no, minimum-scale=1.0, maximum-scale=1.0, initial-scale=1" />
    <meta name="pinterest" content="nopin" />

    <!-- <script src="./js/jQuery_3-6-0.js" type="text/javascript"></script> -->
    <link rel="stylesheet" href="minno-css/main.css" />
    <link rel="stylesheet" href="minno-css/mine.css" />
    <!-- direct link to glyphicons because CORS is not allowing us to download from PI -->
        <link href="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">

    <style type="text/css">
      .container {padding-top: 15px;}

      /* http://www.sitepoint.com/css3-responsive-centered-image/ */
      .pi-spinner {
        position: absolute;max-width: 80%;top: 50%;left: 50%;margin-left: -32px;margin-top: -32px;border-radius: 3px;
        display: block; -moz-box-sizing: border-box; box-sizing: border-box;
                background: url(data:image/gif;base64,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) no-repeat;
                width: 64px;height: 64px;padding-left: 64px; /* Equal to width of new image */}
      .pi-spinner:empty {margin: auto;-webkit-transform: translate(-50%, -50%);-moz-transform: translate(-50%, -50%);-ms-transform: translate(-50%, -50%);-o-transform: translate(-50%, -50%);transform: translate(-50%, -50%);}
      @media screen and (orientation: portrait) {.pi-spinner { max-width: 90%; }}
      @media screen and (orientation: landscape) {.pi-spinner { max-height: 90%; }}
    </style>

    <script type="text/javascript">
<?php
    echo "      var which_iat = $which_iat;\n";
    echo "      var redcap_uid = $redcap_uid;\n";
    echo "      var redirect_url = \"$redirect_url\";\n";
    echo "      var touch_fail_url = \"$touch_fail_url\";\n";
 ?>
    </script>
  </head>

  <body>
    <!--[if lt IE 7]>
      <p class="browsehappy">You are using an <strong>outdated</strong> browser.
      Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

    <div class="container" id="pi-app">
      <img class="pi-spinner" ng-hide="1"/>
      <div pi-manager="study/mgr.js?random=<?php echo uniqid(); ?>"></div>
            <!-- <div pi-console></div> -->
    </div>

  </body>

  <!--[if lt IE 7]>
    <script src="//cdnjs.cloudflare.com/ajax/libs/json3/3.3.1/json3.min.js"></script>
  <![endif]-->
  <!--[if lte IE 8]>
    <script src="//cdnjs.cloudflare.com/ajax/libs/es5-shim/3.4.0/es5-shim.min.js"></script>
     <script src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
    <script src="https://cdn.jsdelivr.net/gh/minnojs/minno-quest@0.1/dist/js/bootstrap.js" type="text/javascript"></script>
</html>
