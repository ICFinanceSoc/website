<?php require_once('header.php');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script src="jquery.js"></script>
 <link href="first.css"
        rel="stylesheet" type="text/css" />
    <link href="last.css"
        rel="Stylesheet" type="text/css" />
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
<h1>Add event</h1>
<form id="form1" name="form1" method="post" action="addeventscript.php">
  <table width="500" border="0" cellspacing="5" cellpadding="5">
    <tr>
      <td width="149" bgcolor="#dddddd">Event title</td>
      <td width="351" bgcolor="#eeeeee"><label for="title"></label>
        <input type="text" name="title" id="title" /></td>
    </tr>
    <tr>
      <td bgcolor="#dddddd"> Date</td>
      <td bgcolor="#eeeeee"><input type="text" name="date" id="datepicker" />
<input type="hidden" name="date_2" class="jdpicker" /></td>
    </tr>
    <tr>
      <td bgcolor="#dddddd">Start time</td>
      <td bgcolor="#eeeeee"><label for="startm"></label>
        <label for="starth"></label>
        <input name="starth" type="text" id="starth" size="4" maxlength="2" />
        <label for="startm"></label>
        <input name="startm" type="text" id="startm" size="4" maxlength="2" />
HH:MM</td>
    </tr>
    <tr>
      <td bgcolor="#dddddd">End time</td>
      <td bgcolor="#eeeeee"><label for="startm"></label>
      <input name="endh" type="text" id="start" size="4" maxlength="2" />
      <label for="endm"></label>
      <input name="endm" type="text" id="endm" size="4" maxlength="2" /> 
      HH:MM</td>
    </tr>
    <tr>
      <td bgcolor="#dddddd">Event location</td>
      <td bgcolor="#eeeeee"><label for="startm"></label>
      <input type="text" name="location" id="start" /></td>
    </tr>
    <tr>
      <td bgcolor="#dddddd">Organisers</td>
      <td bgcolor="#eeeeee"><label for="startm"></label>
      <input type="text" name="organisers" id="start" /></td>
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
                    <option value="<?php echo $row['ID']; ?>">
                        <?php echo urldecode($row['name']); ?>
                    </option>
                <?php } ?>
            </select>
        </td>
    </tr>
    <tr>
      <td bgcolor="#dddddd">Event information</td>
      <td bgcolor="#eeeeee"><label for="information"></label>
      <textarea name="information" cols="55" rows="5" id="information"></textarea></td>
    </tr>
   
   <tr>
      <td bgcolor="#dddddd">Interests:</td>
      <td bgcolor="#eeeeee"><label for="information"></label>
      <select name="Interests[]" multiple="multiple">
<?php
$LookupInterests = mysql_query("SELECT * FROM 2011_Interests");
$num=mysql_numrows($LookupInterests);

$i=0;
while ($i < $num) {
$field1=mysql_result($LookupInterests,$i,"Interest_ID");
$field2=mysql_result($LookupInterests,$i,"InterestName");


echo "<option value=\"$field1\" name=\"Interests[]\">$field2</option>";

$i++;
}
?>
		</select>
   
      
      
      </td>
    </tr>
       <tr>
      <td bgcolor="#dddddd">Registration Open?</td>
      <td bgcolor="#eeeeee"><label for="startm"></label>
      <input type="checkbox" name="Open" checked/></td>
    </tr>

   <tr>
      <td>&nbsp;</td>
      <td bgcolor="#eeeeee"><input type="submit" name="button" id="button" value="Add event" /></td>
    </tr>
  </table>

</form>
<p>&nbsp;</p>
</body>
</html>
