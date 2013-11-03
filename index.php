<?php
    $currentpage = 'index';
    require_once('header.php');
    //mysql_select_db($database_sql, $sql);
?>

<div id="<?php echo $currentpage; ?>" class="clearfix">
    <div class="mainsection grid_7 alpha">
        <h1>
            Welcome 
            <?php if(isset($_SESSION['username']) && !LOCAL){
                $name = ldap_get_names($_SESSION['username']); 
                echo $name[0].'!';
            } else {
                 echo $_SESSION['username'];
            } ?>
        </h1>

        <div id="loginbox">
            <?php displayLogin3(); ?>
 
 </div>
	<div id="nfw_advert" class="clearfix"> <?php //TXSL hack here too. CSS/LESS needs upating ?>
		<h4>Welcome to 2013/14!</h4>
		<div id="image_box">
			<img src="images/nov_2013.jpg" width="550px" style="margin-bottom: 10px"/>
		</div>
            <p>Last year we were voted the fourth best Student Society in the UK - join us this year to go three better! Forget the staid networking events, ICFS offers something totally different from the norm. With unrivalled industry connections built up over several years and a dedicated committee we are able to offer you opportunities you can’t find elsewhere, ranging from the wildly successful Trading Education Certificate (now in its fourth year!) to our flagship New Financial Worlds Conference in November.</p>
            <p>ICFS’ unique blend of academic, business and social sets it apart from other societies, at Imperial and elsewhere. So what are you waiting for? Click on Events to find out what’s on this week.</p>
            <p style="font-weight:bold">ICFS Committee 2013/14</p>
            <p>George, Deepika, Abhinav, Dario, Ash, Tsatska, Tasmin, Karen & Wee Kii</p>
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
