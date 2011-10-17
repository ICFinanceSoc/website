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
<h1>Add sponsor
</h1>
<form action="addsponsorscript.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
  <label for="name"></label>
  <table width="650" border="0" cellspacing="5" cellpadding="5">
    <tr>
      <td width="183" bgcolor="#dddddd">Sponsor name</td>
      <td width="467" bgcolor="#eeeeee"><input type="text" name="name" id="name" /></td>
    </tr>
    <tr>
      <td bgcolor="#dddddd">Sponsor type</td>
      <td bgcolor="#eeeeee"><label for="type"></label>
        <select name="type" id="type">
          <option value="platinum">platinum</option>
          <option value="gold">gold</option>
          <option value="silver">silver</option>
          <option value="learning">learning</option>
      </select></td>
    </tr>
    <tr>
      <td bgcolor="#dddddd">Sponsor profile</td>
      <td bgcolor="#eeeeee"><label for="profile"></label>
      <textarea name="profile" id="profile" cols="55" rows="10"></textarea></td>
    </tr>
    <tr>
      <td bgcolor="#dddddd">Sponsor logo</td>
      <td bgcolor="#eeeeee"><label for="logo"></label>
      <input type="file" name="logo" id="logo" /></td>
    </tr>
    <tr>
      <td bgcolor="#dddddd">Sponsor link</td>
      <td bgcolor="#eeeeee"><label for="link"></label>
      <input type="text" name="link" id="link" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td bgcolor="#eeeeee"><input type="submit" name="button" id="button" value="Add sponsor" /></td>
    </tr>
  </table>
</form>
<p>&nbsp;</p>
</body>
</html>