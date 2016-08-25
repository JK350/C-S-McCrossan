<?php
session_start();
include('includes/secureadmin.inc');
require('includes/db_config.php');
$msgString = "";
$is_deleted = 0;
$manu_id = $_GET['id'];
if(isset($_POST['delete']))
{
  
  $sql = deleteManu($manu_id);
  $result = mysql_query($sql);
  if(!$result)
  {
    $msgString = "Error deleting manufacturer: ".mysql_error();
  }
  else
  {
    $msgString = "Manufacturer successfully deleted.";
    $is_deleted = 1;
  }
}

if(isset($_POST['submitChanges']))
{
  $manu_name = $_POST['manu_name'];
  if($_GET['id'] > 0)
  {
    $sql = editManu(mysql_real_escape_string($manu_name), $manu_id);
    $result = mysql_query($sql);
    if(!$result)
    {
      $msgString = "Error editing manufacturer: ".mysql_error();
    }
    else
    {
      $msgString = "Manufacturer successfully edited.";
    }
  }
  else
  {
    $sql = addManu(mysql_real_escape_string($manu_name));
    $result = mysql_query($sql);
    if(!$result)
    {
      $msgString = "Error adding manufacturer: ".mysql_error();  
    }
    else
    {
      $msgString = "Manufacturer successfully added.";  
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
    if($manu_id == 0)
    {
      $headerString = "Add a New Manufacturer";
      $manu_name = "";
      $buttons = "<div id='formAddButtons'  class='editButtonDiv'><input type='submit' value='Add Manufacturer' name='submitChanges'/></div>";
    }
    else
    {
      $sql = getManu($manu_id);
      $result = mysql_fetch_assoc(mysql_query($sql));
      $manu_name = $result['manufacturer_name'];
      $headerString = "Edit Manufacturer Information For ".$manu_name;
      $buttons = "<div id='manuEditButtons' class='editButtonDiv'><input type='submit' value='Save Changes' name='submitChanges'/><input type='submit' value='Delete Manufacturer' id='delete_manu' name='delete' class='delete'/><div class='clear'></div></div>";     
    }
  ?>
    <div id='wrapper'>
      <div id='header'>
        <div id='indListHeader'><?php echo $headerString; ?><br /><a href='list_manufacturer.php'>Back to Listing</a><a href='database_home.php'>Main Page</a></div>
        <div id='headerBody'></div>       
      </div>
      <div id='body'>
      <?php
        if ($is_deleted == 0)
        {
      ?>
        <div id='manufacturerAddForm' class='centeredDiv'>
          <form method='post' enctype='multipart/form-data' action='edit_manufacturer.php?id=<?php echo $manu_id; ?>'>
            <div class='formRow'>
              <div id='manufacturerRT' class='rowTitle'>Manufacturer Name:</div>          
              <div class='formRowInput'>
                <input type='text' value='<?php echo str_replace("'", "&apos;", $manu_name); ?>' id='manu_name' name='manu_name' class='formInput'/>
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
