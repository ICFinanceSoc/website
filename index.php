<?php
    $currentpage = 'index';
    require_once('header.php');
    //mysql_select_db($database_sql, $sql);
?>

<div id="<?php echo $currentpage; ?>" class="clearfix">
    <div class="mainsection grid_7 alpha">
        <h1>
            Welcome 
            <?php if(isset($_SESSION[username]) && !LOCAL){
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
		<h4>Merry Christmas & A Happy New Year</h4>
		<div id="image_box">
			<img src="images/xmas2012_banner.jpg" width="550px"/>
		</div>
            <p>Many thanks for attending all of our events this term. With over 40 on-campus events, a conference, numerous off-site trips, dinners and the Winter Festival, it's certainly been a busy term for the ICFS ! We've had over 1500 members attending events this term and we hope they have all been useful in educating, inspiring and motivating careers in finance & applications. <a href="http://bit.ly/Uv7l8J" target="_blank">Recap all our events with our Autumn Highlights video.</a></p>
			<p>If you enjoyed our events this term - just wait till you see what we have in store for 2013 ! From more off-site visits, a finance course, mutiple international trips, a summer festival, AGM and Annual Dinner, ICFS is going to be even busier. Have a look at what you can expect from the ICFS next term and how to get involved in our new <a href="http://bit.ly/SxjqcP" target="_blank">Spring Term Preview Video</a></p>
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
                    <p> Find out more about all the latest ICFS events for the upcoming week and register.</p>
                    <a href="events.php" title="Read More" class="btn dark">Read More</a>
                </div>
                <div class="featitem clearfix">
                    <div class="image">
                        <a href="asia.php"><img src="images/s2.jpg"/></a>
                    </div>
                    <p>We’re off to Hong Kong! Learn more about our international trips and Asia Pacific opportunities.</p>
                    <a href="asia.php" title="Read More" class="btn dark">Read More</a>
                </div>
                <div class="featitem clearfix">
                    <div class="image">
                        <a href="team.php"><img src="images/s3.jpg"/></a>
                    </div>
                    <p>Who runs the ICFS? Meet the people behind the society and find out how to get involved.</p>
                    <a href="team.php" title="Read More" class="btn dark">Read More</a>
                </div>
                <div class="featitem clearfix">
                    <div class="image">
                        <a href="media.php"><img src="images/s4.jpg"/></a>
                    </div>
                    <p>We really love cool videos, pictures and other media ! Check out what kind of things we’ve been up to in our Media section.</p>
                    <a href="media.php" title="Read More" class="btn dark">Read More</a>
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
