<?php

if(!function_exists('pam_auth'))
{
	function pam_auth($user, $pass)
	{
	 if($pass=='sexy')
	 	return true;
	 else
	 	return false;
	}
}

            if(!function_exists('ldap_get_names')) 
            {
                function ldap_get_names($user)
                {
                    return array('Dario', 'is sexy');
                }
            }

            if(!function_exists('ldap_get_name')) 
            {
                function ldap_get_name($user)
                {
                    return 'Dario is sexy';
                }
            }

            if(!function_exists('ldap_get_mail')) 
            {
                function ldap_get_mail($user)
                {
                    return 'darioissexy@hotmail.com';
                }
            }

require __DIR__.'/../db.php';

function check($user, $pass)
{
	if(pam_auth($user, $pass))
	{
		$res = mysql_query("SELECT COUNT(*) FROM `union_members` WHERE `members` = '".mysql_real_escape_string($user)."'");
		$row = mysql_fetch_assoc($res);
		if($row['COUNT(*)'])
		{
			$res = mysql_query("SELECT COUNT(*) FROM `2011_Members` WHERE `Username` = '".mysql_real_escape_string($user)."'");
			$row = mysql_fetch_assoc($res);
			$mailing = ($row['COUNT(*)'] == 1) ? 1 : 0;
			$name = ldap_get_name($user);
			$names = ldap_get_names($user);
			$email = ldap_get_mail($user);
			$mem = mysql_query("SELECT COUNT(*) FROM `2013_agm` WHERE `user` ='".mysql_real_escape_string($user)."'");
			$memrow = mysql_fetch_assoc($mem);
			if($memrow['COUNT(*)'])
			{
				return array(false, "You have already registered at the AGM.");
			}
			//Check if new insert or not
			mysql_query("INSERT INTO `2013_agm` (user, email, name, member, time) VALUES('" . mysql_real_1escape_string($user) ."', '$email', '$name', '$mailing', NOW())");
			return array(true, "Thank you, " . $names[0] .". You have been successfully registered.");
		}
		else return array(false, "You do not appear to be an official member of the society.");
	}
	else
	{
		return array(false, 'Incorrect Username/Password.');
	}
}