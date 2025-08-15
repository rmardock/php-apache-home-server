//---script to remove tile---//
$(function(){
    // hide elements on load
    $(".checkbox").hide();
    // if remove tile button is clicked, enter tile remover mode
    $("#remove-tile").click(function(){
        // if tile buttons are showing
        if($("#tile-buttons").hasClass("edit-open")){
                // change state class
                $("#tile-buttons").removeClass("edit-open");
                $("#tile-buttons").addClass("edit-closed");
                // hide tile buttons
                $("#tile-buttons").hide();
                // hide edit button
                $("#edit-button").hide();
                // show remove tile buttons
                $("#rm-tile-buttons").show();
                // show checkboxes
                $(".checkbox").show();
                // add disabled class
                $(".tile-link").addClass("disabled");
                // add container disable class for user tiles
                $(".tile").addClass("container-disable");
                // change tiles to dark mode if dark mode exists for each tile
                $(".tile-link").each(function(){
                    var img_element = $(this).children(":first");
                    var file_name = img_element.attr("src");
                    var dark_file_name = file_name.replace(".svg", "-dark.svg");
                    var dark_mode_data_val = img_element.attr("data-dark-mode");
                    var id = img_element.attr("id");
                    // only change to dark mode if exists
                    if(dark_mode_data_val == "1"){
                        $("#" + id).attr("src", dark_file_name);
                    }
                });
        }
    });
    // if tile is clicked while in tile remover mode
    $(".tile-link").click(function(event){
        if($(this).hasClass("disabled")){
            // disable link
            event.preventDefault();
            // check checkbox
            $(".tile-link".firstChild).prop("checked", true);
        }
    });
    // if cancel button is clicked in tile remover mode
    $("#rm-cancel").click(function(){
        if($("#tile-buttons").hasClass("edit-closed")){
            // change state class
            $("#tile-buttons").removeClass("edit-closed");
            $("#tile-buttons").addClass("edit-open");
            // hide remove tile buttons
            $("#rm-tile-buttons").hide();
            // remove checkbox selection(s)
            $(".tile-link".firstChild).prop("checked", false);
            // hide checkboxes
            $(".checkbox").hide();
            // show tile buttons
            $("#tile-buttons").show();
            // show edit button
            $("#edit-button").show();
            // enable links
            $(".tile-link").removeClass("disabled");
            // remove container disable class
            $(".tile").removeClass("container-disable");
            // change back to light mode for each tile
            $(".tile-link").children(":first").each(function(){
                var img_element = $(".tile-link").children(":first");
                var dark_mode_data_val = img_element.attr("data-dark-mode");
                var file_name = img_element.attr("src");
                // if dark mode exists and is active
                if(dark_mode_data_val == "1"){
                    var dark_file_name = file_name.replace("-dark.svg", ".svg");
                    var id = img_element.attr("id");
                    // only change to light mode
                    $("#" + id).attr("src", dark_file_name);
                }
            });
        }
    });
    // if remove confirm button is clicked
    $("#rm-submit").click(function(){
        // array to update user config file
        var id = [];
        // message string
        var message = "";
        // add each checked tile to array
        var checked_tiles = $("input[type='checkbox']:checked");
        // add each selected checkbox id to array
        checked_tiles.each(function(){
            id.push($(this).val());

        });
        // encode as json
        id_json = JSON.stringify(id);
        // prepare data to send with post request
        var tile_data = {
            id: id_json
        };
        // post request
        $.post("../php/back-end/tile-remover.php", tile_data, function(form_data){
        // if tile not removed
        if(!form_data){
            // error message 
        }
        })
        // if .post() fails
        .fail(function(data){
            // error message 
        });
        // reload page
        location.reload();
    });
});