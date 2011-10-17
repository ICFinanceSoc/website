<?php
include_once('header.php');
$id = $_GET['id'];

	        $result = mysql_query("DELETE FROM 2011_Members WHERE Username='$id' ",$connect);

		 

		                     

							                        echo "<meta http-equiv=Refresh content=0;url=viewmembers.php>";

										?>
