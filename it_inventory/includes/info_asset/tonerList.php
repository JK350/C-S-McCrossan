<?php
require("../db_config.php");

$printer_id = $_POST['printer_id'];
$sql = getPrinterToner($printer_id);
$result = mysql_query($sql);
if(!$result)
{
  $msgString = "Error getting toner: ".mysql_error();
}  
?>
<div id='tonerHeaderRow' class='tonerRow'>
  <div class='floatLeft tonerDescSmall'>Toner Description</div>
  <div class='floatLeft tonerModelSmall'>Toner Model</div>
  <div class='floatLeft numInStock'>Num in Stock</div>
  <div class='floatLeft tonerPrice'>Price</div>
  <div class='clear'></div>
</div>
<?php
for ($rowCount = 0; $rowCount < mysql_num_rows($result); $rowCount++)
{
  $row = mysql_fetch_assoc($result);
  echo "<div class='formRow'>";
  $className = array("tonerDescSmall", "tonerModelSmall", "numInStock", "tonerPrice", "tonerEdit");
  $intI = 0;
  foreach($row as $rowData)
  {
    if($rowData == '')
    {
      $rowData = "&nbsp;";
    }
    if ($intI == 3)
    {
      echo "<div class='floatLeft ".$className[$intI]."'>$".$rowData."</div>";
    }
    else if($intI == 4)
    {
      echo "<div class='floatLeft ".$className[$intI]."'><a href='edit_toner.php?id=".$rowData."'>Edit</a>&nbsp;&nbsp;&nbsp;<a href='javascript:printerTonerFunctions(3, ".$printer_id.", ".$rowData.")'>Delete</a></div>";
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

<div id='assetTonerFooter' class='editButtonDiv'>
  <a href='javascript:addNewToner()' id='addNewToner'>Add New Toner to Printer</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href='javascript:addExistingToner()' id='addExistingToner'>Add Existing Toner to Printer</a>
</div>
<script type='text/javascript'>   
function addNewToner()
{
  $.post('includes/info_asset/tonerAddNew.php', {printer_id: printer_id}, function(data)
  {
    $('#tonerArea').html(data);
  }); 
}

function addExistingToner()
{
  $.post('includes/info_asset/tonerAddExisting.php', {printer_id: printer_id}, function(data)
  {
    $('#tonerArea').html(data);
  });
}       
</script>