<?php
require_once("header.php");
$ID = $_POST['ID'];
$title = urlencode($_POST['title']);
$date = str_replace("/","-",$_POST['date']);
$start = $_POST['starth'].":".$_POST['startm'].":00";
$end = $_POST['endh'].":".$_POST['endm'].":00";;
$location = urlencode($_POST['location']);
$organisers = urlencode($_POST['organisers']);
$information = urlencode($_POST['information']);
$Open = urlencode($_POST['Open']);
$Updte = urlencode($_POST['Updte']);

$Interests = ',';
$Interests1 = $_POST['Interests'];
if ($Interests1){
foreach ($Interests1 as $I){
$Interests = $Interests.$I.',';
}
}

mysql_select_db($database_sql, $sql);
$query_events = "SELECT * FROM 2011_Attendance WHERE `Event_ID` = $ID";
$events = mysql_query($query_events, $sql) or die(mysql_error());
$row_events = mysql_fetch_assoc($events);
$totalRows_events = mysql_num_rows($events);
// insert image into db
mysql_query("UPDATE events SET `title`='$title',`date`='$date',`start`='$start',`end`='$end',`location`='$location',`organisers`='$organisers',`information`='$information',`Interests`='$Interests',`Open`='$Open' WHERE ID = '$ID'");

if($totalRows_events > 0 && $Updte == 'on') {
do {
$titledisplay = $_POST['title'];
$displaydate = $date;
$info = $_POST['information'];
$to = $row_events['Username'] . "@imperial.ac.uk";
 $subject = "ICFS - Event updated";
 $body = "
 This an automated email informing you that an event you registered to has been altered.
 
$titledisplay
 
Date: $displaydate  $start - $end
 
For full details about the event please go to https://www.union.ic.ac.uk/scc/finance/eventinformation.php?ID=$ID
 
We hope to see you there.
 
 ICFS
 
 www.financesociety.co.uk
 Imperial College Finance Society
 
 
 To unregister from this event, please log in to your account and navigate to your Attendance page.
 ";

mail($to, $subject, $body, "From: no_reply@financesociety.co.uk");

} while ($row_events = mysql_fetch_assoc($events));
}


// rever back to upload page
 print "<meta http-equiv=\"refresh\" content=\"0;URL=editevents.php?message=Event updated\">";
 mysql_close($sql);
?>