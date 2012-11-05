<?php
set_time_limit(0);
include_once('mailer.php');
include_once('header.php');

function eventline($upcomingevents, $user){
$question = ' ';
foreach ($upcomingevents as $I){
$question .='ID='.$I.' OR ';
}
$question = substr($question, 0, -4);
$table = <<<EOF
<repeater>
<tr>
<td align="left" style="padding: 0 0 0px; font-family: Helvetica, Verdana, sans-serif;">
<table class="content-item" cellspacing="0" border="0" align="left" bgcolor="#fff" style="background: #fff; border: 1px solid #bddacb;" cellpadding="0" width="700">
EOF;
$result2 = mysql_query("SELECT * FROM events WHERE".$question);
while($row2 = mysql_fetch_array( $result2 )) {
$row2['title'] = urldecode($row2['title']);
$row2['information'] = urldecode($row2['information']);
$row2['location'] = urldecode($row2['location']);
$row2['date'] = urldecode($row2['date']);
$table .= <<<EOF
<tr>
<td bgcolor="#fff" style="padding: 10px 10px 0; font-family: Helvetica, Verdana, sans-serif; background: #fff;" colspan="2">
<h2>{$row2['title']}</h2> - {$row2['date']}, {$row2['location']}
</td>
</tr>
<tr>
<td valign="top" bgcolor="#fff" style="padding: 10px; font-family: Helvetica, Verdana, sans-serif; background: #fff;">
<multiline label="Description"><p>
{$row2['information']}
<BR>
<a href=https://union.ic.ac.uk/scc/finance/confirmattendance.php?event={$row2['ID']}&user={$user}&r=imperialcollegeunion>Register immediately</a>
</p>
</multiline>
</td>
</tr>
EOF;
     }
$table .= '</table></td></tr></repeater>';
return $table;
}


function submitmassmail($body, $category, $department, $upcomingevents){

if($category==A && $department==A){
$result = mysql_query("SELECT * FROM 2011_Members") or die(mysql_error());
}

if($department!=A && $category==A){
$result = mysql_query("SELECT * FROM 2011_Members WHERE Dept='$department'") or die(mysql_error());
}

if($department!=A && $category!=A){
$category = ','.$category.',';
$result = mysql_query("SELECT * FROM 2011_Members WHERE Dept='$department' AND Interests LIKE '%$category%'") or die(mysql_error());
}

if($department==A && $category!=A){
$category = ','.$category.',';
$result = mysql_query("SELECT * FROM 2011_Members WHERE Interests LIKE '%$category%'") or die(mysql_error());
}
echo 'Sending '.mysql_num_rows($result).' emails';
echo '<BR>';

while($row = mysql_fetch_array( $result )) {
$to = $row['Username'];
$to .="@ic.ac.uk";
$output = $body;
$output .= <<<EOF
</multiline></td>
</tr>
</table>  
</td>
</tr>
</table>
</td>
</tr>
</table><!-- header -->
</td>
</tr>
EOF;
if($upcomingevents != ''){
$output .= eventline($upcomingevents,$row['Username']);
}
mailer($to, $output);
}
}


$submit = 0;
$submit = $_POST['submit'];

if($submit == 1){

$body = $_POST['body'];
$category = $_POST['category'];

$department = $_POST['department'];
$dall = $_POST['dall'];
if($dall == 1){
$department = "A";
}

$all = $_POST['all'];
if($all == 1){
$category = "A";
}

$upcomingevents = '';
$upcomingevents = $_POST['upcomingevents'];
submitmassmail($body, $category, $department, $upcomingevents);
}
if($submit == 0){
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="../CSS/adminstyles.css" rel="stylesheet" type="text/css" />
<script src="http://code.jquery.com/jquery-latest.js"></script>
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
<h1>Mass Email system</h1>
<h2>Email members</h2>
<form action="messagemembers.php" method="post">
  <table width="100%" border="0" cellspacing="5" cellpadding="5">
    <tr>
      <td bgcolor="#DDDDDD">Email body</td>
      <td bgcolor="#EEEEEE"><label for="body"></label>
      <textarea name="body" id="body" cols="130" rows="30"></textarea></td>
    </tr>
        <tr>
      <td width="90" bgcolor="#DDDDDD">Only email these interests</td>
      <td width="*" bgcolor="#EEEEEE"><label for="title"></label>
      <select name="category">
<?php
$currentdate = gmdate("Y-m-d");
mysql_select_db($database_sql, $sql);
$query_Recordset1 = "SELECT * FROM events WHERE `date` >= '$currentdate' ORDER BY `date`";
$Recordset1 = mysql_query($query_Recordset1, $sql) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);




