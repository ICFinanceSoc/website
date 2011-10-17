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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE homepage SET title=%s, body=%s WHERE ID=%s",
                       GetSQLValueString(urlencode($_POST['title']), "text"),
                       GetSQLValueString(urlencode($_POST['body']), "text"),
                       GetSQLValueString($_POST['ID'], "int"));

  mysql_select_db($database_sql, $sql);
  $Result1 = mysql_query($updateSQL, $sql) or die(mysql_error());

  $updateGoTo = "homepagetext.php?message=Region updated";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

mysql_select_db($database_sql, $sql);
$query_homepage = "SELECT * FROM homepage";
$homepage = mysql_query($query_homepage, $sql) or die(mysql_error());
$row_homepage = mysql_fetch_assoc($homepage);
$totalRows_homepage = mysql_num_rows($homepage);

mysql_select_db($database_sql, $sql);
$query_Recordset1 = "SELECT * FROM homepage WHERE ID = 1";
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
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script type ="text/javascript" src="../jquery/datepicker/jquery.jdpicker.js"></script><link rel="stylesheet" href="../jquery/datepicker/jdpicker.css" type="text/css" media="screen" />

<script type="text/javascript" src="richtext/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
$(document).ready(function(){
   $('#date').jdPicker({
   });
});
	tinyMCE.init({
		mode : "textareas",
		theme : "advanced",
		plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",
				style_formats : [
			{title : 'Heading', inline : 'h3'}
		],
	});
	
</script>
</head>

<body>
<h1>Home page</h1>
<h2>Edit editable region</h2>
<form id="form1" name="form1" method="POST" action="<?php echo $editFormAction; ?>">
  <table width="500" border="0" cellspacing="5" cellpadding="5">
    <tr>
      <td width="90" bgcolor="#DDDDDD">Region title</td>
      <td width="410" bgcolor="#EEEEEE"><label for="title"></label>
        <input name="title" type="text" id="title" value="<?php echo urldecode($row_Recordset1['title']); ?>" /></td>
    </tr>
    <tr>
      <td bgcolor="#DDDDDD">Region text</td>
      <td bgcolor="#EEEEEE"><label for="body"></label>
      <textarea name="body" id="body" cols="55" rows="7"><?php echo stripslashes(urldecode($row_Recordset1['body'])); ?></textarea></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td bgcolor="#EEEEEE"><input type="submit" name="button" id="button" value="Update" />
      <input name="ID" type="hidden" id="ID" value="1" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($homepage);

mysql_free_result($Recordset1);
?>
