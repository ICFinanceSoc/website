<?php require_once('header.php'); ?>
<?php
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
	$minsec = gmdate("i:s");
$hour = gmdate("H");
$DST = date("I");
$hour2 = $hour + $DST;
$TIME = $hour2.":".$minsec;
$DATE = gmdate("Y-m-d");
$datetime = $DATE.' '.$TIME;
require_once("header.php");

mysql_select_db($database_sql,$sql);
mysql_query("INSERT INTO amplifytrading VALUES('','$fileName','$fileSize','$fileType','$content','$datetime')");
mysql_close($sql);
print "<meta http-equiv=\"refresh\" content=\"0;URL=amplifytrading.php?message=Publication added\">";

?>

