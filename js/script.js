$(document).ready(function() {

    if($('#featbox').length) {
        $('#featbox #items').cycle( {
            fx: 'scrollDown',
            easing: 'easeOutBounce',
            next:   '#next', 
            prev:   '#prev'
        });
    }

    if($('.boxthumb').length) {
        $('.boxthumb').hover(function() {
            $(this).find('img').fadeTo('300', 0.2);
            $(this).find('.caption').fadeIn('300');
        }, function() {
            $(this).find('img').fadeTo('300', 1);
            $(this).find('.caption').fadeOut('300');
        });
    }
});
