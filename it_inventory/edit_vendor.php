<?php
session_start();
include('includes/secureadmin.inc');
require('includes/db_config.php');
$msgString = "";
$is_deleted = 0;
$vendor_id = $_GET['id'];
if(isset($_POST['delete']))
{ 
  $sql = deleteVendor($vendor_id);
  $result = mysql_query($sql);
  if(!$result)
  {
    $msgString = "Error deleting vendor: ".mysql_error();
  }
  else
  {
    $msgString = "Vendor successfully deleted.";
    $is_deleted = 1;
  }
}

if(isset($_POST['submitChanges']))
{
  $vendor_name = $_POST['vendor_name'];
  $vendor_phone = $_POST['vendor_phone'];
  $vendor_email = $_POST['vendor_email'];
  if($_GET['id'] > 0)
  {
    $sql = editVendor(mysql_real_escape_string($vendor_name), mysql_real_escape_string($vendor_phone), mysql_real_escape_string($vendor_email), $vendor_id);
    $result = mysql_query($sql);
    if(!$result)
    {
      $msgString = "Error editing vendor: ".mysql_error();
    }
    else
    {
      $msgString = "Vendor successfully edited.";
    }
  }
  else
  {
    $sql = addVendor(mysql_real_escape_string($vendor_name), mysql_real_escape_string($vendor_phone), mysql_real_escape_string($vendor_email));
    $result = mysql_query($sql);
    if(!$result)
    {
      $msgString = "Error adding vendor: ".mysql_error();  
    }
    else
    {
      $msgString = "Vendor successfully added.";  
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
      $headerString = "Add a New Vendor";
      $vendor_name = "";
      $vendor_phone = "";
      $vendor_email = "";
      $buttonString = "Add Vendor";
      $buttons = "<div id='formAddButtons' class='editButtonDiv'><input type='submit' value='Add Vendor' name='submitChanges'/></div>";
    }
    else
    {
      $sql = getVendor($vendor_id);
      $result = mysql_fetch_assoc(mysql_query($sql));
      $vendor_name = $result['vendor_name'];
      $vendor_phone = $result['vendor_phone'];
      $vendor_email = $result['vendor_email'];
      $headerString = "Edit The Vendor Information For ".$vendor_name;
      $buttonstring = "Save Changes";
      $buttons = "<div id='vendorEditButtons' class='editButtonDiv'><input type='submit' value='Save Changes' name='submitChanges'/><input type='submit' value='Delete Vendor' id='delete_vendor' name='delete' class='delete'/><div class='clear'></div></div>";     
    }
  ?>
    <div id='wrapper'>
      <div id='header'>
        <div id='indListHeader'><?php echo $headerString; ?><br /><a href='list_vendor.php'>Back to Listing</a><a href='database_home.php'>Main Page</a></div>
        <div id='headerBody'></div>       
      </div>
      <div id='body'>
      <?php
        if ($is_deleted == 0)
        { 
          $vendorInfoArray = array(array("Vendor Name:", "<input type='text' value='".str_replace("'", "&apos;", $vendor_name)."' id='vendor_name' name='vendor_name' class='formInput' />" ),
                                   array("Vendor Phone:", "<input type='text' value='".$vendor_phone."' id='vendor_phone' name='vendor_phone' class='formInput'/>"),
                                   array("Vendor Email:", "<input type='text' value='".str_replace("'", "&apos;", $vendor_email)."' id='vendor_email' name='vendor_email' class='formInput'/>"));
          echo "<div id='vendorAddForm' class='centeredDiv'><form method='post' enctype='multipart/form-data' action='edit_vendor.php?id=".$vendor_id."'>";
          
          foreach($vendorInfoArray as $vendorInfo)
          {
            echo "<div class='formRow'><div class='vendorRT rowTitle'>".$vendorInfo[0]."</div><div class='formRowInput'>".$vendorInfo[1]."</div></div>";
          }        
          echo "<div id='formFooter'><div id='formButtons'>".$buttons."</div><div class='clear'></div></div></form></div>";
        }
      ?>              
      </div>
      <div id='successMsg'><?php echo $msgString; ?>&nbsp;</div>
      <div id='footer'></div>
    </div>
  </body>
</html>
