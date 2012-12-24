<?php
/* 
 * This is the user handler. Extends to also use NGAP!
 * Login, Logout and logging is handled by this
*/

namespace ICFS\Model;

use Silex\Application;
use Silex\ServiceProviderInterface;

class User implements ServiceProviderInterface
{
    public function register(Application $app)
    {
        $app['icfs.user'] = $app->share(function ($app) {
            return new ICFSUser($app);
        });
    }

    public function boot(Application $app)
    {
        $app['icfs.user']->authenticate($app); //check if the user is authenticated
    }
}

class ICFSUser
{
    public $username;

    public $auth;
    public $adminauth;

    function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function adminLogin() {
        if (($return = $this->login()) === true)
            if ($this->admin > 0)
                 $this->app['session']->set('icfs_admin', true); //Give admin credentials
             else
                $return = "No admin permissions for you!";
        return $return;
    }
    public function login() { //return true if went well, otherwise return the error message!
        if ($this->app['debug'] && !function_exists('pam_auth')) {
            function pam_auth($user, $pass) {
                if (($user == 'dm1911' && $pass == "sexy") || ($user == 'txl11' && $pass == "sexy"))
                    return true;
                return false;
            }
        }

        if (!pam_auth($this->app['request']->get('username'), $this->app['request']->get('password')))
            $error = "Invalid User/Password Combination";
        elseif (!($user = $this->app['db']->executeQuery("SELECT * FROM members WHERE uname = ?", array($this->app['request']->get('username')))->fetch()))
            $error = "Unregistered user - IP Logged";

        if (!isset($error)) {
            $this->app['session']->set('icfs_user', $this->app['request']->get('username'));
            $this->fillUserClass($user);
            return true;
        }

        return $error;
    }
    private function fillUserClass($user) //$user is an SQL query result (->fetch() ed)
    {
        if ($user) {
            $this->auth = true;
            $this->username = $user['uname'];
            $this->name = array(
                'first' => $user['firstname'],
                'last' => $user['lastname'], 
                'full' => ($user['firstname'] . " " . $user['lastname']));
            $this->admin = $user['admin'];

            return true;
        }
        return false;
    }

    public function logout() {
        $this->app['session']->clear();
        return true;
    }

    public function checkAdminLogin() {
        return ($this->checkLogin() && $this->adminauth);
    }

    public function checkLogin() {
        return ($this->auth);
    }

    public function authenticate() //this is run at the start of every page. Sets the adminauth, and user details, fetched from SQL to make sure we're up to date.
    {
        if ($this->app['session']->has('icfs_user'))
            if ($this->fillUserClass($this->app['db']->executeQuery('SELECT * FROM members WHERE uname = ?', array($this->app['session']->get('icfs_user')))->fetch())) {
                if ($this->app['session']->get('icfs_admin') === true) //We've logged ourselves in...
                    if ($this->admin > 0)
                        $this->adminauth = true;
                    else
                        $this->app['session']->remove('icfs_admin');
                return true;
            }
        return false;
    }


    public function adminAllowed($location) //Returns a true/false depending on the bit we are requesting. 0 = global true, 1 = bit 0, etc
    {
        if ($location == 0)
            return true;
        return (bool)($this->admin & (0x1 << ($location - 1)));
    }
}


