<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="../CSS/adminstyles.css" rel="stylesheet" type="text/css" />
</head>

<body>
<h1>Add learning section</h1>
<form id="form1" name="form1" method="post" action="addlearningsectionscript.php">
  <table width="500" border="0" cellspacing="5" cellpadding="5">
    <tr>
      <td bgcolor="#ddd">Title</td>
      <td bgcolor="#eee"><label for="title"></label>
      <input type="text" name="title" id="title" /></td>
    </tr>
    <tr>
      <td bgcolor="#ddd">Introduction to section</td>
      <td bgcolor="#eee"><label for="intro"></label>
      <textarea name="intro" id="intro" cols="45" rows="5"></textarea></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td bgcolor="#eee"><input type="submit" name="button" id="button" value="Add" /></td>
    </tr>
  </table>
</form>
<p>&nbsp;</p>
</body>
</html>