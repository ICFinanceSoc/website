<?
    $dbname = 'scc_finance';
    $user = 'scc_finance';
    $pass = 'phqxNcL6BLSfLBjr';

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


if(!defined('HOME_PAGE')) define('HOME_PAGE', 'https://www.union.ic.ac.uk/scc/finance/');
?> 
