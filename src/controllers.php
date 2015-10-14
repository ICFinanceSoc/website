<?php

use ICFS\Model\Page;
use Symfony\Component\HttpFoundation\Response;
use ICFS\Model\Events;
use Silex\Application;

$app->get('/ngap', function (Application $app) {
    return $app->redirect($app['url_generator']->generate('homepage').'ngap/');
});
$app->mount('/ngap', new ICFS\Controller\AdminController());

$app->get('/user/logout', function (Application $app) {
    $app['icfs.user']->logout();
    return $app->redirect($app['url_generator']->generate('homepage'));
});
$app->get('/login', function (Application $app) {
    if ($app['icfs.user']->checkLogin())
        return $app->redirect($app['url_generator']->generate('homepage'));
    return $app['twig']->render('pages/login', array('error' => ''));
})->bind('userlogin');
$app->post('/login', function (Application $app) {
	if (($error = $app['icfs.user']->login()) === true)
        return $app->redirect($app['url_generator']->generate('homepage', array(), true));
    else if ($app['icfs.user']->checkCredentials($app['request']->get('username'), $app['request']->get('password'))) {
        $app['session']->set('icfs_temp_user', $app['request']->get('username'));
        return $app->redirect($app['url_generator']->generate('registration_finalise'));
        
    }
    return $app['twig']->render('pages/login', array('error' => $error, 'username' => $app['request']->get('username')) );
});



$app->get('/register/complete', function (Application $app) {
    if (!$app['session']->get('icfs_temp_user')) 
        return $app->redirect($app['url_generator']->generate('userlogin'));

    $username = $app['session']->get('icfs_temp_user');
    $info = $app['icfs.user']->getLdapDetails($username);

    return $app['twig']->render('pages/register_complete', array(
        'username' => $username,
        'name' => implode(" ", $app['icfs.user']->getLdapName($username))
        ) );
})->bind('registration_finalise');
$app->post('/register/complete', function (Application $app) {
    if (!$app['session']->get('icfs_temp_user')) 
        return $app->redirect($app['url_generator']->generate('userlogin'));

    $username = $app['session']->get('icfs_temp_user');
    $newsletter = ($app['request']->get('newsletter') == "on") ? true : false;

    if (($error = $app['icfs.user']->newUser($username, "WEB2", $newsletter)) === true){
        $app['icfs.user']->forceLogin($username);
        $app['session']->remove('icfs_temp_user');
        return $app->redirect($app['url_generator']->generate('homepage', array(), true));
    }
    else
        return $app['twig']->render('pages/register_complete', array(
            'error' => $error,
            'username' => $username,
            'name' => implode(" ", $app['icfs.user']->getLdapName($username))
        ) );
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

    $attending = $events->attending($eventid, $app['icfs.user']->username);

    return $app['twig']->render('pages/eventdetails', array(
            'event'=>$event,
            'attending' => $attending
        ));
});
$app->post('/events/{eventid}', function($eventid) use ($app) {
    $events = new Events($app);
    if (!is_numeric($eventid) || !($event = $events->get($eventid)))
        return new Response($app['twig']->render('pages/404'), 404);

    $attending = $events->attending($eventid, $app['icfs.user']->username);

    if ($attending) {
        // remove attendance
        $events->removeAttendance($eventid, $app['icfs.user']->username);
    } else {
        // add attendance
        $events->addAttendance($eventid, $app['icfs.user']->username);
    }

    return $app->redirect($app['url_generator']->generate('homepage') . "events/" . $eventid);
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


$app->get('/user', function() use ($app) {
    if (!$app['icfs.user']->checkLogin())
        return $app->redirect($app['url_generator']->generate('homepage'));
    return $app['twig']->render('pages/usercp', array());
})->bind('usercp');
$app->post('/user', function() use ($app) {
    if (!$app['icfs.user']->checkLogin())
        return $app->redirect($app['url_generator']->generate('homepage'));

    $newsletter = ($app['request']->get('newsletter')) ? 1 : 0;
    if ($newsletter != $app['icfs.user']->newsletter){
        $app['icfs.user']->updateNewsletter($newsletter);
    }

    return $app->redirect($app['url_generator']->generate('usercp'));
});




$app->get('/team', function() use ($app) {
    $year = ( date('Y') - (date('m') < 8));

    $team = new \ICFS\Model\ICFSTeam($app);
    $comittee = $team->getComittee($year);

    $sponsors = $app['db.em']->getRepository('\\ICFS\\Model\\Sponsors');
    return $app['twig']->render('pages/team', array(
        'team'=> $comittee
        ));
});


$app->get('/register', function() use ($app) {
    if ($app['icfs.user']->checkLogin())
        return $app->redirect($app['url_generator']->generate('homepage'));

    return $app['twig']->render('pages/register', array());
});



$app->get('/careers', function() use ($app) {
    // if (!$app['icfs.user']->checkLogin())
    //     return $app->redirect($app['url_generator']->generate('userlogin'));
    return $app['twig']->render('pages/careers', array());
});
$app->get('/careers/test', function() use ($app) {
    // if (!$app['icfs.user']->checkLogin())
    //     return $app->redirect($app['url_generator']->generate('userlogin'));
    return $app['twig']->render('pages/careers_test', array());
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