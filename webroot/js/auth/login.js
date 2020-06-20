$(function () {
    resize();

    $( window ).resize(function() {
        resize();
    });
});

function resize() {
    var h = $(window).height();
    $('.container').height(h);

    var mainHeight = $('.main-div').height();
    var logoHeight = $('.logo').height();
    $('.login-form').css({'padding-top': ((h-mainHeight)/2)-logoHeight})
}

