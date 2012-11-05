<?php
set_time_limit(0);

include_once('mailer.php');
include_once('../db.php');

function eventline($upcomingevents, $user){
$upcomingevents = substr($upcomingevents, 0, -1);
$upcomingevents = explode(",", $upcomingevents);
$question = ' ';
foreach ($upcomingevents as $I){
$question .='ID='.$I.' OR ';
}
$question = substr($question, 0, -4);
$table = <<<EOF
<repeater>
<tr>
<td align="left" style="padding: 0 0 0px; font-family: Helvetica, Verdana, sans-serif;">
<table class="content-item" cellspacing="0" border="0" align="left" bgcolor="#fff" style="background: #fff; border: 1px solid #bddacb;" cellpadding="0" width="700">
EOF;
$result2 = mysql_query("SELECT * FROM events WHERE".$question);
while($row2 = mysql_fetch_array( $result2 )) {
$row2['title'] = urldecode($row2['title']);
$row2['information'] = urldecode($row2['information']);
$row2['location'] = urldecode($row2['location']);
$row2['date'] = urldecode($row2['date']);
$table .= <<<EOF
<tr>
<td style="padding: 10px 10px 0; font-family: Helvetica, Verdana, sans-serif; background: #fff;" colspan="2">
<h2>{$row2['title']}</h2>
</td>
</tr>
<tr>
<td valign="top" bgcolor="#fff" style="padding: 10px; font-family: Helvetica, Verdana, sans-serif; background: #fff;">
EOF;
       $spon = $row2['Sponsor'];
                                                                if($spon != '0'){
                                                             $sponlogo = mysql_query("SELECT * FROM sponsors WHERE ID='$spon'");
                                                              $sponlogoadd = mysql_result($sponlogo,0,logo);
                                                                  $table .= '<img src="http://union.ic.ac.uk/scc/finance/sponsorlogos/';
                                                                  $table .= $sponlogoadd;
                                          $table .= '" width="257" align="right" style="padding: 0 0 10px 10px;" editable="true" label="Image" />';
                                                               } else {
$table .= '<img src="http://union.ic.ac.uk/scc/finance/images/logo-250.png" width="257" align="right" style="padding: 0 0 10px 10px;" editable="true" label="Image" />';
                                                                                     }
$table .= <<<EOF
<multiline label="Description">
<b>{$row2['date']}, {$row2['location']}</b>
<p>
{$row2['information']}
<BR>
<a href=https://www.union.ic.ac.uk/scc/finance/confirmattendance.php?event={$row2['ID']}&user={$user}&r=imperialcollegeunion>Register in one click - Click Here</a>
<hr>
</p>
</multiline>
</td>
</tr>
EOF;
     }
$table .= '</table></td></tr></repeater>';
return $table;
}


function submitmassmail($body, $category, $department, $upcomingevents, $subject){

if($category==A && $department==A){
$result = mysql_query("SELECT * FROM 2011_Members") or die(mysql_error());
}

if($department!=A && $category==A){
$result = mysql_query("SELECT * FROM 2011_Members WHERE Dept='$department'") or die(mysql_error());
}

if($department!=A && $category!=A){
$category = ','.$category.',';
$result = mysql_query("SELECT * FROM 2011_Members WHERE Dept='$department' AND Interests LIKE '%$category%'") or die(mysql_error());
}

if($department==A && $category!=A){
$category = ','.$category.',';
$result = mysql_query("SELECT * FROM 2011_Members WHERE Interests LIKE '%$category%'") or die(mysql_error());
}

//
//When you want to test, comment out from here
//


//
//

while($row = mysql_fetch_array( $result )) {
$to = $row['Username'];
$to .="@ic.ac.uk";
$output = $body;
$output .= <<<EOF
</multiline></td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table><!-- header -->
</td>
</tr>
EOF;
if($upcomingevents != ''){
$output .= eventline($upcomingevents,$row['Username']);
}
mailer($to, $output, $subject);
}


//
//

//
//.... to here, and uncomment
//
/*

$output = $body;
$output .= <<<EOF
</multiline></td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table><!-- header -->
</td>
</tr>
EOF;
if($upcomingevents != ''){
$output .= eventline($upcomingevents,pjb09);
}
mailer('pjb09@imperial.ac.uk', $output, $subject);

*/

//
//...to here.
//


}

$searchformail = mysql_query("SELECT * FROM 2011_Mail") or die(mysql_error());
$countmail = mysql_num_rows($searchformail);
if($countmail > 0){

$body = stripslashes(mysql_result($searchformail,0,body));
$category = mysql_result($searchformail,0,category);
$department = mysql_result($searchformail,0,department);
$subject = stripslashes(mysql_result($searchformail,0,subject));
$upcomingevents = mysql_result($searchformail,0,upcomingevents);
mysql_query("TRUNCATE TABLE 2011_Mail") or die(mysql_error());
submitmassmail($body, $category, $department, $upcomingevents, $subject);
}
?>
