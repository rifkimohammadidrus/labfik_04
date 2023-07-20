$(document).ready(function () {
    $(".feed-itemlab").slice(0, 8).show();
    if ($(".feed-itemlab:hidden").length != 0) {
        $("#loadMore").show();
    } else {
        $("#loadMore").hide();
    }
    $("#loadMore").on('click', function (e) {
        e.preventDefault();
        $(".feed-itemlab:hidden").slice(0, 4).slideDown();
        if ($(".feed-itemlab:hidden").length == 0) {
            $("#loadMore").fadeOut('slow');
        }
    });
});