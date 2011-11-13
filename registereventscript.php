<?php require_once('header.php');
if(isset($_SESSION['username'])) {
	$emailaddress = $_SESSION['username'];
	$ID = $_GET['ID'];
} else {

}


mysql_select_db($database_sql, $sql);
$query_Recordset1 = "SELECT * FROM 2011_Attendance WHERE Username = '$emailaddress' AND Event_ID ='$ID'";
$Recordset1 = mysql_query($query_Recordset1, $sql) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$queryOpen= mysql_query("SELECT * FROM events WHERE ID ='$ID'");
$queryOpen = mysql_result($queryOpen,0,"Open");

$errors = array();


if($totalRows_Recordset1 != 0) {
		$errors[] = 'You\'re already registered to go to this event.';
}


if($queryOpen != 'on') {
		$errors[] = 'Registration to this event is disabled.';
}

if(!isset($_SESSION['username'])) {
	$errors[] = 'You need to be logged in to register for an event.';
}


if(empty($errors)) {
	mysql_select_db($database_sql, $sql);
mysql_query("INSERT INTO 2011_Attendance (`Event_ID`,`Username`)
  VALUES('$ID','$emailaddress')");

// rever back to upload page
if($revert == '') {
	$revert = '/index.php';
} else {
	$revert = urldecode($revert);
}
 ?>
 <script src="http://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript">
$(document).ready(function(){
parent.window.location='eventinformation.php?ID=<?php echo $ID; ?>&message=Thanks for registering to this event'
});
</script>
 <?php
 
	
} else {
	$errors1 = serialize($errors);
	$errorsoutput = urlencode($errors1);
	$_SESSION['eventerrors'] = $errorsoutput;
	print "<meta http-equiv=\"refresh\" content=\"0;URL=eventinformation.php?ID=$ID&message=There were errors in your submission\">";
}



mysql_free_result($Recordset1);
?>
