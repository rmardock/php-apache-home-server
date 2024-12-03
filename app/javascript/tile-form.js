//---script for tile form functions on home page---//
$(function() {
    // hide elements on page load
    $("#tile-form").hide();
    $("#tile-buttons").hide();
    $("#rm-tile-buttons").hide();
    // when edit button is clicked
    $("#edit-button").click(function(){
        // if button menu is closed
        if($("#tile-buttons").hasClass("edit-closed"))
        {
            // change state class
            $("#tile-buttons").removeClass("edit-closed");
            $("#tile-buttons").addClass("edit-open");
            // show tile buttons
            $("#tile-buttons").show();
            // change edit button text to "done"
            $("#edit-button").attr("value", function(index, attr){
                return attr.replace("edit", "done");
            });
        }
        else
        {
            // if button menu is open
            // edit button is shown as 'done' here
            if($("#tile-buttons").hasClass("edit-open")){
                // change state class
                $("#tile-buttons").removeClass("edit-open");
                $("#tile-buttons").addClass("edit-closed");
                // hide tile buttons
                $("#tile-buttons").hide();
                // hide new tile form
                $("#tile-form").hide();
                // change edit button text to "edit"
                $("#edit-button").attr("value", function(index, attr){
                    return attr.replace("done", "edit");
                });
            }
        }
    });

    // if add button clicked
    $("#add-tile").click(function(){
        // show new tile form
        $("#tile-form").show();
        // hide tile buttons
        $("#tile-buttons").hide();
    });

    // when new tile form submitted
    $("#new-tile-form").submit(function(){
        // call exit form function
        exit_form();
    });
    
    // when cancel button is clicked
    $("#tile-cancel").click(function(){
        // call exit form function
        exit_form();
    });

    // function for hiding tile form and showing tile buttons
    function exit_form(){
        // hide tile form
        $("#tile-form").hide();
        // show tile buttons
        $("#tile-buttons").show();
    }
});