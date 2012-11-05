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
<h3>Website, Event and Mailing list Registration</h3>

<?php
require_once('../db.php');
require_once('../createuser.php');
    $show = 0;

    $submit = $_POST['submit'];
    $Interests = ',';
    if($submit == 1){

        $Username = mysql_real_escape_string($_POST['Username']);
        $Mobile = mysql_real_escape_string($_POST['Mobile']);
        $Interests1 = $_POST['Interests'];
        include('/usr/local/share/union-php/_auto_pre.php');
        if ($Interests1){
            foreach ($Interests1 as $I){
                $Interests = $Interests.$I.',';
            }
        }
        $result = freshers_createuser($Username, $Mobile, $Interests);
    }

    if(!isset($result)){ ?>
    <p style="font-size:13px;font-weight:normal;line-height:18px;margin-bottom:4px;font-style:italic;padding-left:20px;color:#666666;"><img src="../images/information.png"> Please enter your details in order to sign up to our society.</p>
</div>
    <?php }
    else{

        if($result["status"]){ ?>
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

                <div class="clearfix">
                    <label for="Mobile">Mobile Number</label>
                    <div class="input">
                        <input type="text" name="Mobile" id="Mobile" />
                    </div>
                </div>
                <div class="clearfix">
                    <label for="Interests">Interests</label>
                    <div class="input">
                        <select name="Interests[]" multiple="multiple">
                        <?php
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
                        </select>
                        <span class="help-block">Feel free to select multiple options</span>
                    </div>
                </div>
</div>
        <div class="actions" style="padding-left:200px">
            <button type="submit" name="submit" class="btn primary" />Register</button>
        </div>
            </fieldset>
            <input type="hidden" name="submit" value="1" />
        </form>

        <h4>Why do we need your username?</h4>
        <p>The ICFS website now uses the College Single Sign On System. We email you based on your college username.</p>
        <h4>Does this make me a society member?</h4>
        <p>Not exactly. We encourage you to 'buy' free membership of the ICFS on the union website, in order to register officially with the union as a member of the society. This will allow you to vote in ICFS elections. This registration system is our communications system: registering on this website will ensure you receive updates on events we run and publications we release.</p>
</div>
</div>
</body>
<?php //} ?>
