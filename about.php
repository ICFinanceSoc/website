<?php
    $currentpage = 'about';
    require_once('header.php');
    mysql_select_db($database_sql, $sql);
    $query_homeregion = "SELECT * FROM homepage WHERE ID = 1";
    $homeregion = mysql_query($query_homeregion, $sql) or die(mysql_error());
    $row_homeregion = mysql_fetch_assoc($homeregion);
    $totalRows_homeregion = mysql_num_rows($homeregion);
?>

<img src="images/welcome.jpg" width="100%">
<div class="displaytext">
    <?php echo stripslashes(urldecode($row_homeregion['body'])); ?>
</div>                      

<? require_once('footer.php');?>
