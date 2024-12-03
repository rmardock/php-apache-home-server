$(function() {
    // Hide confirm account deletion form
    $(".account-deletion-form").hide();
    // When delete account button is clicked
    $(".delete-button").click(function() {
        // Show confirmation button and hide delete button
        $(".account-deletion-form").show();
        $(".delete-button-container").hide();
    });
    // function to change to delete dark icon on hover
    $("#delete-link").hover(function(){
        $("#delete-image").attr("src", function(index, attr){
            return attr.replace(".svg", "-dark.svg");
        });
    }, function(){ // on mouse away, return from dark mode
        $("#delete-image").attr("src", function(index, attr){
            return attr.replace("-dark.svg", ".svg");
        });
    });
});