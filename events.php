<?php $currentpage = 'events'; ?>
<?php require_once('header.php'); ?>
     <h1>Our current events</h1>
     <span class="writingnopadding"><a href="pastevents.php">Past events</a></span><br />
   <?php
		if($totalRows_Recordset1 > 0) {
					  $initial = '';
					  do {
					  $new = date("F Y",strtotime($row_Recordset1['date']));
					  if($initial != $new) {
					   echo "<h3>".date("F Y",strtotime($row_Recordset1['date']))."</h3></br>"; 
                       } 
					   $initial = $new;
					   ?>
                          <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td class="displaytext"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="288" bgcolor="#f5f5f5" class="writingnopadding"><strong><?php echo urldecode($row_Recordset1['title']); ?></strong></td>
                                  <td width="250" bgcolor="#f5f5f5" class="writingnopadding"><?php echo date("d F Y",strtotime($row_Recordset1['date'])); ?> <?php echo substr($row_Recordset1['start'],0,-3); ?> - <?php echo substr($row_Recordset1['end'],0,-3); ?></td>
                                  <td width="117" bgcolor="#f5f5f5" class="writingnopadding"><a href="eventinformation.php?ID=<?php echo $row_Recordset1['ID']; ?>">More info/register</a></td>
                                  </tr>
                                </table></td>
                              </tr>
                            </table>
                          <p>
                            <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1));
						  } else {
						  ?>
                            <br />
                            We have recently updated our website and are still in the process of uploading all the necessary documents to the site.</p>
                          <p>The work should be completed in the next few days</p>
                          <p>Sorry for any inconvenience this may have caused.
                            <?php } ?>
    
            <?php require_once('footer.php');  ?>