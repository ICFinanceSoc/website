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
                <a href="#"><img src="http://placehold.it/250x150/DDDDDD/07C3F4"/></a>
            </div>
            <p>1 Pariatur synth esse, butcher non quis placeat sunt eiusmod. Elit cardigan aliquip american apparel, skateboard brunch ea dolor butcher fanny pack freegan 3 wolf moon fixie.</p> 
            <a href="#" title="Read More" class="btn dark">Read More</a>
        </div>
        <div class="featitem clearfix">
            <div class="image">
                <a href="#"><img src="http://placehold.it/250x150/DDDDDD/07C3F4"/></a>
            </div>
            <p>2 Pariatur synth esse, butcher non quis placeat sunt eiusmod. Elit cardigan aliquip american apparel, skateboard brunch ea dolor butcher fanny pack freegan 3 wolf moon fixie.</p> 
            <a href="#" title="Read More" class="btn dark">Read More</a>
        </div>
        <div class="featitem clearfix">
            <div class="image">
                <a href="#"><img src="http://placehold.it/250x150/DDDDDD/07C3F4"/></a>
            </div>
            <p>3 Pariatur synth esse, butcher non quis placeat sunt eiusmod. Elit cardigan aliquip american apparel, skateboard brunch ea dolor butcher fanny pack freegan 3 wolf moon fixie.</p> 
            <a href="#" title="Read More" class="btn dark">Read More</a>
        </div>
        <div class="featitem clearfix">
            <div class="image">
                <a href="#"><img src="http://placehold.it/250x150/DDDDDD/07C3F4"/></a>
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
    <?php include_once('sponsorlist.php'); ?>
</div>

<?php require_once('footer.php');  ?>
