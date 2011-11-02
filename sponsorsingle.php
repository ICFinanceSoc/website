<?
include("db.php");
if (!function_exists("GetSQLValueString")) {
    function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
    {
        if (PHP_VERSION < 6) {
            $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
        }

        $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

        switch ($theType) {
            case "text":
                $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
                break;    
            case "long":
            case "int":
                $theValue = ($theValue != "") ? intval($theValue) : "NULL";
                break;
            case "double":
                $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
                break;
            case "date":
                $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
                break;
            case "defined":
                $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
                break;
        }
        return $theValue;
    }
}
$colname_currentsponsor = "-1";
if (isset($_GET['ID'])) {
    $colname_currentsponsor = $_GET['ID'];
}
mysql_select_db($database_sql, $sql);
echo $colname_currentsponsor;
$query_currentsponsor = sprintf("SELECT * FROM sponsors WHERE ID = %s", GetSQLValueString($colname_currentsponsor, "int"));
$currentsponsor = mysql_query($query_currentsponsor, $sql) or die(mysql_error());
$row_currentsponsor = mysql_fetch_assoc($currentsponsor);
$totalRows_currentsponsor = mysql_num_rows($currentsponsor);
?>

<div id="sponsorbox">
    <div class="profile">
        <a href="<?php echo urldecode($row_currentsponsor['link']); ?>" target="_blank">
            <h3><?php echo urldecode($row_currentsponsor['name']); ?></h3>
        </a>
        <?php echo stripslashes(urldecode($row_currentsponsor['profile'])); ?>
    </div>
    <div class="events">
    </div>
</div>
