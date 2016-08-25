<?php
require("includes/db_config.php");
session_start();
$sql = getUsernamePassword();
$return = mysql_fetch_array(mysql_query($sql));

$invalidStr = "";

if (isset($_POST['password']))
{
  if ((md5($_POST['password']) == $return['password']) && (md5($_POST['user']) == $return['username']))
  {
    $_SESSION["Username"] = "admin";
    $_SESSION["admin"] = "no";
    header("Location: ".admin_equip.".".php);
    exit;
  }
  else
  {
    $invalidStr = "Username and/or password is incorrect.  Please try again.";
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
          <div id='headerImage'>
            <img src='images/company_name.png' alt='C. S. McCrossan' width='350' height='40' />
          </div>
        </div>
  			<div class='clear'></div>
  			<div id='mainBody'>
          <div id='logInArea'>
            <div id='loginTitle'>ADMINISTRATOR LOGIN</div>
            <form method='post' action='admin_login_csm.php'>
              <div id='formUser'>
                <div>Username:</div><input type='text' name='user' title='username' />
              </div>
              <div id='formPassword'>
                <div>Password:</div><input type='password' name='password' title='password' />
              </div>
              <div id='formLogIn'>
                <input type='submit' name='submit' value='Log In' />
              </div>
            </form>
            <div id='errorMsg'>
              <?php echo $invalidStr; ?>
            </div>
          </div>
        </div>
        <div id='footer'>
        </div>
  		</div>
    </div>
  </body>
</html>