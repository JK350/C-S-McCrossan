<?php
require("../db_config.php");

$comp_id = $_POST['comp_id'];
$sql = getComputerSoftware($comp_id);
$result = mysql_query($sql);
if(!$result)
{
  $msgString = "Error getting Software: ".mysql_error();
}  
?>
<div id='softwareHeaderRow'>
  <div class='floatLeft assetSoftwareDesc'>Software Name</div>
  <div class='floatLeft assetSoftwareVersion'>Version</div>
  <div class='floatLeft assetSoftwareLicNum'>License Number</div>
  <div class='clear'></div>
</div>
<?php
for ($rowCount = 0; $rowCount < mysql_num_rows($result); $rowCount++)
{
  $row = mysql_fetch_assoc($result);
  echo "<div class='assetSoftwareListRow'>";
  $className = array("assetSoftwareDesc", "assetSoftwareVersion", "assetSoftwareLicNum", "assetSoftwareEdit");
  $intI = 0;
  foreach($row as $rowData)
  {
    if($rowData == '')
    {
      $rowData = "&nbsp;";
    }
    if($intI == 3)
    {
      echo "<div class='floatLeft ".$className[$intI]."'><a href='edit_software.php?id=".$rowData."'>Edit</a>&nbsp;&nbsp;&nbsp;<a href='javascript:computerSoftwareFunctions(3, ".$comp_id.", ".$rowData.")'>Delete</a></div>";
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

<div id='softwareFooter'>
  <a href='javascript:addNewSoftware()' id='addNewSoftware'>Add New Software</a>
  <a href='javascript:addExistingSoftware()' id='addExistingSoftware'>Add Existing Software</a>
</div>
<script type='text/javascript'>   
function addNewSoftware()
{
  $.post('includes/info_asset/softwareAddNew.php', {comp_id: comp_id}, function(data)
  {
    $('#softwareArea').html(data);
  }); 
}

function addExistingSoftware()
{
  $.post('includes/info_asset/softwareAddExisting.php', {comp_id: comp_id}, function(data)
  {
    $('#softwareArea').html(data);
  });
}       
</script>