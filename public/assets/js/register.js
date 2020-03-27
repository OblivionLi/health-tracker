$(document).ready(function() {
    // on click signup, hide login and show registration form
    $("#signup").click(function() {
        $("#login-form").slideUp("slow", function() {
            $("#register-form").slideDown("slow");
        });
    });

    // on click signin, hide registration and show login form
    $("#signin").click(function() {
        $("#register-form").slideUp("slow", function() {
            $("#login-form").slideDown("slow");
        });
    });
});