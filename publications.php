<?php $currentpage = 'publications'; ?>
<?php 
    require_once('header.php'); 
    mysql_select_db($database_sql, $sql);
    $query_publication_sections = "SELECT * FROM publication_sections";
    $publication_sections = mysql_query($query_publication_sections, $sql) or die(mysql_error());
    $row_publication_sections = mysql_fetch_assoc($publication_sections);
    $totalRows_publication_sections = mysql_num_rows($publication_sections);
?>

<div id="<?php echo $currentpage; ?>">
    <?php if($totalRows_publication_sections > 0) { do { ?>
        <div class="publication clearfix">
            <h3><?php echo urldecode($row_publication_sections['title']); ?></h3>
            <?php if($row_publication_sections['intro']) { ?>
                <p class="intro"><?php echo stripslashes(urldecode($row_publication_sections['intro'])); ?></p>
            <?php }
                $section = $row_publication_sections['ID'];
                mysql_select_db($database_sql, $sql);
                $query_currentsection = "SELECT * FROM publications WHERE `section` = '$section' ORDER BY title ASC";
                $currentsection = mysql_query($query_currentsection, $sql) or die(mysql_error());
                $row_currentsection = mysql_fetch_assoc($currentsection);
                $totalRows_currentsection = mysql_num_rows($currentsection);
                if($totalRows_currentsection > 0) { ?>
                    <?php do { ?> 
                        <div class="boxthumb grid_4 alpha">
                            <a href="viewpublication.php?ID=<?php echo $row_currentsection['ID']; ?>">
                                <div class="imageholder">
                                <img src="<?php if($row_currentsection['image_name']) echo 'images/timthumb.php?src=publications/'.$row_currentsection['image_name'].'&w=270'; else echo 'http://placehold.it/270x350';?>" alt="" />
                                    <div class="caption">
                                        <div class="title"><?php echo urldecode($row_currentsection['Title']); ?></div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php } while ($row_currentsection = mysql_fetch_assoc($currentsection));  ?>
            <?php } else { ?>  
                <strong>There are currently no articles in this section.</strong>
            <?php } ?>
        </div>
    <?php } while ($row_publication_sections = mysql_fetch_assoc($publication_sections)); } ?> 
    <?php if(!isset($_SESSION['username'])) { ?>
        <div class="message">You must be logged in to view protected files.</div>
    <?php } ?>
</div>
                      
<?php require_once('footer.php');  ?>
