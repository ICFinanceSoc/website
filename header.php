<?php
/* Include Files *********************/
session_name('ICFS2011');
session_start(); 
include("db.php");
include("login.php");
/*************************************/

if(!(isset($_SERVER["HTTPS"]) && !strcmp($_SERVER['SERVER_NAME'],'www.financesociety.co.uk')) && (LOCAL == false)) {
    $pageURL = "Location: https://www.financesociety.co.uk";
    header($pageURL);
}

if (!function_exists("GetSQLValueString")) {
    function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
    {
        if (PHP_VERSION < 6) {
            $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
        }

        $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

        switch ($theType) {
            case "text":
                $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
                break;    
            case "long":
            case "int":
                $theValue = ($theValue != "") ? intval($theValue) : "NULL";
                break;
            case "double":
                $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
                break;
            case "date":
                $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
                break;
            case "defined":
                $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
                break;
        }
        return $theValue;
    }
}

mysql_select_db($database_sql, $sql);
$query_platinumsponsors = "SELECT * FROM sponsors WHERE type = 'platinum' ORDER BY name ASC";
$platinumsponsors = mysql_query($query_platinumsponsors, $sql) or die(mysql_error());
$row_platinumsponsors = mysql_fetch_assoc($platinumsponsors);
$totalRows_platinumsponsors = mysql_num_rows($platinumsponsors);

mysql_select_db($database_sql, $sql);
$query_goldsponsors = "SELECT * FROM sponsors WHERE type = 'gold' ORDER BY name ASC";
$goldsponsors = mysql_query($query_goldsponsors, $sql) or die(mysql_error());
$row_goldsponsors = mysql_fetch_assoc($goldsponsors);
$totalRows_goldsponsors = mysql_num_rows($goldsponsors);

mysql_select_db($database_sql, $sql);
$query_silversponsors = "SELECT * FROM sponsors WHERE type = 'silver' ORDER BY name ASC";
$silversponsors = mysql_query($query_silversponsors, $sql) or die(mysql_error());
$row_silversponsors = mysql_fetch_assoc($silversponsors);
$totalRows_silversponsors = mysql_num_rows($silversponsors);

mysql_select_db($database_sql, $sql);
$query_learningsponsors = "SELECT * FROM sponsors WHERE type = 'learning' ORDER BY name ASC";
$learningsponsors = mysql_query($query_learningsponsors, $sql) or die(mysql_error());
$row_learningsponsors = mysql_fetch_assoc($learningsponsors);
$totalRows_learningsponsors = mysql_num_rows($learningsponsors);

$currentdate = gmdate("Y-m-d");
mysql_select_db($database_sql, $sql);
$query_Recordset1 = "SELECT * FROM events WHERE `date` >= '$currentdate' ORDER BY `date`";
$Recordset1 = mysql_query($query_Recordset1, $sql) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8" />
    <title>Imperial College Finance Society</title>
    <link rel="SHORTCUT ICON" href="favicon.ico" />
    
    <!-- Main stylesheet -->
    <!-- <link rel="stylesheet" type="text/css" href="CSS/style.css" /> -->
    <link rel="stylesheet/less" type="text/css" href="CSS/style.less?v=20131016" />
    <script src="js/less-1.1.4.min.js" type="text/javascript"></script>

    <?php if($currentpage == 'index'){ // Nivo slider themes ?>
        <link rel="stylesheet" href="themes/default/default.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="nivo-slider.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="style.css" type="text/css" media="screen" />
    <?php } ?>

    <?php if($currentpage == 'eventinformation'){
        $colname_Recordset1 = "-1";
        if (isset($_GET['ID'])) {
            $colname_Recordset1 = $_GET['ID'];
        }
        mysql_select_db($database_sql, $sql);
        $query_Recordset1 = sprintf("SELECT * FROM events WHERE ID = %s", GetSQLValueString($colname_Recordset1, "int"));
        $Recordset1 = mysql_query($query_Recordset1, $sql) or die(mysql_error());
        $row_Recordset1 = mysql_fetch_assoc($Recordset1);
    ?>
        <meta property="og:title" content="<?php echo urldecode($row_Recordset1['title']); ?>"/>
        <meta property="og:image" content="http://union.ic.ac.uk/scc/finance/images/logo-250.png"/>
        <meta property="og:site_name" content="Imperial College Finance Society"/>
        <meta property="og:description" content="<?php echo strip_tags(urldecode($row_Recordset1['information'])); ?>"/>
    <?php } ?>
</head>

