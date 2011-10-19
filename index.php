<?php
    $currentpage = 'index';
    require_once('header.php');
    mysql_select_db($database_sql, $sql);
    $query_homeregion = "SELECT * FROM homepage WHERE ID = 1";
    $homeregion = mysql_query($query_homeregion, $sql) or die(mysql_error());
    $row_homeregion = mysql_fetch_assoc($homeregion);
    $totalRows_homeregion = mysql_num_rows($homeregion);
?>

<h1><?php echo urldecode($row_homeregion['title']); ?></h1>
<!-- <img src="images/welcome.jpg" width="100%"> -->
<div class="displaytext">
    <?php echo stripslashes(urldecode($row_homeregion['body'])); ?>
</div>
        
<div class=amplifytradingbox>
    <img src="images/pdf_icon.png" width="32" height="32" alt="Download Amplify Trading" />
    <a href="downloadlatest.php">Download the latest Amplify Trading report </a><?php if(!isset($_SESSION['username'])) { ?>(you must be logged in to do so) <?php } ?>
    | <a href="amplifytrading.php">View all reports</a>
</div>

<?php require_once('footer.php');  ?>
