<?php
session_start();
include('includes/secureadmin.inc');
require('includes/db_config.php');
$msgString = "";
$is_deleted = 0;
$emp_id = $_GET['id'];
if(isset($_POST['delete']))
{
  for($counter = 0; $counter < 2; $counter++)
  {
    $sql = deleteEmp($emp_id, $counter);
    $result = mysql_query($sql);
    if(!$result)
    {
      $msgString = "Error deleting employee: ".mysql_error();
      $counter = 2;
    }
    if($counter == 1)
    {
      $msgString = "Employee successfully deleted.";
      $is_deleted = 1;
    }
  }
}

if(isset($_POST['submitChanges']))
{
  $emp_name = $_POST['emp_name'];
  $role_id = $_POST['role_id'];
  $location_id = $_POST['location_id'];
  $dept_id = $_POST['dept_id'];
  $extension = $_POST['extension'];
  $nxt_num = $_POST['nxt_num'];
  $office_num = $_POST['office_num'];
  $nxt_speed = $_POST['nxt_speed'];
  $nxt_id = $_POST['nxt_id'];
  $notes = $_POST['notes'];
  if($_GET['id'] > 0)
  {
    $sql = editEmp(mysql_real_escape_string($emp_name), $role_id, $location_id, $extension, $nxt_num, $office_num, $nxt_speed, $nxt_id, mysql_real_escape_string($notes), $emp_id);
    $result = mysql_query($sql);
    if(!$result)
    {
      $msgString = "Error editing employee: ".mysql_error();
    }
    else
    {
      $msgString = "Employee successfully edited.";
    }
  }
  else
  {
    $sql = addEmp(mysql_real_escape_string($emp_name), $role_id, $location_id, $extension, $nxt_num, $office_num, $nxt_speed, $nxt_id, mysql_real_escape_string($notes));
    $result = mysql_query($sql);
    if(!$result)
    {
      $msgString = "Error adding employee: ".mysql_error();  
    }
    else
    {
      $msgString = "Employee successfully added.";  
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
    if($emp_id == 0)
    {
      $headerString = "Add New Employee";
      $emp_name = "";
      $role_id = "";
      $location_id = "";
      $dept_id = "";
      $extension = "";
      $nxt_num = "";
      $office_num = "";
      $nxt_speed = "";
      $nxt_id = "";
      $notes = "";
      $buttons = "<div id='formAddButtons'  class='editButtonDiv'><input type='submit' value='Add Employee' name='submitChanges'/></div>";
    }
    else
    {
      $sql = getEmployee($emp_id);
      $result = mysql_fetch_assoc(mysql_query($sql));
      $emp_name = $result['employee_full_name'];
      $role_id = $result['role_id'];
      $dept_id = $result['dept_id'];
      $location_id = $result['location_id'];
      $extension = $result['extension'];
      $nxt_num = $result['nextel_number'];
      $office_num = $result['office'];
      $nxt_speed = $result['nextel_speed'];
      $nxt_id = $result['nextel_id'];
      $notes = $result['notes'];
      $headerString = "Edit Employee Information for ".$emp_name;
      $buttons = "<div id='empEditButtons' class='editButtonDiv'><input type='submit' value='Save Changes' name='submitChanges'/><input type='submit' value='Delete Employee' id='delete_emp' name='delete' class='delete'/><div class='clear'></div></div>";     
    }
  ?>
    <div id='wrapper'>
      <div id='header'>
        <div id='indListHeader'><?php echo $headerString; ?><br /><?php if($is_deleted == 0 && $emp_id > 0){ ?><a href='info_employee.php?id=<?php echo $emp_id; ?>'>Back to Employee Info</a><?php } ?><a href='list_employee.php'>Full Employee Listing</a><a href='database_home.php'>Main Page</a></div>
        <div id='headerBody'></div>       
      </div>
      <div id='body'>
      <?php
        if ($is_deleted == 0)
        { 
          $empRowInfo = array(array("Employee Name:", "<input type='text' value='".str_replace("'", "&apos;", $emp_name)."' id='emp_name' name='emp_name' class='formInput'/>"), 
                              array("Role:"), 
                              array("Location:"),
                              array("Department:"), 
                              array("Extension:", "<input type='text' value='".$extension."' id='extension' name='extension' class='formInput'/>"), 
                              array("Nextel Number:", "<input type='text' value='".$nxt_num."' id='nxt_num' name='nxt_num' class='formInput'/>"), 
                              array("Office Number:", "<input type='text' value='".$office_num."' id='office_num' name='office_num' class='formInput'/>"), 
                              array("Nextel Speed:", "<input type='text' value='".$nxt_speed."' id='nxt_speed' name='nxt_speed' class='formInput'/>"), 
                              array("Nextel ID:", "<input type='text' value='".$nxt_id."' id='nxt_id' name='nxt_id' class='formInput'/>"), 
                              array("Notes:", "<textarea rows='4' cols='40' id='empNotes' name='notes'>".$notes."</textarea>"));
          echo "<div id='empForm' class='centeredDiv'><form method='post' enctype='multipart/form-data' action='edit_employee.php?id=".$emp_id."'>";
          $counter = 0;
          foreach($empRowInfo as $empRow)
          {
            echo "<div class='formRow'><div class='empRT rowTitle'>".$empRow[0]."</div><div class='formRowInput'>";
            switch($counter)
            {
              case 1:
                echo ""?><select name='role_id'><?php getDropDown(listRole(), $role_id); ?></select><?php ;
                break;
                
              case 2:
                echo ""?><select name='location_id'><?php getDropDown(getLocList(), $location_id); ?></select><?php ;
                break;
                
              case 3:
                echo ""?><select name='department_id'><?php getDropDown(getDeptList(), $dept_id); ?></select><?php ; 
                break;
              
              default:
                echo $empRow[1];
                break;  
            }
            $counter++;
            echo "</div></div>";
          }
      ?>
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
        <div id='successMsg'><?php echo $msgString; ?>&nbsp;</div>              
      </div>
    </div>
  </body>
</html>