<?php
    $currentpage = 'events';
    include_once('header.php');

    mysql_select_db($database_sql, $sql);
    $query_Recordset2 = "SELECT * FROM events WHERE `date` < '$currentdate' ORDER BY `date` DESC";
    $Recordset2 = mysql_query($query_Recordset2, $sql) or die(mysql_error());
    $row_Recordset2 = mysql_fetch_assoc($Recordset2);
    $totalRows_Recordset2 = mysql_num_rows($Recordset2);
?>

<div id="<?php echo $currentpage; ?>">
    <h1>Past events <span class="writingnopadding"><a href="events.php">Back to current events</a></span></h1>
    <?php
        if($totalRows_Recordset2 > 0) {
            $initial = '';
            do {
                $new = date("F Y",strtotime($row_Recordset2['date']));
                if($initial != $new) { ?>
                    </table>
                    <h3><?php echo date("F Y",strtotime($row_Recordset2['date'])); ?></h3>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <?php }
                $initial = $new;
            ?>
                    <tr>
                        <td width="288" class="writingnopadding"><strong><?php echo urldecode($row_Recordset2['title']); ?></strong></td>
                        <td width="250" bgcolor="#f5f5f5" class="writingnopadding"><?php echo date("d F Y",strtotime($row_Recordset2['date'])); ?> <?php echo substr($row_Recordset2['start'],0,-3); ?> - <?php echo substr($row_Recordset2['end'],0,-3); ?></td>
                    </tr>
            <?php } while ($row_Recordset2 = mysql_fetch_assoc($Recordset2)); ?>
            </table>
        <?php } else { ?>
            <strong>We currently have no past events</strong>
    <?php } ?>
</div>

<?php require_once('footer.php');  ?>
