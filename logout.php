<?
session_name('ICFS2011');
session_start(); 
include("db.php");
include("login.php");

/**
 * Delete cookies - the time must be in the past,
 * so just negate what you added when creating the
 * cookie.
 */
if(isset($_COOKIE['cookname'])){
   setcookie("cookname", "", time()-60*60*24*100, "/");
   
}


if(!$logged_in){
header("Location:index.php");
}
else{
   /* Kill session variables */
   unset($_SESSION['username']);
   $_SESSION = array(); // reset session array
   session_destroy();   // destroy session.

header("Location:index.php");
}

?>

</body>
</html>
