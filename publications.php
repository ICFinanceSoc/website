<?php $currentpage = 'publications'; ?>
<?php require_once('header.php'); 

mysql_select_db($database_sql, $sql);
$query_publication_sections = "SELECT * FROM publication_sections";
$publication_sections = mysql_query($query_publication_sections, $sql) or die(mysql_error());
$row_publication_sections = mysql_fetch_assoc($publication_sections);
$totalRows_publication_sections = mysql_num_rows($publication_sections);
?>

   <h1>Publications</h1>
   
                  <?php if(!isset($_SESSION['username'])) { ?>
				  <br />
				  <div class="message">You must be logged in to view protected files.
				  </div><br /><?php } ?>
<?php if($totalRows_publication_sections > 0) { do { ?>
                    <div class="sponsorsbox">
                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td class="boxtitle"><h3><?php echo urldecode($row_publication_sections['title']); ?></h3></td>
                          </tr>
                        <tr>
                          <td class="displaytext"><p><?php echo stripslashes(urldecode($row_publication_sections['intro'])); ?><br />
                            </p><?php
					  $section = $row_publication_sections['ID'];
mysql_select_db($database_sql, $sql);
$query_currentsection = "SELECT * FROM publications WHERE `section` = '$section' ORDER BY title ASC";
$currentsection = mysql_query($query_currentsection, $sql) or die(mysql_error());
$row_currentsection = mysql_fetch_assoc($currentsection);
$totalRows_currentsection = mysql_num_rows($currentsection);
					  ?>
                            <?php if($totalRows_currentsection > 0) { ?><?php do { ?> <table width="100%" border="0" cellspacing="0" cellpadding="5">
                              
                              <tr>
                                <td width="3%"><img src="../images/pdf_icon.png" width="20" height="20" alt="pdf" /></td>
                                <td width="97%"><a href="viewpublication.php?ID=<?php echo $row_currentsection['ID']; ?>" target="_blank"><?php echo urldecode($row_currentsection['Title']); ?></a></td>
                                </tr>
                             </table> 
                              <?php } while ($row_currentsection = mysql_fetch_assoc($currentsection));  ?>
							  
							  <?php } else { ?>  
                      <strong>There are currently no articles in this section.</strong>
                     <?php  } ?>
                              </td>
                          </tr>
                      </table>
                    </div><br />

                  <?php } while ($row_publication_sections = mysql_fetch_assoc($publication_sections)); } ?> <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td class="amplifytradingbox"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td width="5%"><img src="images/pdf_icon.png" width="32" height="32" alt="Download Amplify Trading" /></td>
                          <td width="76%" class="displaytext"><a href="downloadlatest.php">Download the latest Amplify Trading report</a></td>
                          <td width="19%"><a href="amplify.php">View all reports</a></td>
                        </tr>
                      </table></table>
                      
<?php require_once('footer.php');  ?>