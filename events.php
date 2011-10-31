<?php $currentpage = 'events'; ?>
<?php require_once('header.php'); ?>

<div id="<?php echo $currentpage; ?>">
    <a href="pastevents.php">Past events</a>
    <?php 
        if($totalRows_Recordset1 > 0) {
            $initial = '';
            do {
                $new = date("F Y",strtotime($row_Recordset1['date']));
                if($initial != $new) { ?>
                    <h3><?php echo date("F Y",strtotime($row_Recordset1['date'])); ?></h3> 
                <?php } 
                $initial = $new;
            ?>
                    <div class="eventbox grid_4 alpha">
                            <div id="cont" class="clearfix">
                                <a href="eventinformation.php?ID=<?php echo $row_Recordset1['ID']; ?>" title="Find out more about the event">
                                    <img src="http://placehold.it/250x130" alt="" />
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
                                    <a href="#" title="Sign Up" class="btn dark" id="signup">Sign Up</a>
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

<?php require_once('footer.php');  ?>
