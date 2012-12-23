<?php

namespace ICFS\Controller;

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

        $this->makeNavigation = function() use ($app) {

            $cmspages = $app['db']->fetchAll("SELECT name,title FROM pages_content");
            $pages_sub = array();

            foreach ( $cmspages as $key=>$value )  { //generate the sub-pages for the 'pages' page. Pageception!
                $pages_sub[$value['name']] = array(
                    'name' => $value['title'],
                    'type' => 'link'
                    );
            }
            $pages_sub['add'] = array(
                    'name' => 'Add New Page',
                    'class' => 'navli-green',
                    'type' => 'link'
                );

            $app['twig']->addGlobal('ngap_nav', array(
                'user'  => array(
                    'name' => "Hello, " . $app['ngap.admin']->username,
                    'type' => 'holder',
                    'class' => 'user',
                    'subpages' => array(
                        'info' => array(
                            'name' => 'Put user info here',
                            'type' => 'holder'),
                        'logout' => array(
                            'name' => 'Logout',
                            'class' => 'logout',
                            'type' => 'link')
                    )
                ),
                'home' => array(
                    'name'  =>  'Home' ,
                    'type'  =>  'link'  
                ),
                'pages' => array(
                    'name' => 'Page Manager »',
                    'type'  =>  'holder',
                    'subpages' => $pages_sub
                ),
                'members' => array(
                    'name' => 'Members »',
                    'type'  =>  'holder',
                    'subpages' => array(
                        'list' => array(
                            'name' => 'Member List',
                            'type' => 'link'),
                        'email' => array(
                            'name' => 'E-mail Members',
                            'type' => 'link'),
                        'interests' => array(
                            'name' => 'Interests',
                            'type' => 'link')
                    )
                ),
                'management' => array(
                    'name' => 'Management »',
                    'type'  =>  'holder',
                    'subpages' => array(
                        'page' => array(
                            'name' => 'Management Page',
                            'type' => 'link'),
                        'access' => array(
                            'name' => 'Ngap Access',
                            'type' => 'link')
                    )
                )
            ));
        };

        // creates a new controller based on the default route
        $this->controllers = $app['controllers_factory'];
        
        $this->adminLogin();
        $this->adminPages();

        $this->redirects();

        return $this->controllers;
    }

    private function redirects()
    {
		$this->controllers->get('/', function (Application $app) {
			return $app->redirect('home');
        })->bind('ngap');
    }

    /* Binds the login and logout functions */
	private function adminLogin() {

		// Logs the user out via the AdminServiceProvider (ngap.admin)
		$this->controllers->get('/logout', function (Application $app) {
			$app['ngap.admin']->logout();
			return $app->redirect($app['url_generator']->generate('login'));
        });

		// Checks if the user is logged out. If he is, show him login, else forward to ngap
        $this->controllers->get('/login', function (Application $app) {
        	if ($app['ngap.admin']->checkLogin())
        		return $app->redirect($app['url_generator']->generate('ngap'));

			return $app['twig']->render('ngap/login', array('error' => ''));
        })->bind('login');

        // Logic behind the login. Delegates actual login function to AdminServiceProvider
        $this->controllers->post('/login', function (Application $app) {
        	if ($app['ngap.admin']->login())
        		return $app->redirect($app['url_generator']->generate('ngap', array(), true));

        	return $app['twig']->render('ngap/login', 
        		array('error' => 'Invalid', 
        			'username' => $app['request']->get('username'))
        		);
        });
    }

    /* Binds the admin pages function */
    private function adminPages()
    {
        $this->controllers->get('home', function (Application $app) {
			return $app['twig']->render('ngap/skeleton', array('content' => $app['twig']->render('ngap/home')));
        })->before($this->checkLogin)->before($this->makeNavigation);

        $this->controllers->get('pages/{page}', function (Application $app, $page) {
            if ($data = $app['db']->executeQuery("SELECT * FROM pages_content WHERE name = ?", array($page))->fetch())
                return $app['twig']->render('ngap/page_edit', array('data' => $data, 'save' => $app['request']->query->has("success")));

            return $app->abort(404, "Page $page does not exist.");

        })->before($this->checkLogin)->before($this->makeNavigation);

        $this->controllers->post('pages/{page}', function (Application $app, $page) {
            if ($data = $app['db']->executeQuery("SELECT * FROM pages_content WHERE name = ?", array($page))->fetch()){
                //The page exists, lets update!
                $app['db']->executeUpdate("UPDATE pages_content SET name = ?, title = ?, content = ?, lastedit_who = ?, lastedit_when = NOW() WHERE name = ?", array(
                    $app['request']->get('page_url'),
                    $app['request']->get('page_title'),
                    $app['request']->get('page_content'),
                    $app['ngap.admin']->username,
                    $data['name']
                    ));

                return $app->redirect($app['url_generator']->generate('ngap', array(), true) . 'pages/' . $app['request']->get('page_url') . '?success');
            }
            return $app->abort(404, "Page $page does not exist.");
        })->before($this->checkLogin);
    }
}









