<?php
$currentpage = 'management'; 
require_once('header.php');

if (isset($_GET[year])){
    $year = $_GET[year];
}
else{
    $year = 2012;   
}

mysql_select_db($database_sql, $sql);
$query_Recordset1 = "SELECT * FROM ". $year ."_management ORDER BY `order` ASC";
$Recordset1 = mysql_query($query_Recordset1, $sql) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>

<div id="<?php echo $currentpage; ?>">
    <div style="text-align:center;font-size:1.4em">
        <a href="team.php?year=2012">2012</a>
        <a href="team.php?year=2011">2011</a>
    </div>
</br>
<?php do { ?>
    <?php $currentimage = $row_Recordset1['image']; ?>
    <div class="person clearfix <?php if(file_exists("managementpictures/$currentimage")) echo 'imageactive'; ?>">
        <div class="image">
        <?php
            if(file_exists("managementpictures/$currentimage")) { ?>
                <img src="managementpictures/<?php echo $row_Recordset1['image']; ?>" alt="" width="200" />
        <?php } ?>
        </div>
        <div class="leftpointer"></div>
        <div class="personinfo">
            <div class="name">
                <h2><?php echo urldecode($row_Recordset1['name']); ?></h2>
            </div>
            <div class="info">
                <div id="position">
                    <p><?php echo urldecode($row_Recordset1['position']); ?> - <?php echo urldecode($row_Recordset1['degree']); ?></p>
                </div>
                <p><?php echo urldecode($row_Recordset1['blurb']); ?></p>
            </div>
        </div>
    </div>
<?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
</div>
                       
<?php require_once('footer.php');  ?>
