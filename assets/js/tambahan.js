// Material Design Input
$('.form-check input').after('<span class="custom-mark"></span>');
$('.table').addClass('table-hover');
$('.form-check:has(input:disabled)').addClass('disabled');
$('.custom-form input,.custom-form textarea').addClass('custom-form-control');
$('.custom-form input[type="checkbox"]').removeAttr('class');
$(".custom-form .form-group label").removeAttr('class');
$(".custom-form .form-horizontal .form-group div .form-control,.custom-form .form-horizontal .form-group div textarea,.custom-form .form-horizontal .form-group div .checkbox,.custom-form .form-horizontal .form-group div .radio,.custom-form .form-horizontal .form-group div button").unwrap();
$('.custom-form .form-group:has(label) input,.custom-form .form-group:has(label) textarea').attr('placeholder', ' ');
$('.custom-form .form-group:has(select)').addClass('has-select');
$('.custom-form .form-group:has(input) label').each(function () {
    $(this).insertAfter($(this).parent().find('.form-control'));
});

function leaveInput(el) {
    if (el.value.length > 0) {
        if (!el.classList.contains('active')) {
            el.classList.add('active');
        }
    } else {
        if (el.classList.contains('active')) {
            el.classList.remove('active');
        }
    }
}
var inputs = document.getElementsByClassName('custom-form-control');
for (var i = 0; i < inputs.length; i++) {
    var el = inputs[i];
    el.addEventListener("blur", function () {
        leaveInput(this);
    });
};

$(function () {
    $('.navbar ul li a').each(function () {
        if ($(this).prop('href') == window.location.href) {
            $(this).addClass('active');
            $(this).parents('li').addClass('active');
        }
    });
});

$('.direct-chat-msg').after('<div class="clear"></div>');
$('.fik-db-side-menu .card:has(ul) > .btn').append('<i class="fas fa-chevron-down"></i>');

$('.menu-trigger,.waktu').on('click', function () {
    $('.fik-navbar-menu ul.center,.jadwal-ruangan').slideToggle();
});
$('.db-menu-trigger,.waktu').on('click', function () {
    $('.fik-db-side-menu,.waktu').toggleClass('show');
});
$('.akun-helpdesk.dua .col-md-4 .card-header h6').on('click', function () {
    $('.akun-helpdesk.dua .col-md-4').toggleClass('show');
});

$('.fik-feed.galeri-karya .feed-item .gambar a:has(img)').addClass('foto');