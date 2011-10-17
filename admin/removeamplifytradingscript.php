<?php require_once('header.php');
$ID = $_GET['ID']; 

mysql_select_db($database_sql,$sql);
mysql_query("DELETE FROM amplifytrading WHERE ID = '$ID'");

mysql_close($sql);
print "<meta http-equiv=\"refresh\" content=\"0;URL=amplifytrading.php?message=Publication deleted\">";
?>