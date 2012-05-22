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
$query_Recordset1 = "SELECT * FROM learning_sections ORDER BY title ASC";
$Recordset1 = mysql_query($query_Recordset1, $sql) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$colname_Recordset2 = "-1";
if (isset($_GET['ID'])) {
  $colname_Recordset2 = $_GET['ID'];
}
mysql_select_db($database_sql, $sql);
$query_Recordset2 = sprintf("SELECT * FROM learning WHERE ID = %s", GetSQLValueString($colname_Recordset2, "int"));
$Recordset2 = mysql_query($query_Recordset2, $sql) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="../CSS/adminstyles.css" rel="stylesheet" type="text/css" />
</head>

<body>
<h1>Edit learning article
</h1>
<form action="editlearningscript.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
  <table width="500" border="0" cellspacing="5" cellpadding="5">
    <tr>
      <td width="181" bgcolor="#ddd">Title</td>
      <td width="284" bgcolor="#eee"><label for="title2"></label>
        <input name="title" type="text" id="title2" value="<?php echo $row_Recordset2['Title']; ?>" /></td>
    </tr>
    <tr>
      <td bgcolor="#ddd">Section</td>
      <td bgcolor="#eee"><label for="section"></label>
        <select name="section" id="section">
          <?php
do {  
?>
          <option value="<?php echo $row_Recordset1['ID']?>"<?php if (!(strcmp($row_Recordset1['ID'], $row_Recordset2['section']))) {echo "selected=\"selected\"";} ?>><?php echo urldecode($row_Recordset1['title'])?></option>
          <?php
} while ($row_Recordset1 = mysql_fetch_assoc($Recordset1));
  $rows = mysql_num_rows($Recordset1);
  if($rows > 0) {
      mysql_data_seek($Recordset1, 0);
	  $row_Recordset1 = mysql_fetch_assoc($Recordset1);
  }
?>
      </select></td>
    </tr>
    <tr>
      <td bgcolor="#ddd">Document (pdf only)<br />
        <span class="notice">leave empty to keep original</span></td>
      <td bgcolor="#eee"><label for="file"></label>
        <input type="file" name="file" id="file" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td bgcolor="#eee"><input type="submit" name="button" id="button" value="Edit" />
      <input name="ID" type="hidden" id="ID" value="<?php echo $row_Recordset2['ID']; ?>" /></td>
    </tr>
  </table>
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);
?>
