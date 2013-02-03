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
    }
}

class ICFSMembers
{
    function __construct (Application $app)
    {
        $this->app = $app;
    }

    public function return_depts() //Lists all departments.
    {
        $results = $this->app['db']->executeQuery("SELECT DISTINCT `dept` from `members`")->fetchAll();
        $return = array();
        foreach ($results as $key)
        {
            $return[]=$key['dept'];
        }
        return $return;
    }

    public function return_members($depts = NULL)
    {
        if($depts)
        {
            //Build up query depending on how many depts we want to return
            $sql = "SELECT * FROM `members` WHERE `dept` = ";
            $count = sizeof($depts);
            for ($i = 1; $i < $count; $i++) 
            {
                $sql .= "? OR `dept` = ";
            }
            $sql .= "?";

            return $this->app['db']->executeQuery($sql, $depts)->fetchAll();
        }
        else
        {
            //If we want to get all society members back
            return $this->app['db']->executeQuery("SELECT * from `members`")->fetchAll();
        }
    }
}