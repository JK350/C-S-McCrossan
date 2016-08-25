<?php
require("../db_config.php");

$printer_id = $_POST['printer_id'];
$msgString = "";
?>
<div id='tonerAddForm'>
  <form method='submit' enctyoe='multipart/form-data' action='includes/tonerAddNew.php'>
    <div id='tonerAddFormBody'>
      <div class='tonerAddRow'>
        <select name='tonerList' id='tonerList'>
          <?php
            $sql = getTonerFullList();
            $result = mysql_query($sql);
            echo "<option value='NULL'>&nbsp;</option>";
            for ($rowCount = 0; $rowCount < mysql_num_rows($result); $rowCount++)
            {
              $row = mysql_fetch_array($result);
              echo "<option value='".$row[0]."'>".$row[1]."</option>";
            };
          ?>        
        </select>
        <input type='button' id='addToner' name='addToner' value='Add Toner' />
        <div class='clear'></div>
      </div>
      <div class='clear'></div>
    <div id='tonerAddFormFooter'>
      <input type='hidden' id='printer_id' value='<?php echo $printer_id; ?>' />
    </div>   
  </form>
</div>
<div id='tonerAddFooter'>
  <a href='javascript:returnTonerListing(<?php echo $printer_id; ?>)'>Return to Toner Listing</a>
  <script type='text/javascript'>
    $('#addToner').click(function()
    {
      var toner_id = $('#tonerList').val();
      var printer_id = $('#printer_id').val();      
      printerTonerFunctions(1, printer_id, toner_id);
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