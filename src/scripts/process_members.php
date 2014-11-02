<?php

//CLI tool to transfer members from the old database schema to the new one.
//TXSL December 2012

$DB_NAME = 'scc_finance';
$DB_HOST = 'localhost';
$DB_USER = 'scc_finance';
$DB_PASS = '';


$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

if (mysqli_connect_errno()) 
{
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
}

$result = $mysqli->query("SELECT DISTINCT(Username), Mobile, Reg_time, Reg_method FROM 2011_Members GROUP BY Username");
echo "We currently have {$result->num_rows} unique members\n";
$unique = $result->num_rows;
$non_exist = 0;
$added = 0;
$values = NULL;
$departmentless = array();

while($row = $result->fetch_assoc())
{
    $names = ldap_get_names($row['Username']);
    if($names)
    {
        $email = ldap_get_mail($row['Username']);
        $info = ldap_get_info($row['Username']);
        if(!$info['2'])
        {
            echo "Warning! {$row['Username']} appears to not be in any department.\n";
            $departmentless[] = $row['Username'];
        }
        $values = $values . " ('{$row['Username']}', '{$row['Mobile']}', '{$info[2]}', '{$names[0]}', '{$names[1]}', '{$email}', '{$row['Reg_time']}', '{$row['Reg_method']}'),";
        echo $names[0].' '.$names[1]." moved to new table\n";
        $added++;
    }
    else
    {
        echo "Username {$row['Username']} appears to no longer exist.\n";
        $non_exist++;
    }
}
$result->close();

$values = substr_replace($values,"", -1); // So we get rid of the last comma and have valid SQL syntax.

$result = $mysqli->query("SELECT * FROM 2011_Members");
$total = $result->num_rows;
$result->close;

$diff = $total - $unique;
$num_no_dept = count($departmentless);

echo "$added users successfully added\n";
echo "$non_exist users appear to have left\n";
echo "There were $diff cases of more than one account per user\n";
echo "{$num_no_dept} appear to be in no department. They are:\n"; //These are some bizarre edge cases.
var_dump($departmentless);
echo "\nHere is what you want to import in to your new table:\n";
echo $values;
echo "\n\n";


$q ='Have you created the members table with the correct schema? (yn)'."\n";
fwrite(STDOUT, $q);
$in = trim(fgets(STDIN));
if(!strcmp($in, 'y'))
{
    $q= 'Do you want to push this data to the new table? (yn)'."\n";
    fwrite(STDOUT, $q);
    $in = trim(fgets(STDIN));
    if(!strcmp($in, 'y'))
    {
        $full = "INSERT INTO `members` (`uname`, `mobile`, `dept`, `fname`, `lname`, `email`, `regdate`, `regmethod`) VALUES". $values;
        $result = $mysqli->query($full);
        var_dump($full);
        if(!$result)
        {
            echo 'Something went wrong submitting the feedback. Database error'."\n"; //make a $this->error if you return false;
            echo $mysqli->error;
        }
        else
        {
        echo "Seems to have worked. All done. loveyoubye\n";
        }
    }
    else
    {
        echo 'loveyoubye';
    }
}
else
{
    echo 'loveyoubye';
}

