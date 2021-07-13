if ('ontouchstart' in window) {
    $(document).on('focus', 'textarea,input,select', function () {
        $('.msg-login').css('position', 'static');
    }).on('blur', 'textarea,input,select', function () {
        $('.msg-login').css('position', 'fixed');
    });
}