<?php require_once('header.php');
$ID = $_POST['ID'];
mysql_select_db($database_sql, $sql);
$query_Recordset1 = "SELECT * FROM sponsors WHERE ID = $ID";
$Recordset1 = mysql_query($query_Recordset1, $sql) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
 // define the base image dir 
$base_img_dir = "../sponsorlogos/";

if($_FILES["logo"]["size"] == 0) {
	$uniq = $row_Recordset1['logo'];
} else {
	unlink("../sponsorlogos/".$row_Recordset1['logo']);
	$uniq = uniqid("");
}

// define location of image conversion programs
$img_conv_dir = "./bin/";

// define database table containing image info

$name = urlencode($_POST['name']);
$type = $_POST['type'];
$link = urlencode($_POST['link']);
$profile = urlencode($_POST['profile']);


// generate unique id for use in filename



// new file name
$filename = $base_img_dir.$uniq;

// move uploaded file to destination
if($_FILES["logo"]["size"] > 0) {
move_uploaded_file($_FILES["logo"]["tmp_name"], $filename);
}

if($_FILES["logo"]["size"] > 0) {
include('SimpleImage.php');
$thumbname = $filename."thumb";
   $image = new SimpleImage();
   $image->load($filename);
   $image->resizeToWidth(460);
   $image->save($filename);
   $image = new SimpleImage();
   $image->load($filename);
   $image->resizeToWidth(200);
   $image->save($thumbname);
}

// insert image into db
mysql_query("UPDATE sponsors SET `name` = '$name', `type` = '$type', `profile` = '$profile', `logo` = '$uniq', `link` = '$link' WHERE `ID` = '$ID'");

// rever back to upload page
 print "<meta http-equiv=\"refresh\" content=\"0;URL=editsponsors.php?message=Sponsor updated\">";
 
 mysql_close($sql);
   ?>