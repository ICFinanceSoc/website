<?php
/**
 * Created by JetBrains PhpStorm.
 * User: txsl
 * Date: 02/01/2013
 * Time: 17:21
 */

namespace ICFS\Model;

use Silex\Application;
use Silex\ServiceProviderInterface;

class Members implements ServiceProviderInterface
{
    public function register(Application $app)
    {
        $app['icfs.members'] = $app->share(function ($app) {
            return new ICFSMembers($app);
        });
    }

    public function boot(Application $app)
    {
        //$app['icfs.members']->authenticate($app); //check if the user is authenticated
    }
}

class ICFSMembers
{
    function __construct (Application $app)
    {
        $this->app = $app;
    }

    public function return_depts()
    {
        return $this->app['db']->executeQuery("SELECT DISTINCT `dept` from `members`")->fetchAll();
    }
}