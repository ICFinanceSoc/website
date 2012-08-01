<div class="sponsorbox ">
    <h4>Platinum Sponsors</h4>
    <table cellspacing="0">
        <tr>
        <?php $pcount = 0; do { $pcount++; ?>
                <td style="vertical-align:middle">
                    <a href="sponsordetail.php?ID=<?php echo $row_platinumsponsors['ID']; ?>" title="<?php echo urldecode($row_platinumsponsors['name']);?>">
                    <img src="sponsorlogos/<?php echo $row_platinumsponsors['logo']; ?>thumb" width="<?php if($currentpage == 'index') echo '100'; else echo '120';?>" alt="" />
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
        <?php $pcount = 0; $ccount = 0; do { $pcount++; $ccount++; ?>
            <td style="vertical-align:middle">
                <a href="sponsordetail.php?ID=<?php echo $row_goldsponsors['ID']; ?>" title="<?php echo urldecode($row_goldsponsors['name']);?>">
                    <img src="sponsorlogos/<?php echo $row_goldsponsors['logo']; ?>thumb" width="<?php if($currentpage == 'index') echo '100'; else echo '120';?>" alt="" />
                </a>
            </td>
        <?php if($pcount == 3) { ?>
            </tr><tr> 
        <?php
            $pcount = 0; 
        } ?>
        <?php } while ($row_goldsponsors = mysql_fetch_assoc($goldsponsors)); ?>
        <?php 
            /*
             * If cell count is not divisible by 3 then output empty cells until it is 
             */
            do { 
                $ccount++; 
        ?>
            <td></td>
        <?php } while(!is_int($ccount/3)); ?>
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
                    <img src="sponsorlogos/<?php echo $row_silversponsors['logo']; ?>thumb" width="<?php if($currentpage == 'index') echo '100'; else echo '120';?>" alt="" />
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
    <h4>Bronze Sponsors</h4>
    <table cellspacing="0">
        <tr>
        <?php
            mysql_select_db($database_sql, $sql);
            $query_bronzesponsors = "SELECT * FROM sponsors WHERE type = 'bronze' ORDER BY name ASC";
            $bronzesponsors = mysql_query($query_bronzesponsors, $sql) or die(mysql_error());
            $row_bronzesponsors = mysql_fetch_assoc($bronzesponsors);
            $totalRows_bronzesponsors = mysql_num_rows($bronzesponsors);
            $pcount = 0; 
            do { $pcount++; 
        ?>
            <td style="vertical-align:middle">
                <a href="sponsordetail.php?ID=<?php echo $row_bronzesponsors['ID']; ?>" title="<?php echo urldecode($row_bronzesponsors['name']);?>">
                    <img src="sponsorlogos/<?php echo $row_bronzesponsors['logo']; ?>thumb" width="<?php if($currentpage == 'index') echo '100'; else echo '120';?>" alt="" />
                </a>
            </td>
        <?php if($pcount == 3) { ?>
            </tr><tr> 
        <?php
            $pcount = 0; 
        } ?>
        <?php } while ($row_bronzesponsors = mysql_fetch_assoc($bronzesponsors)); ?>
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
                    <img src="sponsorlogos/<?php echo $row_learningsponsors['logo']; ?>thumb" width="<?php if($currentpage == 'index') echo '100'; else echo '120';?>" alt="" />
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

