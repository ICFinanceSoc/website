<div class="sponsorbox ">
    <h4>Platinum Sponsors</h4>
    <table cellspacing="0">
        <tr>
        <?php $pcount = 0; do { $pcount++; ?>
                <td style="vertical-align:middle">
                    <a href="sponsordetail.php?ID=<?php echo $row_platinumsponsors['ID']; ?>" title="<?php echo urldecode($row_platinumsponsors['name']);?>">
                        <img src="sponsorlogos/<?php echo $row_platinumsponsors['logo']; ?>thumb" width="120" alt="" />
                    </a>
                </td>
                <?php if($pcount == 3) { ?>
                </tr><tr> 
                <?php
                    $pcount = 0; 
                } ?>
        <?php } while ($row_platinumsponsors = mysql_fetch_assoc($platinumsponsors)); ?>
            </tr>
    </table>
</div>
<div class="sponsorbox">
    <h4>Gold Sponsors</h4>
    <table cellspacing="0">
        <tr>
        <?php $pcount = 0; do { $pcount++; ?>
            <td style="vertical-align:middle">
                <a href="sponsordetail.php?ID=<?php echo $row_goldsponsors['ID']; ?>" title="<?php echo urldecode($row_goldsponsors['name']);?>">
                    <img src="sponsorlogos/<?php echo $row_goldsponsors['logo']; ?>thumb" width="120" alt="" />
                </a>
            </td>
        <?php if($pcount == 3) { ?>
            </tr><tr> 
        <?php
            $pcount = 0; 
        } ?>
        <?php } while ($row_goldsponsors = mysql_fetch_assoc($goldsponsors)); ?>
        </tr>
    </table>
</div>
<div class="sponsorbox ">
    <h4>Silver Sponsors</h4>
    <table cellspacing="0">
        <tr>
        <?php
            mysql_select_db($database_sql, $sql);
            $query_silversponsors = "SELECT * FROM sponsors WHERE type = 'silver' ORDER BY name ASC";
            $silversponsors = mysql_query($query_silversponsors, $sql) or die(mysql_error());
            $row_silversponsors = mysql_fetch_assoc($silversponsors);
            $totalRows_silversponsors = mysql_num_rows($silversponsors);
            $pcount = 0; 
            do { $pcount++; 
        ?>
            <td style="vertical-align:middle">
                <a href="sponsordetail.php?ID=<?php echo $row_silversponsors['ID']; ?>" title="<?php echo urldecode($row_silversponsors['name']);?>">
                    <img src="sponsorlogos/<?php echo $row_silversponsors['logo']; ?>thumb" width="120" alt="" />
                </a>
            </td>
        <?php if($pcount == 3) { ?>
            </tr><tr> 
        <?php
            $pcount = 0; 
        } ?>
        <?php } while ($row_silversponsors = mysql_fetch_assoc($silversponsors)); ?>
        </tr>
    </table>
    </ul>
</div>
<div class="sponsorbox ">
    <h4>Partners</h4>
    <table cellspacing="0">
        <tr>
        <?php $pcount = 0; do { $pcount++; ?>
            <td style="vertical-align:middle">
                <a href="sponsordetail.php?ID=<?php echo $row_learningsponsors['ID']; ?>" title="<?php echo urldecode($row_learningsponsors['name']);?>">
                    <img src="sponsorlogos/<?php echo $row_learningsponsors['logo']; ?>thumb" width="120" alt="" />
                </a>
            </td>
        <?php if($pcount == 3) { ?>
            </tr><tr> 
        <?php
            $pcount = 0; 
        } ?>
        <?php } while ($row_learningsponsors = mysql_fetch_assoc($learningsponsors)); ?>
        </tr>
    </table>
</div>
