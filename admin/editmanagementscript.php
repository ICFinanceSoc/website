<?php
require_once("header.php");
$ID = $_POST['ID'];
mysql_select_db($database_sql, $sql);
$query_Recordset1 = "SELECT * FROM 2012_management WHERE ID = '$ID'";
$Recordset1 = mysql_query($query_Recordset1, $sql) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$name = urlencode($_POST['name']);
$degree = urlencode($_POST['degree']);
$position = urlencode($_POST['position']);
$blurb = urlencode($_POST['blurb']);
$base_img_dir = "../managementpictures/";
// connect with database
mysql_select_db($database_sql, $sql);
// generate unique id for use in filename
$uniq = uniqid("");
// new file name
$filename = $base_img_dir.$uniq;

if($_FILES['image']['size'] > 0) {
	unlink('../managementpictures/'.$row_Recordset1['image']);
// move uploaded file to destination
move_uploaded_file($_FILES["image"]["tmp_name"], $filename);

include('SimpleImage.php');
   $image = new SimpleImage();
   $image->load($filename);
   $image->resizeToWidth(250);
   $image->save($filename);
   
   $fileinput = $uniq;
   
} else {
	$fileinput = $row_Recordset1['image'];
}


// insert image into db
mysql_query("UPDATE management SET `name` = '$name', `position` = '$position', `degree` = '$degree', `blurb` = '$blurb', `image` = '$fileinput' WHERE `ID` = '$ID'");
  
  // rever back to upload page
 print "<meta http-equiv=\"refresh\" content=\"0;URL=management.php?message=Management updated\">";

mysql_close($sql);
?>