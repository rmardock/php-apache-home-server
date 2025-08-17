<?
    // access $_SESSION
    if(!session_start()) {
        header("Location: error.php");
        exit;
    }
    //load session variables
    $loggedin = empty($_SESSION["loggedin"]) ? FALSE : $_SESSION["loggedin"];
    $username = empty($_SESSION['username']) ? null : $_SESSION['username'];
    $admin = empty($_SESSION["admin"]) ? FALSE : $_SESSION["admin"];
    // if not logged in, redirect to homepage
    if(!$loggedin) {
        // redirect to homepage
        header("Location: /");
        exit; 
    }
?>
<!DOCTYPE html>
<!--
    account services webpage
    by ry mardock
-->
<html lang="en">
    <head>
        <title>Account</title>
        <!--set the viewport-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <!--link to local copy of jquery-->
        <script src="/jslib/jquery-3.5.1.min.js"></script>
        <!--link to javascript files-->
        <script src="/javascript/account-services.js"></script>
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
                <h1 class="page-title">Account Services</h1>
                <?php
                    if(!is_null($loggedin))
                    {
                        echo "<h4 class=\"username\">welcome, " . $username . "</h4>";
                    }
                ?>
            </div>
            <!--account services card-->
            <div class="w3-row services-wrapper">
                <!--first delete account button-->
                <div class="w3-card service-card delete-button-container">
                    <button id="delete-link" class="w3-button service-button delete-button">
                        <img id="delete-image" src="/img/delete-icon.svg" class="service-image" alt="delete account icon">
                        <div class="w3-container">
                            <h3 class="service-name">Delete Account</h3>
                        </div>
                    </button>
                </div>
                <!--form for deleting account-->
                <div class="w3-card w3-center service-card account-deletion-form">
                    <form class="confirm-wrapper" action="/php/back-end/delete-acc.php" method="POST">
                        <div class="w3-container">
                            <img id="confirm-link" src="/img/warning-icon.svg" class="service-image" alt="warning icon">
                            <h3 class="service-name">Delete Account</h3>
                            <h6 class="service-name">Warning: This action cannot be undone</h6>
                            <div class="w3-button account-button">
                                <input id="delete-submit" type="submit" value="">
                                <h3 class="service-name">Confirm</h3>
                            </div>
                            <div class="w3-button account-button">
                                <h3 class="service-name">Cancel</h3>
                            </div>
                        </div>
                    </form>
                </div>
                <?php
                    $args = "acc-services";
                    // if user has admin priveleges, show admin tools link
                    include("../back-end/tile-builder.php");
                ?>
            </div>
        </div>
    </body>
</html>
