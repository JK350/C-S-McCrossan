<?php
header("content-type:application/html;charset=utf-8");
require("../db_config.php");

$emp_id = $_POST['emp_id'];
$emp_name = $_POST['emp_name'];
$asset_id = "";
$noAssetsString = "";
$sql = getAssetInformationList($emp_id);
$result = mysql_query($sql);
if(!$result)
{
  $msgString = "Error getting toner: ".mysql_error();
}
if(mysql_num_rows($result) == 0)
{
  $noAssetsString = $emp_name." has not been assigned any assets.";
}  
?>
<div id='noEmpAssets'><?php echo $noAssetsString; ?></div>
<?php
  $catHolder = " ";
  $classList = array("", "", "assetNumEmpList", "empManuList", "empModelList");
  while($row = mysql_fetch_row($result))
  { 
    if ($row[0] != $catHolder)
    { 
      if($row[0] == "")
      { 
        echo "<div class='listLocation'>No asset category specified</div>";
        $catHolder = $row[0];
      }
      else
      {
        echo "<div class='listLocation'>".$row[0]."</div>";
        $catHolder = $row[0];
      }
    }
    echo "<div class='empAssetRow'>";
    $intI = 0;
    $rowItem = "";
    foreach($row as $rowData)
    {
      $data = "&nbsp;";
      if($intI > 0)
      {
        if($rowData == '')
        {
          $rowData = "&nbsp;";
        }
        $rowItem = "<div class='floatLeft ".$classList[$intI]."'>".$rowData."</div>";
        if($intI == 1)
        {
          $asset_id = $rowData;
        }
        else if($intI == 2)
        {
          $rowItem = "<div class='floatLeft ".$classList[$intI]."'><a href='info_asset.php?id=".$asset_id."'>".$rowData."</a></div>";
        }
      }
      if($intI > 1)
      {
        echo $rowItem;
      }
      $intI++;
      if($intI == 5)
      {
        echo "<div class='floatLeft deleteAsset'><a href='javascript:employeeAssetFunctions(3, ".$emp_id.", ".$asset_id.", \"".$emp_name."\")'>Delete</a></div>";
      }
    }
    echo "<div class='clear'></div></div>";
  }
?>
</div>  