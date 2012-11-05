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
$query_Recordset1 = sprintf("SELECT * FROM events WHERE ID = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $sql) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script src="jquery.js"></script>
<link href="first.css" rel="stylesheet" type="text/css" />
<link href="last.css" rel="Stylesheet" type="text/css" />
<script src="first.js"></script>
<script src="last.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function () {  
        $('#datepicker').datepicker({
            minDate: "0",
            changeMonth: true,
            changeYear: true
        });
    });
</script>
<link href="../CSS/adminstyles.css" rel="stylesheet" type="text/css" />

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
<h1>Edit event</h1>
<form id="form1" name="form1" method="post" action="editeventconfirmscript.php">
  <table width="500" border="0" cellspacing="5" cellpadding="5">
    <tr>
      <td width="149" bgcolor="#dddddd">Event title</td>
      <td width="351" bgcolor="#eeeeee"><label for="title"></label>
        <input name="title" type="text" id="title" value="<?php echo urldecode($row_Recordset1['title']); ?>" /></td>
    </tr>
    <tr>
      <td bgcolor="#dddddd"> Date</td>
      <td bgcolor="#eeeeee"><input name="date" type="text" id="datepicker" value="<?php echo str_replace("-","/",$row_Recordset1['date']); ?>" /></td>
    </tr>
    <tr>
      <td bgcolor="#dddddd">Start time</td>
      <td bgcolor="#eeeeee"><label for="startm"></label>
        <label for="starth"></label>
        
        <input name="starth" type="text" value="<?php echo substr($row_Recordset1['start'],0,-6); ?>" id="starth" size="4" maxlength="2" />
        <label for="startm"></label>
        <input name="startm" type="text" value="<?php echo substr($row_Recordset1['start'],3,-3); ?>" id="startm" size="4" maxlength="2" />
HH:MM</td>
    </tr>
    <tr>
      <td bgcolor="#dddddd">End time</td>
      <td bgcolor="#eeeeee"><label for="startm"></label>
        
        <input name="endh" type="text" value="<?php echo substr($row_Recordset1['end'],0,-6); ?>" id="start" size="4" maxlength="2" />
      <label for="endm"></label>
      <input name="endm" type="text" value="<?php echo substr($row_Recordset1['end'],3,-3); ?>" id="endm" size="4" maxlength="2" />
      HH:MM</td>
    </tr>
    <tr>
      <td bgcolor="#dddddd">Event location</td>
      <td bgcolor="#eeeeee"><label for="startm"></label>
      <input name="location" type="text" id="start" value="<?php echo urldecode($row_Recordset1['location']); ?>" /></td>
    </tr>
    <tr>
        <td bgcolor="#dddddd">Organisers</td>
        <td bgcolor="#eeeeee"><label for="startm"></label>
            <input name="organisers" type="text" id="start" value="<?php echo urldecode($row_Recordset1['organisers']); ?>" /></td>
    </tr>
    <tr>
        <td bgcolor="#dddddd">Sponsor</td>
        <td bgcolor="#eeeeee"><label for="startm"></label>
            <select name="sponsor">
                <option value="NULL">None</option>
                <?php
                    $sql = "SELECT * FROM sponsors";
                    $rsc = mysql_query($sql);
                    while($row = mysql_fetch_array($rsc)) { ?>
                    <option value="<?php echo $row['ID']; ?>"
                        <?php if($row['ID'] == $row_Recordset1['Sponsor']) {
                            echo 'selected="selected"'; 
                        } ?>
                    >
                        <?php echo urldecode($row['name']); ?>
                    </option>
                <?php } ?>
            </select>
        </td>
    </tr>
    <tr>
      <td bgcolor="#dddddd">Event information <b>NOT TIME/DATE etc...that already gets displayed!</b></td>
      <td bgcolor="#eeeeee"><label for="information"></label>
      <textarea name="information" id="information" cols="55" rows="15"><?php echo urldecode($row_Recordset1['information']); ?></textarea></td>
    </tr>
    <tr>
        <td bgcolor="#dddddd">Interests</td>
      <td bgcolor="#eeeeee">
   <?php $int = urldecode($row_Recordset1['Interests']); ?>
    
    <select name="Interests[]" multiple="multiple">
<?php
$int = substr($int, 1, -1);
$int = explode(",", $int);
$nint = count($int);

$LookupInterests = mysql_query("SELECT * FROM 2011_Interests");
$num=mysql_numrows($LookupInterests);

$i=0;
while ($i < $num) {
    $field1=mysql_result($LookupInterests,$i,"Interest_ID");
    $field2=mysql_result($LookupInterests,$i,"InterestName");
    echo "<option value=\"$field1\" name=\"Interests[]\"";
    $j=0;
    while($j<$num){
        if($int[$j] == $field1){
            echo ' selected';
        }
        $j++;
    }
    echo ">$field2</option>";
    $i++;
}
?>
</select>
    </tr>
        <tr>
      <td bgcolor="#dddddd">Registration Open?</td>
      <td bgcolor="#eeeeee"><label for="startm"></label>
      <input name="Open" type="checkbox" id="start" <?php
      																	$cur = urldecode($row_Recordset1['Open']); 
      																	if($cur == 'on'){
      																	echo 'checked';
      																	} 
      																	?> /></td>
    </tr>
      <tr>
      <td bgcolor="#dddddd">Update Attendees?</td>
      <td bgcolor="#eeeeee"><label for="startm"></label>
      <input name="Updte" type="checkbox" id="start" checked /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td bgcolor="#eeeeee"><input type="submit" name="button" id="button" value="Edit event" />
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
