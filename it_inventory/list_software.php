<?php
session_start();
include('includes/secureadmin.inc');
require('includes/db_config.php');

$sql = listSoftware();
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
    <div id='softwareListWrapper' class='wrapper'>
      <div id='listHeader'>C. S. McCrossan Software Listing<br /><a href='database_home.php'>Return To Main Page</a>
      </div>
      <div class='clear'></div>
      <div id='body'>
        <div id='listBanner'>
          <div class='floatLeft software'>Software</div>
          <div class='floatLeft softVersion'>Version</div>
          <div class='floatLeft numLicense'>Number of Licenses</div>
          <div class='floatLeft licenseNum'>License Number</div>
          <div class='floatLeft softPrice'>Price</div>
          <div class='floatLeft editSoft'><a href='edit_software.php?id=0'>Add</a></div>
          <div class='clear'></div>
        </div>
        <div id='listMain'>
          <?php
            $classList = array("software", "softVersion", "numLicense", "licenseNum", "softPrice", "editSoft");        
            while($row = mysql_fetch_row($result))
            {
              $intI = 0;
              echo "<div class='listRow'>";
              foreach($row as $rowData)
              {
                if($rowData == '')
                {
                  $rowData = "&nbsp;";
                }
                if($intI < 5)
                { 
                  if($intI == 4)
                  {
                    echo "<div class='floatLeft ".$classList[$intI]."'>$".$rowData."</div>";                  
                  }
                  else
                  {               
                    echo "<div class='floatLeft ".$classList[$intI]."'>".$rowData."</div>";
                  }
                }
                else
                {
                  echo "<div class='floatLeft ".$classList[$intI]."'><a href='edit_software.php?id=".$rowData."'>Edit</a></div>";
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
      <div id='footer'></div>
    </div>
  </body>
</html>