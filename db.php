<?
/*   Begin definitions   */



$dbname = 'scc_finance_dev';
$user = 'scc_finance';
$pass = 'DfxVaJvZEGdYW4jv';


// Define your homepage here. The PHP will likely push all traffic through this address
define('HOME_PAGE', 'https://www.union.ic.ac.uk/scc/finance/dev');

// Useful for skipping union login etc, but only on a local version, not any hosted one (obvs)
define('LOCAL', false);

// Comment out this line to turn off error reporting (do this for the production site)
error_reporting(E_ERROR | E_WARNING | E_PARSE);



/*   End definitions   */




$connect = mysql_connect('localhost', $user, $pass);
$sql = $connect;
if (!$connect) {
    die('Could not connect: ' . mysql_error());
}
mysql_select_db($dbname, $connect);

//These lines are here for safety, in case for some reason they have not been defined above 

if(!defined('HOME_PAGE')) define('HOME_PAGE', 'https://www.union.ic.ac.uk/scc/finance/');
if(!defined('LOCAL')) define('LOCAL', false);

?>
