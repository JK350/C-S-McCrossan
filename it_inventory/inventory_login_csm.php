<?php
require("includes/db_config.php");
session_start();
$sql = getUsernamePassword();
$result = mysql_query($sql);

$invalidStr = "";
$catchCounter = 0;
$errorCatch = 0;

if(isset($_POST['password']))
{
  while($myRow = mysql_fetch_assoc($result))
  {
    if((md5($_POST['password']) == $myRow['userPW']) && (md5($_POST['user']) == $myRow['username']))
    {
      $_SESSION["Username"] = "admin";
      $_SESSION["admin"] = "no";
      $invalidStr = "Valid";
      $errorCatch = 1;
      $username = $_POST['user'];
    }
    else
    {     
      $invalidStr = "Username and/or password is incorrect.  Please try again.";
    }
  }
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
<?php include "includes/html_header_info.html" ?>
  </head>	
  <body>
    <div id='wrapper'>
  		<div id='mainDiv'>
  			<div id='header'>
          <div id='headerTitle'>USER LOGIN</div>
        </div>
  			<div class='clear'></div>
  			<div id='mainBody'>
          <div id='logInArea' class='editButtonDiv'>
            <form method='post' action='inventory_login_csm.php' enctype='multipart/form-data'>
              <div class='loginFormRow'>
                <div id='formUsername' class='rowTitle'>Username:</div><div class='loginFormInput'><input type='text' name='user' title='username' /></div>
                <div class='clear'></div>
              </div>
              <div class='loginFormRow'>
                <div id='formPassword' class='rowTitle'>Password:</div><div class='loginFormInput'><input type='password' name='password' title='password' /></div>
                <div class='clear'></div>
              </div>
                <div id='formLogIn' class='editButtonDiv'>
                  <input type='submit' name='submit' value='Log In' />
                </div>
            </form>      
          </div>
        </div>
        <div id='loginFooter'>
        <?php
          if($errorCatch == 0)
          {
            echo $invalidStr;
          }
          else
          {
            echo "<div id='loginWelcome'>Welcome ".$username."</div>";
            echo "<div id='loginLinks'><a href='database_home.php'>Continue to Application</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href='csm_password_changer.php?user=".$username."'>Change Password</a></div>";
          }
        ?>
        </div>
  		</div>
    </div>
  </body>
</html>
