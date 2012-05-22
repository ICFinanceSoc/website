<?php require_once('header.php');
$ID = $_POST['ID']; 
$title = urlencode($_POST['title']);
$section = urlencode($_POST['section']);
$fileName = $_FILES['file']['name'];
$tmpName = $_FILES['file']['tmp_name'];
$fileSize = $_FILES['file']['size'];
$fileType = $_FILES['file']['type'];

if($fileSize != 0) {
$fp      = fopen($tmpName, 'r');
$content = fread($fp, filesize($tmpName));
$content = addslashes($content);
fclose($fp);

if(!get_magic_quotes_gpc())
{
    $fileName = addslashes($fileName);
}


mysql_select_db($database_sql,$sql);
mysql_query("UPDATE publications SET `section`='$section',`title`='$title',`filename`='$fileName',`filetype`='$fileType',`filesize`='$fileSize',`content`='$content' WHERE ID = '$ID'");
} else {
	mysql_select_db($database_sql,$sql);
	mysql_query("UPDATE publications SET `section`='$section',`title`='$title' WHERE ID = '$ID'");

}
mysql_close($sql);
print "<meta http-equiv=\"refresh\" content=\"0;URL=publications.php?message=Publication edited\">";
?>