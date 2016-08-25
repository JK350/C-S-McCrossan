<?php
session_start();
include('includes/secureadmin.inc');
require('includes/db_config.php');
$msgString = "";
$is_deleted = 0;
$loc_id = $_GET['id'];
if(isset($_POST['delete']))
{
  for($counter = 0; $counter < 2; $counter++)
  {
    $sql = deleteLocation($loc_id, $counter);
    $result = mysql_query($sql);
    if(!$result)
    {
      $msgString = "Error deleting location: ".mysql_error();
      $counter = 2;
    }
    if($counter == 1)
    {
      $msgString = "Location successfully deleted.";
      $is_deleted = 1;
    }
  }
}

if(isset($_POST['submitChanges']))
{
  $loc_name = $_POST['loc_name'];
  $loc_address = $_POST['loc_address'];
  $loc_phone = $_POST['loc_phone'];
  if($_GET['id'] > 0)
  {
    $sql = editLocation(mysql_real_escape_string($loc_name), mysql_real_escape_string($loc_address), mysql_real_escape_string($loc_phone), $loc_id);
    $result = mysql_query($sql);
    if(!$result)
    {
      $msgString = "Error editing location: ".mysql_error();
    }
    else
    {
      $msgString = "Location successfully edited.";
    }
  }
  else
  {
    $sql = addLocation(mysql_real_escape_string($loc_name), mysql_real_escape_string($loc_address), mysql_real_escape_string($loc_phone));
    $result = mysql_query($sql);
    if(!$result)
    {
      $msgString = "Error adding location: ".mysql_error();  
    }
    else
    {
      $msgString = "Location successfully added.";  
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
    if($loc_id == 0)
    {
      $headerString = "Add a New Location";
      $loc_name = "";
      $loc_address = "";
      $loc_phone = "";
      $buttons = "<div id='formAddButtons'  class='editButtonDiv'><input type='submit' value='Add Location' name='submitChanges'/></div>";
    }
    else
    {
      $sql = getLocation($loc_id);
      $result = mysql_fetch_assoc(mysql_query($sql));
      $loc_name = $result['location'];
      $loc_address = $result['location_address'];
      $loc_phone = $result['location_main_phone'];
      $headerString = "Edit Location Information For ".$loc_name;
      $buttons = "<div id='locEditButtons' class='editButtonDiv'><input type='submit' value='Save Changes' name='submitChanges'/><input type='submit' value='Delete Location' id='delete_loc' name='delete' class='delete'/><div class='clear'></div></div>";     
    }
  ?>
    <div id='editLocationWrapper' class='wrapper'>
      <div id='header'>
        <div id='indListHeader'><?php echo $headerString; ?><br /><?php if ($is_deleted == 0 && $loc_id > 0){ ?><a href='info_location.php?id=<?php echo $loc_id; ?>'>Back to Location Info</a><?php } ?><a href='list_location.php'>Full Location Listing</a><a href='database_home.php'>Main Page</a></div>
        <div id='headerBody'></div>       
      </div>
      <div id='body'>
      <?php
        if ($is_deleted == 0)
        {
          $locationInfoRow = array(array("Location Name:", "<input type='text' value='".str_replace("'", "&apos;", $loc_name)."' id='loc_name' name='loc_name' class='formInput'/>"), 
                                   array("Location Address:", "<input type='text' value='".str_replace("'", "&apos;", $loc_address)."' id='loc_address' name='loc_address' class='formInput'/>"), 
                                   array("Location Phone:", "<input type='text' value='".str_replace("'", "&apos;", $loc_phone)."' id='loc_phone' name='loc_phone' class='formInput'/>"));
          echo "<div id='locAddForm' class='centeredDiv'><form method='post' enctype='multipart/form-data' action='edit_location.php?id=".$loc_id."'>";
          foreach($locationInfoRow as $locRow)
          {
            echo "<div class='formRow'><div class='locationRT rowTitle'>".$locRow[0]."</div><div class='formRowInput'>".$locRow[1]."</div></div>";
          }                         
      ?>
            <div id='formFooter'>
              <div id='formButtons'>
                <?php echo $buttons; ?>
              </div>
            </div>          
          </form>
        </div>
      </div>
      <?php 
        }
      ?>              
      <div id='successMsg'><?php echo $msgString; ?>&nbsp;</div>
      <div class='clear'></div>
      <div id='footer'></div>
    </div>
  </body>
</html>
