<?php require_once('header.php'); ?><?php
$title = urlencode($_POST['title']);
$intro = urlencode($_POST['intro']);
mysql_select_db($database_sql,$sql);
mysql_query("INSERT INTO learning_sections VALUES('','$title','$intro')");
mysql_close($sql);
print "<meta http-equiv=\"refresh\" content=\"0;URL=learning.php?message=learning section added\">";
?>