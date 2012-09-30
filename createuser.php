<?php
/**
 * Created by JetBrains PhpStorm.
 * User: txsl
 * Date: 30/09/2012
 * Time: 21:55
 * To change this template use File | Settings | File Templates.
 */

require_once('/usr/local/share/union-php/_auto_pre.php');

function createuser($username, $mobile, $interests){
    $names = ldap_get_names($username);
    if ($names){
        if(mysql_num_rows(mysql_query("SELECT * FROM 2011_Members WHERE Username = '$username'"))==0){
            $email = ldap_get_email($username);
            $info = ldap_get_info($username);
            mysql_query("INSERT INTO 2011_Members (Username, Mobile, Interests, Forename, Surname, Department, Email)
            VALUES('$username', '$mobile', '$interests', '$names[0]', '$names[1]', '$info[2]', '$email')");
            return [
                "status" => true,
                "msg" => "Thank you, $names[0]! You are now on the Finance Society mailing list.",
            ];
        }
        else{
            return [
                "status" => false,
                "msg" => "You appear be a member registered with us already.",
            ];
        }
    }
    else{
        return [
            "status" => false,
            "msg" => "Sorry, that username does not exist.",
        ];
    }
}