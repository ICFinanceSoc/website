<?php
require_once("header.php");

$ID = $_POST['ID'];
mysql_select_db($database_sql,$sql);
mysql_query("DELETE FROM events WHERE ID = '$ID'");
mysql_query("DELETE FROM register WHERE event = '$ID'");
mysql_query("DELETE FROM sentreminders WHERE event = '$ID'");
mysql_close($sql);
print "<meta http-equiv=\"refresh\" content=\"0;URL=editevents.php?message=Event removed\">";
?>