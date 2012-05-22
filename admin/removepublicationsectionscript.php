<?php require_once('header.php'); 

$ID = $_POST['ID'];
mysql_select_db($database_sql,$sql);
mysql_query("DELETE FROM publication_sections WHERE ID = '$ID'");
mysql_query("DELETE FROM publications WHERE section = '$ID'");
mysql_close($sql);
print "<meta http-equiv=\"refresh\" content=\"0;URL=publications.php?message=Publication section removed\">";
?>