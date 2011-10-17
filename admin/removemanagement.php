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

$colname_currentmanagement = "-1";
if (isset($_GET['ID'])) {
  $colname_currentmanagement = $_GET['ID'];
}
mysql_select_db($database_sql, $sql);
$query_currentmanagement = sprintf("SELECT * FROM management WHERE ID = %s", GetSQLValueString($colname_currentmanagement, "int"));
$currentmanagement = mysql_query($query_currentmanagement, $sql) or die(mysql_error());
$row_currentmanagement = mysql_fetch_assoc($currentmanagement);
$totalRows_currentmanagement = mysql_num_rows($currentmanagement);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="../CSS/adminstyles.css" rel="stylesheet" type="text/css" />
</head>

<body>
<h1>Remove management
</h1>
<form action="removemanagementscript.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
  <table width="600" border="0" cellspacing="5" cellpadding="5">
    <tr>
      <td width="150" bgcolor="#ddd">Full name</td>
      <td width="350" bgcolor="#eee"><label for="name"></label>
        <?php echo urldecode($row_currentmanagement['name']); ?></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td bgcolor="#EEEEEE"><input type="submit" name="button" id="button" value="Remove" />
      <input name="ID" type="hidden" id="ID" value="<?php echo $row_currentmanagement['ID']; ?>" /></td>
    </tr>
  </table>
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($currentmanagement);
mysql_close($sql);
?>
