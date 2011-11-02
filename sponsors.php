<?php $currentpage = 'sponsors'; ?>
<?php 
    require_once('header.php'); 
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
        <?php include_once('sponsorlist.php'); ?>
    </div>
</div>
                 
<?php require_once('footer.php');  ?>
