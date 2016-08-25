<?php header('Content-type: text/xml');
require("../db_config.php");    
    
    $mode = $_GET['mode'];
    $comp_id = $_GET['comp_id'];
    $software_id = $_GET['software_id'];
    $software_name = $_GET['software_name'];
    $software_type = $_GET['software_type'];
    $version = $_GET['version'];
    $num_licenses = $_GET['num_licenses'];
    $license_num = $_GET['license_num'];
    $software_price = $_GET['software_price'];
    if($software_price == "")
    {
      $software_price = "NULL";
    }
    $software_notes = $_GET['software_notes'];
    $result = "FAIL";
    $message = "";
    
    switch($mode)
    {
      case 1:
        $sql = updateCompSoftware($comp_id, $software_id); 
        break;
      
      case 2:
        $sql = addSoftware($software_name, $software_type, $version, $num_licenses, $license_num, str_replace(",","", $software_price), mysql_real_escape_string($software_notes));      
        break;
        
      case 3:
        $sql = deleteCompSoftware($comp_id, $software_id);
        break;
    }
    
    $sqlResult = mysql_query($sql);
    if($sqlResult)
    {
      $result = "Success";
      if($mode == 2)
      {
        $sql = getNewSoftwareID();
        $sqlResult = mysql_fetch_assoc(mysql_query($sql));
        $software_id = $sqlResult['software_asset_id'];
        if($comp_id != 0 && $software_id != 0)
        {
          $sql = updateCompSoftware($comp_id, $software_id);
          $sqlResult = mysql_query($sql);
        }
      }
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