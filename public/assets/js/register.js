$(document).ready(function() {
    // on click signup, hide login and show registration form
    $("#signup").click(function() {
        $("#login_form").slideUp("slow", function() {
            $("#register_form").slideDown("slow");
        });
    });

    // on click signin, hide registration and show login form
    $("#signin").click(function() {
        $("#register_form").slideUp("slow", function() {
            $("#login_form").slideDown("slow");
        });
    });
});