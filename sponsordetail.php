<?php $currentpage = 'sponsors'; ?>
<?php require_once('header.php'); ?>
<?
$colname_currentsponsor = "-1";
if (isset($_GET['ID'])) {
    $colname_currentsponsor = $_GET['ID'];
}
mysql_select_db($database_sql, $sql);
$query_currentsponsor = sprintf("SELECT * FROM sponsors WHERE ID = %s", GetSQLValueString($colname_currentsponsor, "int"));
$currentsponsor = mysql_query($query_currentsponsor, $sql) or die(mysql_error());
$row_currentsponsor = mysql_fetch_assoc($currentsponsor);
$totalRows_currentsponsor = mysql_num_rows($currentsponsor);
?>

<div id="sponsorbox">
    <div class="grid_3 alpha">
        <div class="image">
            <a href="<?php echo urldecode($row_currentsponsor['link']); ?>" target="_blank" title="Go to website">
                <img src="sponsorlogos/<?php echo $row_currentsponsor['logo']; ?>thumb" width="200" alt="" />
            </a>
        </div>
        <div class="events">
        </div>
    </div>
    <div class="profile grid_9 omega">
        <h3><?php echo urldecode($row_currentsponsor['name']); ?></h3>
        <?php echo stripslashes(urldecode($row_currentsponsor['profile'])); ?>
        <a href="<?php echo urldecode($row_currentsponsor['link']); ?>" target="_blank">» Go to website</a>
    </div>
</div>

<?php require_once('footer.php');  ?>
