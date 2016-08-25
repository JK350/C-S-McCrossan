<?php
  require("../db_config.php");

  $printer_id = $_POST['asset_id'];
  $toner_desc = $_POST['toner_desc'];
  $toner_model = $_POST['toner_model'];
  $num_stock = $_POST['num_stock'];
  $price = $_POST['price'];
  $msgString = "";
  
  $sql = addNewToner($toner_desc, $toner_model, $num_stock, str_replace(",","",$price));
  $result = mysql_query($sql);
  if($result)
  {
    $sql2 = getNewTonerID();
    $result2 = mysql_fetch_assoc(mysql_query($sql2));
    $toner_id = $result2['toner_asset_id'];
      if($result2)
      {
        $sql3 = addPrinterToner($printer_id, $toner_id);
        $result3 = mysql_query($sql3);
        if($result3)
        {
          $msgString = "New toner successfully created and attached to printer.";
        }
        else
        {
          $msgString = "Error attaching toner to printer: ".mysql_error();
        }        
      }
      else
      {
        $msgString = "Error getting new toner id number: ".mysql_error();
      }  
  }
  else
  {
    $msgString = "Error creating toner: ".mysql_error();
  }
  
  echo $msgString;
?>
