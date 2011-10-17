<?php $currentpage = 'sponsors'; ?>
<?php require_once('header.php'); 
mysql_select_db($database_sql, $sql);
$query_platinumsponsorsmain = "SELECT * FROM sponsors WHERE type = 'platinum' ORDER BY name ASC";
$platinumsponsorsmain = mysql_query($query_platinumsponsorsmain, $sql) or die(mysql_error());
$row_platinumsponsorsmain = mysql_fetch_assoc($platinumsponsorsmain);
$totalRows_platinumsponsorsmain = mysql_num_rows($platinumsponsorsmain);

mysql_select_db($database_sql, $sql);
$query_goldsponsorsmain = "SELECT * FROM sponsors WHERE type = 'gold' ORDER BY name ASC";
$goldsponsorsmain = mysql_query($query_goldsponsorsmain, $sql) or die(mysql_error());
$row_goldsponsorsmain = mysql_fetch_assoc($goldsponsorsmain);
$totalRows_goldsponsorsmain = mysql_num_rows($goldsponsorsmain);

mysql_select_db($database_sql, $sql);
$query_silversponsorsmain = "SELECT * FROM sponsors WHERE type = 'silver' ORDER BY name ASC";
$silversponsorsmain = mysql_query($query_silversponsorsmain, $sql) or die(mysql_error());
$row_silversponsorsmain = mysql_fetch_assoc($silversponsorsmain);
$totalRows_silversponsorsmain = mysql_num_rows($silversponsorsmain);

mysql_select_db($database_sql, $sql);
$query_learningsponsorsmain = "SELECT * FROM sponsors WHERE type = 'learning' ORDER BY name ASC";
$learningsponsorsmain = mysql_query($query_learningsponsorsmain, $sql) or die(mysql_error());
$row_learningsponsorsmain = mysql_fetch_assoc($learningsponsorsmain);
$totalRows_learningsponsorsmain = mysql_num_rows($learningsponsorsmain);

?>

   <h1>Sponsors</h1>
   Please click on our sponsors' logo to find out more.
                      <BR><BR>
                  <h2>Platinum Sponsors</h2>
                        
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
                      <tr>
                        <td><table  border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <?php
						$pcount = 0; do { $pcount++; ?>
                            <td width="150" class="sponsorsurround"><a href="sponsordetail.php?ID=<?php echo $row_platinumsponsorsmain['ID']; ?>"><img src="sponsorlogos/<?php echo $row_platinumsponsorsmain['logo']; ?>thumb" width="100" alt="" /></a>&nbsp;</td>
                            <?php if($pcount == 4) { echo "</tr>"; $pcount = 0; } ?>
                            <?php } while ($row_platinumsponsorsmain = mysql_fetch_assoc($platinumsponsorsmain)); ?>
                            </tr>
                          </table></td>
                        </tr>
                     </table><BR><BR>
                     <h2>Gold Sponsors</h2>
                     
                     <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
                      <tr>
                        <td><table  border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <?php
						$gcount = 0; do { $gcount++; ?>
                            <td width="150" class="sponsorsurround"><a href="sponsordetail.php?ID=<?php echo $row_goldsponsorsmain['ID']; ?>"><img src="sponsorlogos/<?php echo $row_goldsponsorsmain['logo']; ?>thumb" width="100" alt="" /></a>&nbsp;</td>
                            <?php if($gcount == 4) { echo "</tr>"; $gcount = 0; } ?>
                            <?php } while ($row_goldsponsorsmain = mysql_fetch_assoc($goldsponsorsmain)); ?>
                            </tr>
                          </table></td>
                        </tr></table><BR><BR>
                        <h2>Silver Sponsors</h2>
                       <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
                      <tr>
                        <td><table  border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <?php
						$scount = 0; do { $scount++; ?>
                            <td width="150" class="sponsorsurround"><a href="sponsordetail.php?ID=<?php echo $row_silversponsorsmain['ID']; ?>"><img src="sponsorlogos/<?php echo $row_silversponsorsmain['logo']; ?>thumb" width="100" alt="" /></a>&nbsp;</td>
                            <?php if($pcount == 4) { echo "</tr>"; $pcount = 0; } ?>
                            <?php } while ($row_silversponsorsmain = mysql_fetch_assoc($silversponsorsmain)); ?>
                            </tr>
                          </table></td>
                        </tr>
                        </table><BR><BR>
                        <h2>Partners</h2>
                      <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
                      <tr>
                        <td class="displaytext"><table  border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <?php
						$lcount = 0; do { $lcount++; ?>
                            <td width="150" class="sponsorsurround"><a href="sponsordetail.php?ID=<?php echo $row_learningsponsorsmain['ID']; ?>"><img src="sponsorlogos/<?php echo $row_learningsponsorsmain['logo']; ?>thumb" width="100" alt="" /></a>&nbsp;</td>
                            <?php if($lcount == 4) { echo "</tr>"; $lcount = 0; } ?>
                            <?php } while ($row_learningsponsorsmain = mysql_fetch_assoc($learningsponsorsmain)); ?>
                            </tr>
                          </table></td>
                        </tr>
                      </table>
                     
            <?php require_once('footer.php');  ?>