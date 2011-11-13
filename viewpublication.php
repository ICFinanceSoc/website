<?php require_once('header.php'); 
if(isset($_SESSION['username'])) {
	
$colname_Recordset1 = "-1";
if (isset($_GET['ID'])) {
  $colname_Recordset1 = $_GET['ID'];
}
$ID = $_GET['ID'];
mysql_select_db($database_sql, $sql);
$query_Recordset1 = sprintf("SELECT * FROM publications WHERE ID = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $sql) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

if(isset($_GET['ID'])) 
{
// if id is set then get the file with the id from database

	$size = $row_Recordset1['filesize'];
	$type = $row_Recordset1['filetype'];
	$name = $row_Recordset1['filename'];
	$content = $row_Recordset1['content'];

    header("Content-length: $size");
    header("Content-type: $type");
    header("Content-Disposition: attachment; filename=$name");
    echo $content;

    exit;
}


mysql_free_result($Recordset1);

} else {
	$revert = urlencode("/publications");
	print "<meta http-equiv=\"refresh\" content=\"0;URL=requirelogin.php?reg=You must be logged in to view protected files&revert=$revert\">";
}
?>
