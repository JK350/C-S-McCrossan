<?php
session_start();
include('includes/secureadmin.inc');
require('includes/db_config.php');

$sql = listVendor();
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
    <div id='vendorWrapper' class='wrapper'>
      <div id='listHeader'>C. S. McCrossan Vendor Listing<br /><a href='database_home.php'>Return To Main Page</a>
      </div>
      <div class='clear'></div>
      <div id='body'>
        <div id='listBanner'>
          <div class='floatLeft vendorDesc'>Vendor</div>
          <div class='floatLeft vendorPhone'>Vendor Phone</div>
          <div class='floatLeft vendorEmail'>Vendor Email</div>
          <div class='floatLeft edit'><a href='edit_vendor.php?id=0'>Add</a></div>
          <div class='clear'></div>
        </div>
        <div id='listMain'>
          <?php
            $classList = array("vendorDesc", "vendorPhone", "vendorEmail", "editRole");
            while($row = mysql_fetch_assoc($result))
            {
              $intI = 0;
              echo "<div class='listRow'>";
              foreach($row as $rowData)
              {
                if($rowData == "")
                {
                  $rowData = "&nbsp;";
                }
                if($intI == 3)
                {
                  echo "<div class='floatLeft ".$classList[$intI]."'><a href='edit_vendor.php?id=".$rowData."'>Edit</a></div>";
                }
                else
                {
                  echo "<div class='floatLeft ".$classList[$intI]."'>".$rowData."</div>";
                }
                $intI++;
              }
              echo "<div class='clear'></div></div>";
            }           
          ?>
        </div>
      </div>
      <div class='clear'></div>
      <div id='footer'></div>
    </div>
  </body>
</html>