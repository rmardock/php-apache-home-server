<?php
    // cookie parms
    require_once "cookie_params.php";

    // access = $_SESSION
    if(!session_start())
    {
        // redirect to error screen
        header("Location: error.php");
        // close database connection
        $mysqli->close();
        exit;
    }

    // get logged in session variable
    $loggedin = empty($_SESSION["loggedin"]) ? FALSE : $_SESSION["loggedin"];
    // logout
    if($loggedin) {
        // call cookie params function
        cookie_params();
        // Set session variable
        $_SESSION['loggedout'] = TRUE;
        // Redirect to home page
        header("Location: /");
    }
?>
