<?php
require_once('header.php');
if(isset($_SESSION['username'])) {
require_once("db.php");
mysql_select_db($database_sql, $sql);
$query_Recordset1 = "SELECT * FROM amplifytrading ORDER BY `date` DESC";
$Recordset1 = mysql_query($query_Recordset1, $sql) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

	$size = $row_Recordset1['filesize'];
	$type = $row_Recordset1['filetype'];
	$name = $row_Recordset1['filename'];
	$content = $row_Recordset1['content'];


header("Content-length: $size");
header("Content-type: $type");
header("Content-Disposition: attachment; filename=$name");
echo $content;

exit;
} else {
	$revert = urlencode("amplifytrading.php");
	print "<meta http-equiv=\"refresh\" content=\"0;URL=requirelogin.php?reg=You must be logged in to view protected files&revert=$revert\">";
}


?>