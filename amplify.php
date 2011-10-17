<?php require_once('../Connections/sql.php'); session_start(); ?>
<?php
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
$query_learningsponsors = "SELECT * FROM sponsors WHERE type = 'learning' ORDER BY name ASC";
$learningsponsors = mysql_query($query_learningsponsors, $sql) or die(mysql_error());
$row_learningsponsors = mysql_fetch_assoc($learningsponsors);
$totalRows_learningsponsors = mysql_num_rows($learningsponsors);

mysql_select_db($database_sql, $sql);
$query_Recordset1 = "SELECT * FROM amplifytrading ORDER BY `date` DESC";
$Recordset1 = mysql_query($query_Recordset1, $sql) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/main.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<!-- InstanceBeginEditable name="doctitle" -->
<title>Amplify Trading - Imperial College Finance Society</title>
<!-- InstanceEndEditable -->
<?php

$domain = $_SERVER['HTTP_HOST'];
if($domain == 'icfinancesociety.com' || $domain == 'www.icfinancesociety.com') {
	
} else {
	header("Location: http://icfinancesociety.com");
}?>
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
<link href="../CSS/styles.css" rel="stylesheet" type="text/css" />
</head>

<body>

<!-- InstanceBeginEditable name="pagename" --><?php $currentpage = 'amplify'; ?><!-- InstanceEndEditable -->

<div class="topbg">
<div class="bannerbg">
<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
      <td class="logobox"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td class="mainbanner">
                    <div class="loginbox"><?php if(isset($_SESSION['username'])) { ?>
                      <?php echo $_SESSION['username']; ?> | <a href="#" onclick="window.open('../changepassword.php','Password','width=500, height=300')">Change password</a> | <a href="#" onclick="window.open('../updateinfo.php','Update information','width=500,height=400');">Update information</a> | <a href="../logout.php?revert=<?php echo urlencode($_SERVER['REQUEST_URI']) ?>">Logout</a>
                      <?php } else { ?>
                      <?php if($currentpage != 'login') { ?>
                      <a href="../login.php?revert=<?php echo urlencode($_SERVER['REQUEST_URI']) ?>">
                        <?php } ?>
                        Login to ICFS
                        <?php if($currentpage != 'login') { ?>
                        </a>
                      <?php } ?>
                      <?php } ?>
                      | <a href="../mailinglist.php">Join Mailing List</a> | <a href="../contact">Contact Us</a><br />
<img src="../images/spacer.gif" width="1000" height="1" /></div></td>
          </tr>
      </table></td>
    </tr>
