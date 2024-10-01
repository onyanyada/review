$(document).ready(function () {
    $(".current-user").click(function () {
        $(".user-menu").fadeIn();
    });

    $(".close").click(function () {
        $(".user-menu").fadeOut();
    });
});