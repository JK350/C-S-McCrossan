<?php
require("../db_config.php");

$software_id = $_POST['software_id'];
$asset_id = "";
$sql = getSoftwareInformation($software_id);
$result = mysql_query($sql);
if(!$result)
{
  $msgString = "Error getting toner: ".mysql_error();
}  
?>
<div class='softwareRow'>
  <div class='floatLeft softwareCompAssetNum'>Asset Number</div>
  <div class='floatLeft softwareModel'>Model</div>
  <div class='floatLeft softwareUser'>User</div>
  <div class='clear'></div>
</div>
<?php           
  $locHolder = " ";
  while($row = mysql_fetch_array($result))
  {
    if ($row[2] != $locHolder)  
      if($row[2] == '')
      {
        echo "<div class='listLocation'>No location specified</div>";
        $locHolder = $row[2];
      }
      else
      {
        echo "<div class='listLocation'>".$row[2]."</div>";
        $locHolder = $row[2];
      }
      if ($row[5] == '' ) {
        $softwareUser = "<div class='floatLeft softwareUser'>&nbsp;</div>";                	
      }
      else
      {
        $softwareUser = "<div class='floatLeft softwareUser'><a href='edit_employee.php?id=".$row[4]."'>".$row[5]."</a></div>";
      }
      echo "<div class='softwareRow'><div class='floatLeft softwareCompAssetNum'><a href='info_asset.php?id=".$row[1]."'>".$row[0]."</a></div><div class='floatLeft softwareModel'>".$row[3]."</div>".$softwareUser."<div class='deleteSoftware'><a href='javascript:softwareComputerFunctions(3, ".$software_id.", ".$row[1].")'>Delete</a></div><div class='clear'></div></div>";
  }
?>
<div class='clear'></div>
</div>

  