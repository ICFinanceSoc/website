<?php require_once('header.php');
$ID = $_POST['ID'];

// connect with database
mysql_select_db($database_sql, $sql);

	unlink('../managementpictures/'.$row_Recordset1['image']);


// insert image into db
mysql_query("DELETE FROM management WHERE `ID` = '$ID'");
  
  // rever back to upload page
 print "<meta http-equiv=\"refresh\" content=\"0;URL=management.php?message=Management removed\">";

mysql_close($sql);
?>