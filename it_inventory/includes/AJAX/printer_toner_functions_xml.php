<?php header('Content-type: text/xml');
require("../db_config.php");    
    
    $mode = $_GET['mode'];
    $printer_id = $_GET['printer_id'];
    $toner_id = $_GET['toner_id'];
    $toner_desc = $_GET['toner_desc'];
    $toner_model = $_GET['toner_model'];
    $stock_num = $_GET['stock_num'];
    $toner_price = $_GET['toner_price']; 
    $result = "FAIL";
    $message = "";
    
    switch($mode)
    {
      case 1:
        $sql = addPrinterToner($printer_id, $toner_id); 
        break;
      
      case 2:
        $sql = addToner($toner_desc, $toner_model, $stock_num, str_replace(",","", $toner_price));      
        break;
        
      case 3:
        $sql = deleteTonerPrinter($printer_id, $toner_id);
        break;
    }
    
    $sqlResult = mysql_query($sql);
    if($sqlResult)
    {
      $result = "Success";
      if($mode == 2)
      {
        $sql = getNewTonerID();
        $sqlResult = mysql_fetch_assoc(mysql_query($sql));
        $toner_id = $sqlResult['toner_asset_id'];
        if($printer_id != 0 && $toner_id != 0)
        {
          $sql = addPrinterToner($printer_id, $toner_id);
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