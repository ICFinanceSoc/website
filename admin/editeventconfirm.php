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
      <td bgcolor="#dddddd">Event information</td>
      <td bgcolor="#eeeeee"><label for="information"></label>
      <textarea name="information" id="information" cols="55" rows="15"><?php echo urldecode($row_Recordset1['information']); ?></textarea></td>
    </tr>
    <tr>
        <td bgcolor="#dddddd">Interests</td>
      <td bgcolor="#eeeeee">
   <?php $int = urldecode($row_Recordset1['Interests']); ?> 
    
    <select name="Interests[]" multiple="multiple">
<?
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
