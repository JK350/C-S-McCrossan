<?php
session_start();
include('includes/secureadmin.inc');
require('includes/db_config.php');

$sql = listAssetCat();
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
    <div id='assetCatWrapper' class='wrapper'>
      <div id='listHeader'>C. S. McCrossan Asset Category Listing<br /><a href='database_home.php'>Return To Main Page</a>
      </div>
      <div class='clear'></div>
      <div id='body'>
        <div id='listBanner'>
          <div class='floatLeft assetCatDesc'>Category Description</div>
          <div class='floatLeft editCatDesc'><a href='edit_asset_cat.php?id=0'>Add</a></div>
          <div class='clear'></div>
        </div>
        <div id='listMain'>
          <?php
            $classList = array("assetCatDesc", "editCatDesc");        
            while($row = mysql_fetch_row($result))
            {
              echo "<div class='assetRow listRow'>";
              if($row[1] == '')
              {
                $row[1] = "&nbsp;";
              }
              echo "<div class='floatLeft ".$classList[0]."'>".$row[1]."</div>";
              echo "<div class='floatLeft ".$classList[1]."'><a href='edit_asset_cat.php?id=".$row[0]."'>Edit</a></div>";                
              echo "<div class='clear'></div>";
              echo "</div>";           
            }           
          ?>
        </div>
      </div>
      <div class='clear'></div>
      <div id='footer'></div>
    </div>
  </body>
</html>