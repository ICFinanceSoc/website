<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <title>Imperial College Finance Society</title>
    <link rel="SHORTCUT ICON" href="../favicon.ico" />
    <!-- Main stylesheet -->
    <!-- <link rel="stylesheet" type="text/css" href="CSS/style.css" /> -->
    <link rel="stylesheet/less" type="text/css" href="../CSS/style.less" />
    <script src="../js/less-1.1.4.min.js" type="text/javascript"></script>
</head>
<body>
<?php $isiPad = (bool) strpos($_SERVER['HTTP_USER_AGENT'],'iPad');
/* if(!$isiPad){
//    echo '<div style="margin-left:auto;margin-right:auto;width:600px;border-style:transparent;border-width:25px;padding:10px>"';
}
else{ */
    echo '<div style="width:600px;border-style:transparent;border-width:25px;padding:10px">';
//} ?>
<div style="margin-left:auto;margin-right:auto">
<div style="text-align:center">
<img src="../images/logo.png" width="300px"/>
<h3>Kenya Briefing Sign In</h3>

<?php
require_once('../db.php');
require_once('../createuser.php');
    $show = 0;

    $submit = $_POST['submit'];
    $Interests = ',';
    if($submit == 1){

        $Username = mysql_real_escape_string($_POST['Username']);
        include('/usr/local/share/union-php/_auto_pre.php');
        $result = kenyareg($Username);
    }
    if(!isset($result)){ ?>
    <p style="font-size:13px;font-weight:normal;line-height:18px;margin-bottom:4px;font-style:italic;padding-left:20px;color:#666666;"><img src="../images/information.png"> Please enter your details in order to confirm your attendance at the Hong Kong Briefing</p>
</div>
    <?php }
    else{

        if(!$result["already_mem"]){ ?>
            <p class="success"><?php echo $result["msg"]; ?></p>

        <?php }
        else{ ?>
            <p style="font-size:13px;font-weight:normal;line-height:18px;margin-bottom:9px;font-style:italic;padding-left:20px;color:#666666;"><img src="../images/error.png"><?php echo $result["msg"]; ?></p>
        <?php }
    } ?>
        <form action="" method="POST" style="padding-left:50px">
            <fieldset>
                <div class="clearfix">
                    <label for="Username">College Username</label>
                    <div class="input">
                        <input type="text" name="Username" id="Username" />
                    </div>
                </div>
        <div class="actions" style="padding-left:200px">
            <button type="submit" name="submit" class="btn primary" />Register</button>
        </div>
            </fieldset>
            <input type="hidden" name="submit" value="1" />
        </form>

</div>
</body>
<?php //} ?>
