<?php require_once('header.php');
$title = urlencode($_POST['title']);
$intro = urlencode($_POST['intro']);
$ID = $_POST['ID'];
mysql_select_db($database_sql,$sql);
mysql_query("UPDATE `publication_sections` SET `title`='$title', `intro`='$intro' WHERE ID = '$ID'");
mysql_close($sql);
print "<meta http-equiv=\"refresh\" content=\"0;URL=publications.php?message=Publication section updated\">";
?>