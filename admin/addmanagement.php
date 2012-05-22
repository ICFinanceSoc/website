<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="../CSS/adminstyles.css" rel="stylesheet" type="text/css" />
<script src="http://code.jquery.com/jquery-latest.js"></script>

<script type="text/javascript" src="richtext/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
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
<h1>Add management
</h1>
<form action="addmanagementscript.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
  <table width="500" border="0" cellspacing="5" cellpadding="5">
    <tr>
      <td width="150" bgcolor="#ddd">Full name</td>
      <td width="350" bgcolor="#eee"><label for="name"></label>
        <input type="text" name="name" id="name" /></td>
    </tr>
    <tr>
      <td bgcolor="#ddd">Position</td>
      <td bgcolor="#eee"><input type="text" name="position" id="position" /></td>
    </tr>
    <tr>
      <td bgcolor="#ddd">Degree course</td>
      <td bgcolor="#eee"><input type="text" name="degree" id="degree" /></td>
    </tr>
    <tr>
      <td bgcolor="#ddd">Blurb</td>
      <td bgcolor="#eee"><label for="blurb"></label>
      <textarea name="blurb" id="blurb" cols="55" rows="8"></textarea></td>
    </tr>
    <tr>
      <td bgcolor="#ddd">Image</td>
      <td bgcolor="#eee"><label for="image"></label>
      <input type="file" name="image" id="image" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td bgcolor="#EEEEEE"><input type="submit" name="button" id="button" value="Add" /></td>
    </tr>
  </table>
</form>
<p>&nbsp;</p>
</body>
</html>