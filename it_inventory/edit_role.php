<?php
session_start();
include('includes/secureadmin.inc');
require('includes/db_config.php');
$msgString = "";
$is_deleted = 0;
if(isset($_POST['delete']))
{
  $role_id = $_GET['id'];
  $sql = deleteRole($role_id);
  $result = mysql_query($sql);
  if(!$result)
  {
    $msgString = "Error deleting role: ".mysql_error();
  }
  else
  {
    $msgString = "Role successfully deleted.";
    $is_deleted = 1;
  }
}

if(isset($_POST['submitChanges']))
{
  $role_id = $_GET['id'];
  $role_desc = $_POST['role_desc'];
  if($_GET['id'] > 0)
  {
    $sql = editRole(mysql_real_escape_string($role_desc), $role_id);
    $result = mysql_query($sql);
    if(!$result)
    {
      $msgString = "Error editing role: ".mysql_error();
    }
    else
    {
      $msgString = "Role successfully edited.";
    }
  }
  else
  {
    $sql = addRole(mysql_real_escape_string($role_desc));
    $result = mysql_query($sql);
    if(!$result)
    {
      $msgString = "Error adding role: ".mysql_error();  
    }
    else
    {
      $msgString = "Role successfully added.";  
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
  <?php     
    if($_GET['id'] == 0)
    {
      $headerString = "Add a New Role";
      $role_desc = "";
      $buttons = "<div id='formAddButtons' class='editButtonDiv'><input type='submit' value='Add Role' name='submitChanges'/></div>";
    }
    else
    {
      $sql = getRole($_GET['id']);
      $result = mysql_fetch_assoc(mysql_query($sql));
      $role_desc = $result['role_description'];
      $headerString = "Edit The Role Information For ".$role_desc;
      $buttons = "<div id='roleEditButtons' class='editButtonDiv'><input type='submit' value='Save Changes' name='submitChanges'/><input type='submit' value='Delete Role' id='delete_role' name='delete' class='delete'/><div class='clear'></div></div>";     
    }
  ?>
    <div id='wrapper'>
      <div id='header'>
        <div id='indListHeader'><?php echo $headerString; ?><br /><a href='list_role.php'>Back to Listing</a><a href='database_home.php'>Main Page</a></div>
        <div id='headerBody'></div>       
      </div>
      <div id='body'>
      <?php
        if ($is_deleted == 0)
        {
      ?>
        <div id='roleAddForm' class='centeredDiv'>
          <form method='post' enctype='multipart/form-data' action='edit_role.php?id=<?php echo $_GET['id']; ?>'>
            <div class='formRow'>
              <div id='roleRT' class='rowTitle'>Role Name:</div>          
              <div class='formRowInput'>
                <input type='text' value='<?php echo str_replace("'", "&apos;", $role_desc); ?>' id='role_desc' name='role_desc' class='formInput'/>
              </div>
            </div>
            <div id='formFooter'>
              <div id='formButtons'>
                <?php echo $buttons; ?>
              </div>
              <div class='clear'></div>
            </div>          
          </form>
        </div>
      <?php 
        }
      ?>              
      </div>
      <div id='successMsg'><?php echo $msgString; ?>&nbsp;</div>
      <div id='footer'></div>
    </div>
  </body>
</html>
