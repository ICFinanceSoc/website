<?php
$title = urlencode($_POST['title']);
$section = $_POST['section'];
$fileName = $_FILES['file']['name'];
$tmpName = $_FILES['file']['tmp_name'];
$fileSize = $_FILES['file']['size'];
$fileType = $_FILES['file']['type'];

$fp      = fopen($tmpName, 'r');
$content = fread($fp, filesize($tmpName));
$content = addslashes($content);
fclose($fp);

if(!get_magic_quotes_gpc())
{
    $fileName = addslashes($fileName);
}

require_once('header.php');

mysql_select_db($database_sql,$sql);
mysql_query("INSERT INTO publications VALUES('','$section','$title','$fileName','$fileType','$fileSize','$content')");
mysql_close($sql);
print "<meta http-equiv=\"refresh\" content=\"0;URL=publications.php?message=Publication added\">";
?>