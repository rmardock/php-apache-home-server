<?php
    //---tile builder---//
    //---dynamically builds tiles with data supplied from config files---//
    //---data is stored in php arrays---//

    // init variables
    $config_file = "";
    $file_path_header = "/var/www/html/config";
    $config_file_path = "";
    
    // add args for different configs here
    
    // example:
    //if($args == 'new-config-args'){
    //  $config_file = ".new_config_file.php;
    //  $config_file_path = $file_path_header . "/config-subdir-here/" . $config_file;
    //}
    //note: php config files must be structured in the same way

    // assign config file based on args

    // if args is home-page
    if($args == "home-page"){
        $config_file = ".default_config.php";
        $config_file_path = $file_path_header . "/default/" . $config_file;
    }
    // if args is admin-tools
    if($args == "admin-tools"){
        $config_file = ".admin_tools_config.php";
        $config_file_path = $file_path_header . "/default/" . $config_file;
    }
    // if args is acc-services
    if($args == "acc-services"){
        // if user had admin priveleges
        if($admin){
            // assign correct config file
            $config_file = ".acc_services_config.php";
            $config_file_path = $file_path_header . "/default/" . $config_file;
        }else{ // if user does not have admin privileges
            // assign correct config file
            $config_file = ".acc_services_no_admin_config.php";
            $config_file_path = $file_path_header . "/default/" . $config_file;
        }
    }
    // if args is not-logged-in
    if($args == "not-logged-in"){
        $config_file = ".not_logged_in_config.php";
        $config_file_path = $file_path_header . "/default/" . $config_file;
    }
    // if args is user
    if($args == "user"){
        // get user config file from session
        $config_file = empty($_SESSION['preferences']) ? null : $_SESSION['preferences'];
        // if no preference file exists
        if($config_file == null){
            // do nothing
            exit;
        }
        else{
            // assign file path
            $config_file_path = $file_path_header . "/users/" . $config_file;
        }
    }
    
    // get array from config file
    $array = include $config_file_path;
    // get array keys
    $keys = array_keys($array);
    // loop array
    for($i = 0; $i < count($array); $i++){
        // init variables
        $name = "";
        $url = "";
        $icon_path = "";
        $dark_mode = false;
        $dark_mode_data_val = "0";
        $id = $keys[$i];
        // loop through each key-pair in each tile entry array  and assign values
        foreach($array[$keys[$i]] as $key => $value){
            // switch case for correctly assigning values
            switch($key){
                // assign name
                case "name":
                    $name = $value;
                    break;
                // assign url
                case "url":
                    $url = $value;
                    break;
                // assign icon path
                case "icon-path":
                    $icon_path = $value;
                    break;
                // assign dark mode
                case "dark-mode":
                    $dark_mode = $value;
                    break;
            }
        }
        // assign dark mode marker
        if($dark_mode == true){
            $dark_mode_data_val = "1";
        }
        else{
            $dark_mode_data_val = "0";
        }
        // if no icon supplied for tile
        if($icon_path == ""){
            // supply default icon with dark mode
            $icon_path = "img/stack-icon.svg";
            $dark_mode_data_val = "1";
        }
        // replace spaces with '-' for html formatting
        $name_formatted = preg_replace('/\s+/', '-', $name);
        // build tiles dynamically with array values from config file
        echo'<div class="w3-card service-card default-tile w3-center">
                <a id="'. $name_formatted . '-link" data-id="' . $id . '" target="_blank" class="w3-button service-button tile-link" href="'. $url . '">
                    <img id="' . $name_formatted . '-image" data-dark-mode="' . $dark_mode_data_val . '" src="' . $icon_path . '" class="service-image" alt="' . $name . ' icon">
                    <div class="w3-container">
                        <h3 class="service-name">' . $name . '</h3>
                    </div>
                </a>
            </div>';
    }
?>