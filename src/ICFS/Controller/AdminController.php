<?php

namespace ICFS\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Silex\ControllerProviderInterface;
use ICFS\AdminServiceProvider;

class AdminController implements ControllerProviderInterface
{
    public function connect(Application $app)
    {
        $this->nav = new \ICFS\Model\AdminNavigation($app);

        // creates a new controller based on the default route
        $this->controllers = $app['controllers_factory'];
        
        $this->adminLogin(); //Binds the login. These need to be done first, to avoid any accidental interferance!
        $this->adminPages(); //Pages are next..

        $this->redirects(); //Redirects are last!

        return $this->controllers; //Let's send our controller back to home.
    }

    private function allowed($permission = 0) //middleware to check admin login and permissions. Permission = 0 means all admins are allowed.
    {
        return function(Request $req, Application $app) use ($permission)
        {
            if ($app['icfs.user']->checkAdminLogin() !== true)
                return $app->redirect($app['url_generator']->generate('login'));
            elseif (!$app['icfs.user']->adminAllowed($permission))
                return new Response($app['twig']->render('ngap/no-permission'));
        };
    }

    private function redirects() //make life easier to manage!
    {
		$this->controllers->get('/', function (Application $app) {
			return $app->redirect('home');
        })->bind('ngap');
    }

    /* Binds the login and logout functions */
	private function adminLogin() {

		// Logs the user out via the AdminServiceProvider (ngap.admin)
		$this->controllers->get('/user/logout', function (Application $app) {
			$app['icfs.user']->logout();
			return $app->redirect($app['url_generator']->generate('login'));
        });

		// Checks if the user is logged out. If he is, show him login, else forward to ngap
        $this->controllers->get('/login', function (Application $app) {
        	if ($app['icfs.user']->checkAdminLogin())
        		return $app->redirect($app['url_generator']->generate('ngap'));

			return $app['twig']->render('ngap/login', array('error' => ''));
        })->bind('login');

        // Logic behind the login. Delegates actual login function to AdminServiceProvider
        $this->controllers->post('/login', function (Application $app) {
        	if (($error = $app['icfs.user']->adminLogin()) === true)
        		return $app->redirect($app['url_generator']->generate('ngap', array(), true));

            return $app['twig']->render('ngap/login', 
        		array('error' => $error, 
        			'username' => $app['request']->get('username'))
        		);
        });
    }

    /* Binds the admin pages function */
    private function adminPages()
    {
        $this->controllers->get('home', function (Application $app) {
			return $app['twig']->render('ngap/skeleton', array('content' => $app['twig']->render('ngap/home')));
        })->before($this->allowed())->before($this->nav->fetch()); //->before($this->nav->make())



        $this->controllers->get('pages/add', function (Application $app) {
            return $app['twig']->render('ngap/page_edit', array('title' => "Add New Page"));
        })->before($this->allowed($this->nav->permission('pages')))->before($this->nav->fetch());



        $this->controllers->get('pages/{page}', function (Application $app, $page) {
            if ($app['request']->query->has("delete")){
                $data = $app['db']->executeQuery("DELETE FROM pages_content WHERE name = ?", array($page));
                return $app->redirect($app['url_generator']->generate('ngap'));
            }
            if ($data = $app['db']->executeQuery("SELECT * FROM pages_content WHERE name = ?", array($page))->fetch())
                return $app['twig']->render('ngap/page_edit', array('data' => $data, 'save' => $app['request']->query->has("success")));

            return $app->abort(404, "Page $page does not exist.");

        })->before($this->allowed())->before($this->nav->fetch());



        $this->controllers->post('pages/{page}', function (Application $app, $page) {
            if ($page == "add" || $data = $app['db']->executeQuery("SELECT * FROM pages_content WHERE name = ?", array($page))->fetch()) {
                //lets clean our inputs up
                //$app['request']->set('page_url', 'dario');


                //check for validity: (Duplicates and reserved names)
                if (strlen($app['request']->get('page_title')) < 2 || strlen($app['request']->get('page_url')) < 2)
                    $error = "Please make sure the title and url are long enough (2 characters)";
                elseif (($app['request']->get('page_url') == 'add') || ($app['request']->get('page_url') != $page && $app['db']->executeQuery("SELECT * FROM pages_content WHERE name = ?", array($app['request']->get('page_url')))->fetch()) )
                    $error = "Wowzers... That didn't go well. Make sure you're page URL is unique and is not 'add'!";

                if ($error) {
                    //Let's inject the user stuff into our $data.
                    $data['name'] = $app['request']->get('page_url');
                    $data['title'] = $app['request']->get('page_title');
                    $data['content'] = $app['request']->get('page_content');
                    return $app['twig']->render('ngap/page_edit', array('data' => $data, 'error' => @$error));;
                }

                //if this a new page or are we updating?
                if ($page == 'add')
                    $app['db']->executeUpdate("INSERT INTO pages_content VALUES (?, ?, ?, null, NOW())", array(
                        $app['request']->get('page_url'),
                        $app['request']->get('page_title'),
                        $app['request']->get('page_content')
                    ));
                else  //The page exists, lets update!
                    $app['db']->executeUpdate("UPDATE pages_content SET name = ?, title = ?, content = ?, lastedit_who = ?, lastedit_when = NOW() WHERE name = ?", array(
                        $app['request']->get('page_url'),
                        $app['request']->get('page_title'),
                        $app['request']->get('page_content'),
                        $app['icfs.user']->username,
                        $data['name']
                    ));

                return $app->redirect($app['url_generator']->generate('ngap', array(), true) . 'pages/' . $app['request']->get('page_url') . '?success');
            }
            return $app->abort(404, "Page $page does not exist.");
        })->before($this->allowed())->before($this->nav->fetch());
    }
}









