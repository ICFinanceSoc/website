<?php
$currentpage = register;
include_once('header.php');

?>

<h1>Website, Event and Mailing list Registration</h1>
<?
$show = 0;
$message = 0;

$submit = $_GET['submit'];
$Interests = ',';
if($submit == 1){
$Username = mysql_real_escape_string($_POST['Username']);
$Password = mysql_real_escape_string($_POST['Password']);
$Mobile = mysql_real_escape_string($_POST['Mobile']);
$Interests1 = $_POST['Interests'];
if ($Interests1){
 foreach ($Interests1 as $I){
 $Interests = $Interests.$I.',';
 }
}
$filter= '(uid=';
$filter .= $Username;
$filter .= ')';
$conn = ldap_connect("addressbook.ic.ac.uk") or die("Could not connect to server");
$r = ldap_bind($conn) or die("Could not bind to server");
$dn = "o=Imperial College,c=GB";
$justthese = array("ou");
$sr=ldap_search($conn, $dn, $filter, $justthese);
$info = ldap_get_entries($conn, $sr);
$Dept = $info[0]["ou"][0];
ldap_close($conn);
$validpassword = pam_auth($Username, $Password);

if($validpassword == 1){
	if(mysql_num_rows(mysql_query("SELECT * FROM 2011_Members WHERE Username = '$Username'"))==0) {
		mysql_query("INSERT INTO 2011_Members (Username, Mobile, Interests,Dept)
		VALUES ('$Username', '$Mobile', '$Interests', '$Dept')");
		$message = 1;
		$show = 1;
	}else{
	$message = 2;
	}
	}else{
$message = 3;
}
}


if($message == 0){
?>
Please enter your details in order to sign up to our society.
<?
}

if($message == 1){
?>
Thank you. You have succesfully confirmed your identity and are now on the Finance Society mailing list. Please <a href="requirelogin.php">now log in</a>.
<?
}

if($message == 2){
?>
Something went wrong. It would appear that you are already a member of the society.
<?
}

if($message == 3){
?>
Your password was incorrect. Please try again.
<?
}

if($show == 0){
?>
<BR><BR>
<form action="register.php?submit=1" method="POST">

<table width="500" border="0" cellspacing="5" cellpadding="5">
    <tr>
      <td width="149" bgcolor="#dddddd">College Username</td>
      <td width="351" bgcolor="#eeeeee"><label for="title"></label>
   <input type="text" name="Username" />
     </td>
    </tr>
    
 <tr>
      <td width="149" bgcolor="#dddddd">College Password</td>
      <td width="351" bgcolor="#eeeeee"><label for="title"></label>
<input type="password" name="Password" />
     </td>
    </tr>
   <tr>
      <td width="149" bgcolor="#dddddd">Mobile Number</td>
      <td width="351" bgcolor="#eeeeee"><label for="title"></label>
     <input type="text" name="Mobile" />
     </td>
    </tr>
    <tr>
      <td bgcolor="#dddddd">Interests</td>
      <td bgcolor="#eeeeee"> 
      <select name="Interests[]" multiple="multiple">
<?
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
</select><BR>
Feel free to select multiple options - hold down Ctrl/Cmd
      </td>
    </tr>
   <tr>
      <td>&nbsp;</td>
      <td bgcolor="#eeeeee"><input type="submit" name="submit" /></td>
    </tr>
  </table>
<p class=displaytext>
<b>Why do we need your username and password?</b><BR>
The ICFS website now runs on the College SSO authentication system. We never see or store your password. We require it now to confirm your identity.
<BR><BR><b>
Does this make me a society member?</b><BR>
Not exactly. We encourage you to 'buy' free membership of the ICFS on the union website, in order to register officially with the union as a member of the society.
This will allow you to vote in ICFS elections. This registration system is our communications system: registering on this website will ensure you receive updates on
events we run and publications we release.
</form>
<?
}
?>

<? require_once('footer.php'); ?>
