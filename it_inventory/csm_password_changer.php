<?php
session_start();
require("includes/db_config.php");
include('includes/secureadmin.inc');
$user = md5($_GET['user']);
$sql = getSpecificUsernamePassword($user);
$result = mysql_fetch_assoc(mysql_query($sql));
$msgStr = "";

if(isset($_POST['oldPassword']) || isset($_POST['newPassword']) || isset($_POST['confirmPassword']))
{
  $oldPassword = md5($_POST['oldPassword']);
  $newPassword = md5($_POST['newPassword']);
  $confirmPassword = md5($_POST['confirmPassword']);
  if($oldPassword == $result['userPW'])
  {
    if($newPassword == $confirmPassword)
    {
      $sql = updateUserPassword($user, $newPassword, $oldPassword);
      $result = mysql_query($sql);
      if($result)
      {
        $msgStr = "Password successfully changed.";
      }
      else
      {
        $msgStr = "Error changing password: ".mysql_error();
      }
    }
    else
    {
      $msgStr = "Passwords do not match, please re-enter your new password.";
    }
  }
  else
  {
    $msgStr = "Invalid value for old password.";
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
          <div id='headerTitle'>Change Password for <?php echo $_GET['user'] ?></div>
          <div id='headerLinks'><a href='inventory_login_csm.php'>Back to Login Page</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href='database_home.php'>Continue to Application</a></div>
        </div>
  			<div class='clear'></div>
  			<div id='mainBody'>
          <div id='pwChangeArea' class='editButtonDiv'>
            <form method='post' action='csm_password_changer.php?user=<?php echo $_GET['user']; ?>' enctype='multipart/form-data'>
              <div class='formRow'>
                <div class='formChangePassword rowTitle'>Old Password:</div><div class='loginFormInput'><input type='password' name='oldPassword' /></div>
                <div class='clear'></div>
              </div>
              <div class='formRow'>
                <div class='formChangePassword rowTitle'>New Password:</div><div class='loginFormInput'><input type='password' name='newPassword' /></div>
                <div class='clear'></div>
              </div>
              <div class='formRow'>
                <div class='formChangePassword rowTitle'>Confirm New Password:</div><div class='loginFormInput'><input type='password' name='confirmPassword' /></div>
                <div class='clear'></div>
              </div>
              <div id='changePWButton' class='editButtonDiv'>
                <input type='submit' name='submit' value='Change Password' />
              </div>
            </form>      
          </div>
        </div>
        <div id='loginFooter'><?php echo $msgStr; ?></div>
  		</div>
    </div>
  </body>
</html>
