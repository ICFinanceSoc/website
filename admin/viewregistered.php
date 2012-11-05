<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>VIEW ALL REGISTERED MEMBERS TO EVENT</title>
</head>

<body>
<a href="viewregisteredexcel.php?ID=<?php echo $_GET['ID']; ?>">View in excel</a>
<?php
require_once("header.php");
$ID = $_GET['ID'];
mysql_select_db($database_sql, $sql);
$query_events = "SELECT * FROM 2011_Attendance WHERE Event_ID='$ID' ORDER BY `Attendance_ID` DESC";
$events = mysql_query($query_events, $sql) or die(mysql_error());
$row_events = mysql_fetch_assoc($events);
$totalRows_events = mysql_num_rows($events);

?>
<link href="../CSS/adminstyles.css" rel="stylesheet" type="text/css">
<table width="100%" border="0" cellpadding="5" cellspacing="5">
  <tr>
    <td width="13%" bgcolor="#DDDDDD">Username</td>
    <td width="19%" bgcolor="#DDDDDD">Name</td>
    <td width="24%" bgcolor="#DDDDDD">Email</span></td>
    <td width="24%" bgcolor="#DDDDDD">Mobile</span></td>

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
    <td bgcolor="#eeeeee"><?php echo urldecode($row_users['Username']); ?></td>
    <td bgcolor="#eeeeee"><?php echo ldap_get_name(urldecode($row_users['Username'])); ?></td>
    <td bgcolor="#eeeeee"><?php echo ldap_get_mail(urldecode($row_users['Username'])); ?></td>
    <td bgcolor="#eeeeee"><?php echo urldecode($row_users['Mobile']); ?></td>
  </tr>
  <?php } ?>
  <?php }while ($row_events = mysql_fetch_assoc($events)); ?>
</table>
</body>
</html>
