<?php require_once('header.php');
$ID = $_GET['ID'];
mysql_select_db($database_sql, $sql);
$query_events = "SELECT * FROM 2011_Attendance WHERE Event_ID = '$ID'";
$events = mysql_query($query_events, $sql) or die(mysql_error());
$row_events = mysql_fetch_assoc($events);
$totalRows_events = mysql_num_rows($events);

$file="EVENT_ID_$ID.xls";
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$file");

?>

<table width="100%" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td width="13%"><strong>Username</strong></td>
    <td width="24%"><strong>Name</td>
    <td width="14%"><strong>Email</strong></td>
  </tr>
  <?php do {
  $currentemail = $row_events['Username'];
  $query_users = "SELECT * FROM 2011_Members WHERE `Username` = '$currentemail'";
$users = mysql_query($query_users, $sql) or die(mysql_error());
$row_users = mysql_fetch_assoc($users);
$totalRows_users = mysql_num_rows($users);
if($totalRows_users > 0) {
  ?>
  <tr>
    <td><?php echo urldecode($row_users['Username']); ?></td>
    <td><?php echo ldap_get_name(urldecode($row_users['Username'])); ?></td>
    <td><?php echo urldecode($row_users['Mobile']); ?></td>
  </tr>
  <?php }?>
  <?php }while ($row_events = mysql_fetch_assoc($events)); ?>
</table>
