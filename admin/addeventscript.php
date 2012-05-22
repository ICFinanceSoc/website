<?php
require_once("header.php");
$title = urlencode($_POST['title']);
$date = $_POST['date'];
$start = $_POST['starth'].":".$_POST['startm'].":00";
$end = $_POST['endh'].":".$_POST['endm'].":00";;
$location = urlencode($_POST['location']);
$organisers = urlencode($_POST['organisers']);
$information = urlencode($_POST['information']);
$spons = urlencode($_POST['sponsor']);

$Interests = ',';
$Interests1 = $_POST['Interests'];
if ($Interests1){
 foreach ($Interests1 as $I){
 $Interests = $Interests.$I.',';
 }
}
$Open = urlencode($_POST['Open']);



mysql_select_db($database_sql, $sql);

// insert image into db
mysql_query("INSERT INTO events (`title`,`date`,`start`,`end`,`location`,`organisers`,`information`, `Interests`, `Open`, `Sponsor`)
  VALUES('$title','$date','$start','$end','$location','$organisers','$information', '$Interests', '$Open', '$spons')");

// rever back to upload page
 print "<meta http-equiv=\"refresh\" content=\"0;URL=editevents.php?message=Event added\">";
 mysql_close($sql);
?>
