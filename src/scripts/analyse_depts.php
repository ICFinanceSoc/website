<?php

//CLI tool to transfer members from the old database schema to the new one.
//TXSL December 2012

$DB_NAME = 'scc_finance';
$DB_HOST = 'localhost';
$DB_USER = '';
$DB_PASS = '!';


$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

if (mysqli_connect_errno()) 
{
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
}

$result = $mysqli->query("SELECT DISTINCT(Username), Mobile, Reg_time, Reg_method FROM 2011_Members GROUP BY Username");
echo "We currently have {$result->num_rows} unique members\n";
$unique = $result->num_rows;
$deptcount = array();

while($row = $result->fetch_assoc())
{
    echo "Getting information for {$row['Username']}\n";
    $info = ldap_get_info($row['Username']);
    $dept = $info[2];
    if(array_key_exists($dept, $deptcount))
    {
        $deptcount[$dept] = $deptcount[$dept] + 1;
    }
    else
    {
        $deptcount[$dept] = 1;
    }
}
$result->close();

foreach ($deptcount as $dept => $tot)
{
    echo $tot . '  ' . $dept . "\n";
}