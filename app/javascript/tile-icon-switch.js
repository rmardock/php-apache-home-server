$(function(){
    // function to change to dark icon on hover
    $(".tile-link").hover(function(){
        // get img element for selected tile
        var img_element = $(this).children(":first");
        // get img element attributes
        var arr_index = $(this).attr("data-id");
        var file_name = img_element.attr("src");
        var dark_mode_data_val = img_element.attr("data-dark-mode");
        var id = img_element.attr("id");
        // replace '.svg' with '-dark.svg' 
        const dark_file_name = file_name.replace(".svg", "-dark.svg");
        // if dark mode data val is marked true, change file name here and return
        if(dark_mode_data_val == "1"){
            $("#" + id).attr("src", dark_file_name);
            return;
        }
        // if dark mode data val is not marked true, format data
        var file_name_json = JSON.stringify(dark_file_name);
        var id_json = JSON.stringify(id);
        // prepare data for request
        var data = {
            name: file_name_json,
            id: id_json,
            index: arr_index
        };
        // send request to php backend
        $.post("../php/back-end/darkmode-check.php", data, function(response){
            // process response
            var dark_mode = response['result'];
            var id = response['id'];
            // if dark mode exists
            if(dark_mode == true){
                // change src for tile icon
                $("#" + id).attr("src", dark_file_name);
            }
            // if dark mode does not exist
            else if(dark_mode == false){
                //dev
                console.log("no dark svg found")
                // do nothing
                return;
            }
            else{
                //dev
                console.log('request failed')
                // do nothing
                return;
            }
        }, 
        // json requirement
        'json'); 
    },
    // on hover off 
    function(){
        // select image element
        var img_element = $(this).children(":first");
        // get data val
        var dark_mode_data_val = img_element.attr("data-dark-mode");
        // if no dark mode
        if(dark_mode_data_val == "0"){
            // do nothing
            return;
        }
        // select img id
        var id = img_element.attr("id");
        // return to original icon using element id
        if(img_element.attr("src").includes("-dark")){
            var file_name = img_element.attr("src").replace("-dark.svg", ".svg");
            $("#" + id).attr("src", file_name);
        }
    });
});