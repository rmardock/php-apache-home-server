<?php
    // function to create a new session and set cookie params
    function cookie_params()
    {
        // destroy session
        $_SESSION = array();
        session_destroy();
        $current_cookie_params = session_get_cookie_params();
        $path = "/";
        // set cookie params
        session_set_cookie_params(
            $current_cookie_params["lifetime"],
            $path,
            $current_cookie_params["domain"],
            $current_cookie_params["secure"],
            $current_cookie_params["httponly"]
        );
        // start new session
        session_start();
    }
?>