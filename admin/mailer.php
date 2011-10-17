<?php require_once('header.php'); ?>
<?
function mailer($to, $body){
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
EOF;
$message .= $body;
$message .=<<<EOF
<BR>
<div width=100% style="background-color:#dddddd; width:100%; align:center; border-top: 1px solid #000;" align=center BGCOLOR:#dddddd></div>
Imperial College Finance Society is a part of Imperial College Union operating under the Social Clubs Committee. Your are receiving these emails as a registered member of the ICFS website. To unsubscribe from these email notifications would be to leave the society. If you would like to modify the category of emails you receive, please update your interests on our website by logging in using your College username and password.</body>
</html>
EOF;
$headers  = "From: $from\r\n";
$headers .= "Content-type: text/html\r\n";
mail($to, $subject, $message, $headers);
}
?>
