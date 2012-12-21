<?php
/* 
 * This is the NGAP admin-user handler
 * Login, Logout and logging is handled by this
*/

namespace ICFS;

use Silex\Application;
use Silex\ServiceProviderInterface;

class AdminServiceProvider implements ServiceProviderInterface
{
    public function register(Application $app)
    {
        $app['ngap.admin'] = $app->share(function ($app) {
            return new Admin($app);
        });
    }

    public function boot(Application $app)
    {
        $app['ngap.admin']->authenticate($app); //check if the user is authenticated
    }
}

class Admin
{
    public $username;
    public $auth;

    function __construct(Application $app)
    {
        $this->app = $app;
    }
    
    public function login()
    {
        if (($this->app['request']->get('username') == 'dm1911' && $this->app['request']->get('password') == 'sexy') || ($this->app['request']->get('username') == 'txl11' && $this->app['request']->get('password') == 'sexy'))
        {
            $this->auth == true;
            $this->username = $this->app['request']->get('username');
            $this->app['session']->set('ngap_user', $this->app['request']->get('username'));
            return true;
        }
        return false;
    }

    public function logout()
    {
        $this->app['session']->remove('ngap_user');
        return true;
    }

    public function checkLogin()
    {
        return ($this->auth);
    }

    public function authenticate()
    {
        if ($this->app['session']->get('ngap_user') != null)
        {
            $this->auth = true;
            $this->username = $this->app['session']->get('ngap_user');
        }
    }
}


