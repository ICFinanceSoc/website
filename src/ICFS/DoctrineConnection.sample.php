<?php

/*
	This is the database connection information.

	Please do not commit this to a git repository.
*/


namespace ICFS;

use Silex\Application;
use Silex\ServiceProviderInterface;
use Silex\Provider\DoctrineServiceProvider;

class DoctrineConnection implements ServiceProviderInterface
{
    public function register(Application $app)
    {
    	$app->register(new \Silex\Provider\DoctrineServiceProvider(), array(
		    'db.options' => array(
		        'driver'   => 'pdo_mysql',
		        'host' => 'localhost',
		        'user' => 'that is',
		        'password' => 'so hot',
		        'dbname' => 'icfs'
		    )
		));
    }

    public function boot(Application $app)
    {
    }
}

