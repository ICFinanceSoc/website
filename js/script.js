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
                rollover.dequeue().stop().fadeTo('300', 0.8);
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

    // Sponsors page
    if($('#sponsors').length) {
        $('.sponsorbox td a').click(function() {
            // remove any active sponsors
            $('.sponsorbox td a').each(function(index) {
                $(this).removeClass('active');
            });
            // add active class to current sponsor
            $(this).addClass('active');
            // remove sponsor page helper and add loading spinner
            $('.sponsorinfo').html('').addClass('loading');
            // get id of current sponsor
            var id = getUrlParams($(this).attr('href'), 'ID');
            // load sponsor info
            $('.sponsorinfo').load('sponsorsingle.php?ID='+id+' #sponsorbox').hide().removeClass('loading').fadeIn(300);
            // return false to cancel click action
            return false;
        });
    };

    // Get query parameter from url by name
    function getUrlParams(url, name) {
        var nvpair = {};
        var qs = url.split('?');
        var pairs = qs[1].split('&');
        $.each(pairs, function(i, v){
            var pair = v.split('=');
            nvpair[pair[0]] = pair[1];
        });
        if(nvpair[name]) {
            return nvpair[name];
        } else {
            return false;
        }
      }
});
