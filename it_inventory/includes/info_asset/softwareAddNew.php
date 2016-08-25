<?php
require("../db_config.php");

$comp_id = $_POST['comp_id'];
$software_type = '';
$msgString = "";
$softwareRowInfo = array(array("Software Name:", "<textarea id='software_name' name='software_name' rows='3' cols='40'></textarea>"),
                         array("Software Type:"),
                         array("Version:", "<input type='text' value='' id='version' name='version' class='formInput'/>"),
                         array("Number of Licenses:", "<input type='text' value='' id='num_licenses' name='num_licenses' class='formInput'/>"),
                         array("License Number:", "<input type='text' value='' id='license_num' name='license_num' class='formInput'/>"),
                         array("Software Price:", "$<input type='text' value='' id='price' name='price' class='formInput' />"),
                         array("Notes:", "<textarea rows='4' cols='40' id='software_Notes' name='software_notes'></textarea>"));
echo "<div id='softwareAddForm' class='centeredDiv'>";
$counter = 0;
foreach($softwareRowInfo as $softwareRow)
{
  echo "<div class='formRow'><div class='softwareRT rowTitle'>".$softwareRow[0]."</div><div class='formRowInput floatLeft'>";
  switch($counter)
  {
    case 1:
      echo ""?><select name='software_type' id='software_type'><?php getDropDown(getSoftwareType(), $software_type); ?></select><?php ;
      break;
    
    default:
      echo $softwareRow[1];
      break;
  }
  echo "</div><div class='clear'></div></div>";
  $counter++; 
}
?>
<div id='softwareFooter'>
  <input type='button' value='Attach Software' id='addSoftware' />
  <div class='clear'></div>
  <input type='hidden' value='<?php echo $comp_id; ?>' id='comp_id' />
  <a href='javascript:returnSoftwareListing(<?php echo $comp_id; ?>)'>Return to Software Listing</a>
  <script type='text/javascript'>
    
      
    $('#addSoftware').click(function()
    {            
      var comp_id = $('#comp_id').val();
      var software_name = $('#software_name').val();
      var software_type = $('#software_type').val();
      var version = $('#version').val();
      var num_licenses = $('#num_licenses').val();
      var license_num = $('#license_num').val();
      var software_price = $('#software_price').val();
      var software_notes = $('#software_notes').val();
      computerSoftwareFunctions(2, comp_id, 0, software_name, software_type, version, num_licenses, license_num, software_price, software_notes);
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