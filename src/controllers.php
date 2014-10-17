<?php

$app->mount('/ngap', new ICFS\Controller\AdminController());

$app->get('/', function() use ($app) {
	$sponsors = $app['db.em']->getRepository('\\ICFS\\Model\\Sponsors');
    return $app['twig']->render('home',
    	array('page'=>'home', 'sponsors'=> array(
    		'1'=>$sponsors->findBy(array('type' => '1'), array('type' => 'ASC')),
    		'2'=>$sponsors->findBy(array('type' => '2'), array('type' => 'ASC')),
    		'3'=>$sponsors->findBy(array('type' => '3'), array('type' => 'ASC')),
    		'4'=>$sponsors->findBy(array('type' => '4'), array('type' => 'ASC')),
    		'5'=>$sponsors->findBy(array('type' => '5'), array('type' => 'ASC')),
    	)));
})->bind('homepage');