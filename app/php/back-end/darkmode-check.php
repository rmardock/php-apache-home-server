<?php
    // access $_SESSION
    if(!session_start()) {
        header("Location: error.php");
        exit;
    }
    // access preferences file path from session
    $config_file = empty($_SESSION["preferences"]) ? null : $_SESSION["preferences"];
    // if no pref file exists
    if($config_file == null){
        // do nothing
        exit;
    }
    // assign pref file path
    $config_file_path = "/var/www/html/users/config/" . $config_file;
    // access preferences file array
    $array = include $config_file_path;

    // get image file name from ajax request
    $file_name = json_decode($_POST['name']);
    // assign img file path 
    $file_path = "/var/www/html" . $file_name;
    
    // return result of whether file exists
    $dark_mode = file_exists($file_path);
    // get arr index from ajax request
    $index = json_decode($_POST['index']);
    // convert to int
    $index = (int)$index;
    // if dark mode is true, update config file for data val
    if($dark_mode == true){
        $keys = array_keys($array);
        // loop through array and remove selected tiles
        for($i = 0; $i < count($array); $i++){
            if($keys[$i] == $index){
                $array[$index]['dark-mode'] = true;
            }
        }
        // update config file
        file_put_contents($config_file_path,"<?php return " . var_export($array, true). ";\n?>\n");
    }
    // build and return response
    $response['id'] = json_decode($_POST['id']);
    $response['result'] = $dark_mode;
    $response['filepath'] = $file_path;
    echo json_encode($response);
?>