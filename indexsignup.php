<?
if(isset($_POST['submit'])){
require_once('db.php');
function mailer($to){
$from = "financesociety@imperial.ac.uk";
$subject = "Imperial College Finance Society";
$message = <<<EOF
<html>
<body>
<div width=100% style="background-color:#dddddd; width:100%; align:center; border-bottom: 1px solid #000;" align=center BGCOLOR:#dddddd>
<center><BR>
<img src=http://union.ic.ac.uk/scc/finance/images/logo.png>
</center><BR>
</div>
<BR>
<BR>
Thank you for joining the Finance Society mailing list! This is an automated email to confirm your subscription. Our new website will be going live shortly, onto which you will be able to log in fully in a few days time.
<BR>
<div width=100% style="background-color:#dddddd; width:100%; align:center; border-top: 1px solid #000;" align=center BGCOLOR:#dddddd></div>
</body>
</html>
EOF;
$headers  = "From: $from\r\n";
$headers .= "Content-type: text/html\r\n";
mail($to, $subject, $message, $headers);
}
$user = $_POST['user'];
$pass = $_POST['pass'];
$phone = $_POST['phone'];
$true = pam_auth($user, $pass);
$already = mysql_num_rows(mysql_query("SELECT * FROM 2011_Members WHERE Username='$user'"));
if($already == 0){
if($true == 1){
mysql_query("INSERT INTO 2011_Members (Username, Mobile, Interests) VALUES ('$user', '$phone', ',')");
$user = $user . '@ic.ac.uk';
mailer($user);
} else {
echo 'Your password was invalid';

}
}
}
?>
 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
       <link rel="stylesheet" href="CSS/validationEngine.jquery.css" type="text/css"/>
        <link rel="stylesheet" href="CSS/template.css" type="text/css"/>
        <script src="js/jquery-1.6.min.js" type="text/javascript">
        </script>
        <script src="js/languages/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8">
        </script>
        <script src="js/jquery.validationEngine.js" type="text/javascript" charset="utf-8">
        </script>
        <script>
            jQuery(document).ready(function(){
                jQuery("#formID").validationEngine();
            });
        </script> 
<title>Imperial College Finance Society</title> 
 
<link href="CSS/styles.css" rel="stylesheet" type="text/css" />  
</head> 
 
<body> 
<div class="topbg"> 
<div class=logobox> 
</div> 

</div> 
 
<div id=menu> 
</div> 
 
<BR><BR>  <div id="wrapper"> 
  <form id="formID" class="formular" method="post" action="https://union.ic.ac.uk/scc/finance/new/welcome.php" style="width:600px">
<b>Welcome to the Imperial College Finance Society.</b>
<BR /><BR />
Please sign up to our mailing list by logging in using your College credentials.
<BR /><BR />

IC Username <input value="" class="validate[required,custom[onlyLetterNumber],maxSize[20],ajax[ajaxUserCallPhp]] text-input" type="text" name="user" id="user" />
IC Password <input value="" class="validate[required,maxSize[20]] text-input" type="password" name="pass" id="pass" />
Phone <input value="" class="validate[required,custom[onlyLetterNumber],maxSize[20]] text-input" type="text" name="phone" id="phone" />
<BR />
The ICFS website will launch in a few days time. By pre-registering you will be one of the first to have access to our new schedule of events. Later in the term we hope to introduce a text-messaging reminder system for people who have subscribed to
events. If when this system is introduced you wish to opt-out, this won't be a problem.

 <input type=submit class=submit name=submit>
 </form>
