<?php
session_start();
include('includes/secureadmin.inc');
require('includes/db_config.php');

$sql = listToner();
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
    <div id='tonerWrapper' class='wrapper'>
      <div id='listHeader'>C. S. McCrossan Toner Listing<br /><a href='database_home.php'>Return To Main Page</a>
      </div>
      <div class='clear'></div>
      <div id='body'>
        <div id='listBanner'>
          <div class='floatLeft tonerDesc'>Toner Description</div>
          <div class='floatLeft tonerModel'>Toner Model</div>
          <div class='floatLeft numInStock'>Number in Stock</div>
          <div class='floatLeft tonerPrice'>Price</div>
          <div class='floatLeft editToner'><a href='edit_toner.php?id=0'>Add</a></div>
          <div class='clear'></div>
        </div>
        <div id='listMain'>
          <?php       
            while($row = mysql_fetch_row($result))
            {
              $intI = 0;
              foreach($row as $rowdata)
              {
                if($rowdata == '')
                {
                  $row[$intI] = "&nbsp;";
                }
                $intI++;
              }
              $row[0] = str_replace("&", "&amp;", $row[0]);
              $intI = 0;
              echo "<div class='listRow tonerRow'><div class='floatLeft tonerDesc'>".$row[0]."</div><div class='floatLeft tonerModel'>".$row[1]."</div><div class='floatLeft numInStock'>".$row[2]."</div><div class='floatLeft tonerPrice'>$".$row[3]."</div><div class='floatLeft editToner'><a href='edit_toner.php?id=".$row[4]."'>Edit</a></div><div class='clear'></div><input type='hidden' id='toner_id_hidden' value='".$row[4]."' /></div>";           
            }           
          ?>
        </div>
      </div>
      <div class='clear'></div>
      <div id='footer'></div>
    </div>
  </body>
</html>