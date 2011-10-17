<?
$currentpage = 'events';
include_once('header.php');

mysql_select_db($database_sql, $sql);
$query_Recordset2 = "SELECT * FROM events WHERE `date` < '$currentdate' ORDER BY `date` ASC";
$Recordset2 = mysql_query($query_Recordset2, $sql) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);
?>
<h1>Past events</h1>

<span class="writingnopadding"><a href="events.php">Back to current events</a></span><br />
                          <?php
						  if($totalRows_Recordset2 > 0) {
					  $initial = '';
					  do {
					  $new = date("F Y",strtotime($row_Recordset2['date']));
					  if($initial != $new) {
					   echo "<h3>".date("F Y",strtotime($row_Recordset2['date']))."</h3></br>"; 
                       } 
					   $initial = $new;
					   ?>
                          <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td class="displaytext"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="288" bgcolor="#f5f5f5" class="writingnopadding"><strong><?php echo urldecode($row_Recordset2['title']); ?></strong></td>
                                  <td width="250" bgcolor="#f5f5f5" class="writingnopadding"><?php echo date("d F Y",strtotime($row_Recordset2['date'])); ?> <?php echo substr($row_Recordset2['start'],0,-3); ?> - <?php echo substr($row_Recordset2['end'],0,-3); ?></td>
                                  </tr>
                                </table></td>
                              </tr>
                            </table>
                          <?php } while ($row_Recordset2 = mysql_fetch_assoc($Recordset2)); 
							  } else {
						  ?>
                          <strong><br />
                          We currently have no past events</strong><?php } ?>
                         
             <?php require_once('footer.php');  ?>