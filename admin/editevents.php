<?php require_once('header.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

mysql_select_db($database_sql, $sql);
$query_events = "SELECT * FROM events ORDER BY `date` DESC";
$events = mysql_query($query_events, $sql) or die(mysql_error());
$row_events = mysql_fetch_assoc($events);
$totalRows_events = mysql_num_rows($events);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="../CSS/adminstyles.css" rel="stylesheet" type="text/css" />
</head>

<body>
<h1>Events administration - <a href="addevent.php">Add event</a></h1>
<table width="878" border="0" cellspacing="5" cellpadding="5">
  <?php do { ?>
    <tr>
      <td width="448" bgcolor="#eeeeee"><?php echo urldecode($row_events['title']); ?> - <?php echo $row_events['date']; ?></td>
      <td width="27" bgcolor="#eeeeee"><a href="editeventconfirm.php?ID=<?php echo $row_events['ID']; ?>">Edit</a></td>
      <td width="78" bgcolor="#eeeeee"><a href="removeeventconfirm.php?ID=<?php echo $row_events['ID']; ?>">Remove</a></td>
      <td width="260" bgcolor="#eeeeee"><a href="viewregistered.php?ID=<?php echo $row_events['ID']; ?>" target="_blank">View all registered</a>, <a href="messageattendees.php?event=<?php echo urldecode($row_events['ID']); ?>">Email attendees</a> </td>
    </tr>
    <?php } while ($row_events = mysql_fetch_assoc($events)); ?>
</table>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($events);
?>
