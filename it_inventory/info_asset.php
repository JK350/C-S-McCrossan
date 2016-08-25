<?php
session_start();
include('includes/secureadmin.inc');
require('includes/db_config.php');

  $asset_id = $_GET['id'];
  $sql = getAssetInformation($asset_id);
  $result = mysql_fetch_assoc(mysql_query($sql));
  
  if(!$result)
  {
    echo "Error retrieving asset information: ".mysql_error();
  }    
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
<?php include "includes/html_header_info.html" ?>
  </head>	
  <body>
    <div id='assetInfoWrapper' class='wrapper'>
      <div id='header'>
        <div id='indListHeader'>Information For Asset Number <?php echo $result['Asset_Num']; ?><br /><a href='list_asset.php'>Back to Listing</a><a href='database_home.php'>Return To Main Page</a></div>    
      </div>
      <div id='body'>
        <div id='assetInfo'>
        <?php
          $rowInfo = array("Asset Category: ", "Manufacturer: ", "Vendor: ", "Model: ", "User: ", "Location: ", "Date Purchased: ", "Serial Number: ", "Service Code: ", "Model Number: ", "Service Tag: ", "Express Service Tag: ", "Price: ", "Invoice Number: ", "Warranty", "Service Information: ", "Notes: ", ""); 
          $counter = 0;
          $limit = count($rowInfo) - 1;
          foreach($result as $data)
          {
            echo "<div class='assetInfoRow'>";
            if($data == '')
            {
              $data = "";
            }
            if ($counter < $limit)
            {
              echo "<div class='rowTitle assetRT'>".$rowInfo[$counter]."</div>";
              if($counter == 4)
              {
                $sqlTwo = getEmpID($data);
                $resultTwo = mysql_fetch_assoc(mysql_query($sqlTwo));
                echo "<div class='rowData floatLeft'><a href='info_employee.php?id=".$resultTwo['employee_id']."'>".$data."</a></div>";
              }
              elseif($counter == 5)
              {
                $sqlThree = getLocID($data);
                $resultThree = mysql_fetch_assoc(mysql_query($sqlThree));
                echo "<div class='rowData floatLeft'><a href='info_location.php?id=".$resultThree['location_id']."'>".$data."</a></div>";
              }              
              elseif($counter == 12)
              {
                echo "<div class='rowData floatLeft'>$".$data."</div>";
              }
              else
              {
                echo "<div class='rowData floatLeft'>".$data."</div>";
              }
            }
            else if($counter == $limit)
            {
              echo "<div class='assetEditLink'><a href='edit_asset.php?id=".$asset_id."'>Edit Asset Number ".$data."</a></div>";
            }
            echo "<div class='clear'></div>";
            echo "</div>";
            $counter++;
          }
        ?>
        </div>            
      </div>
      <div id='assetFooter'>
      <?php
        if($result['Asset_Num'][0] == 5 || $result['Asset_Num'][0] == 2 || $result['Asset_Num'][0] == 4)
        {
      ?>
          <div id='softwareArea'></div>
          <input type='hidden' value='<?php echo $asset_id; ?>' id='compID' />
          <script type='text/javascript'>
            var comp_id = $('#compID').val();
            $.post('includes/info_asset/softwareList.php', {comp_id: comp_id}, function(data)
            {
              $('#softwareArea').html(data);
            });  
          </script>
      <?php
        }
        else if($result['Asset_Num'][0] == 3)
        {
      ?>
          <div id='tonerArea'></div>
          <input type='hidden' value='<?php echo $asset_id?>' id='printerID' />
          <script type='text/javascript'>
            var printer_id = $('#printerID').val();
            $.post('includes/edit_asset/tonerList.php', {printer_id: printer_id}, function(data)
            {
              $('#tonerArea').html(data);
            });  
          </script>
      <?php  
        }
      ?>
      </div>
    </div>    
  </body>
</html>
