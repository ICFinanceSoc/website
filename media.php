<?php
    $currentpage = 'media';
    require_once('header.php');

    if (!($content = $NGAPIntegrator->EchoIfClassDefaultSaysYes($currentpage))) {
        mysql_select_db($database_sql, $sql);
        $query_homeregion = "SELECT * FROM media WHERE ID = 1";
        $homeregion = mysql_query($query_homeregion, $sql) or die(mysql_error());
        $row_homeregion = mysql_fetch_assoc($homeregion);
        $totalRows_homeregion = mysql_num_rows($homeregion);
        $content = stripslashes(urldecode($row_homeregion['body']));
    }
?>

<div id="<?php echo 'about';// TXSL to fix this hack ?>">
   <?php /* <div class="clearfix" id="welcomeimage">
        <img src="images/welcome.jpg" width="100%">
    </div> */ ?>
    <div class="displaytext">
        <?php echo $content; ?>
    </div>                      
</div>

<?php require_once('footer.php');?>
