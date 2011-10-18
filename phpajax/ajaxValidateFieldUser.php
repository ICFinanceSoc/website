<?php

/* RECEIVE VALUE */
$validateValue=$_GET['fieldValue'];
$validateId=$_GET['fieldId'];


$validateError= "This is not a valid user name";
$validateSuccess= "Helllo!";



	/* RETURN VALUE */
	$arrayToJs = array();
	$arrayToJs[0] = $validateId;

$name = ldap_get_name($validateValue);
if($name ==""){		// validate??
	$arrayToJs[1] = false;			// RETURN FALSE
	echo json_encode($arrayToJs);			// RETURN ARRAY WITH error
}else{
			$arrayToJs[1] = true;
			$arrayToJs[1] = "Hello, " . $name . "!";
			echo json_encode($arrayToJs);		// RETURN ARRAY WITH ERROR

	
}

?>
