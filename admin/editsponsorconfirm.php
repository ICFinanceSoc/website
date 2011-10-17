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

$colname_Recordset1 = "-1";
if (isset($_GET['ID'])) {
  $colname_Recordset1 = $_GET['ID'];
}
mysql_select_db($database_sql, $sql);
$query_Recordset1 = sprintf("SELECT * FROM sponsors WHERE ID = %s", GetSQLValueString($colname_Recordset1, "int"));
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
<h1>Edit sponsor - <?php echo urldecode($row_Recordset1['name']); ?></h1>
<form action="editsponsorconfirmscript.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
  <table width="650" border="0" cellspacing="5" cellpadding="5">
    <tr>
      <td width="207" bgcolor="#dddddd">Sponsor name</td>
      <td width="408" bgcolor="#eeeeee"><input name="name" type="text" id="name" value="<?php echo urldecode($row_Recordset1['name']); ?>" /></td>
    </tr>
    <tr>
      <td bgcolor="#dddddd">Sponsor type</td>
      <td bgcolor="#eeeeee"><label for="type2"></label>
        <select name="type" id="type2">
          <option value="platinum" <?php if (!(strcmp("platinum", $row_Recordset1['type']))) {echo "selected=\"selected\"";} ?>>platinum</option>
          <option value="gold" <?php if (!(strcmp("gold", $row_Recordset1['type']))) {echo "selected=\"selected\"";} ?>>gold</option>
          <option value="silver" <?php if (!(strcmp("silver", $row_Recordset1['type']))) {echo "selected=\"selected\"";} ?>>silver</option>
          <option value="learning" <?php if (!(strcmp("learning", $row_Recordset1['type']))) {echo "selected=\"selected\"";} ?>>learning</option>
        </select></td>
    </tr>
    <tr>
      <td bgcolor="#dddddd">Sponsor profile</td>
      <td bgcolor="#eeeeee"><textarea name="profile" id="profile" cols="55" rows="10"><?php echo stripslashes(urldecode($row_Recordset1['profile'])); ?></textarea>        </td>
    </tr>
    <tr>
      <td bgcolor="#dddddd"><p>Sponsor logo<br />
        <span class="notice">leave blank to keep original</span></p></td>
      <td bgcolor="#eeeeee"><label for="logo"></label>
        <input type="file" name="logo" id="logo" />
        <br />
        <img src="../sponsorlogos/<?php echo $row_Recordset1['logo']; ?>" alt="" name="<?php echo $row_Recordset1['name']; ?>" width="125" id="<?php echo $row_Recordset1['name']; ?>" /></td>
    </tr>
    <tr>
      <td bgcolor="#dddddd">Sponsor link</td>
      <td bgcolor="#eeeeee"><label for="link"></label>
        <input name="link" type="text" id="link" value="<?php echo urldecode($row_Recordset1['link']); ?>" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td bgcolor="#eeeeee"><input type="submit" name="button" id="button" value="Edit sponsor" />
      <input name="ID" type="hidden" id="ID" value="<?php echo $row_Recordset1['ID']; ?>" /></td>
    </tr>
  </table>
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
