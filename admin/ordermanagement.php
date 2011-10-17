<?php require_once('header.php');
session_start();
$order1 = urldecode($_SESSION['morder']);
$orderarray = unserialize($order1);
$key = $_GET['key'];
$d = $_GET['d'];
if($d = 'up') {
	$temp1 = $orderarray[$key];
	$orderarray[$key] = $orderarray[$key+1];
	$orderarray[$key+1] = $temp1;
} else {
	$temp1 = $orderarray[$key];
	$orderarray[$key] = $orderarray[$key-1];
	$orderarray[$key-1] = $temp1;
}
mysql_select_db($database_sql,$sql);
foreach($orderarray as $key => $item) {
	mysql_query("UPDATE management SET `order` = '$key' WHERE ID = '$item'");
}
mysql_close($sql);
print "<meta http-equiv=\"refresh\" content=\"0;URL=management.php?message=Order altered\">";
?>