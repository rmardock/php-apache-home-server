//---script for menu sidebar on home page---//
$(function() {
    // Hide elements on page load
    $(".menu-bar").hide();

    // When menu button is clicked
    $(".open-button").click(function() {
        // If device is desktop size
        if($(window).width() <= 800)
        {
            if($(".menu-bar").hasClass("desktop"))
            {
                $(".menu-bar").removeClass("desktop");
            }
            $(".menu-bar").addClass("mobile");
        }
        else
        // if device is less than desktop size
        {
            if($(".menu-bar").hasClass("mobile"))
            {
                $(".menu-bar").removeClass("mobile");
            }
            $(".menu-bar").addClass("desktop");
        }
        $(".menu-bar").animate({width: "toggle"});
        $(".open-button").hide();
        $(".title-bar").addClass("center");
    });
    // On click function for clicking close button in menu bar
    $(".close-button").click(function()
    {
        $(".menu-bar").animate({width: "toggle"});
        $(".open-button").show();
        $(".title-bar").removeClass("center");
    });
});