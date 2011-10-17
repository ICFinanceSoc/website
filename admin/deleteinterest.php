<?php
include_once('header.php');
$id = $_GET['id'];

	        $result = mysql_query("DELETE FROM 2011_Interests WHERE Interest_ID='$id' ",$connect);

		 

		                     

							                        echo "<meta http-equiv=Refresh content=0;url=interest.php>";

										?>
