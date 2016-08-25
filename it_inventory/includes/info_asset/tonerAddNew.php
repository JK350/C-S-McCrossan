<?php
require("../db_config.php");

$printer_id = $_POST['printer_id'];
$msgString = "";
$tonerInfoArray = array(array("Toner Description:", "toner_desc"), 
                        array("Toner Model:", "toner_model"), 
                        array("Number in Stock:", "num_stock"), 
                        array("Price ($):", "toner_price"));
echo "<div id='tonerAddForm'><form method='submit' enctyoe='multipart/form-data' action='includes/tonerAddNew.php'><div id='tonerAddFormBody'>";                        
foreach($tonerInfoArray as $tonerRow)
{
  echo "<div class='tonerAddRow'><div class='tonerRT rowTitle'>".$tonerRow[0]."</div><div class='tonerRowInput floatLeft'><input type='text' value='' id='".$tonerRow[1]."' name='".$tonerRow[1]."' class='formInput'/></div><div class='clear'></div></div>";
}

?>          
    </div>
    <div class='clear'></div>
    <div id='tonerAddFormFooter'>
      <input type='button' id='addToner' name='addToner' value='Create and Add Toner' />
      <input type='hidden' id='printer_id' value='<?php echo $printer_id; ?>' />
    </div>   
  </form>
</div>
<div id='tonerAddFooter'>
  <a href='javascript:returnTonerListing(<?php echo $printer_id; ?>)'>Return to Toner Listing</a>
  <script type='text/javascript'>
    $('#addToner').click(function()
    {
      var toner_desc = $('#toner_desc').val();
      var toner_model = $('#toner_model').val();
      var num_stock = $('#num_stock').val();
      var toner_price = $('#toner_price').val();
      var printer_id = $('#printer_id').val();      
      printerTonerFunctions(2, printer_id, 0, toner_desc, toner_model, num_stock, toner_price);
    });
    
    function returnTonerListing(printer_id)
    {
      $.post('includes/info_asset/tonerList.php', {printer_id: printer_id}, function(data)
      {
        $('#tonerArea').html(data);
      });  
    }  
  </script>
</div>