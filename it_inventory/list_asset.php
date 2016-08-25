<?php
session_start();
include('includes/secureadmin.inc');
require('includes/db_config.php');

$sql = listAssets();
$result = mysql_query($sql);

if (!$result)
{
  echo "Error getting assets: ".mysql_error();
  die;
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
<?php include "includes/html_header_info.html" ?>
  </head>	
  <body>
    <div id='assetWrapper' class='wrapper'>
      <div id='listHeader'>C. S. McCrossan Asset Listing<br /><a href='database_home.php'>Return To Main Page</a>
      </div>
      <div class='clear'></div>
      <div id='body'>
        <div id='listBanner'>
          <div class='floatLeft assetNum'>Asset Number</div>
          <div class='floatLeftRM10 assetCategory'>Category</div>
          <div class='floatLeftRM10 assetManufacturer'>Manufacturer</div>
          <div class='floatLeftRM10 assetVendor'>Vendor</div>
          <div class='floatLeftRM10 assetModel'>Model</div>
          <div class='floatLeftRM10 assetUser'>User</div>
          <div class='floatLeft assetLocation'>Location</div>
          <div class='floatLeft editAsset'><a href='edit_asset.php?id=0'>Add</a></div>
          <div class='clear'></div>
        </div>
        <div id='listMain'>
          <?php
            $classList = array("assetNum", "assetCategory", "assetManufacturer", "assetVendor", "assetModel", "assetUser", "assetLocation", "editAsset");        
            while($row = mysql_fetch_row($result))
            {
              $intI = 0;
              echo "<div class='listAssetRow'>";
              foreach($row as $rowData)
              {
                if($rowData == '')
                {
                  $rowData = "&nbsp;";
                }
                if($intI < 7)
                {
                  if($intI == 0 || $intI == 6)
                  {
                    echo "<div class='floatLeft ".$classList[$intI]."'>".$rowData."</div>";                 
                  }
                  else
                  {
                    echo "<div class='floatLeftRM10 ".$classList[$intI]."'>".$rowData."</div>";    
                  }
                }
                else
                {
                  echo "<div class='floatLeft ".$classList[$intI]."'><a href='edit_asset.php?id=".$rowData."'>Edit</a><input type='hidden' class='asset_id_hidden' value='".$rowData."' /></div>";
                }
                $intI++;                
              }
              echo "<div class='clear'></div>";
              echo "</div>";           
            }           
          ?>
        </div>
      </div>
      <div class='clear'></div>
      <div id='footer'>
      <script type='text/javascript'>
        $('.listAssetRow').click(function()
        {
          var asset_id = $(this).children('.editAsset').children('.asset_id_hidden').val();
          window.location.href = 'info_asset.php?id='+asset_id;          
        });
      </script>
      </div>
    </div>
  </body>
</html>