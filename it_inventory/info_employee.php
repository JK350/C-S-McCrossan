<?php
session_start();
include('includes/secureadmin.inc');
require('includes/db_config.php');

  $emp_id = $_GET['id'];
  $sql = getEmpInfo($emp_id);
  $resultInfo = mysql_fetch_assoc(mysql_query($sql));
  if(!$resultInfo)
  {
    echo "Error retrieving employee information: ".mysql_error();
  }  
  $emp_name = $resultInfo['employee_full_name'];
  $location = $resultInfo['location'];   
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
<?php include "includes/html_header_info.html" ?>
  </head>	
  <body>
    <div id='empAssetListWrapper' class='wrapper'>
      <div id='header'>
        <div id='indListHeader'>Asset Summary for <?php echo $emp_name; ?><br /><span>Location: <?php echo $location; ?></span><br /><a href='edit_employee.php?id=<?php echo $emp_id; ?>'>Edit Employee Information</a><a href='list_employee.php'>Employee Listing</a><a href='database_home.php'>Return To Main Page</a></div>
        <div id='headerBody'>
          <div class='addUser'>  
            <div class='addUserTitle'>Add Asset for <?php echo $emp_name ?>:</div>          
            <div class='addUserInput'>
              <select name='asset_list' id='asset_list'>
                <?php
                  $sql = getAssetList();
                  $result = mysql_query($sql);
                  echo "<option value='NULL'>&nbsp;</option>";
                  for ($rowCount = 0; $rowCount < mysql_num_rows($result); $rowCount++)
                  {
                    $row = mysql_fetch_array($result);
                    {
                      echo "<option value='".$row[0]."'>".$row[1]." : ".$row[2]."</option>";
                    }
                  };
                ?>
              </select>
            </div>
            <div class='clear'></div>
            <div class='addUserSubmit editButtonDiv'>
              <input type='button' value='Add Asset' name='addEmpAsset' id='addEmpAsset' />
            </div>
            <input type='hidden' value='<?php echo $emp_id; ?>' name='emp_id' id='emp_id' />
            <input type='hidden' value='<?php echo $emp_name; ?>' name='emp_name' id='emp_name' />
          </div>
        </div>       
      </div>
      <div id='body'>
        <div id='listBanner'>
        <div class='floatLeft assetNumEmpList'>Asset Number</div>
        <div class='floatLeft empManuList'>Manufacturer</div>
        <div class='floatLeft empModelList'>Model</div>
        <div class='clear'></div>
      </div>
        <div id='listMain'></div>            
      </div>
      <div id='footer'>
        <script type='text/javascript'>
        var emp_id = $('#emp_id').val();
        var emp_name = $('#emp_name').val();
        $.post('includes/info_employee/assetList.php', {emp_id: emp_id, emp_name: emp_name}, function(data)
        {
          document.getElementById('listMain').innerHTML = data; 
        });
        
        $('#addEmpAsset').click(function()
        {
          var asset_id = $('#asset_list').val();
          if(asset_id != "NULL")
          {
            employeeAssetFunctions(1, emp_id, asset_id, emp_name);
          }        
        });       
        </script>
      </div>
    </div>
  </body>
</html>
