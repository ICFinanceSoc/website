<?php

date_default_timezone_set("GMT");

require_once __DIR__.'/framework/vendor/autoload.php';


$app = new Silex\Application();
$app['debug'] = true;

$app->register(new ICFS\Model\AdminUser());

$app->register(new Silex\Provider\UrlGeneratorServiceProvider());
$app->register(new Silex\Provider\SessionServiceProvider());
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/src/views',
    'twig.options' => array('strict_variables' => false)
));
$app->register(new ICFS\DoctrineConnection());



$app->mount('/ngap', new ICFS\Controller\AdminController());




$app->get('/', function() {
    return 'Hello!';
})->bind('homepage');




$app->run();
