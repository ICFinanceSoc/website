<?php
require_once("header.php");
$ID = $_GET['ID'];
$username = $_SESSION['username'];
	mysql_select_db($database_sql, $sql);
	// remove from db
mysql_query("DELETE FROM 2011_Attendance WHERE `Event_ID` = '$ID' AND `Username`='$username'");
mysql_close();
print "<meta http-equiv=\"refresh\" content=\"0;URL=eventinformation.php?ID=$ID\">";
?>