<?php $currentpage = 'sponsors'; ?>
<?php require_once('header.php'); 
    mysql_select_db($database_sql, $sql);
    $query_platinumsponsorsmain = "SELECT * FROM sponsors WHERE type = 'platinum' ORDER BY name ASC";
    $platinumsponsorsmain = mysql_query($query_platinumsponsorsmain, $sql) or die(mysql_error());
    $row_platinumsponsorsmain = mysql_fetch_assoc($platinumsponsorsmain);
    $totalRows_platinumsponsorsmain = mysql_num_rows($platinumsponsorsmain);
    
    mysql_select_db($database_sql, $sql);
    $query_goldsponsorsmain = "SELECT * FROM sponsors WHERE type = 'gold' ORDER BY name ASC";
    $goldsponsorsmain = mysql_query($query_goldsponsorsmain, $sql) or die(mysql_error());
    $row_goldsponsorsmain = mysql_fetch_assoc($goldsponsorsmain);
    $totalRows_goldsponsorsmain = mysql_num_rows($goldsponsorsmain);

    mysql_select_db($database_sql, $sql);
    $query_silversponsorsmain = "SELECT * FROM sponsors WHERE type = 'silver' ORDER BY name ASC";
    $silversponsorsmain = mysql_query($query_silversponsorsmain, $sql) or die(mysql_error());
    $row_silversponsorsmain = mysql_fetch_assoc($silversponsorsmain);
    $totalRows_silversponsorsmain = mysql_num_rows($silversponsorsmain);

    mysql_select_db($database_sql, $sql);
    $query_learningsponsorsmain = "SELECT * FROM sponsors WHERE type = 'learning' ORDER BY name ASC";
    $learningsponsorsmain = mysql_query($query_learningsponsorsmain, $sql) or die(mysql_error());
    $row_learningsponsorsmain = mysql_fetch_assoc($learningsponsorsmain);
    $totalRows_learningsponsorsmain = mysql_num_rows($learningsponsorsmain);

?>

<div id="<?php echo $currentpage; ?>">
    <div class="grid_12">
        <h1>Sponsors</h1>
        <p>Please click on our sponsors' logo to find out more.</p>
    </div>
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
</div>
                 
<?php require_once('footer.php');  ?>
