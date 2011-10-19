<?php $currentpage = 'events'; ?>
<?php require_once('header.php'); ?>

<div id="<?php echo $currentpage; ?>">
    <h1>Our current events <span class="writingnopadding"><a href="pastevents.php">Past events</a></span></h1>
    <?php 
        if($totalRows_Recordset1 > 0) {
            $initial = '';
            do {
                $new = date("F Y",strtotime($row_Recordset1['date']));
                if($initial != $new) { ?>
                    </table>
                    <h3><?php echo date("F Y",strtotime($row_Recordset1['date'])); ?></h3> 
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="zebra-striped">
                <?php } 
                $initial = $new;
        ?>
                    <tr>
                        <td width="288" class="writingnopadding"><strong><?php echo urldecode($row_Recordset1['title']); ?></strong></td>
                        <td width="250" class="writingnopadding"><?php echo date("d F Y",strtotime($row_Recordset1['date'])); ?> <?php echo substr($row_Recordset1['start'],0,-3); ?> - <?php echo substr($row_Recordset1['end'],0,-3); ?></td>
                        <td width="117" class="writingnopadding"><a href="eventinformation.php?ID=<?php echo $row_Recordset1['ID']; ?>">More info/register</a></td>
                    </tr>
            <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
            </table>
        <?php } else { ?>
            <p>We have recently updated our website and are still in the process of uploading all the necessary documents to the site.</p>
            <p>The work should be completed in the next few days</p>
            <p>Sorry for any inconvenience this may have caused.</p>
        <?php } ?>
</div>

<?php require_once('footer.php');  ?>
