<?php require_once('header.php'); ?>
<?php
function mailer($to, $body, $subject){
$from = "ICFS <no-reply@financesociety.co.uk>";
if($subject == ''){
$subject = 'ICFS';
}
$message = <<<EOF

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>
Finance Society :: Imperial College</title>
<style type="text/css">
a:hover { text-decoration: none !important; }
ul a { text-decoration: none; color: #151B54; }

.unsubscribe p {
padding: 0;
font-size: 9px;
line-height: 16px;
color: #666;
margin: 0;
}
.header h1 {
font-weight: bold;
padding: 0;
font-size: 60px;
line-height: 76px;
color: #151B54 !important;
margin: 10px 0 0;
}
.welcome p {
font-weight: normal;
padding: 0;
font-size: 16px;
line-height: 20px;
color: #151B54;
margin: 0px 0 0;
}
.content-item h2 {
padding: 6px 10px;
background: #000000;
font-weight: bold;
font-size: 14px;
line-height: 16px;
margin: 0;
color: #fdfdfd !important;
background-image: url('http://union.ic.ac.uk/scc/finance/email/title.png');
}
.content-item p { padding: 0; font-size: 13px; line-height: 16px; color: #2d817d; margin: 0 0 20px;}
.content-item a { font-size: 12px; text-decoration: underline; color: #000;}

#footer {
color: #fff;
}

.footer p {
padding: 0;
font-size: 13px;
line-height: 16px;
color: #ffffff;
margin: 0 0 14px;
}
.footer a { font-size: 13px; font-weight: normal; text-decoration: underline; color: #fff;}

body{
text-align: centre;
padding: 0;
margin: 0;
background-image: url('http://union.ic.ac.uk/scc/finance/email/bg_email.png');
}



</style>
</head>
<body>
<table cellspacing="0" border="0" align="center" background="http://union.ic.ac.uk/scc/finance/email/bg_email.png" width="100%" cellpadding="0">
<tr>
<td align="center" valign="top" style="font-family: Helvetica, Verdana, sans-serif;">

<table cellspacing="0" border="0" cellpadding="0" width="700">
<tr>
<td align="left" style="padding: 0 0 16px; font-family: Helvetica, Verdana, sans-serif;">

<table class="unsubscribe" cellspacing="0" border="0" align="left" cellpadding="0" width="700">
<tr>
<td align="center" style="padding: 12; font-family: Helvetica, Verdana, sans-serif;">
    <p>
      <singleline label="Title">You&#39;re receiving this newsletter because you signed up at www.financesociety.co.uk.</singleline></p>
        </td>
          </tr>
          </table>  <!-- unsubscribe -->
          
          </td>
          </tr>
          <tr>
          <td align="left" style="padding: 0 0 0px; font-family: Helvetica, Verdana, sans-serif;">
          <table class="header" cellspacing="0" border="0" align="left" cellpadding="0" width="700">
          <tr>
          <td style="font-family: Helvetica, Verdana, sans-serif;"><img src="http://union.ic.ac.uk/scc/finance/email/bg_header_top.jpg" alt="divider" style="display: block;" /></td>
          </tr>
          <tr>
          <td align="left" valign="top" style="font-family: Helvetica, Verdana, sans-serif;">
          <table width="700" cellspacing="0" border="0" align="left" bgcolor="#ffffff" style="background: #ffffff url(http://union.ic.ac.uk/scc/finance/email/bg_header.png);">
          <tr>
          <td valign="top" bgcolor="#ffffff" style="padding: 10px; font-family: Helvetica, Verdana, sans-serif; background: #ffffff url(http://union.ic.ac.uk/scc/finance/email/bg_header.png);">
          <h1><singleline label="Title"><center><img src="http://union.ic.ac.uk/scc/finance/email/logo.png" width="518" height="105" border="0" /></center></singleline></h1>
          </td>
          </tr>
          <tr>
          <td valign="top" bgcolor="#ffffff" style="padding: 10px; font-family: Helvetica, Verdana, sans-serif; background: #ffffff url(http://union.ic.ac.uk/scc/finance/email/bg_header.png);">
          <table width="673" border="0" align="left" cellpadding="0" cellspacing="0" bgcolor="#ffffff" style="background: #ffffff url(http://union.ic.ac.uk/scc/finance/email/bg_header.png);">
          <tr>
          <td valign="top" bgcolor="#ffffff" style="font-family: Helvetica, Verdana, sans-serif; background: #ffffff url(http://union.ic.ac.uk/scc/finance/email/bg_header.png); font-size: 13px;" class="welcome">
          <multiline label="Description">



EOF;
$message .= $body;
$message .=<<<EOF

<tr>
<td align="left" style="padding: 0 0 10px; font-family: Helvetica, Verdana, sans-serif;" class="footer">
<table class="footer" cellspacing="0" border="0" align="left" bgcolor="#334b6d" style="" cellpadding="0" width="700">
<tr>
<td bgcolor="#273f63" style="font-family: Helvetica, Verdana, sans-serif; background: #273f63;" width="18"><img src="http://union.ic.ac.uk/scc/finance/email/01.png" width="23" height="34" /></td>
<td width="230" bgcolor="#25587E" style="font-family: Helvetica, Verdana, sans-serif; background: #273f63;">
  <h4 style="padding: 0; font-size: 13px; line-height: 14px; color: #fff; margin: 0;"><img src="http://union.ic.ac.uk/scc/finance/email/02.png" width="234" height="34" /></h4>
        </td>
        <td bgcolor="#25587E" style="font-family: Helvetica, Verdana, sans-serif; background: #273f63;" width="21"><img src="http://union.ic.ac.uk/scc/finance/email/03.png" width="21" height="34" /></td>
        <td width="150" bgcolor="#25587E" style="font-family: Helvetica, Verdana, sans-serif; background: #273f63;">
        <h4 style="padding: 0; font-size: 13px; line-height: 14px; color: #fff; margin: 0;"><img src="http://union.ic.ac.uk/scc/finance/email/04.png" width="150" height="34" /></h4>
                </td>
                <td bgcolor="#25587E" style="font-family: Helvetica, Verdana, sans-serif; background: #273f63;" width="21"><img src="http://union.ic.ac.uk/scc/finance/email/05.png" width="21" height="34" /></td>
                <td width="236" bgcolor="#25587E" style="font-family: Helvetica, Verdana, sans-serif; background: #273f63;">
                <h4 style="padding: 0; font-size: 13px; line-height: 14px; color: #fff; margin: 0;"><img src="http://union.ic.ac.uk/scc/finance/email/06.png" alt="" width="230" height="34" /></h4>
                            </td>
                            <td bgcolor="#25587E" style="font-family: Helvetica, Verdana, sans-serif; background: #273f63;" width="24"><img src="http://union.ic.ac.uk/scc/finance/email/01.png" width="23" height="34" /></td>
                              </tr>
                              <tr>
                              <td bgcolor="#334b6d" style="font-family: Helvetica, Verdana, sans-serif; background: #334b6d url(http://union.ic.ac.uk/scc/finance/email/bg_footer.png);">&nbsp;</td>
                              <td valign="top" bgcolor="#334b6d" style="font-family: Helvetica, Verdana, sans-serif; background: #334b6d url(http://union.ic.ac.uk/scc/finance/email/bg_footer.png);">
                                <p>
                                    <a href="http://www.financesociety.co.uk/"></a><br />
                                      </p>
                                        <p>In order to be recognized by our sponsors and the Union as an official member, it is essential that you 'purchase' our FREE membership <a href="https://www.imperialcollegeunion.org/activities/a-to-z/233"><strong>here</strong></a>!</p></td>
                                        <td bgcolor="#334b6d" style="font-family: Helvetica, Verdana, sans-serif; background: #334b6d url(http://union.ic.ac.uk/scc/finance/email/bg_footer.png);">&nbsp;</td>
                                          <td valign="top" bgcolor="#334b6d" style="font-family: Helvetica, Verdana, sans-serif; background: #334b6d url(http://union.ic.ac.uk/scc/finance/email/bg_footer.png);">
                                          <p>
                                              <singleline label="Title"></singleline>
                                              </p>
                                              <p>&nbsp;</p>
                                              <forwardtoafriend style="font-size: 12px; font-weight: bold; text-decoration: underline; color: #fff;">
                                                <table width="130" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                          <td><a href="http://twitter.com/ICFinanceSoc"><img src="http://union.ic.ac.uk/scc/finance/email/twitter_2012.png" alt="Twitter" width="32" height="32" /></a></td>
                                                                <td><a href="http://www.facebook.com/groups/20171188344/"><img src="http://union.ic.ac.uk/scc/finance/email/facebook_2012.png" alt="Facebook" width="32" height="32" /></a></td>
                                                                      <td><a href="http://www.linkedin.com/groups?gid=1166757"><img src="http://union.ic.ac.uk/scc/finance/email/linkedin_2012.png" alt="Linkedin" width="32" height="32" /></a></td>
                                                                      <td><a href="http://www.youtube.com/ICFinanceSociety"><img src="http://union.ic.ac.uk/scc/finance/email/youtube_2012.png" alt="Youtube" width="32" height="32" /></a></td>
                                                                          </tr>
                                                                            </table>
                                                                            </forwardtoafriend></td>
                                                                            <td bgcolor="#334b6d" style="font-family: Helvetica, Verdana, sans-serif; background: #334b6d url(http://union.ic.ac.uk/scc/finance/email/bg_footer.png);">&nbsp;</td>
                                                                              <td valign="top" bgcolor="#334b6d" style="font-family: Helvetica, Verdana, sans-serif; background: #334b6d url(http://union.ic.ac.uk/scc/finance/email/bg_footer.png);">
                                                                              <multiline label="Description"></multiline>
                                                                              <p>
                                                                                <singleline label="Title"></singleline>
                                                                                                                    </p>
                                                                                                                    <table width="130" border="0" cellspacing="0" cellpadding="0">
                                                                                                                      
                                                                                                                          </table>
                                                                                                                                                                                                  <p><a href="mailto:president@financesociety.co.uk">George Lee</a> - President <br />
                                                                                                                                                                                                          <a href="mailto:svp.investment@financesociety.co.uk">Abhinav Gandhi</a> - Senior Vice President Investment<br />
                                                                                                                                                                                                          <a href="mailto:svp.finance@financesociety.co.uk">Deepika Pyla</a> - Senior Vice President Finance<br />
                                                                                                                                                                                                          <a href="mailto:vp.events@financesociety.co.uk">Aisling Man</a> - VP Events <br />
                                                                                                                                                                                                          <a href="mailto:vp.technology@financesociety.co.uk">Dario Magliocchetti</a> - VP Technology <br />  
                                                                                                                                                                                                          <!-- <a href="mailto:vp.marketing@financesociety.co.uk">Tsatska Enkhbayer</a> - VP Marketing <br /> -->
                                                                                                                                                                                                          <!-- <a href="mailto:capmag@financesociety.co.uk">Tasmin Symons</a> - Capmag Editor <br /> -->
                                                                                                                                                                                                          <!-- <a href="mailto:treasurer@financesociety.co.uk">Karen Lai</a> - Treasurer <br /> -->
                                                                                                                                                                                                          <a href="mailto:secretary@financesociety.co.uk">Wee Kii Teh</a> - Secretary <br />
                                                                                                                                                                                                                              </p>
                                                                                                                                                                                                                                      <p> <a href="http://www.financesociety.co.uk/">Imperial College Finance Society</a></p></td>
                                                                                                                                                                                                                                                                          <td bgcolor="#334b6d" style="font-family: Helvetica, Verdana, sans-serif; background: #334b6d url(http://union.ic.ac.uk/scc/finance/email/bg_footer.png);">&nbsp;
                                                                                                                                                                                                                                                                                                             
                                                                                                                                                                                                                                                                                                                                               </td>
                                                                                                                                                                                                                                                                                                                                               </tr>
                                                                                                                                                                                                                                                                                                                                               </table>
                                                                                                                                                                                                                                                                                                                                               
                                                                                                                                                                                                                                                                                                                                               </tr><tr><td>
                                                                                                                                                                                                                                                                                                                                               <img src="http://union.ic.ac.uk/scc/finance/email/sponsors_2012.png" alt="divider" style="display: block;" /><br /><img src="http://union.ic.ac.uk/scc/finance/email/bg_header_top.jpg" alt="divider" style="display: block;" />
                                                                                                                                                                                                                                                                                                                                               <p>&nbsp;</p></td>
                                                                                                                                                                                                                                                                                                                                                                     
                                                                                                                                                                                                                                                                                                                                                                       </tr>
                                                                                                                                                                                                                                                                                                                                                                       </table>
                                                                                                                                                                                                                                                                                                                                                                       </td>
                                                                                                                                                                                                                                                                                                                                                                                   
                                                                                                                                                                                                                                                                                                                                                                                   </tr>
                                                                                                                                                                                                                                                                                                                                                                                   </table>
                                                                                                                                                                                                                                                                                                                                                                                   </body>
                                                                                                                                                                                                                                                                                                                                                                                   </html>




EOF;

$headers  = "From: $from\r\n";
$headers .= "Content-type: text/html\r\n";
mail($to, $subject, $message, $headers);
}

?>
