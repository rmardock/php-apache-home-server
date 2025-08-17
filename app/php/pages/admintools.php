<?
    // access $_SESSION
    if(!session_start()) {
        header("Location: error.php");
        exit;
    }
    // assign session variables
    $username = empty($_SESSION['username']) ? null : $_SESSION['username'];
    $admin = empty($_SESSION['admin']) ? FALSE : $_SESSION['admin'];

    // if user does not have admin priveleges
    // no need to check for loggedin session var because admin is only set if user is logged in
    if(!$admin){ 
        // redirect to index.php
        header("Location: /");
        exit;
    }
?>
<!DOCTYPE html>
<!--
    admin tools page
    by ry mardock
-->
<html lang="en">
    <head>
        <title>Admin Services</title>
        <!--set the viewport-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <!--link to local copy of jquery-->
        <script src="/jslib/jquery-3.5.1.min.js"></script>
        <!--link to javascript files-->
        <script src="/javascript/tile-icon-switch.js"></script>
        <!--link to stylesheets-->
        <link rel="stylesheet" type="text/css" href="/stylesheets/w3.css">
        <link rel="stylesheet" type="text/css" href="/stylesheets/website-shared.css">
        <link rel="stylesheet" type="text/css" href="/stylesheets/account-pages.css">
        <!--favicon-->
        <link rel="shortcut icon" href="/img/farquaad-favicon.ico" type="image/x-icon"/>
    </head>
    <body>
        <div class="page-wrapper">
            <div class="title-bar">
                <h1 class="page-title">Admin Services</h1>
                <?php
                    // show welcome message
                    echo "<h4 class=\"username\">welcome, " . $username . "</h4>";
                ?>
            </div>
            <!--admin links-->
            <div class="w3-row services-wrapper">
                <h2 class="service-title">Services</h2>
                <!--load admin tiles from config-->
                <?php
                    // set args
                    $args = "admin-tools";
                    // load tiles
                    include("../back-end/tile-builder.php");
                ?>
            </div>
        </div>
    </body>
</html>
