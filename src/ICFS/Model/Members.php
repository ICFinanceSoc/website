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

    function createuser($username, $mobile, $regmethod)
    {
            //These guys are here if we are running locally and want to do member ops which integrate with LDAP.
            if($this->app['debug'] && !function_exists('ldap_get_names')) 
            {
                function ldap_get_names($user)
                {
                    return array('Dario', 'is sexy');
                }
            }

            if($this->app['debug'] && !function_exists('ldap_get_mail')) 
            {
                function ldap_get_mail($user)
                {
                    return 'darioissexy@hotmail.com';
                }
            }

            if($this->app['debug'] && !function_exists('ldap_get_info')) 
            {
                function ldap_get_info($user)
                {
                    return array("Exact Course Title",
                                    "Undergraduate",
                                    "Department",
                                    "Faculty",
                                    "Imperial College"
                                    );
                }
            }
        $names = ldap_get_names($username);
        if ($names)
        {
            if($app['db']->executeQuery(("SELECT * FROM members WHERE username = ?"), array($username))==0){
                $email = ldap_get_mail($username);
                $info = ldap_get_info($username);
                $time = time();
                mysql_query("INSERT INTO 2011_Members (Username, Mobile, Forename, Surname, Department, Email, Reg_time, Reg_method)
                VALUES('$username', '$mobile', '$names[0]', '$names[1]', '$info[2]', '$email', NOW(), '$regmethod')");
                return array(
                    "status" => true,
                    "msg" => "Thank you, $names[0]! You are now on the Finance Society mailing list.",
                    "already_mem" => false,
                    );
            }
            else{
                return array(
                    "status" => false,
                    "msg" => "You appear be a member registered with us already.",
            "already_mem" => true,
            "first_name" => $names[0],
                );
            }
        }
        else{
            return array(
                "status" => false,
                "msg" => "Sorry, that username does not exist.",
                "first_name" => $names[0],
            "already_mem" => false,
        );
        }
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

    public function returnMembers($depts = NULL)
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

            $members = $this->app['db']->executeQuery($sql, $depts)->fetchAll();
        }
        else
        {
            //If we want to get all society members back
            $members = $this->app['db']->executeQuery("SELECT * from `members`")->fetchAll();
        }

        foreach($members as &$member)
        {
            $member['fullName'] = $member['fname'].' '.$member['lname'];
        }

        return $members;
    }

    public function deleteMember($memid, $deletemethod)
    {
        $member = $this->app['db']->executeQuery("SELECT * FROM members WHERE uname = ?", array($memid))->fetchAll();
        if($member)
        {
            $member[0]['deletemethod'] = $deletemethod;
            $member[0]['deletetime'] = date('Y-m-d H:i:s');
            $this->app['db']->insert('deletedmembers', $member[0]);
            $this->app['db']->delete('members', array('uname' => $memid));
            $member[0]['fullName'] = $member[0]['fname'].' '.$member[0]['lname'];
            return $member[0]; //We only return this if we have successfully deleted someone.
        }
        else
        {
            return false; //Here if they are not registered as a member
        }
    }
}