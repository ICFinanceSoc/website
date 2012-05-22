<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>VIEW ALL MEMBERS</title>
</head>

<body>
<p>
  <?php
require_once("header.php");
mysql_select_db($database_sql, $sql);
  $query_users = "SELECT * FROM 2011_Members";
$users = mysql_query($query_users, $sql) or die(mysql_error());
$row_users = mysql_fetch_assoc($users);
$totalRows_users = mysql_num_rows($users);
?>
</p>
<p><a href="createexcel.php" target="_blank">DOWNLOAD AS EXCEL FILE</a></p>
<link href="../CSS/adminstyles.css" rel="stylesheet" type="text/css">
<table width="100%" border="1" cellpadding="5" cellspacing="0">
  <tr>
    <td width="13%" bgcolor="#dddddd">Login</td>
    <td width="19%" bgcolor="#dddddd">Name</td>
    <td width="24%" bgcolor="#dddddd">Email</td>
    <td width="14%" bgcolor="#dddddd">Mobile</td>
    <td width="13%" bgcolor="#dddddd">Interests</td>
<td width="3% bgcolor=#dddddd">X</td>
  </tr>

  <?php do { 
  
  ?>
  <tr>
    <td bgcolor="#eeeeee"><a href=userevents.php?User=<?php echo urldecode($row_users['Username']); ?>><?php echo urldecode($row_users['Username']); ?></a></td>
    <td bgcolor="#eeeeee"><?php echo ldap_get_name(urldecode($row_users['Username'])); ?></td>
    <td bgcolor="#eeeeee"><?php echo ldap_get_mail(urldecode($row_users['Username'])); ?></td>
    <td bgcolor="#eeeeee"><?php echo urldecode($row_users['Mobile']); ?></td>
    <td bgcolor="#eeeeee">
    	<?php 
    	if($row_users['Interests'] <> ','){
    	$Interests = substr(urldecode($row_users['Interests']), 1, -1);
    	$Interests = explode(",", $Interests);
    	$Num = count($Interests);
    	$i =0;
    	while ($i < $Num){
    	$lookupInterest = mysql_query("SELECT * FROM 2011_Interests WHERE Interest_ID=$Interests[$i]");
    	if(mysql_num_rows($lookupInterest)>0){
    	echo mysql_result($lookupInterest,0,"InterestName");
    	echo '<BR>';
    	}
    	$i++;
    	}
    	}

    ?>
    
    </td>
    <td bgcolor="#eeeeee"><a href="deletemember.php?id=<?php echo urldecode($row_users['Username']); ?>">X</a></td>
  </tr>
  <?php } while ($row_users = mysql_fetch_assoc($users)); ?>
</table>
</body>
</html>
