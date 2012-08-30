<?
$cwd = getcwd();
/*$cwdlength = strlen($cwd);
if (substr($cwd, -5) === 'admin') {
	$wroot = substr_replace($cwd, '', -6);
}
else{
	$wroot = $cwd;
}*/

/*if(file_exists($wroot.'/db.local.php')) {
    require_once('db.local.php');
} else {*/
define('location', 'dev');

if(location == 'dev'){
    $dbname = 'scc_finance_dev';
    $user = 'scc_finance';
    $pass = 'phqxNcL6BLSfLBjr';
    define('HOME_PAGE', 'https://www.union.ic.ac.uk/scc/finance/dev/');
} elseif(location == 'live'){
    $dbname = 'scc_finance';
    $user = 'scc_finance';
    $pass = 'phqxNcL6BLSfLBjr';
    define('HOME_PAGE', 'https://www.union.ic.ac.uk/scc/finance/');
} elseif(location == 'local'){
	$dbname = 'scc_finance_dev';
    $user = 'scc_finance';
    $pass = 'password';
    define('HOME_PAGE', 'http://localhost/finance/');
}

$connect = mysql_connect('localhost', $user, $pass);
$sql = $connect;
if (!$connect) {
    die('Could not connect: ' . mysql_error());
}
mysql_select_db($dbname, $connect);

/* turn off error reporting */
//error_reporting(0);
/* to turn on error reporting uncomment line: */
error_reporting(E_ERROR | E_WARNING | E_PARSE);

if(!defined('HOME_PAGE')) define('HOME_PAGE', 'https://www.union.ic.ac.uk/scc/finance/');
if(!defined('LOCAL')) define('LOCAL', false);
?>
