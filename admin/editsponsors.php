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
$query_Recordset1 = "SELECT * FROM sponsors ORDER BY name ASC";
$Recordset1 = mysql_query($query_Recordset1, $sql) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="../CSS/adminstyles.css" rel="stylesheet" type="text/css" />
</head>

<body>
<h1>Edit sponsors - <a href="addsponsor.php">add sponsor</a></h1>
<h2>Current sponsors:</h2>
<?php if ($totalRows_Recordset1 > 0) { // Show if recordset not empty ?>
  <table width="100%" border="0" cellspacing="5" cellpadding="5">
    
    
    <tr>
      <td bgcolor="#dddddd"><h3>Logo</h3></td>
      <td bgcolor="#dddddd"><h3>Sponsor name</h3></td>
      <td bgcolor="#dddddd"><h3>Sponsor type</h3></td>
      <td bgcolor="#dddddd"><h3>Sponsor link</h3></td>
      <td bgcolor="#dddddd"><h3>&nbsp;</h3></td>
      </tr> 
    <?php do { ?>
      <tr>
        <td width="19%"><p><img name="<?php echo $row_Recordset1['name']; ?>" src="../sponsorlogos/<?php echo $row_Recordset1['logo']; ?>" width="125" alt="" /></p></td>
        <td width="18%" bgcolor="#eeeeee"><p><?php echo urldecode($row_Recordset1['name']); ?></p></td>
        <td width="17%" bgcolor="#eeeeee"><p><?php echo $row_Recordset1['type']; ?></p></td>
        <td width="17%" bgcolor="#eeeeee"><p><?php echo urldecode($row_Recordset1['link']); ?></p></td>
        <td width="18%" bgcolor="#eeeeee"><p><a href="editsponsorconfirm.php?ID=<?php echo $row_Recordset1['ID']; ?>">Edit</a> <a href="removesponsor.php?ID=<?php echo $row_Recordset1['ID']; ?>">Remove</a></p></td>
      </tr>
      <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
  </table>
  <?php } else {
	  // Show if recordset not empty ?>
<h3>You have yet to add any sponsors.</h3>
      <?php } ?>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
