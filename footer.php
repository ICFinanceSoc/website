        </div>
    </div>

    <div class="line"></div>

    <div class="footer">
        <div class="container_12">
            <div id="contactus" class="grid_5">
                <form class="form-stacked">
                    <fieldset>
                        <legend>Contact Us</legend> 
                        <div class="clearfix">
                            <label for="contactemail">Name</label>
                            <div class="input">
                                <input type="text" name="contactemail" placeholder="Joe Bloggs" class="large" />
                            </div>
                        </div>
                        <div class="clearfix">
                            <label for="contactemail">Email</label>
                            <div class="input">
                                <input type="text" name="contactemail" placeholder="example@example.com" class="large" />
                            </div>
                        </div>
                        <div class="clearfix">
                            <label for="contactmessage">Message</label>
                            <div class="input">
                                <textarea id="contactmessage" name="contactmessage" placeholder="Hello!" class="large"></textarea>
                            </div>
                        </div>
                        <div class="clearfix">
                            <input type="submit" name="submit" value="Send" class="btn" />
                        </div>
                    </fieldset>
                </form>
            </div>
            <div id="registernow" class="grid_7">
                <form class="form-stacked"> 
                    <fieldset>
                        <legend>Register Now</legend>
                        <div class="grid_3 alpha">
                            <div class="clearfix">
                                <label for="registeruser">College Username</label>
                                <div class="input">
                                    <input name="registeruser" id="registerpass" type="text"/>
                                </div>
                            </div>
                            <div class="clearfix">
                                <label for="registerpass">College Password</label>
                                <div class="input">
                                    <input name="registerpass" id="registerpass" type="text"/>
                                </div>
                            </div>
                            <div class="clearfix">
                                <label for="registermobile">Mobile Number</label>
                                <div class="input">
                                    <input name="registermobile" id="registermobile" type="text"/>
                                </div>
                            </div>
                        </div>
                        <div class="grid_3 omega">
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
                        </div>
                        <div class="clearfix">
                            <input type="submit" name="submit" value="Register" class="btn" />
                        </div>
                    </fieldset>
                </form>
            </div>
            <ul class="grid_4 push_4">
                <!-- <li><a href="http://twitter.com/ICFS100" target="_blank"><img src="images/followtwitter.png" width="50" height="50" alt="Follow us on Twitter" style="padding-right:20px;"/></a></li> -->
                <!-- <li><a href="http://www.imperialcollegeunion.org/" target="_blank"><img src="images/Imperial-logo.png" height="50" alt="Imperial college union" /></a></li> -->
                <!-- <li><a href="http://www.facebook.com/group.php?gid=20171188344&amp;ref=ts" target="_blank"><img src="images/followfacebook.png" width="50" height="50" alt="Follow us on facebook" style="padding-left:20px;"/></a></li> -->
            </ul>
            <div class="clear"></div>
            <p class="grid_2 push_5">&#169; Finance Society 2011</p>
        </div>
    </div>

    <!-- Javascript -->
    <script type="text/javascript" src="scripts/jquery-1.6.1.min.js"></script>
    <script type="text/javascript" src="js/jquery.cycle.all.js"></script>
    <script type="text/javascript" src="js/jquery.easing.1.3.js"></script>

<? if($currentpage == 'index'){ ?> 

    <script type="text/javascript" src="jquery.nivo.slider.pack.js"></script>

    <script type="text/javascript">
        $(window).load(function() {
            $('#slider').nivoSlider( {
                directionNavHide: false
            });
        });
    </script>

<?php } ?>

    <script type="text/javascript" src="js/script.js"></script>

</body>
<!-- InstanceEnd --></html>
<?php
    mysql_free_result($platinumsponsors);
    mysql_free_result($goldsponsors);
    mysql_free_result($learningsponsors);
?>
