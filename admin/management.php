<?php require_once('header.php'); ?>
<?php
session_start();
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
$query_Recordset1 = "SELECT * FROM management ORDER BY `order` ASC";
$Recordset1 = mysql_query($query_Recordset1, $sql) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

mysql_select_db($database_sql, $sql);
$query_repeated = "SELECT * FROM management ORDER BY `order` ASC";
$repeated = mysql_query($query_repeated, $sql) or die(mysql_error());
$row_repeated = mysql_fetch_assoc($repeated);
$totalRows_repeated = mysql_num_rows($repeated);
$orderarray = array();
$count = 0;
do {
	$count++;
	$orderarray[$count] = $row_repeated['ID'];
	
} while ($row_repeated = mysql_fetch_assoc($repeated));
$order1 = serialize($orderarray);
$_SESSION['morder'] = urldecode($order1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="../CSS/adminstyles.css" rel="stylesheet" type="text/css" />
</head>

<body>
<h1>Management administration
- <a href="addmanagement.php">Add management</a></h1>
<?php
$count = 0;
 do { 
 $count++; ?>
  <table width="100" border="0" cellspacing="0" cellpadding="5">
    <tr>
      <td style="border:solid 4px #eee;"><table width="600" border="0" cellspacing="0" cellpadding="5">
        <tr>
          <td colspan="2"><h2><?php echo urldecode($row_Recordset1['name']); ?></h2></td>
          <td width="100" rowspan="2"><p><a href="removemanagement.php?ID=<?php echo $row_Recordset1['ID']; ?>">Remove</a><br />
            <a href="editmanagement.php?ID=<?php echo $row_Recordset1['ID']; ?>">Edit</a><br />
              <a href="ordermanagement.php?d=down&amp;key=<?php echo $count; ?>">Move down </a></p></td>
        </tr>
        <tr>
          <td width="200"><img src="../managementpictures/<?php echo $row_Recordset1['image']; ?>" alt="" width="200" /></td>
          <td width="300"><h3><?php echo urldecode($row_Recordset1['position']); ?><br />
            <?php echo urldecode($row_Recordset1['degree']); ?></h3>
            <p><?php echo urldecode($row_Recordset1['blurb']); ?><br />
            </p></td>
        </tr>
      </table></td>
    </tr>
  </table>
  <br />
  <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
