        </div>
        <div class=sponsorscolumn>
            <fieldset id=sponsorbox>
                <legend>Platinum Sponsors</legend>
                <table width="100%" border="0" cellspacing="0" cellpadding="8">
                    <tr>
                        <?php
                        $pcount = 0; do { $pcount++; ?>
                            <td class="sponsorsurround"><a href="sponsordetail.php?ID=<?php echo $row_platinumsponsors['ID']; ?>"><img src="sponsorlogos/<?php echo $row_platinumsponsors['logo']; ?>thumb" width="100" alt="" /></a>&nbsp;</td> <?php if($pcount == 2) { echo "</tr>"; $pcount = 0; } ?>
                        <?php } while ($row_platinumsponsors = mysql_fetch_assoc($platinumsponsors)); ?>
                    </tr>
                </table>
            </fieldset>
            <fieldset id=sponsorbox>
                <legend>Gold Sponsors</legend>
                <table width="100%" border="0" cellspacing="0" cellpadding="8">
                    <tr>
                        <?php
                            $gcount = 0; do { $gcount++; ?>
                            <td class="sponsorsurround"><a href="sponsordetail.php?ID=<?php echo $row_goldsponsors['ID']; ?>"><img src="sponsorlogos/<?php echo $row_goldsponsors['logo']; ?>thumb" width="100" alt="" /></a>&nbsp; </td>
                            <?php if($gcount == 2) { echo "</tr>"; $gcount = 0; } ?>
                        <?php } while ($row_goldsponsors = mysql_fetch_assoc($goldsponsors)); ?>
                    </tr>
                </table>
            </fieldset>
            <fieldset id=sponsorbox>
                <legend>Silver Sponsors</legend>
                <table width="100%" border="0" cellspacing="0" cellpadding="8">
                    <tr>
                        <?php
                            mysql_select_db($database_sql, $sql);
                            $query_silversponsors = "SELECT * FROM sponsors WHERE type = 'silver' ORDER BY name ASC";
                            $silversponsors = mysql_query($query_silversponsors, $sql) or die(mysql_error());
                            $row_silversponsors = mysql_fetch_assoc($silversponsors);
                            $totalRows_silversponsors = mysql_num_rows($silversponsors);
                            $scount = 0; do { $scount++; ?>
                                <td class="sponsorsurround"><a href="sponsordetail.php?ID=<?php echo $row_silversponsors['ID']; ?>"><img src="sponsorlogos/<?php echo $row_silversponsors['logo']; ?>thumb" width="100" alt="" /></a>&nbsp;</td>
                                <?php if($scount == 2) { echo "</tr>"; $scount = 0; } ?>
                            <?php } while ($row_silversponsors = mysql_fetch_assoc($silversponsors)); ?>
                    </tr>
                </table>
            </fieldset>
            <fieldset id=sponsorbox>
                <legend>Partners</legend>
                <table width="100%" border="0" cellspacing="0" cellpadding="8">
                    <tr>
                        <?php
                            $lcount = 0; do { $lcount++; ?>
                                <td class="sponsorsurround"><a href="sponsordetail.php?ID=<?php echo $row_learningsponsors['ID']; ?>"><img src="sponsorlogos/<?php echo $row_learningsponsors['logo']; ?>thumb" width="100" alt="" /></a></td>
                                <?php if($lcount == 2) { echo "</tr>"; $lcount = 0; } ?>
                            <?php } while ($row_learningsponsors = mysql_fetch_assoc($learningsponsors)); ?>
                    </tr>
                </table>
            </fieldset> 
        </div>
    </div>
     
    <div style="clear: both;"></div>
    <div class="line"></div>

    <div class=footer>
        <a href="index.php" title="">Home</a> | 
        <a href="about.php" title="">About Us</a> | 
        <a href="events.php" title="">Events</a> | 
        <a href="publications.php" title="">Publications</a> | 
        <a href="subsidiaries.php" title="">Subsidiaries</a> | 
        <a href="learning.php" title="">Learning</a> | 
        <a href="sponsors.php" title="">Sponsors</a> | 
        <a href="management.php" title="">Management</a>
        <BR><BR>
        <a href="http://twitter.com/ICFS100" target="_blank"><img src="../images/followtwitter.png" width="50" height="50" alt="Follow us on Twitter" style="padding-right:20px;"/></a>
        <a href="http://www.imperialcollegeunion.org/" target="_blank"><img src="../images/Imperial-logo.png" height="50" alt="Imperial college union" /></a>
        <a href="http://www.facebook.com/group.php?gid=20171188344&amp;ref=ts" target="_blank"><img src="../images/followfacebook.png" width="50" height="50" alt="Follow us on facebook" style="padding-left:20px;"/></a>
    </div>
</body>
<!-- InstanceEnd --></html>
<?php
    mysql_free_result($platinumsponsors);
    mysql_free_result($goldsponsors);
    mysql_free_result($learningsponsors);
?>