<body>
    <div id="container">
    <div id="header">
        <div class="container_12 clearfix">
            <a href="<?php echo HOME_PAGE; ?>" title="Home"><h1>Imperial College Finance Society</h1></a>
            <div id="menu" class="container_12 clearfix">
                <ul class="clearfix">
                    <li><a href="about.php" <?php if($currentpage == 'about'){ echo 'class="active"'; } ?> title="">About Us</a></li>
                    <li><a href="events.php" <?php if($currentpage == 'events'){ echo 'class="active"'; } ?> title="">Events</a></li>
                    <li><a href="publications.php" <?php if($currentpage == 'publications'){ echo 'class="active"'; } ?> title="">Publications</a></li>
                    <?php /* <li><a href="http://iciclub.co.uk" <?php if($currentpage == 'subsidiaries'){ echo 'class="active"'; } ?> target="_blank" title="Imperial College Investment Club">ICIC</a></li>
                    <li><a href="asia.php" <?php if($currentpage == 'asia'){ echo 'class="active"'; } ?> title="">Asia</a></li> ?>
                    <li><a href="kenya.php" <?php if($currentpage == 'kenya'){ echo 'class="active"'; } ?> title="">Kenya</a></li> ?> */ ?>
                    <li><a href="sponsors.php" <?php if($currentpage == 'sponsors'){ echo 'class="active"'; } ?> title="">Sponsors</a></li>
                    <li><a href="team.php" <?php if($currentpage == 'management'){ echo 'class="active"'; } ?> title="">Team</a></li>
                    <li><a href="icic.php" <?php if($currentpage == 'icic'){ echo 'class="active"'; } ?> title="">ICIC</a></li>
                    <li><a href="tec.php" <?php if($currentpage == 'tec'){ echo 'class="active"'; } ?> title="">TEC</a></li>
                    <li><a href="media.php" <?php if($currentpage == 'media'){ echo 'class="active"'; } ?> title="">Media</a></li>
		  <!--<?php if(isset($_SESSION[username])){ }else { ?>
                    <li><a href="register.php" <?php if($currentpage == 'register'){ echo 'class="active"'; } ?> title="">Register</a></li>
                    <?php } ?>-->
                </ul>
            </div>
        </div>
    </div>

    <?php if($currentpage == 'index'){ ?>
        <div id="wrapper">
            <div class="slider-wrapper theme-default">
                <div class="ribbon"></div>
                <div id="slider" class="nivoSlider">
                    <?php if($totalRows_Recordset1 > 0) {   ?>
                        <a href="eventinformation.php?ID=<?php echo mysql_result($Recordset1,0,"ID"); ?>">
                    <?php } else { ?>
                        <a href=pastevents.php>
                    <?php } ?>
                    <img src="images/slider1.jpg" alt="" title="#htmlcaption1"/>
                    </a>
                    <?php if($totalRows_Recordset1 > 1) {   ?>
                        <a href="eventinformation.php?ID=<?php echo mysql_result($Recordset1,1,"ID"); ?>">
                    <?php } else { ?>
                        <a href=publications.php>
                    <?php } ?>
                    <img src="images/slider2.jpg" alt="" title="#htmlcaption2"/>
                    </a>
                    <?php if($totalRows_Recordset1 > 2) {   ?>
                        <a href="eventinformation.php?ID=<?php echo mysql_result($Recordset1,2,"ID"); ?>">
                    <?php } else { ?>
                        <a href=sponsors.php>
                    <?php } ?>
                    <img src="images/slider3.jpg" alt="" title="#htmlcaption4"/>
                    </a>
                    <?php if($totalRows_Recordset1 > 3) {   ?>
                        <a href="eventinformation.php?ID=<?php echo mysql_result($Recordset1,3,"ID"); ?>">
                    <?php } else { ?>
                        <a href=subsidiaries.php>
                    <?php } ?>
                    <img src="images/slider4.jpg" alt="" title="#htmlcaption5"/>
                    </a>
                    <?php if(isset($_SESSION['username'])){ } else {?>
                        <a href="requirelogin.php">
                    <?php } ?>
                        <img src="images/slider5.jpg" alt="" title="#htmlcaption3"/>
                    </a>
                </div>

                <div id="htmlcaption1" class="nivo-html-caption">
                    <?php if($totalRows_Recordset1 > 0) {  ?>
                        <h4> 
                            <?php echo urldecode(mysql_result($Recordset1,0,"title")); ?>&nbsp;
                            <span id="date"><?php echo date("d F Y",strtotime(mysql_result($Recordset1,0,"date"))); ?>, <?php echo substr(mysql_result($Recordset1,0,"start"),0,-3); ?></span>
                        </h4>
                        <?php if(isset($_SESSION[username]) && !LOCAL){ ?>
                            <?php $name = ldap_get_names($_SESSION[username]); echo $name[0]; ?>, click the image for more information, or <a href="registereventscript.php?ID=<?php echo mysql_result($Recordset1,0,"ID"); ?>">here to register to the event in one-click</a>.
                        <?php } else { ?>
                        Click the logo for more information. To attend the event, please sign in and register your interest.
                        <?php } ?>
                    <?php } else { ?>
                    <h4>What have we achieved?</h4>
                    Take a look at some of the events we've held this year.
                    <?php }   ?>
                </div>

                <div id="htmlcaption2" class="nivo-html-caption">
                    <?php if($totalRows_Recordset1 > 1) {  ?>
                        <h4> 
                            <?php echo urldecode(mysql_result($Recordset1,1,"title")); ?>&nbsp;
                            <span id="date"><?php echo date("d F Y",strtotime(mysql_result($Recordset1,1,"date"))); ?>, <?php echo substr(mysql_result($Recordset1,1,"start"),0,-3); ?></span>
                        </h4>
                        <?php if(isset($_SESSION[username]) && !LOCAL){ ?>
                            <?php $name = ldap_get_names($_SESSION[username]); echo $name[0]; ?>, click the image for more information, or <a href="registereventscript.php?ID=<?php echo mysql_result($Recordset1,1,"ID"); ?>">here to register to the event in one click</a>.
                        <?php } else { ?>
                        Click for more information. To attend the event, please sign in.
                        <?php } ?>
                    <?php } else { ?>
                        <h4>Read up on Finance</h4>
                        <p>Have a read through some of our publications to help you get to grips with the world of Finance.</p>
                    <?php }   ?>
                </div>

                <div id="htmlcaption3" class="nivo-html-caption">
                    <?php if(isset($_SESSION[username])){ ?>
                    <h4>Thank you for being a member</h4>
                    Did you know that you can sign up to our next events in one click from both your emails and our homepage? Try it out!
                    <?php } else {  ?>
                    <h4>Don't be a stranger</h4>
                    Are you not yet a member of the ICFS, or have you just not logged in? By signing in you can attend events in one click. If this is your personal computer, you can
                    sign in forever by checking 'Remember Me'.
                    <?php } ?>
                </div>

                <div id="htmlcaption4" class="nivo-html-caption">
                    <?php if($totalRows_Recordset1 > 2) {  ?>
                    <h4>
                        <?php echo urldecode(mysql_result($Recordset1,2,"title")); ?>&nbsp;
                        <span id="date"><?php echo date("d F Y",strtotime(mysql_result($Recordset1,2,"date"))); ?>, <?php echo substr(mysql_result($Recordset1,2,"start"),0,-3); ?></span>
                    </h4>
                    <?php if(isset($_SESSION[username]) && !LOCAL){ ?>
                    <?php $name = ldap_get_names($_SESSION[username]); echo $name[0]; ?>, click the image for more information, or <a href="registereventscript.php?ID=<?php echo mysql_result($Recordset1,2,"ID"); ?>">here to register for the event in one click.</a>
                    <?php } else { ?>
                    Click for more information. To attend the event, please sign in.
                    <?php } ?>
                    <?php } else { ?>
                    <h4>Company Profiles</h4>
                    Get all the information on companies you could apply to for internships, placements or even jobs. Our Sponsors post helpful information
                    to help you with your career.
                    <?php }   ?>
                </div>

                <div id="htmlcaption5" class="nivo-html-caption">
                    <?php if($totalRows_Recordset1 > 3) {  ?>
                    <h4>
                        <?php echo urldecode(mysql_result($Recordset1,3,"title")); ?>&nbsp;
                        <span id="date"><?php echo date("d F Y",strtotime(mysql_result($Recordset1,3,"date"))); ?>, <?php echo substr(mysql_result($Recordset1,3,"start"),0,-3); ?></span>
                    </h4>
                    <?php if(isset($_SESSION[username]) && !LOCAL){ ?>
                    <?php $name = ldap_get_names($_SESSION[username]); echo $name[0]; ?>, click the image for more information, or <a href="registereventscript.php?ID=<?php echo mysql_result($Recordset1,3,"ID"); ?>">here to register in one click.</a>
                    <?php } else { ?>
                    Click for more information. To attend the event, please sign in.
                    <?php } ?>
                    <?php } else { ?>
                    <h4>More to us than meets the eye</h4>
                    ICFS has three subsidiary clubs that specialise in Trading and Entrepreneurial skills.<?php }   ?>
                </div>
                <div class=shadow></div>
            </div>	
        </div>
    <?php } ?>

<!-- <div class="line"></div> -->
<div class="widthbox">
    <div class="container_12">
    <div class="contentcolumn grid_12">
