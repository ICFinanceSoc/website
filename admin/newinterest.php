<?php require_once('header.php');
isset($_POST['submit']))

  {
  //begin of if($submit).

        // Set global variables to easier names

	     // and pervent sql injection and apostrophe to break the db.

	           $title = mysql_escape_string($_POST['title']);



			        


					                    if(!$title){  //this means If the title is really empty.

							                         echo "Error: Interest name is required.";

										                      exit(); //exit the script and don't do anything else.

												                    }// end of if

														     

														              //run the query which adds the data gathered from the form into the database

															               $result = mysql_query("INSERT INTO 2011_Interests (InterestName)

																                              VALUES ('$title')",$connect);

																			                //print success message.

																					          echo "<b>Updated</b>";

																						            echo "<meta http-equiv=Refresh content=1;url=interests.php>";

																							      }//end of if($submit).

																							       

																							        

																								  // If the form has not been submitted, display it!

																								  else

																								    {//begin of else

																								     

																								           ?>

																									         <br>

																										       <h3>Add Interest</h3>

																										        

																											      <form method="post" action="<?php echo $PHP_SELF ?>">

																											       

																											   Interest: <input name="title" size="40" maxlength="255">

																												           <br>

																																         <input type="submit" name="submit" value="Add">

																																	       </form>

																																	             <?

																																		       }//end of else

																																		        

																																			 ?>
