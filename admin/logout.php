<?php
session_name('ICFSAdmin');
session_start();
session_destroy();
header('Location:index.php');
?>
