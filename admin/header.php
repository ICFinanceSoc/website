<?php
session_name('ICFSAdmin');
session_start();
if(!isset($_SESSION['user'])){
header("location:login.php");
}
?>
<?php require_once('../db.php'); ?>

