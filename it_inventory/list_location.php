<?php
session_start();
include('includes/secureadmin.inc');
require('includes/db_config.php');

$sql = listLocation();
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
    <div id='locationWrapper' class='wrapper'>
      <div id='listHeader'>C. S. McCrossan Location Listing<br /><a href='database_home.php'>Return To Main Page</a>
      </div>
      <div class='clear'></div>
      <div id='body'>
        <div id='listBanner'>
          <div class='floatLeftRM10 locDesc'>Location</div>
          <div class='floatLeftRM10 locAddress'>Address</div>
          <div class='floatLeft locPhone'>Main Phone</div>
          <div class='floatLeft editLoc'><a href='edit_location.php?id=0'>Add</a></div>
          <div class='clear'></div>
        </div>
        <div id='listMain'>
          <?php
            $classList = array("locDesc", "locAddress", "locPhone", "editLoc");        
            while($row = mysql_fetch_row($result))
            {
              $intI = 0;
              echo "<div class='listRow locationRow'>";
              foreach($row as $rowData)
              {
                if($rowData == '')
                {
                  $rowData = "&nbsp;";
                }
                if($intI < 3)
                {
                  echo "<div class='floatLeft ".$classList[$intI]."'>".$rowData."</div>";
                }
                else
                {
                  echo "<div class='floatLeft ".$classList[$intI]."'><input type='hidden' value='".$rowData."' class='loc_id_hidden' /><a href='edit_location.php?id=".$rowData."'>Edit</a></div>";
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
          $('.locationRow').click(function()
          {
            var location_id = $(this).children('.editLoc').children('.loc_id_hidden').val();
            window.location.href = 'info_location.php?id='+location_id;
          });
        </script>
      </div>
    </div>
  </body>
</html>