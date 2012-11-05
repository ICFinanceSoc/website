<?php
$currentpage = 'subsidiaries';
require_once('header.php');
mysql_select_db($database_sql, $sql);
$query_homeregion = "SELECT * FROM subsidpage WHERE ID = 1";
$homeregion = mysql_query($query_homeregion, $sql) or die(mysql_error());
$row_homeregion = mysql_fetch_assoc($homeregion);
$totalRows_homeregion = mysql_num_rows($homeregion);
?>

<div class="displaytext" id="<?php echo $currentpage; ?>">
    <?php echo stripslashes(urldecode($row_homeregion['body'])); ?>
</div>                      

<?php require_once('footer.php');?>
