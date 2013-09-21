<?php

$app->mount('/ngap', new ICFS\Controller\AdminController());

$app->get('/', function() use ($app) {
    return 'Hello!';
})->bind('homepage');