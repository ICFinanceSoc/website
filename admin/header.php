<?php
session_name('ICFSAdmin');
session_start();
if(!session_is_registered(user)){
header("location:login.php");
}
?>
<?php require_once('../db.php'); ?>

