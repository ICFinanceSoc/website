<?php require_once('../db.php');
$user = $_POST['user'];
$pass = $_POST['pass'];
$username = stripslashes($user);
$password = stripslashes($pass);


function confirmUser($username, $password){
   global $connect;
       if(!get_magic_quotes_gpc()) {
               $username = addslashes($username);
                  }
      
            $q = "select * from 2011_Admin where Admin_Username = '$username'";
             $result = mysql_query($q,$connect);
             if(!$result || (mysql_numrows($result) < 1)){
             return 1; //Indicates username failure
             }
                                    
  $checck = pam_auth($username,$password);
  if($checck == 1){
       return 3;
          }
                   else{
        return 2; //Indicates password failure
           }
           }

$chek = confirmUser($username,$password);                                                             
if($chek == 3){
session_name('ICFSAdmin');
session_register("user");
header("location:index.php");
}else{
header("location:login.php");
}
?>
