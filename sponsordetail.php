<?php $currentpage = 'sponsors'; ?>
<?php require_once('header.php'); ?>
<?

$colname_currentsponsor = "-1";
if (isset($_GET['ID'])) {
  $colname_currentsponsor = $_GET['ID'];
}
mysql_select_db($database_sql, $sql);
$query_currentsponsor = sprintf("SELECT * FROM sponsors WHERE ID = %s", GetSQLValueString($colname_currentsponsor, "int"));
$currentsponsor = mysql_query($query_currentsponsor, $sql) or die(mysql_error());
$row_currentsponsor = mysql_fetch_assoc($currentsponsor);
$totalRows_currentsponsor = mysql_num_rows($currentsponsor);
?>
<h1><a href="sponsors.php">Sponsors</a> » <?php echo urldecode($row_currentsponsor['name']); ?></h1>
                  
                  
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="16%" class="padding5"><img src="../sponsorlogos/<?php echo $row_currentsponsor['logo']; ?>thumb" width="100" alt="" /></td>
                        <td width="84%" class="padding5"><div class="sponsorsbox">
                          <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td width="100%" class="boxtitle"><h3>Profile:</h3></td>
                              </tr>
                            <tr>
                              <td class="padding5"><?php echo stripslashes(urldecode($row_currentsponsor['profile'])); ?></td>
                              </tr>
                          </table>
                        </div>
                          <br />
                         <a href="<?php echo urldecode($row_currentsponsor['link']); ?>" target="_blank">» Go to website</a>
       </table>
            <?php require_once('footer.php');  ?>