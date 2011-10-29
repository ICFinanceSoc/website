<?php
    $currentpage = 'index';
    require_once('header.php');
    //mysql_select_db($database_sql, $sql);
?>

<h1>Welcome</h1>
<!-- <img src="images/welcome.jpg" width="100%"> -->

<div class="displaytext">
    This website is currently under construction, however will be finished shortly,... it is fully functional but please forgive any aesthetic mishaps!
</div>
       
<div class="amplifytradingbox grid_8">
    <img src="images/pdf_icon.png" width="32" height="32" alt="Download Amplify Trading" />
    <a href="downloadlatest.php">Download the latest Amplify Trading report </a><?php if(!isset($_SESSION['username'])) { ?>(you must be logged in to do so) <?php } ?>
    | <a href="amplifytrading.php">View all reports</a>
</div>
<div class="clear"></div>

<div id="eventsbox" class="grid_5 alpha">
    <h4>Upcoming Events</h4>
    <ul>
        <?php 
        $currentdate = gmdate("Y-m-d");
        mysql_select_db($database_sql, $sql);
        $max = 5;
        $query_Recordset1 = "SELECT * FROM events WHERE `date` >= '$currentdate' ORDER BY `date` LIMIT 0,".$max;
        $Recordset1 = mysql_query($query_Recordset1, $sql) or die(mysql_error());
        $totalRows_Recordset1 = mysql_num_rows($Recordset1);
        if($totalRows_Recordset1 > 0) {
            $i = 0;
            while($row_Recordset1 = mysql_fetch_array($Recordset1)) {
                $i++;
        ?>
            <a href="eventinformation.php?ID=<?php echo $row_Recordset1['ID']; ?>">
                <li class="clearfix <?php if($i == $max) echo 'last'; ?>">
                    <div class="date">
                        <span class="day"><?php echo date("d",strtotime($row_Recordset1['date'])); ?></span> 
                        <span class="month"><?php echo date("M",strtotime($row_Recordset1['date'])); ?></span>
                    </div>
                    <div class="title"><?php echo urldecode($row_Recordset1['title']); ?></div>
                </li>
            </a>
            <?php } ?>
        <?php } else { ?>
            <p><em>No upcoming events.</em></p>
        <?php } ?>
    </ul>
</div>

<div id="featbox" class="grid_7 omega">
    <h4>Featured things</h4>
    <div id="items">
        <div class="featitem clearfix">
            <div class="image">
                <img src="http://placehold.it/250x150/DDDDDD/07C3F4"/>
            </div>
            <p>1 Pariatur synth esse, butcher non quis placeat sunt eiusmod. Elit cardigan aliquip american apparel, skateboard brunch ea dolor butcher fanny pack freegan 3 wolf moon fixie.</p> 
            <a href="#" title="Read More" class="btn dark">Read More</a>
        </div>
        <div class="featitem clearfix">
            <div class="image">
                <img src="http://placehold.it/250x150/DDDDDD/07C3F4"/>
            </div>
            <p>2 Pariatur synth esse, butcher non quis placeat sunt eiusmod. Elit cardigan aliquip american apparel, skateboard brunch ea dolor butcher fanny pack freegan 3 wolf moon fixie.</p> 
            <a href="#" title="Read More" class="btn dark">Read More</a>
        </div>
        <div class="featitem clearfix">
            <div class="image">
                <img src="http://placehold.it/250x150/DDDDDD/07C3F4"/>
            </div>
            <p>3 Pariatur synth esse, butcher non quis placeat sunt eiusmod. Elit cardigan aliquip american apparel, skateboard brunch ea dolor butcher fanny pack freegan 3 wolf moon fixie.</p> 
            <a href="#" title="Read More" class="btn dark">Read More</a>
        </div>
        <div class="featitem clearfix">
            <div class="image">
                <img src="http://placehold.it/250x150/DDDDDD/07C3F4"/>
            </div>
            <p>4 Pariatur synth esse, butcher non quis placeat sunt eiusmod. Elit cardigan aliquip american apparel, skateboard brunch ea dolor butcher fanny pack freegan 3 wolf moon fixie.</p> 
            <a href="#" title="Read More" class="btn dark">Read More</a>
        </div>
    </div>
    <div id="nav">
        <a href="#" id="prev" title="Previous"></a>
        <a href="#" id="next" title="Next"></a>
    </div>
</div>

<div id="thumbs" class="grid_12 clearfix">
    <div class="boxthumb grid_4 alpha">
        <a href="#">
            <div class="imageholder">
                <img src="http://placehold.it/270x150" alt="" />
                <div class="caption">
                    <div class="title">Fancy event</div>
                    <div class="desc">
                         Lorem ipsum dolor sit amet, consectetur adipisicing elit.                 
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="boxthumb grid_4 alpha">
        <a href="#">
            <div class="imageholder">
                <img src="http://placehold.it/270x150" alt="" />
                <div class="caption">
                    <div class="title">Fancy event</div>
                    <div class="desc">
                         Lorem ipsum dolor sit amet, consectetur adipisicing elit.                 
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="boxthumb grid_4 alpha">
        <a href="#">
            <div class="imageholder">
                <img src="http://placehold.it/270x150" alt="" />
                <div class="caption">
                    <div class="title">Fancy event</div>
                    <div class="desc">
                         Lorem ipsum dolor sit amet, consectetur adipisicing elit.                 
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>

<div class="sponsors">
    <!-- <div class="container_12"> -->
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
    <!-- </div> -->
</div>

<?php require_once('footer.php');  ?>
