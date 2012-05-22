<?php
include_once('header.php');
     if(isset($_POST['submit']))

       {

		         $Interest = mysql_escape_string($_POST['Interest']);

					         $result = mysql_query("INSERT INTO 2011_Interests (InterestName) VALUES ('$Interest')",$connect);
							              echo "<meta http-equiv=Refresh content=0;url=interest.php>";

								      } else {			
								      ?>

  <h1>:: New Interest</h1>
<form method="post" action="<?php echo $PHP_SELF ?>">
Interest Name: <input name="Interest" size="40" maxlength="255">
<input type="submit" name="submit" value="Update">

																		      </form>

																		    <?

																				       }//end else

																				       ?>
