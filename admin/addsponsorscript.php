<?php require_once('header.php');
 // define the base image dir 
$base_img_dir = "../sponsorlogos/";
$base_profile_dir = "../sponsorprofiles/";

// define location of image conversion programs
$img_conv_dir = "./bin/";

// define database table containing image info

$name = urlencode($_POST['name']);
$type = $_POST['type'];
$link = urlencode($_POST['link']);
$profile = urlencode($_POST['profile']);

// connect with database
mysql_select_db($database_sql, $sql);
// generate unique id for use in filename
$uniq = uniqid("");
$uniq2 = uniqid("").".pdf";

// new file name
$filename = $base_img_dir.$uniq;

// move uploaded file to destination
move_uploaded_file($_FILES["logo"]["tmp_name"], $filename);

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

// insert image into db
mysql_query("INSERT INTO sponsors (`name`,`type`,`profile`,`logo`,`link`)
  VALUES('$name','$type','$profile','$uniq','$link')");

// rever back to upload page
 print "<meta http-equiv=\"refresh\" content=\"0;URL=editsponsors.php?message=Sponsor added\">";
   ?>