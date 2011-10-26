<?php
$currentpage = 'index';
require_once('header.php');
mysql_select_db($database_sql, $sql);

?>

<h1>Welcome</h1>
<img src="images/welcome.jpg" width="100%">
<BR /><BR />
<div class="displaytext">
This website is currently under construction, however will be finished shortly,... it is fully functional but please forgive any aesthetic mishaps!
</div>
<BR />        
       
       <div class=amplifytradingbox>
       <img src="images/pdf_icon.png" width="32" height="32" alt="Download Amplify Trading" />
                         <a href="downloadlatest.php">Download the latest Amplify Trading report </a><?php if(!isset($_SESSION['username'])) { ?>(you must be logged in to do so) <?php } ?>
                         | <a href="amplifytrading.php">View all reports</a>
        </div>

<?php require_once('footer.php');  ?>
