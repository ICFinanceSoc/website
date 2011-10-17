<?php 
$currentpage = 'management'; 
require_once('header.php');

mysql_select_db($database_sql, $sql);
$query_Recordset1 = "SELECT * FROM management ORDER BY `order` ASC";
$Recordset1 = mysql_query($query_Recordset1, $sql) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>


     <h1>ICFS Management</h1>
    
                        <?php do { ?>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                          <?php
						  $currentimage = $row_Recordset1['image']; if(file_exists("managementpictures/$currentimage")) { ?>
                            <td width="19%" class="padding5"><table width="200" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td class="imagebox"><img src="managementpictures/<?php echo $row_Recordset1['image']; ?>" alt="" width="200" /></td>
                              </tr>
                            </table></td>
							<?php } ?>
                            <td width="81%" class="padding5"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td class="boxtitle"><h2><?php echo urldecode($row_Recordset1['name']); ?></h2></td>
                              </tr>
                              <tr>
                                <td class="writingnopadding"><strong><?php echo urldecode($row_Recordset1['position']); ?> - <?php echo urldecode($row_Recordset1['degree']); ?><br />
                                </strong><?php echo urldecode($row_Recordset1['blurb']); ?></td>
                              </tr>
                            </table></td>
                          </tr>
                        </table>
                        <br />

                        <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
                        
                       
             <?php require_once('footer.php');  ?>