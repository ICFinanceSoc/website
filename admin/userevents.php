<?php require_once('header.php');

?>
     <h1>User Profile</h1>
     <table>
   <?php
$username = $_GET['User'];
$getprofile = mysql_query("SELECT * FROM 2011_Members WHERE Username='$_GET[User]'");
//Mobile, Interests

$mob = mysql_result($getprofile,0,"Mobile");
$inter = substr(mysql_result($getprofile,0,"Interests"), 1, -1);
$inter = explode(",", $inter);
$ninter = count($inter);

echo '<tr><td>Name:<td>' . ldap_get_name($username);
echo '<tr><td>Mobile:<td>' . $mob;
echo '<tr><td>Interests:<td>';


$i=0;
while ($i<$ninter){

$LookupInterests = mysql_query("SELECT * FROM 2011_Interests WHERE Interest_ID='$inter[$i]'");
$textversion=mysql_result($LookupInterests,0,"InterestName");
echo $textversion;
echo '<BR>';
$i++;
}

?>
</table>

<?php

echo '<BR><BR>Attended events:';

	$gethistory = mysql_query("SELECT * FROM 2011_Attendance WHERE Username='$_GET[User]'");
 	$num_gethistory = mysql_num_rows($gethistory);
	$row_gethistory = mysql_fetch_assoc($gethistory);
	$i =0;
	while($i < $num_gethistory){
		$id = mysql_result($gethistory,$i,"Event_ID");
		mysql_select_db($database_sql, $sql);
		$query_Recordset2 = "SELECT * FROM events WHERE ID='$id'";
		$Recordset2 = mysql_query($query_Recordset2, $sql) or die(mysql_error());
		$row_Recordset2 = mysql_fetch_assoc($Recordset2);
		$totalRows_Recordset2 = mysql_num_rows($Recordset2);
		 if($totalRows_Recordset2 > 0) {
					  $initial = '';
					  do {
					  $new = date("F Y",strtotime($row_Recordset2['date']));
					  if($initial != $new) {
					   echo "<h3>".date("F Y",strtotime($row_Recordset2['date']))."</h3></br>"; 
                       } 
					   $initial = $new;
					   ?>
                          <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td class="displaytext"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="288" bgcolor="#f5f5f5" class="writingnopadding"><strong><?php echo urldecode($row_Recordset2['title']); ?></strong></td>
                                  <td width="250" bgcolor="#f5f5f5" class="writingnopadding"><?php echo date("d F Y",strtotime($row_Recordset2['date'])); ?> <?php echo substr($row_Recordset2['start'],0,-3); ?> - <?php echo substr($row_Recordset2['end'],0,-3); ?></td>
                                  </tr>
                                </table></td>
                              </tr>
                            </table>
                          <?php } while ($row_Recordset2 = mysql_fetch_assoc($Recordset2));
                          }
	$i++;
	}
	
 ?>