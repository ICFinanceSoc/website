<?php
date_default_timezone_set("GMT");

require_once __DIR__.'/../vendor/autoload.php';

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation;

$app = new Application();

$app->register(new ICFS\Model\User());
$app->register(new ICFS\Model\Members());
$app->register(new ICFS\Model\Admin\Mail());

$app->register(new Silex\Provider\UrlGeneratorServiceProvider());

use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage;
$storage = new NativeSessionStorage(array(), new NativeSessionStorage());
$session = new Session($storage);


$app->register(new Silex\Provider\SessionServiceProvider());

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../src/views',
    'twig.options' => array('strict_variables' => false)
));

$app->register(new Silex\Provider\SwiftmailerServiceProvider());

$logger = new Swift_Plugins_Loggers_EchoLogger();
$app['mailer']->registerPlugin(new Swift_Plugins_LoggerPlugin($logger));

//$app['mailer.logger'] = new Logger\MessageLogger();
//$app['mailer']->registerPlugin($app['mailer.logger']);

$app['swiftmailer.transport'] = Swift_SendmailTransport::newInstance('/usr/sbin/sendmail -bs');
/*$app['mailer'] = $app->share(function ($app) {
    return new \Swift_Mailer($app['swiftmailer.transport']);
});*/
/*$app['swiftmailer.options'] = array(
    'host' => 'smtp.gmail.com',
    'port' => '465',
    'username' => 'no-reply@financesociety.co.uk',
    'password' => 'L2Bh<Vq<',
    'encryption' => 'ssl',
    'auth_mode' => 'login'
);*/
//$app['swiftmailer.transport'] = Swift_SendmailTransport::newInstance('/usr/sbin/sendmail -bs');
//$transport = Swift_MailTransport::newInstance();
//$app['swiftmailer.transport']=$transport;

$app->register(new ICFS\DoctrineConnection());


return $app;
