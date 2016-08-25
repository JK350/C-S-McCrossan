<?php header('Content-type: text/xml');
require("../db_config.php");    
    
    $mode = $_GET['mode'];
    $comp_id = $_GET['comp_id'];
    $software_id = $_GET['software_id'];
    $result = "FAIL";
    $message = "";
    
    switch($mode)
    {
      case 1:
        $sql = updateCompSoftware($comp_id, $software_id); 
        break;
        
      case 3:
        $sql = deleteCompSoftware($comp_id, $software_id);
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