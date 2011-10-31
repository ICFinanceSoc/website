$(document).ready(function() {

    // Feat box
    if($('#featbox').length) {
        $('#featbox #items').cycle( {
            fx: 'scrollDown',
            easing: 'easeOutBounce',
            next:   '#next', 
            prev:   '#prev'
        });
    }

    // Box thumbs
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
    
    // Register modal box
    if($('#registermodal').length) {
        $('#registermodal').modal({
            keyboard: true, 
            backdrop: true
        });
    }

    // Event boxes
    if($('.eventbox').length) {
        $('.eventbox #imgcont').hover(function() {
            var eventbox = $(this);
            var image = eventbox.find('img');
            var rollover = eventbox.find('#rollover');
            if (!eventbox.hasClass('animated')) {
                image.dequeue().stop().fadeTo('300', 0.2);
                rollover.dequeue().stop().fadeIn('300');
            }
       }, function() {
            var eventbox = $(this);
            var image = eventbox.find('img');
            var rollover = eventbox.find('#rollover');
            eventbox.addClass('animated');
            rollover.fadeOut('300');
            image.fadeTo('300', 1, function() {
                eventbox.removeClass('animated').dequeue();
            });
       });
    }
});
