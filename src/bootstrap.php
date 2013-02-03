<?php

date_default_timezone_set("GMT");

require_once __DIR__.'/../framework/vendor/autoload.php';

$app = new Silex\Application();
$app['debug'] = true;

$app->register(new ICFS\Model\User());
$app->register(new ICFS\Model\Members());
$app->register(new ICFS\Model\Admin\Mail());

$app->register(new Silex\Provider\UrlGeneratorServiceProvider());
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage;
$storage = new NativeSessionStorage(array('save_path' => '/Users/txsl/sites/icfs'), new NativeSessionStorage());
$session = new Session($storage);

$app->register(new Silex\Provider\SessionServiceProvider());

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../src/views',
    'twig.options' => array('strict_variables' => false)
));

$app->register(new Silex\Provider\SwiftmailerServiceProvider());
$app['swiftmailer.transport'] = Swift_SendmailTransport::newInstance('/usr/sbin/sendmail -bs');

$app->register(new ICFS\DoctrineConnection());

$app->mount('/ngap', new ICFS\Controller\AdminController());

$app->get('/', function() {
    return 'Hello!';
})->bind('homepage');