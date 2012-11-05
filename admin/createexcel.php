<?php
$file="ICFSUSERS.xls";
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$file");
require_once("header.php");
mysql_select_db($database_sql, $sql);
  $query_users = "SELECT * FROM 2011_Members";
$users = mysql_query($query_users, $sql) or die(mysql_error());
$row_users = mysql_fetch_assoc($users);
$totalRows_users = mysql_num_rows($users);
?>

<table width="100%" border="1" cellspacing="0">
  <tr>
    <td width="13%" bgcolor="#dddddd">Login</td>
    <td width="19%" bgcolor="#dddddd">Name</td>
    <td width="24%" bgcolor="#dddddd">Email</td>
    <td width="14%" bgcolor="#dddddd">Mobile</td>
    <td width="13%" bgcolor="#dddddd">Interests</td>
  </tr>
  <?php do {
  
  ?>
  <tr>
    <td bgcolor="#eeeeee"><?php echo urldecode($row_users['Username']); ?></td>
    <td bgcolor="#eeeeee"><?php echo ldap_get_name(urldecode($row_users['Username'])); ?></td>
    <td bgcolor="#eeeeee"><?php echo ldap_get_mail(urldecode($row_users['Username'])); ?></td>
    <td bgcolor="#eeeeee"><?php echo urldecode($row_users['Mobile']); ?></td>
    <td bgcolor="#eeeeee">
    	<?php
    	$Interests = substr(urldecode($row_users['Interests']), 1, -1);
    	$Interests = explode(",", $Interests);
    	$Num = count($Interests);
    	$i =0;
    	while ($i < $Num){
    	$lookupInterest = mysql_query("SELECT * FROM 2011_Interests WHERE Interest_ID=$Interests[$i]");
    	if(mysql_num_rows($lookupInterest)>0){
    	echo mysql_result($lookupInterest,0,"InterestName");
    	echo ', ';
    	}
    	$i++;
    	}
    ?>
    
    </td>
  </tr>
  <?php } while ($row_users = mysql_fetch_assoc($users)); ?>
</table>