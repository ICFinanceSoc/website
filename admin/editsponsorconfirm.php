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
