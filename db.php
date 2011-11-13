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

/* turn off error reporting */
error_reporting(0);
/* to turn on error reporting uncomment line: */
//error_reporting(E_ERROR | E_WARNING | E_PARSE);

if(!defined('HOME_PAGE')) define('HOME_PAGE', 'http://union.ic.ac.uk/scc/finance/new/');
if(!defined('LOCAL')) define('LOCAL', false);
?> 
