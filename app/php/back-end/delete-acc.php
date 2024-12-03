<?php
    // database connection
    require_once "db.php";

    // cookie params file
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

    // get loggedin session variable
    $loggedin = empty($_SESSION['loggedin']) ? FALSE : $_SESSION['loggedin'];
    // if user is logged in
    if($loggedin)
    {
        // delete entry from database
        if($stmt = $mysqli->prepare('DELETE FROM users WHERE id = ?'))
        {
            // prepare statement
            $stmt->bind_param('i', $_SESSION['id']);
            // execute statement
            $stmt->execute();

            // set cookie params
            cookie_params();
            // set session variable
            $_SESSION['account-deleted'] = TRUE;
            // redirect to home page
            header("Location: /");
            // close database connection
            $mysqli->close();
            exit;
        }
        // if sql query fails
        else
        {
            echo "error! id does not exist! contact your administrator";
            // close database connection
            $mysqli->close();
            exit;
        }
    }
    // if user is not logged in
    else
    {
        // redirect to home page
        header("Location: /");
        // close database connection
        $mysqli->close();
        exit;
    }
?>