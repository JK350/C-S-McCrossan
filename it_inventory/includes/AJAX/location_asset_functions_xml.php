<?php header('Content-type: text/xml');
require("../db_config.php");    
    
$mode = $_GET['mode'];
$loc_id = $_GET['loc_id'];
$asset_id = $_GET['asset_id'];
$result = "FAIL";
$message = "";

switch($mode)
{
  case 1:
    $sql = addLocAsset($loc_id, $asset_id); 
    break;
    
  case 3:
    $sql = deleteLocAsset($loc_id, $asset_id);
    break;
}

$sqlResult = mysql_query($sql);
if($sqlResult)
{
  $result = "Success";
}
else
{
  $message = "Error, that function cannot be performed: ".mysql_error();
}
    
 ?><?xml version="1.0" encoding="UTF-8"?>
<queryResults> 
  <result><?php echo $result; ?></result>
  <messages><?php echo $message; ?></messages> 
</queryResults>