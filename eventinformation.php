<?
$currentpage = urldecode($row_Recordset1['title']); 
$currentpage = 'events';
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
    <h1><?php echo urldecode($row_Recordset1['title']); ?></h1>
    
    
    <?php if(isset($_GET['message'])) { ?>
                  <?php echo $_GET['message']; ?>
                  <?php } ?>
             
             
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td class="boxtitle"><h3>About</h3></td>
                            </tr>
                          <tr>
                            <td class="displaytext"><?php echo urldecode($row_Recordset1['information']); ?></td>
                            </tr>
                        </table>
<BR>                      
        <div class="sponsorbox">
                          <?php
						  if(isset($_SESSION['username'])) {
						  $loggedin = $_SESSION['username']; 
						  $eventid = $row_Recordset1['ID'];
mysql_select_db($database_sql, $sql);
$query_registerall = "SELECT * FROM 2011_Attendance WHERE Username = '$loggedin' AND Event_ID='$eventid'";
$registerall = mysql_query($query_registerall, $sql) or die(mysql_error());
$row_registerall = mysql_fetch_assoc($registerall);
$totalRows_registerall = mysql_num_rows($registerall);

if($totalRows_registerall > 0) {
 ?>
 <h3>» <a href="unregisterevent.php?ID=<?php echo $row_Recordset1['ID']; ?>">Unregister from event</a></h3>
 <?php } else {
 if($row_Recordset1['Open'] == 'on'){
  ?>
 <h3>» <a href="registereventscript.php?ID=<?php echo $row_Recordset1['ID']; ?>" id="registerevent">Register to  event </a></h3>
 <p>Once registered to this event you will receive email updates if the event is altered and a reminder.</p>
 <? } else {
 ?>
  <h3>» Registration is currently disabled.</h3>
  <? }
 } ?>
 <?php } else { ?>
 <h3>» Your must be logged in to register for an event.</h3>
 <p>Once registered to this event you will receive email updates if the event is altered and a reminder. Registration takes twenty seconds tops.</p>
 <?php } ?>
                          </div>
                          <br />
                          <div class="sponsorbox">
                            <h3>Information</h3>
                            <h5>Date: <?php echo date("d/M/Y",strtotime($row_Recordset1['date'])); ?><br /> 
                              Time: <?php echo substr($row_Recordset1['start'],0,-3); ?> - <?php echo substr($row_Recordset1['end'],0,-3); ?></h5>
                          <p>Venue: <?php echo urldecode($row_Recordset1['location']); ?><br />
                            <br />
                            <?php echo urldecode($row_Recordset1['organisers']); ?></p>
                    </div></td>
                      </tr>
                </table></td>
                </tr>
              </table>
             <?php require_once('footer.php');  ?>