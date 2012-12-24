<?php

/*$
printf('%b', $permission);
echo "<br />";
function get_bit($input, $location)
{
	if ($location == 0)
		return true;
	return (bool)($input & (0x1 << ($location - 1)));
	return (bool)(($input >> ($location)) & 0x1);
}

$echo = get_bit($permission, 6);

var_dump($echo);
echo "<br />";
printf("%b", $echo);
exit();*/

date_default_timezone_set("GMT");

require_once __DIR__.'/framework/vendor/autoload.php';


$app = new Silex\Application();
$app['debug'] = true;

$app->register(new ICFS\Model\User());

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



// publication page made into normal CMS page??