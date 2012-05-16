<?php
include_once('header.php');
$id = $_SESSION['username'];
   $result = mysql_query("DELETE FROM 2011_Members WHERE Username='$id' ",$connect);
unset($_SESSION['username']);
   $_SESSION = array(); // reset session array
      session_destroy();   // destroy session.
              echo "<meta http-equiv=Refresh content=0;url=index.php>";

										?>
