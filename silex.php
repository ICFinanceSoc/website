<?php

require_once __DIR__.'/framework/vendor/autoload.php';

$app = new Silex\Application();

$app->get('/hello', function() {
    return 'Hello!';
});

$app->run();
