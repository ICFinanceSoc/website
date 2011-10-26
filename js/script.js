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
            var boxthumb = $(this);
            var image = boxthumb.find('img');
            var caption = boxthumb.find('.caption');
            if (!boxthumb.hasClass('animated')) {
                image.dequeue().stop().fadeTo('300', 0.2);
                caption.dequeue().stop().fadeIn('300');
            }
        }, function() {
            var boxthumb = $(this);
            var image = boxthumb.find('img');
            var caption = boxthumb.find('.caption');
            boxthumb.addClass('animated');
            caption.fadeOut('300');
            image.fadeTo('300', 1, function() {
                boxthumb.removeClass('animated').dequeue();
            });
        });
    }
});
