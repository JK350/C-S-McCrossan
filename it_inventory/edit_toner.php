<?php
session_start();
include('includes/secureadmin.inc');
require('includes/db_config.php');
$msgString = "";
$is_deleted = 0;
$toner_id = $_GET['id'];
if(isset($_POST['delete']))
{ 
  for($counter = 0; $counter < 2; $counter++)
  { 
    $sql = deleteToner($toner_id, $counter);
    $result = mysql_query($sql);
    if(!$result)
    {
      $msgString = "Error deleting toner: ".mysql_error();
      $counter == 2;
    }
    if($counter == 1)
    {
      $msgString = "Toner successfully deleted.";
      $is_deleted = 1;
    }
  }
}

if(isset($_POST['submitChanges']))
{
  $toner_desc = $_POST['toner_desc'];
  $toner_model = $_POST['toner_model'];
  $stock_num = $_POST['stock_num'];
  $price = str_replace(",","", $_POST['price']);
  if($price == "")
  {
    $price = "NULL";
  }
  if($stock_num == "")
  {
    $stock_num = "NULL";
  }
  if($_GET['id'] > 0)
  {
    $sql = editToner($toner_desc, $toner_model, $stock_num, $price, $toner_id);
    $result = mysql_query($sql);
    if(!$result)
    {
      $msgString = "Error editing asset: ".mysql_error();
    }
    else
    { 
      $msgString = "Asset successfully edited.";
    }
  }
  else
  {
    $sql = addToner($toner_desc, $toner_model, $stock_num, $price);
    $result = mysql_query($sql);
    if(!$result)
    {
      $msgString = "Error adding toner: ".mysql_error();  
    }
    else
    {
      $msgString = "Toner successfully added.";  
    }
  }
}    
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
<?php include "includes/html_header_info.html" ?>
  </head>	
  <body>
  <?php     
    if($toner_id == 0)
    {
      $toner_desc = "";
      $toner_model = "";
      $stock_num = "";
      $price = "";
      $headerString = "Add New Toner";
      $buttons = "<div id='formAddButtons' class='editButtonDiv'><input type='submit' value='Add Toner' name='submitChanges'/></div>";
    }
    else
    {
      $sql = getToner($toner_id);
      $result = mysql_fetch_assoc(mysql_query($sql));
      $toner_desc = $result['toner_description'];
      $toner_model = $result['toner_model'];
      $stock_num = $result['num_in_stock'];
      $price = $result['price'];      
      $headerString = "Edit Toner Information";
      $buttons = "<div id='tonerEditButtons' class='editButtonDiv'><input type='submit' value='Save Changes' name='submitChanges'/><input type='submit' value='Delete Toner' id='delete_emp' name='delete' class='delete'/><div class='clear'></div></div>";     
    }
  ?>
    <div id='wrapper'>
      <div id='header'>
        <div id='indListHeader'><?php echo $headerString; ?><br /><a href='list_toner.php'>Back to Listing</a><a href='database_home.php'>Main Page</a></div>
        <div id='headerBody'></div>       
      </div>
      <div id='body'>
      <?php
        if ($is_deleted == 0)
        {
          $tonerRowInfo = array(array("Toner Description:", "<input type='text' value='".$toner_desc."' id='toner_desc' name='toner_desc' class='formInput' />"), 
                                array("Toner Model:", "<input type='text' value='".$toner_model."' id='toner_model' name='toner_model' class='formInput' />"), 
                                array("Number in Stock:", "<input type='text' value='".$stock_num."' id='stock_num' name='stock_num' class='formInput' />"), 
                                array("Price ($):", "<input type='text' value='".$price."' id='price' name='price' class='formInput'/>"));
          echo "<div id='tonerForm' class='centeredDiv'><form method='post' enctype='multipart/form-data' action='edit_toner.php?id=".$toner_id."'>";
          foreach($tonerRowInfo as $tonerRow)
          {
            echo "<div class='formRow'><div class='tonerRT rowTitle'>".$tonerRow[0]."</div><div class='formRowInput'>".$tonerRow[1]."</div></div>";
          }                                            
      ?>
            <div class='clear'></div>
            <div id='formFooter'>
              <div id='formButtons'>
                <?php echo $buttons; ?>
              </div>
              <div class='clear'></div>
            </div>
          </form>
        </div>      
        <div id='successMsg'><?php echo $msgString; ?>&nbsp;</div>              
      </div>
        <?php
          if($toner_id > 0)
          {
        ?>
      <div id='tonerFooter'>
        <div id='printerAddList' class='centeredDiv'>
          <select name='printerListing' id='printerListing'>
            <?php
              $sql = getPrinterList();
              $result = mysql_query($sql);
              echo "<option value='NULL'>&nbsp;</option>";
              for ($rowCount = 0; $rowCount < mysql_num_rows($result); $rowCount++)
              {
                $row = mysql_fetch_array($result);
                if($row[1] == '')
                {
                  echo "<option value='".$row[3]."'>".$row[0]." : ".$row[2]."</option>";
                }
                else if($row[2] == '')
                {
                  echo "<option value='".$row[3]."'>".$row[0]." : ".$row[1]."</option>";
                }
                else
                {
                  echo "<option value='".$row[3]."'>".$row[0]." : ".$row[1]." - ".$row[2]."</option>";
                }
              };
            ?>    
          </select>
          <div class='clear'></div>
          <input type='hidden' name='toner_id' value='<?php echo $toner_id; ?>' id='toner_id' />
          <input type='button' id='attachToner' value='Attach Toner to Printer' />    
        </div>
        <div id='printerArea'></div>
      </div>
      <?php
          } 
        }
      ?>
    </div>
    <script type='text/javascript'>
      var toner_id = $('#toner_id').val();
      $.post('includes/edit_toner/printerList.php', {toner_id: toner_id}, function(data)
      {
        $('#printerArea').html(data);
      });
      
      $('#attachToner').click(function()
      {
        var printerListing = $('#printerListing').val();
        if(printerListing != "NULL")
        {
          tonerPrinterFunctions(1, <?php echo $toner_id; ?>, printerListing);
        }
      });      
    </script>
  </body>
</html>


