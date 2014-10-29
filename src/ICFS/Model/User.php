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
        $app["twig"]->addGlobal('user', $app['icfs.user']);
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

    public function checkCredentials($user, $pass)
    {
        if ($this->app['debug'] && !function_exists('ICFS\Model\pam_auth')) 
        {
            function pam_auth($user, $pass) {
                if (($user == 'dm1911' && $pass == "sexy") || ($user == 'txl11' && $pass == "sexy"))
                    return true;
                return false;
            }
        }
        return pam_auth($user, $pass);
    }

    public function getLdapName($username)
    {
        if ($this->app['debug'] && !function_exists('ldap_get_names')) 
        {
            function ldap_get_names($username) {
                return array("First $username", "Last");
            }
        }
        return ldap_get_names($username);
    }

    public function getLdapDetails($username) {
        if ($this->app['debug'] && !function_exists('ldap_get_info')) 
        {
            function ldap_get_info($username) {
                return array(2=>"EEE");
            }
        }
        return ldap_get_info($username);
    }

    public function login() 
    {
        if (!$this->checkCredentials($this->app['request']->get('username'), $this->app['request']->get('password')))
            $error = "Invalid User/Password Combination";
        elseif (!($user = $this->app['db']->executeQuery("SELECT * FROM members WHERE uname = ?", array($this->app['request']->get('username')))->fetch()))
            $error = "Unregistered user - IP Logged";

        if (!isset($error)) 
        {
            if ($this->app['request']->get('remember') == "on") {

                $hash = hash("sha256", time() . rand() . $this->app['request']->get('username'));
                $this->app['db']->update('members', array(
                    'loginhash' => $hash), array(
                    'uname' => $this->app['request']->get('username')));

                $this->app->after(function (\Symfony\Component\HttpFoundation\Request $request, \Symfony\Component\HttpFoundation\Response $response) use ($hash) {
                    $dt = new \DateTime();
                    $dt->modify("+1 month");

                    $c1 = new \Symfony\Component\HttpFoundation\Cookie("icfs_hash", $hash, $dt);
                    $c2 = new \Symfony\Component\HttpFoundation\Cookie("icfs_user", $request->get('username'), $dt);

                    $response->headers->setCookie($c1);
                    $response->headers->setCookie($c2);
                });

                $this->app['session']->set('icfs_hash', $hash);
            }
            $this->app['session']->set('icfs_user', $this->app['request']->get('username'));
            $this->fillUserClass($user);
            return true;
        }

        return $error;
    }

    public function forceLogin($username) {
        if ( $user = $this->app['db']->executeQuery("SELECT * FROM members WHERE uname = ?", array($username))->fetch() ) {
            $this->app['session']->set('icfs_user', $username);
            $this->fillUserClass($user);
            return true;
        }
        return false;
    }

    private function fillUserClass($user) //$user is an SQL query result (->fetch() ed)
    {
        if ($user) {
            $this->auth = true;
            $this->username = $user['uname'];
            $this->newsletter = $user['newsletter'];
            $this->name = array(
                'first' => $user['fname'],
                'last' => $user['lname'], 
                'full' => ($user['fname'] . " " . $user['lname']));
            $this->admin = $user['admin'];

            return true;
        }
        return false;
    }

    public function logout() {
        $this->app['session']->clear();
        $this->app->after(function (\Symfony\Component\HttpFoundation\Request $request, \Symfony\Component\HttpFoundation\Response $response) {
            $response->headers->clearCookie('icfs_hash');
            $response->headers->clearCookie('icfs_user');
        });

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
        if ($this->app['session']->has('icfs_user')) {
            if ($this->fillUserClass($this->app['db']->executeQuery('SELECT * FROM members WHERE uname = ?', array($this->app['session']->get('icfs_user')))->fetch()))
            {
                if ($this->app['session']->get('icfs_admin') === true) //We've logged ourselves in...
                    if ($this->admin > 0)
                        $this->adminauth = true;
                    else
                        $this->app['session']->remove('icfs_admin');
                return true;
            }
        } elseif (isset($_COOKIE["icfs_hash"])) {
            if (!$this->fillUserClass($this->app['db']->executeQuery('SELECT * FROM members WHERE uname = ? AND loginhash = ?', array($_COOKIE['icfs_user'], $_COOKIE['icfs_hash']))->fetch())) {
                $this->logout();
            }
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

    public function newUser($username, $method, $newsletter)
    {

        if ($user = $this->app['db']->executeQuery("SELECT * FROM members WHERE uname = ?", array($username))->fetch()) {
            $error = "Username already exists";
        } else {
            $datetime = new \DateTime("now");
            $names = $this->getLdapName($username);
            $info = $this->getLdapDetails($username);

            $this->app['db']->insert('members', array(
                'uname' => strtolower($username),
                'mobile' => "",
                'dept' => $info[2],
                'fname' => $names[0],
                'lname' => $names[1],
                'email' => $username . "@imperial.ac.uk",
                'regdate' => $datetime->format('Y-m-d H:i:s'),
                'regmethod' => $method,
                'admin' => "0",
                'newsletter' => ($newsletter) ? "1" : "0"
            ));

            return true;
        }
        return $error;
    }

    public function updateNewsletter($newsletter){
        $this->app['db']->update('members', array(
                'newsletter' => ($newsletter) ? "1" : "0"
            ), array(
                'uname' => $this->username,
            ));
    }
}


