$(document).ready(function () {
    $(".feed-iteminfo").slice(0, 3).show();
    if ($(".feed-iteminfo:hidden").length != 0) {
        $("#loadMore").show();
    } else {
        $("#loadMore").hide();
    }
    $("#loadMore").on('click', function (e) {
        e.preventDefault();
        $(".feed-iteminfo:hidden").slice(0, 3).slideDown();
        if ($(".feed-iteminfo:hidden").length == 0) {
            $("#loadMore").fadeOut('slow');
        }
    });
});