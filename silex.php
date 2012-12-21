<?php

require_once __DIR__.'/framework/vendor/autoload.php';
require_once __DIR__.'/src/controllers/AdminController.php';
require_once __DIR__.'/src/models/admin/AdminServiceProvider.php';


$app = new Silex\Application();
$app['debug'] = true;

$app->register(new ICFS\AdminServiceProvider());

$app->register(new Silex\Provider\UrlGeneratorServiceProvider());
$app->register(new Silex\Provider\SessionServiceProvider());
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/src/views',
    'twig.options' => array('strict_variables' => false)
));



$app->mount('/ngap', new ICFS\AdminController());




$app->get('/', function() {
    return 'Hello!';
})->bind('homepage');




$app->run();
