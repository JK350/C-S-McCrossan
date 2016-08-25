<?php header('Content-type: text/xml');
require("../db_config.php");    
    
    $mode = $_GET['mode'];
    $printer_id = $_GET['printer_id'];
    $toner_id = $_GET['toner_id']; 
    $result = "FAIL";

    switch($mode)
    {
      case 1:
        $sql = addPrinterToner($printer_id, $toner_id); 
        break;
        
      case 3:
        $sql = deleteTonerPrinter($printer_id, $toner_id);
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
  <return></return> 
</queryResults>