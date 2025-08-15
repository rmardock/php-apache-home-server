<?php
    //---php script for creating custom link tiles for users---//
    //---supports icon image upload---//
    // access $_SESSION
    if(!session_start()) {
        header("Location: error.php");
        exit;
    }
    // assign form input variables
    $tile_name = empty($_POST["tile-name"]) ? null : $_POST["tile-name"];
    $tile_url = empty($_POST["tile-url"]) ? null : $_POST["tile-url"];

    // initialize image path
    $img_path = "";

    // access session variables
    $loggedin = empty($_SESSION["loggedin"]) ? FALSE : $_SESSION["loggedin"];
    $config_file = empty($_SESSION["preferences"]) ? null : $_SESSION["preferences"];

    // assign default darkmode marker
    $dark_mode = false;
    
    // if no preferences file
    if($config_file == null){
        //do nothing
        exit;
    }
    // prepare file path
    $config_file_path = "/var/www/html/config/users/" . $config_file;

    // if not logged in
    if(!$loggedin){
        // do nothing
        exit;
    }

    // if an image is uploaded
    if($_FILES["tile-img"]["name"] != null){
        // assign file path and uploadOk
        $target_dir = "/var/www/html/tile-icons/";
        $target_file = $target_dir . basename($_FILES["tile-img"]["name"]);
        $img_path = "/tile-icons/" . basename($_FILES["tile-img"]["name"]);
        $uploadOk = 1;

        // get image file type
        $imageFileTye = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // check if file already exists
        if(file_exists($target_file)){
            // file not uploaded, file already exists
            $uploadOk = 0;
        }

        // limit file size to 100KB
        if($_FILES["tile-img"]["size"] > 100000){
            // file not uploaded, file too large
            $uploadOk = 0;
        }

        // limit file types to svg and gif
        if($imageFileTye != "svg" && $imageFileTye != "gif"){
            // file not uploaded, incorrect file type
            $uploadOk = 0;
        }

        // check uploadOk 
        if($uploadOk == 0){
            // file not uploaded
        }
        else{
            // upload file
            if(move_uploaded_file($_FILES["tile-img"]["tmp_name"], $target_file)){
            }
            else{
                // error uploading file
            }
        }
    }
    // if no image was uploaded, assign default icon image
    if($img_path == "/tile-icons/" || $img_path == null){
        $img_path = "/tile-icons/stack-icon.svg";
        $dark_mode = true;
    }
    // get array from config file
    $array = include $config_file_path;
    // new tile array entry
    $new_tile = array("name" => $tile_name, "url" => $tile_url, "icon-path" => $img_path, "dark-mode" => $dark_mode);
    // assign index of new array entry
    $index = count($array);
    // append array with new tile
    $array[$index] = $new_tile;
    // update config file
    file_put_contents($config_file_path,"<?php return " . var_export($array, true) . ";\n?>\n");
    // redirect to homepage
    header("Location: /", true, 301);
    exit;
?>