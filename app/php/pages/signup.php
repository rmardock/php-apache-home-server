<?php
    // cookie params file
    require_once "./back-end/cookie_params.php";

    // access $_SESSION
    if(!session_start()) 
    {
        header("Location: error.php");
        exit;
    }

    // get session variables
    $loggedin = empty($_SESSION["loggedin"]) ? FALSE : $_SESSION["loggedin"];
    $pwd_not_match = empty($_SESSION['pwd-not-match']) ? null : $_SESSION['pwd-not-match'];
    $username_taken = empty($_SESSION['username-taken']) ? null : $_SESSION['username-taken'];
    // if logged in, logout
    if($loggedin) 
    {
        // redirect to login
        header("Location: /index.php");
        exit;
    }
?>

<!DOCTYPE html>
<!--
    sign up form for user accounts with swamp local webserver
-->
<html lang="en">
    <head>
        <title>sign up</title>
        <meta charset="UTF-8">
        <!--link to local copy of jquery-->
        <script src="/jslib/jquery-3.5.1.min.js"></script>
        <!--link to javascript file-->
        <script src="/javascript/signup.js"></script>
        <!--link to stylesheets-->
        <link rel="stylesheet" type="text/css" href="/stylesheets/w3.css">
        <link rel="stylesheet" type="text/css" href="/stylesheets/website-shared.css">
        <link rel="stylesheet" type="text/css" href="/stylesheets/login-form.css">
        <!--favicon-->
        <link rel="shortcut icon" href="/img/farquaad-favicon.ico" type="image/x-icon"/>
    </head>
    <body>
        <?php
            // if passwords do not match
            if($pwd_not_match)
            {
                // call cookie params function
                cookie_params();
                // show password not match message
                echo "<div class='w3-container w3-center message-banner'><h4>passwords do not match!</h4></div>";
            }
            // if username is taken
            if($username_taken)
            {
                // call cookie params function
                cookie_params();
                // show username taken message
                echo "<div class='w3-container w3-center message-banner'><h4>username taken! select another username.</h4></div>";
            }
        ?>
        <!--sign up form-->
        <div class="w3-container form-container">
            <form id="signupForm" action="/php/back-end/signup-back-end.php" method="POST">
                <h2 class="w3-center form-text">sign up</h2>
                <input name="username" id="username" class="w3-input form-input" placeholder="username" autofocus required>
                <input type="password" name="password" id="password" class="w3-input form-input" placeholder="password" required>
                <input type="password" name="password-conf" id="passowrd-conf" class="w3-input form-input" placeholder="confirm password" required>
                <input type="submit" id="signup-submit" class="w3-btn form-button" value="submit">
            </form>
            <a class="w3-btn form-button" href="/">home</a>
        </div>
    </body>
</html>