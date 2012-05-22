<?php require_once('header.php');
$title = urlencode($_POST['title']);
$intro = urlencode($_POST['intro']);
mysql_select_db($database_sql,$sql);
mysql_query("INSERT INTO publication_sections VALUES('','$title','$intro')");
mysql_close($sql);
print "<meta http-equiv=\"refresh\" content=\"0;URL=publications.php?message=Publication section added\">";
?>