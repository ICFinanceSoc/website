<?php $currentpage = 'events'; ?>
<?php require_once('header.php'); ?>

<div id="<?php echo $currentpage; ?>">
    <div class="clearfix">
        <?php 
            if($totalRows_Recordset1 > 0) {
                $initial = '';
                do {
                    $new = date("F Y",strtotime($row_Recordset1['date']));
                    if($initial != $new) { ?>
                        <div class="clear"></div>
                        <h3><?php echo date("F Y",strtotime($row_Recordset1['date'])); ?></h3> 
                    <?php } 
                    $initial = $new;
                ?>
                    <div class="eventbox grid_4 alpha">
                        <div id="cont" class="clearfix">
                            <a href="eventinformation.php?ID=<?php echo $row_Recordset1['ID']; ?>" title="Find out more about the event" id="imgcont">
                                <span id="rollover"></span>
                                <? 
                                $spon = $row_Recordset1['Sponsor'];
                                if($spon != '0'){
                                $sponlogo = mysql_query("SELECT * FROM sponsors WHERE ID='$spon'");
                                $sponlogoadd = mysql_result($sponlogo,0,logo);
                                echo '<img src="sponsorlogos/';
                                echo $sponlogoadd;                                
                                echo '" width="286" height="130" alt="" />';
                                } else {
                                echo '<img src="images/logo-250.png" width="286" height="130" alt="" />';
                                                                }
                                                          
                                ?>
                                                         
                              
                                
                                <span id="shadow"></span>
                            </a>
                            <h4><?php echo urldecode($row_Recordset1['title']); ?></h4>
                            <div id="date">
                                <div id="day">
                                    <?php echo date("d", strtotime($row_Recordset1['date'])); ?>
                                </div>
                                <div id="daylong">
                                    <?php echo date("D", strtotime($row_Recordset1['date'])); ?>
                                </div>
                                <div id="month"> 
                                    <?php echo date("M", strtotime($row_Recordset1['date'])); ?>
                                </div>
                                <div id="time">
                                    <?php if(substr($row_Recordset1['start'],0,-6) != 0) { ?> 
                                        <?php echo date("ga", strtotime(substr($row_Recordset1['start'],0,-3))); ?> - <?php echo date("ga", strtotime(substr($row_Recordset1['end'],0,-3))); ?>
                                    <?php } ?>
                                </div>
                                <a href="eventinformation.php?ID=<?php echo $row_Recordset1['ID']; ?>" title="Sign Up" class="btn dark" id="signup">Sign Up</a>
                            </div>
                            <!-- <p><?php echo urldecode($row_Recordset1['information']); ?></p> -->
                        </div>
                    </div>
                <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
            <?php } else { ?>
                <p>We have recently updated our website and are still in the process of uploading all the necessary documents to the site.</p>
                <p>The work should be completed in the next few days</p>
                <p>Sorry for any inconvenience this may have caused.</p>
        <?php } ?>
    </div>
    <?php if($totalRows_Recordset1 < 6) { ?>
        <div id="pastevents" class="clearfix">
            <h3>Some of our past events:</h3>
            <?php
                mysql_select_db($database_sql, $sql);
                $query_Recordset2 = "SELECT * FROM events WHERE `date` < '$currentdate' ORDER BY `date` DESC LIMIT 3";
                $Recordset2 = mysql_query($query_Recordset2, $sql) or die(mysql_error());
                while ($row_Recordset2 = mysql_fetch_assoc($Recordset2)) { ?>
            <div class="eventbox grid_4 alpha">
                <div id="cont" class="clearfix">
                    <a href="eventinformation.php?ID=<?php echo $row_Recordset2['ID']; ?>" title="Find out more about the event" id="imgcont">
                        <span id="rollover"></span>
                         <?
                         $spon = $row_Recordset2['Sponsor'];
                               if($spon != '0'){
                                                     $sponlogo = mysql_query("SELECT * FROM sponsors WHERE ID='$spon'");
                                                                       $sponlogoadd = mysql_result($sponlogo,0,logo);
                                                                                                                                  echo '<img src="sponsorlogos/';
                                                                                                                                                                                                                         echo $sponlogoadd;
                                                                                                                                                                                                                                                         echo '" width="286" height="130" alt="" />';
                                                                                                                                                                                                                                                                                         } else {
                                                                                                                                                                                                                                                                                                                         echo '<img src="images/logo-250.png" width="286" height="130" alt="" />';
                                                                                                                                                                                                                                                                                                                                                                                         }
                                                                                                                                                                                                                                                                                                                                                                                         
                                                                                                                                                                                                                                                                                                                                                                                                                         ?>
                                                                                                                                                                                                                                                                                                                                                                                                                         
                        
                        <span id="shadow"></span>
                    </a>
                    <h4><?php echo urldecode($row_Recordset2['title']); ?></h4>
                    <div id="date">
                        <div id="day">
                            <?php echo date("d", strtotime($row_Recordset2['date'])); ?>
                        </div>
                        <div id="daylong">
                            <?php echo date("D", strtotime($row_Recordset2['date'])); ?>
                        </div>
                        <div id="month"> 
                            <?php echo date("M", strtotime($row_Recordset2['date'])); ?>
                        </div>
                        <div id="time">
                            <?php if(substr($row_Recordset2['start'],0,-6) != 0) { ?> 
                                <?php echo date("ga", strtotime(substr($row_Recordset2['start'],0,-3))); ?> - <?php echo date("ga", strtotime(substr($row_Recordset1['end'],0,-3))); ?>
                            <?php } ?>
                        </div>
                        <a href="eventinformation.php?ID=<?php echo $row_Recordset2['ID']; ?>" title="Sign Up" class="btn dark" id="signup">Sign Up</a>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    <?php } ?>
    <div id="pasteventlink">
        <a href="pastevents.php">Past events »</a>
    </div>
</div>

<?php require_once('footer.php');  ?>
