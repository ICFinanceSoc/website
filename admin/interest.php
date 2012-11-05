<?php
include_once('header.php');
?>


<h1>Interests</h1>
<?php

    $result = mysql_query("SELECT * FROM 2011_Interests");
         while($myrow = mysql_fetch_assoc($result))
{
echo $myrow['InterestName'];
echo " <a href=\"editinterest.php?id=$myrow[Interest_ID]\">Edit</a>
|| <a href=\"deleteinterest.php?id=$myrow[Interest_ID]\">Delete</a><br><hr>";
 }//end of loop

?>
<BR><BR>
<a href=addinterest.php>Add Interest</a>