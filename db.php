<?
if(file_exists(getcwd().'/db.local.php')) {
    require_once('db.local.php'); 
} else {
    $dbname = 'scc_finance';
    $user = 'scc_finance';
    $pass = 'phqxNcL6BLSfLBjr';
}

$connect = mysql_connect('localhost', $user, $pass);
$sql = $connect;
if (!$connect) {
    die('Could not connect: ' . mysql_error());
}
mysql_select_db($dbname, $connect);

?> 
