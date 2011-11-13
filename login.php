<?

function confirmUser($username, $password){
    global $connect;
        if(!get_magic_quotes_gpc()) {
        $username = addslashes($username);
    }

    $q = "select * from 2011_Members where Username = '$username'";
    $result = mysql_query($q,$connect);
    if(!$result || (mysql_numrows($result) < 1)){
      return 1; //Indicates username failure
    }
    $password = stripslashes($password);

    if(LOCAL == true) { // if on a local machine (doesn't have pam_auth)
        $checck = 1; // bypass authentication
    } else {
        $checck = pam_auth($username,$password);
    }
    if($checck == 1){
        return 0; // Indicates success
    }
    else{
        return 2; //Indicates password failure
    }
}

function confirmUser2($username){
    global $connect;
       if(!get_magic_quotes_gpc()) {
               $username = addslashes($username);
                  }
                  
                     $q = "select Username from 2011_Members where Username = '$username'";
                        $result = mysql_query($q,$connect);
                           if(!$result || (mysql_numrows($result) == 1)){
                                 return 0;
                }
}                          
                                                               

function checkLogin(){
    /* Check if user has been remembered */
    if(isset($_COOKIE['cookname'])){
        $_SESSION['username'] = $_COOKIE['cookname'];
    }
    if(isset($_SESSION['username'])){
        if(confirmUser2($_SESSION['username']) != 0){
            /* Variables are incorrect, user not logged in */
            unset($_SESSION['username']);
            return false;
        }
        return true;
    }
    /* User not logged in */
    else{
        return false;
    }
}

/**
 * Determines whether or not to display the login
 * form or to show the user that he is logged in
 * based on if the session variables are set.
 */
function displayLogin(){
    global $logged_in;
    if($logged_in){
        echo "<h1>Logged In!</h1>";
        echo "Welcome <b>$_SESSION[username]</b>, you are logged in. <a href=\"logout.php\">Logout</a>";
    }
    else{
?>

<h1>Login</h1>
<form action="" method="post">
<table align="left" border="0" cellspacing="0" cellpadding="3">
<tr><td>College Username:</td><td><input type="text" name="user" maxlength="30"></td></tr>
<tr><td>College Password:</td><td><input type="password" name="pass" maxlength="30"></td></tr>
<tr><td colspan="2" align="left"><input type="checkbox" name="remember">
<font size="2">Remember me so I can sign up for events with one click</td></tr>
<tr><td colspan="2" align="right"><input type="submit" name="sublogin" value="Login"></td></tr>
<tr><td colspan="2" align="left"><a href="register.php">Join</a></td></tr>
</table>
</form>

<?
   }
}


/**
 * Determines whether or not to display the login
 * form or to show the user that he is logged in
 * based on if the session variables are set.
 */
function displayLogin2(){
   global $logged_in;
    if($logged_in){
      echo "";
      echo "<b>$_SESSION[username]</b> | <a href=\"update.php\">Update details</a> | <a href=\"myevents.php\">Event Attendance</a> |<a href=\"logout.php\">Logout</a>";
   }
   else{
?>

<form action="" method="post">
<font size="2">
<input type="text" name="user" placeholder='College username' maxlength="20">
<input type="password" name="pass" placeholder="Password" maxlength="20">
<input type="checkbox" name="remember">
Remember me</font>
<input type="submit" name="sublogin" value="Login">
</form>

<?
   }
}

/**
 * Determines whether or not to display the login
 * form or to show the user that he is logged in
 * based on if the session variables are set.
 */
function displayLogin3(){
    global $logged_in;
    if($logged_in){ ?>
        <!-- <b><?php echo $_SESSION[username]; ?></b>  -->
        <a href="update.php">Update details</a> 
        | <a href="myevents.php">Event Attendance</a> 
        | <a href="logout.php">Logout</a>
<?php } else {
?>

<h4>Login Now</h4>
<form action="" method="post" id="loginbox">
    <fieldset>
        <div class="clearfix">
            <div class="input">
                <input type="text" name="user" placeholder='College username' maxlength="20">
                <input type="password" name="pass" placeholder="Password" maxlength="20">
                <input type="submit" name="sublogin" value="Login" class="btn dark">
            </div>
        </div>
        <div class="clearfix" id="rememberme">
            <input type="checkbox" name="remember" id="remember">
            <label for="remember">Remember me</label>
        </div>
    </fieldset>
</form>

<?
   }
}

/**
 * Checks to see if the user has submitted his
 * username and password through the login form,
 * if so, checks authenticity in database and
 * creates session.
 */
if(isset($_POST['sublogin'])){
   /* Check that all fields were typed in */
   if(!$_POST['user'] || !$_POST['pass']){
         echo '<center><div align=center style="position: absolute; top:300px; font-face:Arial;"><img src=images/logo.png><br>';
      echo 'You didnt fill in all the fields.';
     
      die();
   }
   /* Spruce up username, check length */
   $_POST['user'] = trim($_POST['user']);
   if(strlen($_POST['user']) > 30){
         echo '<center><div align=center style="position: absolute; top:300px; font-face:Arial;"><img src=images/logo.png><br>';
      echo 'That username doesn\'t exist in our database.';
    
      die();
   }

   /* Checks that username is in database and password is correct */
   $result = confirmUser($_POST['user'], $_POST['pass']);

   /* Check error codes */
   if($result == 1){
         echo '<center><div align=center style="position: absolute; top:300px; font-face:Arial;"><img src=images/logo.png><br>';
      echo 'That username doesn\'t exist in our database.';
 
      die();
   }
    else if($result == 2){
        echo '<center><div align=center style="position: absolute; top:300px; font-face:Arial;"><img src=images/logo.png><br>';
        echo 'Incorrect password, please try again.';
        die();
    }

    /* Username and password correct, register session variables */
    $_POST['user'] = stripslashes($_POST['user']);
    $_SESSION['username'] = $_POST['user'];
  
    if(isset($_POST['remember'])){
        setcookie("cookname", $_SESSION['username'], time()+60*60*24*100, "/");
    }

    if(isset($_GET['revert'])){
        echo '<meta http-equiv="Refresh" content="0;url='.$HOME_PAGE.$_GET['revert'].'">';
    } else {
        /* Quick self-redirect to avoid resending data on refresh */
        echo "<meta http-equiv=\"Refresh\" content=\"0;url=$HTTP_SERVER_VARS[PHP_SELF]\">";
    }
    return;
}

/* Sets the value of the logged_in variable, which can be used in your code */
$logged_in = checkLogin();

?>
