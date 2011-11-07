<?php 
$currentpage = 'learning'; 
require_once('header.php');

mysql_select_db($database_sql, $sql);
$query_publication_sections = "SELECT * FROM learning_sections";
$publication_sections = mysql_query($query_publication_sections, $sql) or die(mysql_error());
$row_publication_sections = mysql_fetch_assoc($publication_sections);
$totalRows_publication_sections = mysql_num_rows($publication_sections);
?>

<div id="<?php echo $currentpage; ?>">
<?php if(!isset($_SESSION['username'])) { ?>
    <div class="message">
        You must be logged in to view protected files.
    </div>
    <div id="loginbox">
        <? displayLogin3();?>
    </div>
<?php } else { 
    if($totalRows_publication_sections > 0) { 
        while ($row_publication_sections = mysql_fetch_assoc($publication_sections)) { ?>
            <div class="sponsorsbox">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td class="boxtitle">
                            <h3><?php echo urldecode($row_publication_sections['title']); ?></h3>
                        </td>
                    </tr>
                    <tr>
                        <td class="displaytext">
                            <p><?php echo stripslashes(urldecode($row_publication_sections['intro'])); ?><br /></p>
                            <?php
                                $section = $row_publication_sections['ID'];
                                mysql_select_db($database_sql, $sql);
                                $query_currentsection = "SELECT * FROM learning WHERE `section` = '$section' ORDER BY title ASC";
                                $currentsection = mysql_query($query_currentsection, $sql) or die(mysql_error());
                                $row_currentsection = mysql_fetch_assoc($currentsection);
                                $totalRows_currentsection = mysql_num_rows($currentsection);
                                if($totalRows_currentsection > 0) { 
                                    do { ?>
                                        <table width="100%" border="0" cellspacing="0" cellpadding="5">
                                            <tr>
                                                <td width="3%">
                                                    <img src="images/pdf_icon.png" width="20" height="20" alt="pdf" />
                                                </td>
                                                <td width="97%">
                                                    <a href="viewarticle.php?ID=<?php echo $row_currentsection['ID']; ?>" target="_blank"><?php echo urldecode($row_currentsection['Title']); ?></a>
                                                </td>
                                            </tr>
                                        </table> 
                                <?php } while ($row_currentsection = mysql_fetch_assoc($currentsection)); 
							    } else { ?>  
                                    <strong>There are currently no articles in this section.</strong>
                                <?php } 
                            ?>
                        </td>
                    </tr>
                </table>
            </div>     
<?php   } 
        } else { 
            echo 'There are no files available'; 
        } 
    } ?> 
</div>
<?php require_once('footer.php');  ?>
