<?
error_reporting(E_ALL);
$dbname = 'scc_finance';
$user = 'scc_finance';
$pass = 'phqxNcL6BLSfLBjr';
$connect = mysql_connect('localhost', $user, $pass);
if (!$connect) {
    die('Could not connect: ' . mysql_error());
        }
        mysql_select_db($dbname, $connect) or die(mysql_error());
        

$Listusers = mysql_query("SELECT * FROM `convert`");
echo mysql_error();
$num=mysql_num_rows($Listusers);

for ($i=0; $i < $num; $i++) {
$user=mysql_result($Listusers,$i,"name");
$id=mysql_result($Listusers,$i,"id");
$user1 = $user . '@imperial.ac.uk';
$filter="(|(uid=$user)(mail=$user1))";
$conn = ldap_connect("addressbook.ic.ac.uk") or die("Could not connect to server");
$r = ldap_bind($conn) or die("Could not bind to server");
$dn = "o=Imperial College,c=GB";
$justthese = array("uid");
$sr=ldap_search($conn, $dn, $filter, $justthese);
$info = ldap_get_entries($conn, $sr);
$department = $info[0]["uid"][0];
echo $department;
ldap_close($conn);
if($department <> ''){
mysql_query("UPDATE `convert` SET username='$department' WHERE id=$id") or die("Error setting department");
}
}
?>

