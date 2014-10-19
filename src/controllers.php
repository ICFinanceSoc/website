<?php

use ICFS\Model\Page;
use Symfony\Component\HttpFoundation\Response;
use ICFS\Model\Events;
use Silex\Application;


$app->mount('/ngap', new ICFS\Controller\AdminController());

$app->get('/user/logout', function (Application $app) {
    $app['icfs.user']->logout();
    return $app->redirect($app['url_generator']->generate('homepage'));
});
        // // Logic behind the login. Delegates actual login function to AdminServiceProvider
        // $this->controllers->post('/login', function (Application $app) {
        //     if (($error = $app['icfs.user']->adminLogin()) === true)
        //         return $app->redirect($app['url_generator']->generate('ngap', array(), true));
        //     return $app['twig']->render('ngap/login', array('error' => $error, 'username' => $app['request']->get('username')) );
        // });

$app->get('/login', function (Application $app) {
    if ($app['icfs.user']->checkLogin())
        return $app->redirect($app['url_generator']->generate('homepage'));
    return $app['twig']->render('pages/login', array('error' => ''));
});
$app->post('/login', function (Application $app) {
	if (($error = $app['icfs.user']->login()) === true)
        return $app->redirect($app['url_generator']->generate('homepage', array(), true));
    return $app['twig']->render('pages/login', array('error' => $error, 'username' => $app['request']->get('username')) );
});


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





$app->get('/events', function() use ($app) {
	$events = new Events($app);

	$sponsors = $app['db.em']->getRepository('\\ICFS\\Model\\Sponsors')->findAll();
	$twig_sponsor = array();
	foreach ($sponsors as $sponsor) {
		$twig_sponsor[$sponsor->getId()] = $sponsor;
	}

	$futureEvents = $events->filter("endtime > " . (time()-(24*60*60)), "starttime asc");
	$futureEventsArray = array();

	foreach ($futureEvents as $fe) {
		$futureEventsArray[date("F Y",$fe['starttime'])][] = $fe;
	}

	$pastEvents = $events->filter("endtime < " . (time()-(24*60*60)), "starttime desc", 3);

    return $app['twig']->render('pages/events', array(
    	'events'=>$futureEventsArray,
    	'sponsors'=> $twig_sponsor,
    	'past_event' => $pastEvents
    	));
});


$app->get('/events/{eventid}', function($eventid) use ($app) {
	$events = new Events($app);
    if (!is_numeric($eventid) || !($event = $events->get($eventid)))
        return new Response($app['twig']->render('pages/404'), 404);
    return $app['twig']->render('pages/eventdetails', array(
    	'event'=>$event
    	));
});

$app->get('/sponsors', function() use ($app) {
	$sponsors = $app['db.em']->getRepository('\\ICFS\\Model\\Sponsors');
    return $app['twig']->render('pages/sponsors', array(
    	'sponsors'=> array(
    		'1'=>$sponsors->findBy(array('type' => '1'), array('type' => 'ASC')),
    		'2'=>$sponsors->findBy(array('type' => '2'), array('type' => 'ASC')),
    		'3'=>$sponsors->findBy(array('type' => '3'), array('type' => 'ASC')),
    		'4'=>$sponsors->findBy(array('type' => '4'), array('type' => 'ASC')),
    		'5'=>$sponsors->findBy(array('type' => '5'), array('type' => 'ASC')),
	    )
    	));
});
$app->get('/sponsors/{sponsorid}/ajax', function($sponsorid) use ($app) {
	$sponsors = $app['db.em']->getRepository('\\ICFS\\Model\\Sponsors');
    return $app['twig']->render('sponsordetails', array(
    	'sponsor'=> $sponsors->find($sponsorid)
    	));
});




$app->get('/{page_name}', function($page_name) use ($app) {
	$page = new Page($app, $page_name);

	if ($page->exists) {
		return  $app['twig']->render('pages/generic', array(
			'content'=>$page->data['content']
			));
	} else {
		return new Response($app['twig']->render('pages/404'), 404);
	}

	return $page_name;
});