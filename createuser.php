<?php
/**
 * Created by JetBrains PhpStorm.
 * User: txsl
 * Date: 30/09/2012
 * Time: 21:55
 * To change this template use File | Settings | File Templates.
 */

require_once('/usr/local/share/union-php/_auto_pre.php');

function createuser($username, $mobile, $interests, $regmethod){
    $names = ldap_get_names($username);
    if ($names){
        if(mysql_num_rows(mysql_query("SELECT * FROM 2011_Members WHERE Username = '$username'"))==0){
            $email = ldap_get_mail($username);
            $info = ldap_get_info($username);
            $time = time();
            mysql_query("INSERT INTO 2011_Members (Username, Mobile, Interests, Forename, Surname, Department, Email, Reg_time, Reg_method)
            VALUES('$username', '$mobile', '$interests', '$names[0]', '$names[1]', '$info[2]', '$email', NOW(), '$regmethod')");
            return array(
                "status" => true,
                "msg" => "Thank you, $names[0]! You are now on the Finance Society mailing list.",
            );
        }
        else{
            return array(
                "status" => false,
                "msg" => "You appear be a member registered with us already.",
            );
        }
    }
    else{
        return array(
            "status" => false,
            "msg" => "Sorry, that username does not exist.",
        );
    }
}

function createuser_auth($username, $password, $mobile, $interests, $regmethod){
    if (pam_auth($username, $password)){
        return createuser($username, $mobile, $interests, $regmethod);
    }
    else{
        return array(
            "status" => false,
            "msg" => "Incorrect username and password combination",
        );
    }
}

function freshers_createuser($username, $mobile, $interests){
    $regmethod = 'FF2012';
    $result = createuser($username, $mobile, $interests, $regmethod);
    if ($result['msg']){
        mysql_query("INSERT INTO 2012_Freshers (Username, Mobile, Interests, Forename, Surname, Department, Email, Reg_time, Reg_method)
            VALUES('$username', '$mobile', '$interests', '$names[0]', '$names[1]', '$info[2]', '$email', NOW(), '$regmethod')");
    }
    return $result;
}