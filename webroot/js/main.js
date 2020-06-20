$(document).ready(function () {
    $('.next').on('click', function (e) {
        e.preventDefault();
        $('.menu-list .row').hide();
        $('.menu-list .row:eq(3)').show();
        $(this).hide();
        $('.back').show();
    });
    $('.back').on('click', function (e) {
        e.preventDefault();
        $('.menu-list .row').show();
        $('.menu-list .row:eq(3)').hide();
        $(this).hide();
        $('.next').show();
    });

    $( window ).resize(function() {
        resize();
    });
    resize();
});

function resize() {
    var h = $(window).height();
    if ($('.container').height() < h) {
        // $('.container').height(h)
    }
}