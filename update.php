<?php
require_once('header.php');
?>
<h1>Update Profile</h1>
<?php
if(isset($_SESSION['username'])) {
$u = $_SESSION['username'];

$message = 0;
$submit = $_GET['submit'];
$Interests = ',';

if($submit == 1){
$Mobile = mysql_real_escape_string($_POST['Mobile']);
$Interests1 = $_POST['Interests'];

if ($Interests1){
foreach ($Interests1 as $I){
$Interests = $Interests.$I.',';
}
}

mysql_query("UPDATE 2011_Members SET Mobile='$Mobile', Interests='$Interests' WHERE Username = '$u'");
	$message = 1;

}


if($message == 0){
?>
Please make modifications to your profile here.
<?php
}

if($message == 1){
?>
Thank you. You have succesfully updated your profile.
<?php
}

$getcurrentvalues = mysql_query("SELECT * FROM 2011_Members WHERE Username = '$u'");
$mob=mysql_result($getcurrentvalues,0,"Mobile");
$int=mysql_result($getcurrentvalues,0,"Interests");


?>
<BR><BR>
<form action="update.php?submit=1" method="POST">
  <table width="500" border="0" cellspacing="5" cellpadding="5">
   
   <tr>
      <td width="149" bgcolor="#dddddd">Mobile Number</td>
      <td width="351" bgcolor="#eeeeee"><label for="title"></label>
      <input type="text" name="Mobile" value="<?php echo $mob; ?>"></td>
    </tr>
    <tr>
      <td bgcolor="#dddddd">Interests</td>
      <td bgcolor="#eeeeee">
      
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
      
      
      </td>
    </tr>


   <tr>
      <td>&nbsp;</td>
      <td bgcolor="#eeeeee"><input type="submit" name="submit" /></td>
    </tr>
  </table>
<BR><BR>
If you would like to stop being a member of the society, please click <a href=deletemember.php>here</a>. This will unsubscribe you from our mailing list; however you will also not be able to register for any of our events.

</form>
<?php

} else {
echo 'You need to be logged on to actually have something to update!';
}

require_once('footer.php'); ?>
