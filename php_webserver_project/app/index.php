<?php
    //---this is the homepage for swamp webserver---//
    // access $_SESSION
    if(!session_start()) {
        header("Location: error.php");
        exit;
    }

    // access $_SESSION and assign variables
    $loggedin = empty($_SESSION["loggedin"]) ? FALSE : $_SESSION["loggedin"];
    $username = empty($_SESSION["username"]) ? null : $_SESSION["username"];
    $admin = empty($_SESSION["admin"]) ? FALSE : $_SESSION["admin"];
    $account_deleted = empty($_SESSION['account-deleted']) ? null : $_SESSION['account-deleted'];
    $loggedout = empty($_SESSION["loggedout"]) ? FALSE : $_SESSION["loggedout"];  
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!--page title-->
        <title>home page</title>
        <!--set the viewport-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <!--link to local copy of jquery-->
        <script src="/jslib/jquery-3.5.1.min.js"></script>
        <!--links to javascript files-->
        <script src="/javascript/menu.js"></script>
        <script src="/javascript/tile-form.js"></script>
        <script src="/javascript/remove-tile.js"></script>
        <script src="/javascript/tile-icon-switch.js"></script>
        <!--links to stylesheets-->
        <link rel="stylesheet" type="text/css" href="/stylesheets/w3.css">
        <link rel="stylesheet" type="text/css" href="/stylesheets/website-shared.css">
        <link rel="stylesheet" type="text/css" href="/stylesheets/index.css">
        <link rel="stylesheet" type="text/css" href="/stylesheets/menu-bar.css">
        <!--favicon-->
        <link rel="shortcut icon" href="/img/farquaad-favicon.ico" type="image/x-icon"/>
    </head>
    <body>
        <?php 
            // load sidebar based on user login status and priveleges
            // if user is logged in
            if($loggedin){
                // if user has admin priveleges
                if($admin){
                    include("./php/sidebar/sidebar-loggedin-admin.php");
                }
                // if user does not have admin priveleges
                else{
                include("./php/sidebar/sidebar-loggedin.php");
                }
            }
            // if user is not logged in
            else{
                include("./php/sidebar/sidebar.php");
            }
        ?>
        <div class="page-wrapper">
            <div class="title-bar">
                <button class="open-button">&#9776;</button>
                <h1 class="page-title">home page</h1>
            </div>
            <?php
                // if account deleted
                if($account_deleted)
                {
                    // destroy session
                    $_SESSION = array();
                    session_destroy();
                    // show account deleted message
                    echo "<div class='w3-container w3-center message-banner'><h4>account deleted</h4></div>";
                }
                // if redirected from logout
                if($loggedout)
                {
                   // destroy session
                    $_SESSION = array();
                    session_destroy();
                    // show logout message
                    echo "<div class='w3-container w3-center message-banner'><h4>logged out</h4></div>";
                }
            ?>
            <!--google search-->
            <div class="w3-row google-search-wrapper">
                <form method="get" action="http://www.google.com/search" target="_blank">
                    <input id="google-search" type="text" name="q" size="31" maxlength="255" placeholder="google search" autofocus/>
                </form>
            </div>
            <!--services pane div-->
            <div class="w3-row services-wrapper">
                <h2 class="service-title">services
                    <?php
                    // if user is logged in
                    if($loggedin)
                    {
                        // show welcome message
                        echo "| welcome, " . $username;
                    }
                    ?>
                </h2>
                <?php
                    // load home page config
                    $args = "home-page";
                    // load tiles from config
                    include("./php/back-end/tile-builder.php");
                ?>
            </div>
            <!--tiles pane-->
            <div class="w3-row services-wrapper">
                <h2 class="service-title">tiles
                    <?php
                        // only show edit button if logged in
                        if($loggedin){
                            echo '<input id="edit-button" class="w3-button edit-button" type="button" value="edit">';
                        }
                    ?>
                </h2>
                <!--tile buttons-->
                <div id="tile-buttons" class="w3-row edit-closed">
                    <input id="remove-tile" class="w3-button tile-button" type="button" value="remove tile">
                    <input id="add-tile" class="w3-button tile-button" type="button" value="add tile">
                </div>
                <div id="rm-tile-buttons" class="w3-row">
                    <input id="rm-cancel" class="w3-button tile-button" type="button" value="cancel">
                    <input id="rm-submit" class="w3-button tile-button" type="button" value="confirm selection">
                </div>
                <!--new tile form-->
                <div id="tile-form" class="w3-row edit-closed">
                    <form id="new-tile-form" class="tile-form" action="/php/back-end/tile-config.php" method="post" enctype="multipart/form-data">
                        <h3 id="form-title" class="tile-text">new tile</h3>
                        <input id="tile-name" name="tile-name" class="w3-input tile-input" type="text" placeholder="name" required>
                        <input id="tile-url" name="tile-url" class="w3-input tile-input" type="url" placeholder="url" required>
                        <label class="file-upload" for="tile-img">upload an icon (optional)</label>
                        <input id="tile-img" name="tile-img" type="file">
                        <input id="tile-cancel" name="tile-cancel" class="w3-button form-button" type="button" value="cancel">
                        <input id="tile-img-submit" name="tile-img-submit" class="w3-button form-button" type="submit" value="add tile">
                    </form>
                </div>
                <?php
                    // is user is not logged in
                    if(!$loggedin){
                        // load not logged in config
                        $args = "not-logged-in";
                        // load tiles from config
                        include("./php/back-end/tile-builder.php");
                    }
                    // if user is logged in
                    else
                    {
                        // load current user config
                        $args = "user";
                        // load tiles from config
                        include("./php/back-end/tile-builder.php");
                    }
                ?>
            </div>
        </div>
    </body>
</html>
