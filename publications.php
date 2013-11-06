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
    <div class="publication clearfix">
    <h3>Capital Magazine</h3>
    <p class="intro">Capital is the editorial arm of ICFS. The flagship publication, Capital Magazine, will provide you with insights and in-depth analysis of current markets. Our current 2013 edition will be available at our stall in Freshers Fair and at other select ICFS events. </p>
              
    <strong>
        <a href="/content/Capital_oct2013.pdf" class="btn">Capital October 2013</a><br /><br />
        <a href="/content/CapitalInsight2013-hi.pdf" class="btn">Capital Insights 2013</a> <a href="/content/CapitalInsight2013-lo.pdf" class="btn">Capital Insights 2013 (Low Res)</a><br /><br />
        <a href="/content/Capital2012.pdf" class="btn">Capital 2012</a>
        
    </strong>
    <br /><br /><br />
    <h3>Useful Downloads<h3>
        <a href="http://www.insidebuzz.co.uk/downloads" class="btn">Inside Buzz Downloads</a>
</div>
</div>                  
<?php require_once('footer.php');  ?>
