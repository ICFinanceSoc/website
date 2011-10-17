<?php
require_once("header.php");
$ID = $_POST['ID'];
mysql_select_db($database_sql, $sql);
$query_Recordset1 = "SELECT * FROM sponsors WHERE ID = $ID";
$Recordset1 = mysql_query($query_Recordset1, $sql) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

unlink("../sponsorlogos/".$row_Recordset1['logo']);

// connect with database
mysql_connect("localhost", "carlisl1_grant", "c@rlisl3*");
mysql_select_db("carlisl1_ICFS");
// generate unique id for use in filename

// insert image into db
mysql_query("DELETE FROM sponsors WHERE `ID` = '$ID'");

// rever back to upload page
 print "<meta http-equiv=\"refresh\" content=\"0;URL=editsponsors.php?message=Sponsor removed\">";
   ?>