</table>
</div>
</div>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="main_bg"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td class="menutabsides">&nbsp;</td>
        <td onclick="javascript:window.location = '../'" onmouseover="if(this.className != 'menutabover') { this.className='menutabhover'; }" onmouseout="if(this.className != 'menutabover') { this.className='menutab'; }" width="125" class="menutab<?php if($currentpage == 'home') { ?>over<?php } ?>">Home</td>
        <td onclick="javascript:window.location = '../about'"  onmouseover="if(this.className != 'menutabover') { this.className='menutabhover'; }" onmouseout="if(this.className != 'menutabover') { this.className='menutab'; }" width="125" class="menutab<?php if($currentpage == 'about') { ?>over<?php } ?>">About Us</td>
        <td onclick="javascript:window.location = '../events'"  onmouseover="if(this.className != 'menutabover') { this.className='menutabhover'; }" onmouseout="if(this.className != 'menutabover') { this.className='menutab'; }" width="125" class="menutab<?php if($currentpage == 'events') { ?>over<?php } ?>">Events</td>
        <td onclick="javascript:window.location = '../publications'"  onmouseover="if(this.className != 'menutabover') { this.className='menutabhover'; }" onmouseout="if(this.className != 'menutabover') { this.className='menutab'; }" width="125" class="menutab<?php if($currentpage == 'publications') { ?>over<?php } ?>">Publications</td>
        <td onclick="javascript:window.location = '../subsidiaries'"  onmouseover="if(this.className != 'menutabover') { this.className='menutabhover'; }" onmouseout="if(this.className != 'menutabover') { this.className='menutab'; }" width="125" class="menutab<?php if($currentpage == 'subsidiaries') { ?>over<?php } ?>">Subsidiaries</td>
        <td onclick="javascript:window.location = '../learning'"  onmouseover="if(this.className != 'menutabover') { this.className='menutabhover'; }" onmouseout="if(this.className != 'menutabover') { this.className='menutab'; }" width="125" class="menutab<?php if($currentpage == 'learning') { ?>over<?php } ?>">Learning</td>
        <td onclick="javascript:window.location = '../sponsors'"  onmouseover="if(this.className != 'menutabover') { this.className='menutabhover'; }" onmouseout="if(this.className != 'menutabover') { this.className='menutab'; }" width="125" class="menutab<?php if($currentpage == 'sponsors') { ?>over<?php } ?>">Sponsors</td>
        <td onclick="javascript:window.location = '../management'"  onmouseover="if(this.className != 'menutabover') { this.className='menutabhover'; }" onmouseout="if(this.className != 'menutabover') { this.className='menutab'; }" width="125" class="menutab<?php if($currentpage == 'management') { ?>over<?php } ?>">Management</td>
        <td class="menutabsides">&nbsp;</td>
      </tr>
    </table>
      <table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td><table width="1000" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="700" class="maincolumn"><!-- InstanceBeginEditable name="main" -->
              <div class="amplifytradingboxbig">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td class="boxtitle"><h1>Amplify Trading</h1></td>
                    </tr>
                  <tr>
                    <td class="displaytext"><p>We have partnered with Amplify Trading to bring to you a regular up-to-date report from the world of trading.<?php if(!isset($_SESSION['username'])) { ?><br /><br />
				    <span class="message">You must be <a href="../login.php?revert=/learning">logged in</a> to view protected files.</span><br /><?php } ?>
                    </p>
                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td class="downloadbox"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td width="5%"><img src="../images/pdf_icon.png" width="32" height="32" alt="Download Amplify Trading" /></td>
                              <td width="95%" class="displaytext"><a href="../amplifytrading/downloadlatest.php">Download the latest Amplify Trading report</a></td>
                              </tr>
                          </table></td>
                        </tr>
                      </table>
                      <?php if($totalRows_Recordset1 > 1) {
						   ?>
                      <h3>Past reports:</h3>
                      <table width="100%" border="0" cellspacing="0" cellpadding="0"><?php $count = 0; do { $count++; if($count > 1) { ?>
                        <tr>
                          <td width="2%" class="displaytext"><img src="../images/pdf_icon.png" width="20" height="20" alt="Download Amplify Trading report" /></td>
                          <td width="98%" class="displaytext"><?php echo date("d F Y", strtotime($row_Recordset1['date'])); ?> - <a href="downloadamplify.php?ID=<?php echo $row_Recordset1['ID']; ?>">download</a></td>
                        </tr>
                        <?php } } while($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
                      </table>
                      <?php } ?>
                      
                      <h3><br />
                      </h3></td>
                    </tr>
                </table>
              </div>
            <!-- InstanceEndEditable --></td>
            <td width="300" class="sponsorscolumn"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td class="displaytext"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td class="sponsorheader">Platinum sponsors:</td>
                    </tr>
                  <tr>
                    <td>
                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <?php
						$pcount = 0; do { $pcount++; ?>
                          <td class="sponsorsurround"><a href="../sponsors/sponsordetail.php?ID=<?php echo $row_platinumsponsors['ID']; ?>"><img src="../sponsorlogos/<?php echo $row_platinumsponsors['logo']; ?>thumb" width="100" alt="" /></a>&nbsp;</td> <?php if($pcount == 2) { echo "</tr>"; $pcount = 0; } ?>
                          <?php } while ($row_platinumsponsors = mysql_fetch_assoc($platinumsponsors)); ?>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  <tr>
                    <td class="sponsorheader">Gold sponsors:</td>
                    </tr>
                  <tr>
                    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <?php
						$gcount = 0; do { $gcount++; ?>
                        <td class="sponsorsurround"><a href="../sponsors/sponsordetail.php?ID=<?php echo $row_goldsponsors['ID']; ?>"><img src="../sponsorlogos/<?php echo $row_goldsponsors['logo']; ?>thumb" width="100" alt="" /></a>&nbsp; </td>
                        <?php if($gcount == 2) { echo "</tr>"; $gcount = 0; } ?>
                        <?php } while ($row_goldsponsors = mysql_fetch_assoc($goldsponsors)); ?>
                        </tr>
                      </table></td>
                  </tr>
                  <tr>
                    <td class="sponsorheader">Silver sponsors:</td>
                  </tr>
                  <tr>
                  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <?php
					mysql_select_db($database_sql, $sql);
$query_silversponsors = "SELECT * FROM sponsors WHERE type = 'silver' ORDER BY name ASC";
$silversponsors = mysql_query($query_silversponsors, $sql) or die(mysql_error());
$row_silversponsors = mysql_fetch_assoc($silversponsors);
$totalRows_silversponsors = mysql_num_rows($silversponsors);
						$scount = 0; do { $scount++; ?>
                    <td class="sponsorsurround"><a href="../sponsors/sponsordetail.php?ID=<?php echo $row_silversponsors['ID']; ?>"><img src="../sponsorlogos/<?php echo $row_silversponsors['logo']; ?>thumb" width="100" alt="" /></a>&nbsp;</td>
                    <?php if($scount == 2) { echo "</tr>"; $scount = 0; } ?>
                    <?php } while ($row_silversponsors = mysql_fetch_assoc($silversponsors)); ?>
                  </tr>
                  </table>
                  </td></tr>
                  <tr>
                    <td class="sponsorheader">Partners:</td>
                  </tr>
                  <tr>
                    <td class="aligntop"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <?php
						$lcount = 0; do { $lcount++; ?>
                        <td class="sponsorsurround"><a href="../sponsors/sponsordetail.php?ID=<?php echo $row_learningsponsors['ID']; ?>"><img src="../sponsorlogos/<?php echo $row_learningsponsors['logo']; ?>thumb" width="100" alt="" /></a></td>
                        <?php if($lcount == 2) { echo "</tr>"; $lcount = 0; } ?>
                        <?php } while ($row_learningsponsors = mysql_fetch_assoc($learningsponsors)); ?>
                      </tr>
                    </table></td>
                  </tr>
                  </table>
                  </td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
</table></td>
  </tr>
  <tr>
    <td class="menurepeat">&nbsp;</td>
  </tr>
  <tr>
    <td class="footer"><table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td class="footercentre"><a href="../">Home</a> | <a href="../about">About</a> | <a href="../events">Events</a> | <a href="../publications">Publications</a> | <a href="../subsidiaries">Subsidiaries</a> | <a href="../learning">Learning</a> | <a href="../sponsors">Sponsors</a> | <a href="../management">Management</a><br />
          <a href="http://devisaweb.co.uk"></a><br />
          <table width="100" border="0" align="center" cellpadding="5" cellspacing="0">
          <tr>
            <td width="64%"><a href="http://twitter.com/ICFS100" target="_blank"><img src="../images/followtwitter.png" width="91" height="91" alt="Follow us on Twitter" /></a></td>
            <td width="11%"><a href="http://www.imperialcollegeunion.org/" target="_blank"><img src="../images/Imperial-logo.png" width="200" height="91" alt="Imperial college union" /></a></td>
            <td width="25%"><a href="http://www.facebook.com/group.php?gid=20171188344&amp;ref=ts" target="_blank"><img src="../images/followfacebook.png" width="91" height="91" alt="Follow us on facebook" /></a></td>
            </tr>
        </table>
          <br />
          <a href="http://devisaweb.co.uk">Web Design</a></td>
        </tr>
    </table></td>
  </tr>
</table>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($platinumsponsors);

mysql_free_result($goldsponsors);

mysql_free_result($learningsponsors);
?>
