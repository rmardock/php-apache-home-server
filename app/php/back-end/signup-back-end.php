<?php
    // database connection
    require_once "db.php";
    
    // cookie params file
    require_once "cookie_params.php";

    // access $_SESSION
    if(!session_start()) {
        header("Location: error.php");
        $mysqli->close();
        exit;
    }

    // get loggedin session variable
    $loggedin = empty($_SESSION['loggedin']) ? FALSE : $_SESSION['loggedin'];
    // if user is logged in
    if($loggedin)
    {
        // redirect and close database connection
        header("Location: /");
        $mysqli->close();
        exit;
    }

    // if passwords do not match
    if($_POST['password'] != $_POST['password-conf']) {
        // set cookie params
        cookie_params();
        // set session variable
        $_SESSION['pwd-not-match'] = TRUE;
        // redirect
        header("Location: /php/pages/signup.php");
        // close database connection
        $mysqli->close();
        exit;
    }

    // check if username is already in use
    if($stmt = $mysqli->prepare('SELECT id FROM users WHERE username = ?'))
    {
        $stmt->bind_param('s', $username);
        $username = $_POST['username'];
        $stmt->execute();
        $stmt->store_result();
        // if any results are generated from query
        if($stmt->num_rows > 0)
        {
            // set cookie params
            cookie_params();
            // set session variable
            $_SESSION['username-taken'] = TRUE;
            // redirect
            header('Location: /php/pages/signup.php');
            // close database connection
            $stmt->close();
            $mysqli->close();
            exit;
        }
    }

    // if no errors, insert data into database
    if($stmt = $mysqli->prepare('INSERT INTO users (username, password, preferences, admin) VALUES (?, ?, ?, ?)'))
    {
        // prepare statement
        $stmt->bind_param('sssi', $username, $password, $preferences, $admin);
        // set username value
        $username = $_POST['username'];
        // set password file
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        // set preferences file name value
        $preferences = "." . strval($username) . "_config";
        // set admin value
        $admin = 0;
        // execute statement
        $stmt->execute();
        // close statement
        $stmt->close();
        // close database connection
        $mysqli->close();
        // target dir for current user preferences file
        $target_path = "/var/www/html/config/users/" . "." . strval($username) . "_config.php";
        // create array for user preferences
        $user_array = array(
            // example of creating categories for tiles
            // "category-name" =>
            array("name" => "Youtube", "url" => "https://www.youtube.com/", "icon-path" => "/tile-icons/youtube-icon.svg", "dark-mode" => true)
        );
        // write array to user's config file --*file will be created and written to with this function*--
        file_put_contents($target_path, "<?php return " . var_export($user_array, true) . ";");
        // set cookie params
        cookie_params();
        // set session variable
        $_SESSION['signup-success'] = TRUE;
        // redirect to login page
        header("Location: /php/pages/login.php");
        exit;
    }
    // if sql query fails
    else
    {
        // redirect to error page here
        echo "Error";
        // close database connection
        $mysqli->close();
        exit;
    }
?>
