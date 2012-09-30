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
<div style="width:500px;border-style:transparent;border-width:25px;padding:10px">
<div style="margin-left:auto;margin-right:auto">
<div style="text-align:center">
<img src="../images/logo.png" width="300px"/>
<h3>Website, Event and Mailing list Registration</h3>

<?
require_once('../db.php');
require_once('../createuser.php')
    $show = 0;
    $message = 0;

    $submit = $_GET['submit'];
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
        $result = createuser($Username, $Mobile, $Interests);
        /*$filter= '(uid=';
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
        //$validpassword = pam_auth($Username, $Password);
        $names = ldap_get_names($Username);
        $name = $names[0];
        //var_dump($names);
        if($names){
            if(mysql_num_rows(mysql_query("SELECT * FROM 2012_Business_school WHERE Username = '$Username'"))==0) {
                mysql_query("INSERT INTO 2012_Business_school (Username, Mobile, Interests,Dept)
                VALUES ('$Username', '$Mobile', '$Interests', '$Dept')");
                $message = 1;
                $show = 1;
            } else {
                $message = 2;
            }
        } else {
            $message = 3;
        }*/
    }

    if(!isset($result)){ ?>
    <p style="font-size:13px;font-weight:normal;line-height:18px;margin-bottom:9px;font-style:italic;padding-left:20px;color:#666666;"><img src="../images/information.png">Please enter your details in order to sign up to our society.</p>
</div>
    <? }

    if($result["status"]){ ?>
        <p class="success"><? echo result["msg"]; ?></p>
        </div>
    <? }
    else{ ?>
        <p class="error"><? echo result["msg"]; ?></p>
        </div>
    <? }

/*    if($message == 2){ ?>
    <p class="error">Something went wrong. It would appear that you are already a member of the society.</p>
</div>
    <? }

    if($message == 3){ ?>
    <p class="error">The username supplied does not exist.</p>
	</div>
    <?*/ }

//if($show == 0){ ?>
        <form action="?submit=1" method="POST" style="padding-left:50px">
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
                        </select>
                        <span class="help-block">Feel free to select multiple options</span>
                    </div>
                </div>
                <div class="actions">
                    <input type="submit" name="submit" class="btn primary" />
                </div>
            </fieldset>
        </form>
</div>
        <h4>Why do we need your username?</h4>
        <p>The ICFS website now uses the College Single Sign On System. We email you based on your college username.</p>
        <h4>Does this make me a society member?</h4>
        <p>Not exactly. We encourage you to 'buy' free membership of the ICFS on the union website, in order to register officially with the union as a member of the society. This will allow you to vote in ICFS elections. This registration system is our communications system: registering on this website will ensure you receive updates on events we run and publications we release.</p>
</div>
</body>
<? //} ?>
