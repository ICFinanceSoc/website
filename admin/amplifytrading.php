<?php require_once('header.php');
mysql_select_db($database_sql, $sql);
$query_Recordset1 = "SELECT * FROM amplifytrading ORDER BY `date` DESC";
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
<h1>Amplify trading</h1>
<form action="amplifytradingscript.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
  <table width="500" border="0" cellspacing="5" cellpadding="5">
    <tr>
      <td width="145" bgcolor="#dddddd">Report<br />
        <span class="notice">The last report uploaded will be posted to the home page</span></td>
      <td width="320" bgcolor="#eeeeee"><label for="file"></label>
      <input type="file" name="file" id="file" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td bgcolor="#eeeeee"><input type="submit" name="button" id="button" value="Upload" /></td>
    </tr>
  </table>
</form>
<br />
<div class="box">
  <h3>Existing reports</h3>
  
  <?php
  if($totalRows_Recordset1 > 0) {
   do { ?>
    <a href="../amplifytrading/downloadlatest.php?ID=<?php echo $row_Recordset1['ID']; ?>">
    <?php echo date("d F Y - H:i:s",strtotime($row_Recordset1['date'])); ?></a> - <a href="removeamplifytradingscript.php?ID=<?php echo $row_Recordset1['ID']; ?>">remove</a> (as soon as you click this button the report will be removed)<br />

<?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1));
  } else {
 ?>
 No existing reports
 <?php } ?>
</div>
</body>
</html>