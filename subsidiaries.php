<?php
$currentpage = 'subsidiaries';
require_once('header.php');
mysql_select_db($database_sql, $sql);
$query_homeregion = "SELECT * FROM subsidpage WHERE ID = 1";
$homeregion = mysql_query($query_homeregion, $sql) or die(mysql_error());
$row_homeregion = mysql_fetch_assoc($homeregion);
$totalRows_homeregion = mysql_num_rows($homeregion);
?>

<div class="displaytext" id="<?php echo $currentpage; ?>">
    <p class="displaytext">There are several clubs that operate under&nbsp;<acronym title="Imperial College Finance Society">ICFS</acronym>. You can visit their websites to learn more about them.</p>

    <div class="subbox grid_6 alpha">
        <h3>Investment Club</h3>
        <div class="imagebox">
            <!-- <img src="http://union.ic.ac.uk/scc/finance/new/images/icfs-ic.gif" alt="" width="180" height="17" /> -->
            <a title="ICFS Investment Club" href="http://www.iciclub.co.uk/" target="_blank">
                <img src="images/icic.jpg" alt="" width="450"/>
            </a>
        </div>
        <p class="displaytext">
            The ICFS&nbsp;<a title="ICFS Investment Club" href="http://www.iciclub.co.uk/" target="_blank"><strong>Investment Club</strong></a>&nbsp;is a platform for the students of Imperial College and Tanaka Business School to learn and discuss the opportunities of investing. Empowering members through participation, we believe first-hand experience is the best way to learn about the markets and understand the rationale of making stock choices. Along with tutorials we offer virtual trading competitions as well as the opportunity for members to group together and invest themselves.
        </p>
    </div>

    <div class="subbox grid_6 omega">
        <h3>Entrepreneurs Interactive</h3>
        <div class="imagebox">
            <!-- <img src="http://union.ic.ac.uk/scc/finance/new/images/icfs-ei.gif" alt="Imperial College Finance Society - Entrepreneurs Interactive" /> -->
            <a title="ICFS Entrepreneurs Interactive" href="http://entrepreneursinteractive.com/icbs/" target="_blank">
                <img src="images/ei.png" alt="Imperial College Finance Society - Entrepreneurs Interactive" width="450"/>
            </a>
        </div>
        <p class="displaytext">
            <a title="ICFS Entrepreneurs Interactive" href="http://entrepreneursinteractive.com/icbs/" target="_blank"><strong>Entrepreneurs Interactive</strong></a>&nbsp;was founded in summer 2006 as IC Entrepreneurs by a group of Imperial College postgraduate students. Last year we organised more than 10 events for over 500 attendants. The mission of Entrepreneurs Interactive is to foster entrepreneurship among students, staff and alumni of Imperial and promote entrepreneurial mind-set as a founder or manager of a start-up company. The club hosts events and provides resources to support the finding of innovations and facilitates networking with like-minded people, VCs and the Imperial College entrepreneurial community.
        </p>
    </div>
    
    <div class="clear"></div>

    <div class="subbox grid_6 alpha">
        <h3>ICFS New Financial World Conference</h3>
        <div class="imagebox">
            <!-- <a href="http://www.icfsconference.com/" target="_blank"><img src="http://union.ic.ac.uk/scc/finance/new/images/nfwclogo.jpg" alt="" width="225" height="50" /></a> -->
            <a href="http://www.icfsconference.com/" target="_blank">
                <img src="images/nfw.jpg" alt="ICFS New Financial World Conference" width="450"/>
            </a>
        </div>
        <p class="displaytext">
            <strong><a href="http://www.icfsconference.com/">New worlds financial confererence</a></strong>&nbsp;- Imperial College, London will be holding its' first ever finance conference at&nbsp;Bloomberg HQ, on<strong>&nbsp;5th February 2012</strong>. We are inviting a select 240 members from this society and other leading university societies to attend this conference. In this futuristic environment successful applicants will be able to enjoy presentations of the highest quality by leading professionals and will be presented with a unique opportunity to network and mingle with all our sponsors during the breaks.
        </p>
    </div>

    <?php //echo stripslashes(urldecode($row_homeregion['body'])); ?>
</div>                      

<? require_once('footer.php');?>
