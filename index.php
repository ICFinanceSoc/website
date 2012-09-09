<?php
    $currentpage = 'index';
    require_once('header.php');
    //mysql_select_db($database_sql, $sql);
?>

<div id="<?php echo $currentpage; ?>" class="clearfix">
    <div class="mainsection grid_7 alpha">
        <h1>
            Welcome 
            <? if(isset($_SESSION[username]) && !LOCAL){
                $name = ldap_get_names($_SESSION[username]); 
                echo $name[0].'!';
            } else {
                 echo $_SESSION[username];
            } ?>
        </h1>

        <div id="loginbox">
            <?php displayLogin3(); ?>
 
 </div>
	<div id="nfw_advert" class="clearfix"> <?php //TXSL hack here too. CSS/LESS needs upating ?>
		<h4>Welcome Autumn 2012</h4>
		<div id="image_box">
			<img src="images/banner.png" width="525px"/>
		</div>
			<p>Hello everyone! Welcome to Imperial & welcome to the Imperial College Finance Society for 2012-2013. We have a lot lined up over the course of the year in order to help you learn more about careers in finance & investment banking - and of course to help with your applications!</p>
			<p>With over 30 events from top firms, company visits, international trips, an education portal, YouTube channel, news feeds and a finance course, ICFS has expanded significantly this year and we encourage you to get involved in all of our exciting activities and initiatives. Have a great year!</p>
			<p style="font-weight:bold">ICFS Committee 2012/2013</p>
			<p>Giri Kesavan, Deepka Rana, Christine Kan, Avtar Rekhi, Thomas Lim, </br> Grahame Harris, Jia Cheong, Tracy Lin</p>
		</a>
	</div>
    
        <div id="featbox">
            <h4>We Recommend</h4>
            <div id="items">
                <div class="featitem clearfix">
                    <div class="image">
                        <a href="events.php"><img src="images/s1.jpg"/></a>
                    </div>
                    <p>Looking for a job? Look through our list of events to find yourself the perfect company to work for.</p>
                    <a href="events.php" title="Read More" class="btn dark">Read More</a>
                </div>
                <div class="featitem clearfix">
                    <div class="image">
                        <a href="learning.php"><img src="images/s2.jpg"/></a>
                    </div>
                    <p>Get all the inside information on how to get an internship, what to do in interviews and learn more about the industry in general</p>
                    <a href="learning.php" title="Read More" class="btn dark">Read More</a>
                </div>
                <div class="featitem clearfix">
                    <div class="image">
                        <a href="subsidiaries.php"><img src="images/s3.jpg"/></a>
                    </div>
                    <p>Try trading for yourself with one of our subsidiaries - we trade live on the markets each week.</p>
                    <a href="subsidiaries.php" title="Read More" class="btn dark">Read More</a>
                </div>
                <div class="featitem clearfix">
                    <div class="image">
                        <a href="about.php"><img src="images/s4.jpg"/></a>
                    </div>
                    <p>Learn more about the Financial World's Conference we run each year, and how to get involved.</p>
                    <a href="about.php" title="Read More" class="btn dark">Read More</a>
                </div>
            </div>
            <div id="nav">
                <a href="#" id="prev" title="Previous"></a>
                <a href="#" id="next" title="Next"></a>
            </div>
        </div>

        <div id="eventsbox">
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
                        <li class="clearfix <?php if($i == $totalRows_Recordset1) echo 'last'; ?>">
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
    </div>

    <div class="sponsors grid_5 omega">
        <?php include_once('sponsorlist.php'); ?>
    </div>

</div>

<?php require_once('footer.php');  ?>
