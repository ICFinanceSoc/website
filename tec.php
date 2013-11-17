<?php
    $currentpage = 'tec';
    require_once('header.php');
?>

<div id="about">
    <div class="displaytext">
        <div style="text-align: center">
            <img src="/images/tec.png" style="max-width: 800px;"/>
        </div>
        <div style="">
            <div class="next-lecture">
                <strong>Lecture VI:</strong> 16nd November 2013, 11:00am, Huxley 308 - "Technical Analysis II"<br />
            </div>
            <div class="next-lecture">
                <strong>Lecture V:</strong> 9nd November 2013, 11:00am, Huxley 308 - "Technical Analysis I" <i>with Taz</i><br />
            </div>
            <div class="next-lecture">
                <strong>Lecture IV:</strong> 2nd November 2013, 11:00am, Huxley 308 - "Fundamental Analysis II" with Credit Suisse<br />
                <?php if(isset($_SESSION['username'])) { echo '<a href="/content/TEC3.pdf">Download Lecture Summary</a><br />'; } else {echo '<a href="https://www.financesociety.co.uk/requirelogin.php">Login to download lecture summary & notes</a>'; } ?>
                <?php if(isset($_SESSION['username'])) { echo '<a href="/content/TEC-slides-4.pdf">Download Lecture Slides</a>'; }?>
            </div>
            <div class="next-lecture">
                <strong>Lecture III:</strong> 26th October 2013, 11:00am, Huxley 308 - "Fundamental Analysis I"<br />
                <?php if(isset($_SESSION['username'])) { echo '<a href="/content/TEC3.pdf">Download Lecture Summary</a><br />'; } else {echo '<a href="https://www.financesociety.co.uk/requirelogin.php">Login to download lecture summary & notes</a>'; } ?>
                <?php if(isset($_SESSION['username'])) { echo '<a href="/content/TEC-slides-3.pdf">Download Lecture Slides</a>'; } ?>
            </div>
            <div class="next-lecture">
                <strong>Lecture I &amp; II:</strong> 19th October 2013, 10:00am, RSM 1.47 – “An Introduction to Securities and Trading” and “Investment Banking Divisions”<br />
                <?php if(isset($_SESSION['username'])) { echo '<a href="/content/TEC1.pdf">Download Lecture Summary</a><br />'; } else {echo '<a href="https://www.financesociety.co.uk/requirelogin.php">Login to download lecture summary & notes</a>'; } ?>
                <?php if(isset($_SESSION['username'])) { echo '<a href="/content/TEC-slides-2.pdf">Download Lecture Slides II</a><br />'; } ?>
                <?php if(isset($_SESSION['username'])) { echo '<a href="/content/TEC-slides-1.pdf">Download Lecture Slides I</a>'; }  ?>
            </div>
            <h2>Trading Education Certificate</h2>
            <p>The Trading Educational Certificate is a series of seminars about the financial markets run in partnership with Credit Suisse. Now in its fourth year, the TEC is an invaluable qualification recognised by employers. It provides an excellent opportunity to learn first-hand about the theory behind finance, gain the essential knowledge to perfect your internship applications and excel in those all-important interviews!</p>
            <p>Over the course of the academic year participants will be required to attend eight seminars. The course will study in detail the different types of securities, how they are traded and how to fundamentally and technically analyse a stock. Candidates that attend the lectures and pass the exam are awarded a certificate endorsed by Credit Suisse.</p>
            <p>The topics covered in the TEC seminars include:</p>
            <ul>
                <li>An Introduction to Securities and Trading</li>
                <li>Investment Banking Divisions</li>
                <li>Fundamental Analysis</li>
                <li>Technical Analysis</li>
                <li>Macroeconomics</li>
                <li>Derivatives</li>
            </ul>
            <p>This course provides an excellent platform to kick-start your career in finance!</p>
        </div>
        <div style="">
        </div>
    </div>                      
</div>

<?php require_once('footer.php');?>
