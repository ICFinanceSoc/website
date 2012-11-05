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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="../CSS/adminstyles.css" rel="stylesheet" type="text/css" />
</head>

<body>
<h1>Learning - <a href="addlearning.php">Add learning article</a> - <a href="addlearningsection.php">Add section</a></h1>
<?php do { ?>
<div class="box">
  <?php
$section = $row_Recordset1['ID'];
mysql_select_db($database_sql, $sql);
$query_Recordset2 = "SELECT * FROM learning WHERE `section` = '$section' ORDER BY title ASC";
$Recordset2 = mysql_query($query_Recordset2, $sql) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2); ?>
  <h3><?php echo urldecode($row_Recordset1['title']); ?> - <a href="editlearningsection.php?ID=<?php echo $row_Recordset1['ID']; ?>">edit</a> - <a href="removelearningsection.php?ID=<?php echo $row_Recordset1['ID']; ?>">remove</a></h3>
  <?php if($totalRows_Recordset2 > 0) { do { ?>
    » <?php echo $row_Recordset2['Title']; ?> - <a href="editlearning.php?ID=<?php echo $row_Recordset2['ID']; ?>">edit</a> - <a href="removelearning.php?ID=<?php echo $row_Recordset2['ID']; ?>">remove</a><br />
    
    <?php } while ($row_Recordset2 = mysql_fetch_assoc($Recordset2)); } else { ?>
    No learning articles in this section.
    <?php } ?>
    </div><br />

    <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>

</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
