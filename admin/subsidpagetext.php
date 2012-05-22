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
  $updateSQL = sprintf("UPDATE subsidpage SET title=%s, body=%s WHERE ID=%s",
                       GetSQLValueString(urlencode($_POST['title']), "text"),
                       GetSQLValueString(urlencode($_POST['body']), "text"),
                       GetSQLValueString($_POST['ID'], "int"));

  mysql_select_db($database_sql, $sql);
  $Result1 = mysql_query($updateSQL, $sql) or die(mysql_error());

  $updateGoTo = "subsidpagetext.php?message=Region updated";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

mysql_select_db($database_sql, $sql);
$query_homepage = "SELECT * FROM subsidpage";
$homepage = mysql_query($query_homepage, $sql) or die(mysql_error());
$row_homepage = mysql_fetch_assoc($homepage);
$totalRows_homepage = mysql_num_rows($homepage);

mysql_select_db($database_sql, $sql);
$query_Recordset1 = "SELECT * FROM subsidpage WHERE ID = 1";
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

<script type="text/javascript">
$(document).ready(function(){
   $('#date').jdPicker({
   });
});
</script>
<!-- TinyMCE -->
<script type="text/javascript" src="tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
        tinyMCE.init({
                        // General options
                                        mode : "textareas",
                                                        theme : "advanced",
                                                                        skin : "o2k7",
                                                                                        plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,inlinepopups,autosave",
                                                                                        
                                                                                                        // Theme options
                                                                                                                        theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
                                                                                                                                        theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
                                                                                                                                                        theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
                                                                                                                                                                        theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",
                                                                                                                                                                                        theme_advanced_toolbar_location : "top",
                                                                                                                                                                                                        theme_advanced_toolbar_align : "left",
                                                                                                                                                                                                                        theme_advanced_statusbar_location : "bottom",
                                                                                                                                                                                                                                        theme_advanced_resizing : true,
                                                                                                                                                                                                                                        
                                                                                                                                                                                                                                                        // Example word content CSS (should be your site CSS) this one removes paragraph margins
                                                                                                                                                                                                                                                                        content_css : "tinymce/examples/css/word.css",
                                                                                                                                                                                                                                                                        
                                                                                                                                                                                                                                                                                        // Drop lists for link/image/media/template dialogs
                                                                                                                                                                                                                                                                                                        template_external_list_url : "tinymce/examples/lists/template_list.js",
                                                                                                                                                                                                                                                                                                                        external_link_list_url : "tinymce/examples/lists/link_list.js",
                                                                                                                                                                                                                                                                                                                                        external_image_list_url : "tinymce/examples/lists/image_list.js",
                                                                                                                                                                                                                                                                                                                                                        media_external_list_url : "tinymce/examples/lists/media_list.js",
                                                                                                                                                                                                                                                                                                                                                        
                                                                                                                                                                                                                                                                                                                                                                        // Replace values for the template plugin
                                                                                                                                                                                                                                                                                                                                                                                        template_replace_values : {
                                                                                                                                                                                                                                                                                                                                                                                                                username : "Some User",
                                                                                                                                                                                                                                                                                                                                                                                                                                        staffid : "991234"
                                                                                                                                                                                                                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                });
                                                                                                                                                                                                                                                                                                                                                                                                                                                                </script>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                <!-- /TinyMCE -->
                                                                                                                                                                                                                                                                                                                                                                                                                                                                


</head>

<body>
<h1>Subsidiary page</h1>
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
