<?php
    // access session
    if(!session_start())
    {
        header("Location: error.php");
        exit;
    }

    // get session variables
    $loggedin = empty($_SESSION["loggedin"]) ? FALSE : $_SESSION["loggedin"];
    $login_incorrect = empty($_SESSION['login-incorrect']) ? null : $_SESSION['login-incorrect'];
    $signup_success = empty($_SESSION['signup-success']) ? null : $_SESSION['signup-success'];
    // if logged in, logout
    if($loggedin) 
    {
        // destroy session
        $_SESSION = array();
        session_destroy();
        // redirect to login
        header("Location: /php/login.php");
        exit;
    }
?>
<!DOCTYPE html>
<!--
    login page for swamp webserver
    by ry mardock
-->
<html lang="en">
    <head>
        <title>login</title>
        <!--set the viewport -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <!--link to local copy of jquery-->
        <script src="/jslib/jquery-3.5.1.min.js"></script>
        <!--link to javascript file-->
        <script src="/javascript/login.js"></script>
        <!--link to stylesheets-->
        <link rel="stylesheet" type="text/css" href="/stylesheets/w3.css">
        <link rel="stylesheet" type="text/css" href="/stylesheets/website-shared.css">
        <link rel="stylesheet" type="text/css" href="/stylesheets/login-form.css">
        <!--favicon-->
        <link rel="shortcut icon" href="/img/farquaad-favicon.ico" type="image/x-icon"/>
    </head>
    <body>
        <?php
            // if login incorrect
            if($login_incorrect)
            {
                // destroy session
                $_SESSION = array();
                session_destroy();
                // show incorrect login message
                echo "<div class='w3-container w3-center message-banner'><h4>incorrect login</h4></div>";
            }
            // if sign up success
            if($signup_success)
            {
                // destroy session
                $_SESSION = array();
                session_destroy();
                // show signup success message
                echo "<div class='w3-container w3-center message-banner'><h4>sign up success!</h4></div>";
            }
        ?>
        <!--login form-->
        <div id="loginform" class="w3-container form-container">
            <form id="loginForm" action="/php/back-end/login-back-end.php" method="POST">
                <h2 class="w3-center form-text">login</h2>
                <input name="username" id="username" class="w3-input form-input" placeholder="username" autofocus required>
                <input type="password" name="password" id="password" class="w3-input form-input" placeholder="password" required>
                <input type="submit" id="login-submit" class="w3-btn form-button" value="submit">
            </form>
            <!--homepage link-->
            <a class="w3-btn form-button" href="/">home</a>
        </div>
    </body>
</html>