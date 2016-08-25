<?php
session_start();
include('includes/secureadmin.inc');
require('includes/db_config.php');
$msgString = "";
$is_deleted = 0;
$software_id = $_GET['id'];
if(isset($_POST['delete']))
{
  for($counter = 0; $counter < 2; $counter++)
  {
    $sql = deleteSoftware($software_id, $counter);
    $result = mysql_query($sql);
    if(!$result)
    {
      $msgString = "Error deleting software: ".mysql_error();
      $counter = 2;
    }
    if($counter == 1)
    {
      $msgString = "Software successfully deleted.";
      $is_deleted = 1;
    }
  }
}

if(isset($_POST['submitChanges']))
{
  $software_name = $_POST['software_name'];
  $software_type = $_POST['software_type'];
  $num_licenses = $_POST['num_licenses'];
  $license_num = $_POST['license_num'];
  $version = $_POST['version'];
  $software_notes = $_POST['software_notes'];
  $price = str_replace(",","", $_POST['price']);
  if($price == "")
  {
    $price = "NULL";    
  }
  if($software_id > 0)
  {
    $sql = editSoftware(mysql_real_escape_string($software_name), $software_type, $version, $num_licenses, $license_num, $price, mysql_real_escape_string($software_notes), $software_id);
    $result = mysql_query($sql);
    if(!$result)
    {
      $msgString = "Error editing software: ".mysql_error();
    }
    else
    {
      $msgString = "Software successfully edited.";
    }
  }
  else
  {
    $sql = addSoftware(mysql_real_escape_string($software_name), $software_type, $version, $num_licenses, $license_num, $price, mysql_real_escape_string($software_notes));
    $result = mysql_query($sql);
    if(!$result)
    {
      $msgString = "Error adding software: ".mysql_error();  
    }
    else
    {
      $msgString = "Software successfully added.";  
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
    if($software_id == 0)
    {
      $headerString = "Add New Software";
      $software_name = "";
      $software_type = "";
      $num_licenses = "";
      $license_num = "";
      $version = "";
      $price = "";
      $software_notes = "";
      $buttons = "<div id='formAddButtons' class='editButtonDiv'><input type='submit' value='Add Software' name='submitChanges'/></div>";
    }
    else
    {
      $sql = getSoftware($software_id);
      $result = mysql_fetch_assoc(mysql_query($sql));
      $software_name = $result['software_name'];
      $software_type = $result['software_type'];
      $num_licenses = $result['num_licenses'];
      $license_num = $result['license_num'];
      $version = $result['version'];
      $price = $result['price'];
      $software_notes = $result['notes'];
      $headerString = "Edit Software Information";
      $buttons = "<div id='softwareEditButtons' class='editButtonDiv'><input type='submit' value='Save Changes' name='submitChanges'/><input type='submit' value='Delete Software' id='delete_software' name='delete' class='delete'/><div class='clear'></div></div>";     
    }
  ?>
    <div id='wrapper'>
      <div id='header'>
        <div id='indListHeader'><?php echo $headerString; ?><br /><a href='list_software.php'>Back to Listing</a><a href='database_home.php'>Main Page</a></div>
        <div id='headerBody'></div>       
      </div>
      <div id='body'>
      <?php
        if ($is_deleted == 0)
        {
          $softwareRowInfo = array(array("Software Name:", "<textarea id='software_name' name='software_name' rows='3' cols='40'>".$software_name."</textarea>"),
                                   array("Software Type:"),
                                   array("Version:", "<input type='text' value='".str_replace("'", "&apos;", $version)."' id='version' name='version' class='formInput'/>"),
                                   array("Number of Licenses:", "<input type='text' value='".str_replace("'", "&apos;", $num_licenses)."' id='num_licenses' name='num_licenses' class='formInput'/>"),
                                   array("License Number:", "<input type='text' value='".str_replace("'", "&apos;", $license_num)."' id='license_num' name='license_num' class='formInput'/>"),
                                   array("Software Price:", "$<input type='text' value='".$price."' id='price' name='price' class='formInput' />"),
                                   array("Notes:", "<textarea rows='4' cols='40' id='software_Notes' name='software_notes'>".$software_notes."</textarea>"));
          echo "<div id='softwareForm' class='centeredDiv'><form method='post' enctype='multipart/form-data' action='edit_software.php?id=".$software_id."'>";
          $counter = 0;
          foreach($softwareRowInfo as $softwareRow)
          {
            echo "<div class='formRow'><div class='softwareRT rowTitle'>".$softwareRow[0]."</div><div class='formRowInput'>";
            switch($counter)
            {
              case 1:
                echo ""?><select name='software_type' id='software_type'><?php getDropDown(getSoftwareType(), $software_type); ?></select><?php ;
                break;
              
              default:
                echo $softwareRow[1];
                break;
            }
            echo "</div></div>";
            $counter++; 
          }
      ?>               
            <div id='formFooter'>
              <div id='formButtons'>
                <?php echo $buttons; ?>
              </div>
            </div>          
          </form>
        </div>
      <?php 
        }
      ?>
        <div id='successMsg'><?php echo $msgString; ?>&nbsp;</div>              
      </div>
      <div id='softwareFooter'>
        <?php 
          if($_GET['id'] > 0 && $is_deleted == 0)
          {
        ?>
            <div id='addNewMachine'> 
                <div class='rowTitle'>Add Machine Software is Installed On:</div>          
                <div id='compDropList' class='floatLeft'>
                  <select name='computerListing' id='computerListing'>
                    <?php
                      $sql = getCompList();
                      $result = mysql_query($sql);
                      echo "<option value='NULL'>&nbsp;</option>";
                      for ($rowCount = 0; $rowCount < mysql_num_rows($result); $rowCount++)
                      {
                        $row = mysql_fetch_array($result);
                        {
                          echo "<option value='".$row[2]."'>".$row[0]." : ".$row[1]."</option>";
                        }
                      };
                    ?>
                  </select>
                </div>
                <div class='clear'></div>
                <div id='addMachineSubmit' class='editButtonDiv'>
                  <input type='hidden' value='<?php echo $software_id; ?>' id='software_id' />
                  <input type='button' value='Add Machine' name='addMachine' id='addMachine'/>
                </div>
              </div>  
        <div id='softwareLocalList' class='centeredDiv'></div>
        <?php
          }
        ?>
      </div>
    </div>
    <script type='text/javascript'>
      var software_id = $('#software_id').val();
      $.post('includes/edit_software/computerList.php', {software_id: software_id}, function(data)
      {
        document.getElementById('softwareLocalList').innerHTML = data;
      });
      
      $('#addMachine').click(function()
      {
        var comp_id = $('#computerListing').val();
        if(comp_id != "NULL")
        {
          softwareComputerFunctions(1, software_id, comp_id);
        }  
      });
    </script>
  </body>
</html>