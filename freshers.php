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
Thank you for joining the Finance Society mailing list! This is an automated email to confirm your subscription. Please log in (using your College username and password) to our website at <a href=http://www.financesociety.co.uk>http://www.financesociety.co.uk</a> to choose the types of event you're interested in attending.
If you don't log in, we'll just send you notifications about everything!
<BR>
<div width=100% style="background-color:#dddddd; width:100%; align:center; border-top: 1px solid #000;" align=center BGCOLOR:#dddddd></div>
Imperial College Finance Society is a part of Imperial College Union operating under the Social Clubs Committee. Your are receiving these emails as a registered member of the ICFS website. To unsubscribe from these email notifications would be to leave the society. If you would like to modify the category of emails you receive, please update your interests on our website by logging in using your College username and password.</body>
</html>
EOF;
$headers  = "From: $from\r\n";
$headers .= "Content-type: text/html\r\n";
mail($to, $subject, $message, $headers);
}
$user = $_POST['user'];
$phone = $_POST['phone'];
$already = mysql_num_rows(mysql_query("SELECT * FROM 2011_Members WHERE Username='$user'"));
if($already == 0){
mysql_query("INSERT INTO 2011_Members (Username, Mobile, Interests) VALUES ('$user', '$phone', ',')");
$user = $user . '@ic.ac.uk';
mailer($user);
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

 
function win1() {
    window.open("lookup.php","Lookup","menubar=no,width=800,height=360,toolbar=no,scrollbar=yes");
}
 
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
  <form id="formID" class="formular" method="post" action="" style="width:600px">
Username <input value="" class="validate[required,custom[onlyLetterNumber],maxSize[20],ajax[ajaxUserCallPhp]] text-input" type="text" name="user" id="user" />
Phone <input value="" class="validate[required,custom[onlyLetterNumber],maxSize[20]] text-input" type="text" name="phone" id="phone" />
 <input type=submit class=submit name=submit>
 </form>