$LookupInterests = mysql_query("SELECT * FROM 2011_Interests");
$num2=mysql_numrows($LookupInterests);
$i2=0;
while ($i2 < $num2) {
$field1=mysql_result($LookupInterests,$i2,"Interest_ID");
$field2=mysql_result($LookupInterests,$i2,"InterestName");
echo "<option value=\"$field1\" name=\"category\">$field2</option>";

$i2++;
}
?>
</select></td>
    </tr>
    
            <tr>
                  <td width="90" bgcolor="#DDDDDD">Only email these subjects</td>
                        <td width="*" bgcolor="#EEEEEE"><label for="title"></label>
                              <select name="department">
                              <option name=department value="ou=ma,o=Imperial College,c=GB">Mathematics</option>
                              <option name=department value="ou=doc,o=Imperial College,c=GB">Computing</option>
                              <option name=department value="ou=dls,o=Imperial College,c=GB">Life Sciences</option>
                              <option name=department value="ou=me,o=Imperial College,c=GB">Mechanical Engineers</option>
                              <option name=department value="ou=cv,o=Imperial College,c=GB">Civil Engineers</option>
                              <option name=department value="ou=ee,o=Imperial College,c=GB">Electrical Engineers</option>
                              <option name=department value="ou=ae,o=Imperial College,c=GB">Aero Engineers</option>
                              <option name=department value="ou=ce,o=Imperial College,c=GB">Chemical Engineers</option>
                              <option name=department value="ou=bg,o=Imperial College,c=GB">BioEngineers</option>
                              <option name=department value="ou=ch,o=Imperial College,c=GB">Chemistry</option>
                              <option name=department value="ou=ph,o=Imperial College,c=GB">Physics</option>
                              <option name=department value="ou=md,o=Imperial College,c=GB">Medicine</option>
                              <option name=department value="ou=ms,o=Imperial College,c=GB">Business School</option>
                              <option name=department value="ou=ese,o=Imperial College,c=GB">Earth Science</option>
                              <option name=department value="ou=mt,o=Imperial College,c=GB">Materials</option>
                                                            </select></td>
                                  </tr>
                                  
    
    <tr>
      <td bgcolor="#DDDDDD">Or, ignore Interests filter?</td>
      <td bgcolor="#EEEEEE"><label for="body"></label>
      <input type="checkbox" name="all" value="1"></td>
    </tr> 
        <tr>
      <td bgcolor="#DDDDDD">And/Or, ignore Subject filter? </td>
      <td bgcolor="#EEEEEE"><label for="body"></label>
      <input type="checkbox" name="dall" value="1"></td>
    </tr> 


     <tr>
           <td bgcolor="#DDDDDD">Include information on these events: </td>
                 <td bgcolor="#EEEEEE"><label for="body"></label>
                    


 <?php
      if($totalRows_Recordset1 > 0) {
echo '<select name="upcomingevents[]" multiple=multiple>';
      do {                                                                                                                                            
echo '<option name="upcomingevents[]" value="'.urldecode($row_Recordset1['ID']).'">'.urldecode($row_Recordset1['title']).' - '.urldecode($row_Recordset1['date']).'</option>';

 } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1));
 echo '</select>';
                                                   } else {
    ?>                                               
No upcoming events - never mind!
<?php
}

?>






    <tr>
      <td>&nbsp;</td>
      <td bgcolor="#EEEEEE">
<input type="hidden" name="submit" value="1"><input type="submit" name="button" id="button" value="Send email" />
      <input name="ID" type="hidden" id="ID" value="1" /></td>
    </tr>
  </table>
</form>
<p>&nbsp;</p>
</body>
</html>




<?php
}
?>

