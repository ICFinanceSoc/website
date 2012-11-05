<?php
session_name('ICFSAdmin');
session_start();
if(!isset($_SESSION['user'])){
header("location:login.php");
die();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ICFS CONTROL PANEL</title>
<script src="../jquery/jquery.js"></script>
<script type ="text/javascript" src="../jquery/datepicker/jquery.jdpicker.js"></script>
<link rel="stylesheet" href="../jquery/datepicker/jdpicker.css" type="text/css" media="screen" />

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
<link href="../CSS/adminstyles.css" rel="stylesheet" type="text/css" />
<frameset rows="*" cols="173,*" framespacing="0" frameborder="no" border="0">
  <frame src="menu.php" name="leftFrame" scrolling="No" noresize="noresize" id="leftFrame" title="leftFrame" />
    <frame src="welcome.php" name="mainFrame" id="mainFrame" title="mainFrame" />
    </frameset>
    <noframes><body>
    </body></noframes>
    </html>
    
