<?
include_once('db.php');
$user = $_GET['user'];
$event = $_GET['event'];
$forreal = $_GET['r'];
$error = 0;

if($forreal == imperialcollegeunion){
$Lookupuser = mysql_query("SELECT * FROM 2011_Members WHERE Username='$user'");
if(mysql_numrows($Lookupuser)==0){
$error = 1; // invalid user
echo 'You are not a valid member of the Finance Society';
die();
}
$Lookupevent = mysql_query("SELECT * FROM events WHERE ID='$event' AND Open='on'");
if(mysql_numrows($Lookupevent)==0){
$error = 2; // invalid event
echo 'There was a problem with the link you clicked. It would appear that the event has already expired or didnt have a valid ID';
die();
}
$alreadyregist = mysql_query("SELECT * FROM 2011_Attendance WHERE Event_ID='$event' AND Username='$user'");
$alreadyregist = mysql_num_rows($alreadyregist);
if($alreadyregist>0){
$error = 4; // already registered
echo 'Youve already signed up to this event';
die();
}
mysql_query("INSERT INTO 2011_Attendance (Event_ID, Username) VALUES ('$event', '$user')");
header("Location:eventinformation.php?ID=" .$event ."&message=You have been successfully subscribed to this event");
}else{
header("Location:events.php"); 
 }
?>

