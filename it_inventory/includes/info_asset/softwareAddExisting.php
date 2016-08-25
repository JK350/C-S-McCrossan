<?php
require("../db_config.php");

$comp_id = $_POST['comp_id'];
$msgString = "";
?>
<div id='softwareAddForm'>
  <div id='softwareAddFormBody'>
    <div class='softwareAddRow'>
      <select name='softwareList' id='softwareList'>
        <?php
          $sql = getSoftwareFullList();
          $result = mysql_query($sql);
          echo "<option value='NULL'>&nbsp;</option>";
          for ($rowCount = 0; $rowCount < mysql_num_rows($result); $rowCount++)
          {
            $row = mysql_fetch_array($result);
            echo "<option value='".$row[0]."'>".$row[1]." : ".$row[2]." v-".$row[3]."</option>";
          };
        ?>        
      </select>  
    </div>
    <div class='clear'></div>
    <div id='addSoftwareButton'>
      <input type='button' id='addSoftware' name='addSoftware' value='Add Software' />
    </div>
  <div id='softwareAddFormFooter'>
    <input type='hidden' id='comp_id' value='<?php echo $comp_id; ?>' />
  </div>   
</div>
<div id='softwareAddFooter'>
  <a href='javascript:returnSoftwareListing(<?php echo $comp_id; ?>)'>Return to Software Listing</a>
  <script type='text/javascript'>
    $('#addSoftware').click(function()
    {
      var comp_id = $('#comp_id').val();
      var software_id = $('#softwareList').val();     
      computerSoftwareFunctions(1, comp_id, software_id);
    });
    
    function returnSoftwareListing(comp_id)
    {
      $.post('includes/info_asset/softwareList.php', {comp_id: comp_id}, function(data)
      {
        $('#softwareArea').html(data);
      });  
    }  
  </script>
</div>