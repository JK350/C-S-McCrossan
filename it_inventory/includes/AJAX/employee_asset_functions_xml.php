<?php header('Content-type: text/xml');
require("../db_config.php");    
    
    $mode = $_GET['mode'];
    $emp_id = $_GET['emp_id'];
    $asset_id = $_GET['asset_id'];
    $result = "FAIL";
    $message = "";
    
    switch($mode)
    {
      case 1:
        $sql = updateEmpAsset($emp_id, $asset_id); 
        break;
        
      case 3:
        $sql = deleteEmpAsset($emp_id, $asset_id);
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