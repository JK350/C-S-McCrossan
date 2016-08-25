<?php
session_start();
include('includes/secureadmin.inc');
require('includes/db_config.php');
$msgString = "";
$is_deleted = 0;
$dept_id = $_GET['id'];
if(isset($_POST['delete']))
{
  
  $sql = deleteDept($dept_id);
  $result = mysql_query($sql);
  if(!$result)
  {
    $msgString = "Error deleting department: ".mysql_error();
  }
  else
  {
    $msgString = "Department successfully deleted.";
    $is_deleted = 1;
  }
}

if(isset($_POST['submitChanges']))
{
  $dept_name = $_POST['dept_name'];
  if($dept_id > 0)
  {
    $sql = editDept(mysql_real_escape_string($dept_name), $dept_id);
    $result = mysql_query($sql);
    if(!$result)
    {
      $msgString = "Error editing department: ".mysql_error();
    }
    else
    {
      $msgString = "Department successfully edited.";
    }
  }
  else
  {
    $sql = addDept(mysql_real_escape_string($dept_name));
    $result = mysql_query($sql);
    if(!$result)
    {
      $msgString = "Error adding department: ".mysql_error();  
    }
    else
    {
      $msgString = "Department successfully added.";  
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
    if($dept_id == 0)
    {
      $headerString = "Add a New Department";
      $dept_name = "";
      $buttons = "<div id='formAddButtons'  class='editButtonDiv'><input type='submit' value='Add Department' name='submitChanges'/></div>";
    }
    else
    {
      $sql = getDept($dept_id);
      $result = mysql_fetch_assoc(mysql_query($sql));
      $dept_name = $result['dept_name'];
      $headerString = "Edit Department Information For ".$dept_name;
      $buttons = "<div id='manuEditButtons' class='editButtonDiv'><input type='submit' value='Save Changes' name='submitChanges'/><input type='submit' value='Delete Department' id='delete_manu' name='delete' class='delete'/><div class='clear'></div></div>";     
    }
  ?>
    <div id='wrapper'>
      <div id='header'>
        <div id='indListHeader'><?php echo $headerString; ?><br /><a href='list_department.php'>Back to Listing</a><a href='database_home.php'>Main Page</a></div>
        <div id='headerBody'></div>       
      </div>
      <div id='body'>
      <?php
        if ($is_deleted == 0)
        {
      ?>
        <div id='manufacturerAddForm' class='centeredDiv'>
          <form method='post' enctype='multipart/form-data' action='edit_department.php?id=<?php echo $dept_id; ?>'>
            <div class='formRow'>
              <div id='departmentRT' class='rowTitle'>Department Name:</div>          
              <div class='formRowInput'>
                <input type='text' value='<?php echo str_replace("'", "&apos;", $dept_name); ?>' id='dept_name' name='dept_name' class='formInput'/>
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
