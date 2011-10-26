$(document).ready(function() {

    if($('#featbox').length) {
        $('#featbox #items').cycle( {
            fx: 'scrollDown',
            easing: 'easeOutBounce',
            next:   '#next', 
            prev:   '#prev'
        });
    }
});
