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
                <?php
                if ($end_middle_img){
                    echo '<td></td>';
                    }
                 if($pcount % 3 == 0) { ?>
                </tr><tr>
                <?php }
                        if (($totalRows_platinumsponsors % 3 == 1) && (($totalRows_platinumsponsors - $pcount) == 1)){
                            $end_middle_img = 1;
                            echo '<td></td>';
                        }
        } while ($row_platinumsponsors = mysql_fetch_assoc($platinumsponsors)); ?>
            </tr>
    </table>
</div>
<div class="sponsorbox">
    <h4>Gold Sponsors</h4>
    <table cellspacing="0">
        <tr>
        <?php $end_middle_img = 0; $pcount = 0; $ccount = 0; do { $pcount++; $ccount++; ?>
            <td style="vertical-align:middle">
                <a href="sponsordetail.php?ID=<?php echo $row_goldsponsors['ID']; ?>" title="<?php echo urldecode($row_goldsponsors['name']);?>">
                    <img src="sponsorlogos/<?php echo $row_goldsponsors['logo']; ?>thumb" width="<?php if($currentpage == 'index') echo '100'; else echo '120';?>" alt="" />
                </a>
            </td>
        <?php   if ($end_middle_img){
                    echo '<td></td>';
                    }
        if($pcount % 3 == 0) { ?>
            </tr><tr> 
        <?php }
        if (($totalRows_goldsponsors % 3 == 1) && (($totalRows_goldsponsors - $pcount) == 1)){
               $end_middle_img = 1;
               echo '<td></td>';
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
            $end_middle_img = 0;
            do { $pcount++; 
        ?>
            <td style="vertical-align:middle">
                <a href="sponsordetail.php?ID=<?php echo $row_silversponsors['ID']; ?>" title="<?php echo urldecode($row_silversponsors['name']);?>">
                    <img src="sponsorlogos/<?php echo $row_silversponsors['logo']; ?>thumb" width="<?php if($currentpage == 'index') echo '100'; else echo '120';?>" alt="" />
                </a>
            </td>
        <?php   if ($end_middle_img){
                    echo '<td></td>';
                    }
                if($pcount % 3 == 0) {
            echo '</tr><tr>';
        }
        if (($totalRows_silversponsors % 3 == 1) && (($totalRows_silversponsors - $pcount) == 1)){
                $end_middle_img = 1;
                echo '<td></td>';
            } 
        } while ($row_silversponsors = mysql_fetch_assoc($silversponsors)); ?>
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


<div class="sponsorbox">
    <h4>Partners Sponsors</h4>
    <table cellspacing="0">
        <tr>
        <?php $end_middle_img = 0; $pcount = 0; do { $pcount++; ?>
            <td style="vertical-align:middle">
                <a href="sponsordetail.php?ID=<?php echo $row_learningsponsors['ID']; ?>" title="<?php echo urldecode($row_learningsponsors['name']);?>">
                    <img src="sponsorlogos/<?php echo $row_learningsponsors['logo']; ?>thumb" width="<?php if($currentpage == 'index') echo '100'; else echo '120';?>" alt="" />
                </a>
            </td>
        <?php   if ($end_middle_img){
                    echo '<td></td>';
                    }
        if($pcount % 3 == 0) { ?>
            </tr><tr> 
        <?php }
        if (($totalRows_learningsponsors % 3 == 1) && (($totalRows_learningsponsors - $pcount) == 1)){
               $end_middle_img = 1;
               echo '<td></td>';
                        } ?>
        <?php } while ($row_learningsponsors = mysql_fetch_assoc($learningsponsors)); ?>
        </tr>
    </table>
</div>