$(document).ready(function() {
    // $("#change-pass").click(function() {
    //     $("#change-password").toggle("slow");
    // });

    // $("#close-acc").click(function() {
    //     $("#close-account").toggle("slow");
    // });

    $("#weight-height").click(function() {
        $("#weight-height-content").slideDown("slow", function() {
            $("#water-intake-content").slideUp("slow");
        });
        $('.weight-height').addClass('header');
        $('.water-intake').removeClass('header');
    });


    $("#water-intake").click(function() {
        $("#water-intake-content").slideDown("slow", function() {
            $("#weight-height-content").slideUp("slow");
        });
        $('.water-intake').addClass('header');
        $('.weight-height').removeClass('header');
    });
});