<?php
  require("../db_config.php");

  $printer_id = $_POST['printer_id'];
  $toner_id = $_POST['toner_id'];
  $msgString = "";
  $sql = addPrinterToner($printer_id, $toner_id);
  $result = mysql_query($sql);
  if(!$result)
  {
    $msgString = "Error attaching toner to specified printer: ".mysql_error();
  }
  else
  {
    $msgString = "Toner successfully attached to printer.";
  }
                                                                               
  echo $msgString;
?>
