<?
$currentpage = urldecode($row_Recordset1['title']); 
$currentpage = 'eventinformation';
include_once('header.php');
$colname_Recordset1 = "-1";
if (isset($_GET['ID'])) {
    $colname_Recordset1 = $_GET['ID'];
}
mysql_select_db($database_sql, $sql);
$query_Recordset1 = sprintf("SELECT * FROM events WHERE ID = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $sql) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>

<div id="<?php echo $currentpage; ?>">
    <h3><?php echo urldecode($row_Recordset1['title']); ?></h3>
    <?php if(isset($_GET['message'])) { ?>
        <?php echo $_GET['message']; ?>
    <?php } ?>
    <div class="informationbox clearfix">
        <div class="grid_3 alpha">
            <h3>Information: </h3>
        </div>
        <div class="grid_9 omega">
            <ul>
                <li><span class="title">Date:</span> <?php echo date("d M Y",strtotime($row_Recordset1['date'])); ?></li> 
                <li><span class="title">Time:</span> <?php echo substr($row_Recordset1['start'],0,-3); ?> - <?php echo substr($row_Recordset1['end'],0,-3); ?></li>
                <li><span class="title">Venue:</span> <?php echo urldecode($row_Recordset1['location']); ?></li>
                <li><span class="title">Organisers:</span> <?php echo urldecode($row_Recordset1['organisers']); ?></li>
            </ul>
        </div>
    </div>
    <div class="eventinfo clearfix">
        <div class="grid_3 alpha">
            <h3>About: </h3>
        </div>
        <div class="grid_9 omega">
            <?php echo urldecode($row_Recordset1['information']); ?>
        </div>
    </div>
    <div class="registerbox">
        <?php
            if(isset($_SESSION['username'])) {
                $loggedin = $_SESSION['username']; 
                $eventid = $row_Recordset1['ID'];
                mysql_select_db($database_sql, $sql);
                $query_registerall = "SELECT * FROM 2011_Attendance WHERE Username = '$loggedin' AND Event_ID='$eventid'";
                $registerall = mysql_query($query_registerall, $sql) or die(mysql_error());
                $row_registerall = mysql_fetch_assoc($registerall);
                $totalRows_registerall = mysql_num_rows($registerall);

                if($totalRows_registerall > 0) { ?>
                    <h3>» <a href="unregisterevent.php?ID=<?php echo $row_Recordset1['ID']; ?>">Unregister from event</a></h3>
            <?php } else {
                if($row_Recordset1['Open'] == 'on'){ ?>
                    <h3>» <a href="registereventscript.php?ID=<?php echo $row_Recordset1['ID']; ?>" id="registerevent">Register to  event </a></h3>
                    <p>Once registered to this event you will receive email updates if the event is altered and a reminder.</p>
                <? } else { ?>
                    <h3>» Registration is currently disabled.</h3>
                <? }
            } ?>
        <?php } else { ?>
            <h3>» Your must be logged in to register for an event.</h3>
            <p>Once registered to this event you will receive email updates if the event is altered and a reminder. Registration takes twenty seconds tops.</p>
        <?php } ?>
    </div>
</div>
<?php require_once('footer.php');  ?>
