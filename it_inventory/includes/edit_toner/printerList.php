<?php
require("../db_config.php");

$toner_id = $_POST['toner_id'];
$sql = getTonerPrinter($toner_id);
$sqlResult = mysql_query($sql);
if(!$sqlResult)
{
  $msgString = "Error getting toner: ".mysql_error();
}  
?>
<div class='tonerHeaderRow formRow'>
  <div class='floatLeft tonerPrinterAssetNum'>Asset Number</div>
  <div class='floatLeft tonerPrinterUser'>User</div>
  <div class='floatLeft tonerPrinterLocation'>Location</div>
  <div class='floatLeft tonerPrinterAddInfo'></div>
  <div class='clear'></div>
</div>
<?php
for ($rowCount = 0; $rowCount < mysql_num_rows($sqlResult); $rowCount++)
{
  $row = mysql_fetch_assoc($sqlResult);
  echo "<div class='formRow'>";
  $className = array("tonerPrinterAssetNum", "tonerPrinterUser", "tonerPrinterLocation", "tonerPrinterAddInfo");
  $intI = 0;
  foreach($row as $rowData)
  {
    if($rowData == '')
    {
      $rowData = "&nbsp;";
    }
    if ($intI == 3)
    {
      echo "<div class='floatLeft ".$className[$intI]."'><a href='info_asset.php?id=".$rowData."'>Info</a>&nbsp;&nbsp;&nbsp;<a href='javascript:tonerPrinterFunctions(3, ".$toner_id.", ".$rowData.")'>Delete</a></div>";
    }
    else
    {
      echo "<div class='floatLeft ".$className[$intI]."'>".$rowData."</div>";
    }
    $intI++;
  }
  echo "<div class='clear'></div></div>";
}  
?>                                         