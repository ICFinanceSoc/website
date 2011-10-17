<?php require_once('header.php');
mysql_select_db($database_sql, $sql);
$query_Recordset1 = "SELECT * FROM management ORDER BY `order` DESC";
$Recordset1 = mysql_query($query_Recordset1, $sql) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
$maxorder1 = $row_Recordset1['order'];
$maxorder = $maxorder1+1;
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

// move uploaded file to destination
move_uploaded_file($_FILES["image"]["tmp_name"], $filename);

include('SimpleImage.php');
   $image = new SimpleImage();
   $image->load($filename);
   $image->resizeToWidth(250);
   $image->save($filename);


// insert image into db
mysql_query("INSERT INTO management (`name`,`position`,`degree`,`blurb`,`image`,`order`)
  VALUES('$name','$degree','$position','$blurb','$uniq','$maxorder')");
  
  // rever back to upload page
 print "<meta http-equiv=\"refresh\" content=\"0;URL=management.php?message=Management added\">";

?>