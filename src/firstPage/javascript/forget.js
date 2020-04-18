$(document).ready(function () {
    $("#login").css("background-color", "#ff5835");
    $("#setpassword").fadeIn(700);
    $("#signup").hover(function () {
            $(this).css("background-color", "#ff5835");
            $("#login").css("background-color", "transparent");
        },
        function () {
            $(this).css("background-color", "transparent");
            $("#login").css("background-color", "#ff5835");
        });
    document.getElementById("login").style.transition ="all .7s";
    document.getElementById("signup").style.transition ="all .7s";
});