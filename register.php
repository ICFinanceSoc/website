<?php
$currentpage = register;
include_once('header.php');
?>

<h3>Website, Event and Mailing list Registration</h3>
<?
    $show = 0;
    $message = 0;

    $submit = $_POST['submit'];
    $Interests = ',';
    if($submit == 1){
        require_once('createuser.php');
        $safe_username = mysql_real_escape_string($_POST['Username']);
        $safe_mobile = mysql_real_escape_string($_POST['Mobile']);
        $safe_password = mysql_real_escape_string($_POST['Password']);
        $result = createuser_auth($safe_username, $safe_password, $safe_mobile, $Interests, 'ICFSSITE');
        if ($result['status']){
            echo '<p class="success">' . $result['msg'] . '</p>';
        }
        else{
            echo '<p class="error">' . $result['msg'] . '</p>';
        }
    }


    if($show == 0){ ?>
        <form action="register.php" method="POST">
            <fieldset>
                <div class="clearfix">
                    <label for="Username">College Username</label>
                    <div class="input">
                        <input type="text" name="Username" id="Username" />
                    </div>
                </div>
                <div class="clearfix">
                    <label for="Password">College Password</label>
                    <div class="input">
                        <input type="password" name="Password" id="Password" />
                    </div>
                </div>
                <div class="clearfix">
                    <label for="Mobile">Mobile Number</label>
                    <div class="input">
                        <input type="text" name="Mobile" id="Mobile" />
                        <input type="hidden" name="submit" value="1" />
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
                        <span class="help-block">Feel free to select multiple options - hold down Ctrl/Cmd</span>
                    </div>
                </div>
                <div class="actions">
                    <input type="submit" name="submit" class="btn primary" />
                </div>
            </fieldset>
            <input type="hidden" name="submit" value="1" />
        </form>
        <h4>Why do we need your username and password?</h4>
        <p>The ICFS website now runs on the College SSO authentication system. We never see or store your password. We require it now to confirm your identity.</p>
        <h4>Does this make me a society member?</h4>
        <p>Not exactly. We encourage you to 'buy' free membership of the ICFS on the union website, in order to register officially with the union as a member of the society. This will allow you to vote in ICFS elections. This registration system is our communications system: registering on this website will ensure you receive updates on events we run and publications we release.</p>
    <? } ?>

<? require_once('footer.php'); ?>
