<?php
    //---tile remover---//
    //---removes user selected custom tiles---//
    // access $_SESSION
    if(!session_start()) {
        header("Location: error.php");
        exit;
    }
    // access and assign post variables
    $id_json = empty($_POST["id"]) ? null : $_POST["id"];

    // access $_SESSION and assign variables
    $loggedin = empty($_SESSION["loggedin"]) ? FALSE : $_SESSION["loggedin"];
    $config_file = empty($_SESSION["preferences"]) ? null : $_SESSION["preferences"];
    // if not logged in
    if(!$loggedin) {
        // do nothing
        exit; 
    }

    // prepare file path
    $config_file_path = "/var/www/html/config/users/" . $config_file;

    // get array from config file
    $array = include $config_file_path;
    // remove array entry
    $tiles_to_remove = json_decode($id_json, true);
    // resort to avoid index shift issues
    rsort($tiles_to_remove);
    $keys = array_keys($array);
    // iterate tiles to remove array
    foreach($tiles_to_remove as $index){
        // loop through array and remove selected tiles
        for($i = 0; $i < count($array); $i++){
            if($keys[$i] == $index){
                //remove tile entry
                array_splice($array, $index, 1);
            }
        }
    }
    // update config file
    file_put_contents($config_file_path,"<?php return " . var_export($array, true). ";\n?>\n");
    // redirect to homepage
    //header("Location: /", true, 301);
    exit;
?>