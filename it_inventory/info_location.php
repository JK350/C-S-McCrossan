<?php
session_start();
include('includes/secureadmin.inc');
require('includes/db_config.php');

  $loc_id = $_GET['id'];
  $sql = getLocInfo($loc_id);
  $resultInfo = mysql_fetch_assoc(mysql_query($sql));
  $loc_name = $resultInfo['location'];  
  if(!$resultInfo)
  {
    echo "Error retrieving location information: ".mysql_error();
  }      
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
<?php include "includes/html_header_info.html" ?>
  </head>	
  <body>
    <div id='locAssetListWrapper' class='wrapper'>
      <div id='header'>
        <div id='indListHeader'>Asset Summary for <?php echo $loc_name; ?><br /><span>Address: <?php echo $resultInfo['location_address']; ?><br />Phone: <?php echo $resultInfo['location_main_phone']; ?></span><br /><a href='edit_location.php?id=<?php echo $loc_id ?>'>Edit Location Information</a><a href='list_location.php'>Location Listing</a><a href='database_home.php'>Return To Main Page</a></div>
        <div id='headerBody'>
          <div class='addLocation'>Add Asset for <?php echo $loc_name ?>:          
            <select name='asset_list' id='asset_list'>
              <?php
                $sql = getLocAssetList();
                $result2 = mysql_query($sql);
                echo "<option value='NULL'>&nbsp;</option>";
                for ($rowCount = 0; $rowCount < mysql_num_rows($result2); $rowCount++)
                {
                  $row = mysql_fetch_array($result2);
                  {
                    if($row[2] != "")
                    {
                      $empData = " : ".$row[2];
                    }
                    else
                    {
                      $empData = "";
                    }
                    echo "<option value='".$row[0]."'>".$row[1]." ".$empData." :  ".$row[3]."</option>";
                  }
                };
              ?>
            </select>
            <div class='clear'></div>
            <div class='addUserSubmit'>
              <input type='button' value='Add Asset' name='addLocAsset' id='addLocAsset' />
            </div>
            <input type='hidden' value='<?php echo $loc_id; ?>' name='loc_id' id='loc_id' />
            <input type='hidden' value='<?php echo $loc_name; ?>' name='loc_name' id='loc_name' />
          </div>
        </div>       
      </div>
      <div id='body'>
        <div id='listBanner'>
          <div class='floatLeft assetNumLocList'>Asset Number</div>
          <div class='floatLeft categoryLocList'>Category</div>
          <div class='floatLeft manufacturerLocList'>Manufacturer</div>
          <div class='floatLeft modelLocList'>Model</div>
          <div class='floatLeft deleteLocList'>&nbsp;</div>
          <div class='clear'></div>
        </div>
        <div id='listMain'></div>            
      </div>
      <div id='footer'>
        <script type='text/javascript'>
          var loc_id = $('#loc_id').val();
          var loc_name = $('#loc_name').val();
          $.post('includes/info_location/assetList.php', {loc_id: loc_id, loc_name: loc_name}, function(data)
          {
            $('#listMain').html(data);
          });
           
          $('#addLocAsset').click(function()
          {
            var asset_id = $('#asset_list').val();
            if(asset_id != "NULL")
            {
              locationAssetFunctions(1, loc_id, asset_id);
            }       
          });       
        </script>
      </div>
    </div>
  </body>
</html>