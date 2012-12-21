<?php

namespace ICFS;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Silex\ControllerProviderInterface;
use ICFS\AdminServiceProvider;

class AdminController implements ControllerProviderInterface
{
    public function connect(Application $app)
    {
		//create middleware needed	
		$this->checkLogin = function (Request $req) use ($app) {
			if (!$app['ngap.admin']->checkLogin())
				return $app->redirect($app['url_generator']->generate('login'));
        };

        // creates a new controller based on the default route
        $controllers = $app['controllers_factory'];
        
        $this->adminLogin($controllers);
        $this->adminPages($controllers);

        $this->redirects($controllers);

        return $controllers;
    }

    private function redirects($controllers)
    {
		$controllers->get('/', function (Application $app) {
			return $app->redirect('home');
        })->bind('ngap');
    }

    /* Binds the login and logout functions */
	private function adminLogin($controllers) {

		// Logs the user out via the AdminServiceProvider (ngap.admin)
		$controllers->get('/logout', function (Application $app) {
			$app['ngap.admin']->logout();
			return $app->redirect($app['url_generator']->generate('login'));
        });

		// Checks if the user is logged out. If he is, show him login, else forward to ngap
        $controllers->get('/login', function (Application $app) {
        	if ($app['ngap.admin']->checkLogin())
        	{
        		return $app->redirect($app['url_generator']->generate('ngap'));
        	}

			return $app['twig']->render('ngap/login', array('error' => ''));
        })->bind('login');

        // Logic behind the login. Delegates actual login function to AdminServiceProvider
        $controllers->post('/login', function (Application $app) {
        	if ($app['ngap.admin']->login())
        		return $app->redirect($app['url_generator']->generate('ngap', array(), true));

        	return $app['twig']->render('ngap/login', 
        		array('error' => 'Invalid', 
        			'username' => $app['request']->get('username'))
        		);
        });
    }

    /* Binds the admin pages function */
    private function adminPages($controllers)
    {
        $controllers->get('home', function (Application $app) {
			return $app['twig']->render('ngap/skeleton', array('content' => $app['twig']->render('ngap/home')));
        })->before($this->checkLogin);
    }
}