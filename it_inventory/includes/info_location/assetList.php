<?php
require("../db_config.php");

$loc_id = $_POST['loc_id'];
$sql = getLocName($loc_id);
$result = mysql_fetch_assoc(mysql_query($sql));
$loc_name = $result['location'];
$asset_id = "";
$noAssetsString = "";
$sql = getLocAssets($loc_id);
$result = mysql_query($sql);
if(!$result)
{
  $noAssetsString = "Error getting assets for the location: ".mysql_error();
}
if(mysql_num_rows($result) == 0)
{
  $noAssetsString = $loc_name." has not been assigned any assets.";
}  
?>
<div id='noEmpAssets'><?php echo $noAssetsString; ?></div>
<?php
  $classList = array("assetNumLocList", "", "", "", "categoryLocList", "manufacturerLocList", "modelLocList", "deleteLocList");        
  $empHolder = " "; 
  while($row = mysql_fetch_row($result))
  {
    $intI = 0;
    if ($row[0] != $empHolder)
    { 
      if(is_null($row[0]))
      { 
        echo "<div class='listLocation'>Unassigned assets</div>";
        $empHolder = $row[0];
      }
      else
      {
        echo "<div class='listLocation'><a href='info_employee.php?id=".$row[0]."'>".$row[1]."</a></div>";
        $empHolder = $row[0];
      }
    }
    echo "<div class='listLocRow'>";
    echo "<div class='floatLeft ".$classList[$intI]."'><a href='info_asset.php?id=".$row[2]."'>".$row[3]."</a></div>";
    foreach($row as $rowData)
    {
      if($rowData == '')
      {
        $rowData = "&nbsp;";
      }
      if($intI > 3)
      {
        echo "<div class='floatLeft ".$classList[$intI]."'>".$rowData."</div>";
      }
 
      $intI++;                
    }
    echo "<input type='hidden'  value='".$row[2]."' class='asset_id' /><div class='listBody ".$classList[$intI]."'><a href='javascript:locationAssetFunctions(3, ".$loc_id.", ".$row[2].")'>Delete</a></div>";
    echo "<div class='clear'></div>";
    echo "</div>";           
  }           
?>