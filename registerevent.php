<?php
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

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="sponsorsbox"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td class="boxtitle"><h3>Register to event</h3></td>
      </tr>
      <tr>
        <td class="padding5"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td class="displaytext"><p>Fed up of entering your personal information every time you want to register to an event? <a href="javascript:parent.window.location='../login.php?revert=<?php echo urlencode("/events/eventinformation.php?ID=".$_GET['ID']); ?>'"><br />
              Create and account </a>or<a href="javascript:parent.window.location='../login.php?revert=<?php echo urlencode("/events/eventinformation.php?ID=".$_GET['ID']); ?>'"> login</a> today and register to events with a click of a button. You can create an account in less than 30 seconds.</p></td>
          </tr>
        </table>
          <br />
          <form id="event" name="event" method="post" action="registereventscript.php">
            <span class="writingnopadding"> </span>
            <table width="100%" border="0" cellspacing="5" cellpadding="5">
              <tr>
                <td bgcolor="#f5f5f5" class="writingnopadding">Name</td>
                <td bgcolor="#f5f5f5"><input value="<?php if(isset($_SESSION['eventname'])) { echo $_SESSION['eventname']; } ?>" type="text" name="eventname" id="eventname" /></td>
              </tr>
              <tr>
                <td bgcolor="#f5f5f5" class="writingnopadding">Surname</td>
                <td bgcolor="#f5f5f5"><input value="<?php if(isset($_SESSION['eventsurname'])) { echo $_SESSION['eventsurname']; } ?>" type="text" name="eventsurname" id="eventsurname" /></td>
              </tr>
              <tr>
                <td width="30%" bgcolor="#f5f5f5" class="writingnopadding">Valid email address</td>
                <td width="70%" bgcolor="#f5f5f5">
                  <input name="eventemail" type="text" id="eventemail" value="<?php if(isset($_SESSION['eventemail'])) { echo $_SESSION['eventemail']; } ?>" /></td>
              </tr>
              <tr>
                <td bgcolor="#f5f5f5" class="writingnopadding">Course</td>
                <td bgcolor="#f5f5f5"><input value="<?php if(isset($_SESSION['eventcourse'])) { echo $_SESSION['eventcourse']; } ?>" type="text" name="eventcourse" id="eventcourse" /></td>
              </tr>
              <tr>
                <td bgcolor="#f5f5f5" class="writingnopadding">Year of study</td>
                <td bgcolor="#f5f5f5"><input value="<?php if(isset($_SESSION['eventyear'])) { echo $_SESSION['eventyear']; } ?>" type="text" name="eventyear" id="eventyear" /></td>
              </tr>
              <tr>
                <td bgcolor="#f5f5f5" class="writingnopadding">University</td>
                <td bgcolor="#f5f5f5"><label for="eventuniversity"></label>
                  <input value="<?php if(isset($_SESSION['eventuniversity'])) { echo $_SESSION['eventuniversity']; } else { ?>Imperial College London<?php } ?>" type="text" name="eventuniversity" id="eventuniversity" /></td>
              </tr>
              <?php if($_SESSION['eventerrors'] != '') { $eventerrors1 = urldecode($_SESSION['eventerrors']);
							  $eventerrors = unserialize($eventerrors1);?>
              <tr>
                <td colspan="2" class="writingnopadding"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <?php foreach($eventerrors as $key => $item) { ?>
                  <tr>
                    <td class="alert"><?php echo $item; ?></td>
                  </tr>
                  <?php } ?>
                </table></td>
              </tr>
              <?php } ?>
              <tr>
                <td class="writingnopadding">&nbsp;</td>
                <td><input type="submit" name="button2" id="button2" value="Register" />
                  <input name="eventrevert" type="hidden" id="eventrevert" value="<?php echo $_GET['revert']; ?>" />
                  <input name="ID" type="hidden" id="ID" value="<?php echo $row_Recordset1['ID']; ?>" /></td>
              </tr>
            </table>
          </form></td>
      </tr>
    </table></td>
  </tr>
</table>
 <?php require_once('footer.php');  ?>
<?php
mysql_free_result($Recordset1);
?>
