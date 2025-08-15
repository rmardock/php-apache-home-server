<?php
    // Database connection
    require_once "db.php";
    
    // Cookie params file
    require_once "cookie_params.php";

    // Access $_SESSION
    if(!session_start())
    {
        // Redirect to error page
        header("Location: error.php");
        // Close database connection
        $mysqli->close();
        exit;
    }

    // Variables for holding database values
    $id = "";
    $password = "";

    // SQL prepared statement
    // Select id and password from database
    if($stmt = $mysqli->prepare('SELECT id, username, password, preferences, admin FROM users WHERE username = ?'))
    {
        // Prepare statement
        $stmt->bind_param('s', $_POST['username']);
        // Execute statement
        $stmt->execute();

        // Store result
        $stmt->store_result();
        // If result contains a row
        if($stmt->num_rows > 0)
        {
            // Bind result to variables
            $stmt->bind_result($id, $username, $password, $preferences, $admin);
            $stmt->fetch();
            // Verify password
            if(password_verify($_POST['password'], $password))
            {
                // convert boolean
                if($admin == 0){
                    $admin_bool = FALSE;
                }
                else{
                    $admin_bool = TRUE;
                }
                // Set session variables
                session_regenerate_id();
                $_SESSION['loggedin'] = TRUE;
                $_SESSION['id'] = $id;
                $_SESSION['username'] = $username;
                $_SESSION['preferences'] = $preferences;
                $_SESSION['admin'] = $admin_bool;
                // Redirect to admin tools page
                header("Location: /");
                // Close database connection
                $stmt->close();
                $mysqli->close();
                exit;
            }
            // If password verification fails
            else
            {
                // Set cookie params
                cookie_params();
                // Set session variable
                $_SESSION['login-incorrect'] = TRUE;
                // Redirect to login page
                header("Location: /php/pages/login.php");
                // Close database connection
                $stmt->close();
                $mysqli->close();
                exit;
            }
        }
        // If no results returned from SQL query
        else
        {
            // Set cookie params
            cookie_params();
            // Set session variable
            $_SESSION['login-incorrect'] = TRUE;
            // Redirect to login page
            header("Location: /php/pages/login.php");
            // Close database connection
            $mysqli->close();
            exit;
        }
    }
    // If SQL query fails
    else
    {
        // Set cookie params
        cookie_params();
        // Set session variable
        $_SESSION['login-incorrect'] = TRUE;
        // Redirect to login page
        header("Location: /php/pages/login.php");
        // Close database connection
        $mysqli->close();
        exit;
    }
?>