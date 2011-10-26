        </div>
    </div>
    
    <?php if($currentpage != 'sponsors') { ?>
    <div class=sponsors>
        <div class="container_12">
            <div class="sponsorbox grid_12">
                <h4>Platinum Sponsors</h4>
                <ul class="clearfix">
                    <?php $pcount = 0; do { $pcount++; ?>
                        <li><a href="sponsordetail.php?ID=<?php echo $row_platinumsponsors['ID']; ?>"><img src="sponsorlogos/<?php echo $row_platinumsponsors['logo']; ?>thumb" width="100" alt="" /></a></li><?php if($pcount == 2) { $pcount = 0; } ?>
                    <?php } while ($row_platinumsponsors = mysql_fetch_assoc($platinumsponsors)); ?>
                </ul>
            </div>
            <div class="sponsorbox grid_12">
                <h4>Gold Sponsors</h4>
                <ul class="clearfix">
                    <?php do { ?>
                        <li><a href="sponsordetail.php?ID=<?php echo $row_goldsponsors['ID']; ?>"><img src="sponsorlogos/<?php echo $row_goldsponsors['logo']; ?>thumb" width="100" alt="" /></a></li>
                    <?php } while ($row_goldsponsors = mysql_fetch_assoc($goldsponsors)); ?>
                </ul>
            </div>
            <div class="sponsorbox grid_12">
                <h4>Silver Sponsors</h4>
                <ul class="clearfix">
                    <?php
                        mysql_select_db($database_sql, $sql);
                        $query_silversponsors = "SELECT * FROM sponsors WHERE type = 'silver' ORDER BY name ASC";
                        $silversponsors = mysql_query($query_silversponsors, $sql) or die(mysql_error());
                        $row_silversponsors = mysql_fetch_assoc($silversponsors);
                        $totalRows_silversponsors = mysql_num_rows($silversponsors);
                        do { ?>
                            <li><a href="sponsordetail.php?ID=<?php echo $row_silversponsors['ID']; ?>"><img src="sponsorlogos/<?php echo $row_silversponsors['logo']; ?>thumb" width="100" alt="" /></a></li>
                    <?php } while ($row_silversponsors = mysql_fetch_assoc($silversponsors)); ?>
                </ul>
            </div>
            <div class="sponsorbox grid_12">
                <h4>Partners</h4>
                <ul class="clearfix">
                    <?php do { ?>
                            <li><a href="sponsordetail.php?ID=<?php echo $row_learningsponsors['ID']; ?>"><img src="sponsorlogos/<?php echo $row_learningsponsors['logo']; ?>thumb" width="100" alt="" /></a></li>
                    <?php } while ($row_learningsponsors = mysql_fetch_assoc($learningsponsors)); ?>
                </ul>
            </div>
        </div>
    </div>
    <?php } ?>

    <div class="line"></div>

    <div class="footer container_12">
        <ul class="grid_4 push_4">
            <li><a href="http://twitter.com/ICFS100" target="_blank"><img src="images/followtwitter.png" width="50" height="50" alt="Follow us on Twitter" style="padding-right:20px;"/></a></li>
            <li><a href="http://www.imperialcollegeunion.org/" target="_blank"><img src="images/Imperial-logo.png" height="50" alt="Imperial college union" /></a></li>
            <li><a href="http://www.facebook.com/group.php?gid=20171188344&amp;ref=ts" target="_blank"><img src="images/followfacebook.png" width="50" height="50" alt="Follow us on facebook" style="padding-left:20px;"/></a></li>
        </ul>
        <div class="clear"></div>
        <p class="grid_2 push_5">&#169; Finance Society 2011</p>
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
