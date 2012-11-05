<?php
include_once('header.php');
     if(isset($_POST['submit']))

       {

$id = $_POST['ID'];
		         $Interest = mysql_escape_string($_POST['Interest']);

					         $result = mysql_query("UPDATE 2011_Interests SET InterestName='$Interest' WHERE Interest_ID='$id' ",$connect);
							              echo "<meta http-equiv=Refresh content=0;url=interest.php>";

								      }

								      elseif(isset($_GET['id']))
$id = $_GET['id'];
								      {

								       

								               $result = mysql_query("SELECT * FROM 2011_Interests WHERE Interest_ID='$id' ",$connect);

									               while($myrow = mysql_fetch_assoc($result))

										                    {

												                    $title = $myrow["InterestName"];

														                  
																		    ?>

																		    <br>

																		    <h3>::Edit Interest</h3>

																		     

																		     <form method="post" action="<?php echo $PHP_SELF ?>">

																		     <input type="hidden" name="ID" value="<?php echo $myrow['Interest_ID']?>">

																		      

																		      Label: <input name="Interest" size="40" maxlength="255" value="<?php echo $title; ?>">

																		     
																		      <input type="submit" name="submit" value="Update">

																		      </form>

																		      <?php

																		                    }//end of while loop

																				     

																				       }//end else

																				       ?>
