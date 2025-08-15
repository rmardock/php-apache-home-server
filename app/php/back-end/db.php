<?php
    # MySQL DB hostname
    $host = "db";

    # MySQL DB username
    $user = "db-agent";

    # MySQL DB password
    $pass = "db-pwd";

    # MySQL DB name
    $name = "web-users";

    # Create connection using mysqli
    $mysqli = new mysqli($host, $user, $pass, $name);

    # Check connection
    if($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }
?>
