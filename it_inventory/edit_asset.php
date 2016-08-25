<?php
session_start();
include('includes/secureadmin.inc');
require('includes/db_config.php');
$msgString = "";
$is_deleted = 0;
$asset_id = $_GET['id'];
if(isset($_POST['delete']))
{ 
  $msgString = "Asset successfully deleted.";
  $cat_id = $_POST['cat_id'];
  for($counter = 0; $counter < 3; $counter++)
  {
    $sql = deleteAsset($asset_id, $counter);
    $result = mysql_query($sql);
    if($counter == 2 && $result)
    {
      if($cat_id == 68)
      {
        $counter++;
        $sql = deleteAsset($asset_id, $counter);        
      }
      else if($cat_id == 1 || $cat_id == 2 || $cat_id == 6)
      {
        $counter++;
        $counter++;
        $sql = deleteAsset($asset_id, $counter);  
      }
      $result = mysql_query($sql);
    }
    if(!$result)
    {
      $counter = 5;
      $msgString = "Error deleting asset: ".mysql_error();
    }
    if($counter == 2 || $counter == 3 || $counter == 4)
    {
      $is_deleted = 1;        
    }
  }
}

if(isset($_POST['submitChanges']))
{
  $asset_num = $_POST['asset_num'];  
  $emp_id = $_POST['emp_id'];
  $loc_id = $_POST['location_id'];
  $cat_id = $_POST['cat_id'];
  $manu_id = $_POST['manu_id'];
  $vendor_id = $_POST['vendor_id'];
  $model_id = $_POST['model_id'];
  $date_purchased = $_POST['date_purchased'];
  $serial_num = $_POST['serial_num'];
  $serv_code = $_POST['serv_code'];
  $model_num = $_POST['model_num'];
  $serv_tag = $_POST['serv_tag'];
  $ex_serv_tag = $_POST['ex_serv_tag'];
  $price = $_POST['price'];
  $invoice_num = $_POST['invoice_num'];
  $warranty = $_POST['warranty'];
  $serv_info = $_POST['serv_info'];
  $notes = $_POST['notes'];
  $locHolder = $_POST['locHold'];
  $empHolder = $_POST['empHold'];
  if($price == "")
  {
    $price = "NULL";
  }
  if($asset_id > 0)
  {
    $sql = editAsset($asset_num, $cat_id, $manu_id, $vendor_id, $model_id, $date_purchased, $serial_num, $serv_code, $model_num, $serv_tag, $ex_serv_tag, str_replace(",","", $price), $invoice_num, mysql_real_escape_string($warranty), mysql_real_escape_string($serv_info), mysql_real_escape_string($notes), $asset_id);
    $result = mysql_query($sql);
    if(!$result)
    {
      $msgString = "Error editing asset: ".mysql_error();
    }
    else
    {
      if($locHolder != $loc_id)
      {
        $sql = changeAssetLocation($locHolder, $loc_id, $asset_id);
        $result = mysql_query($sql);
        if(!$result)
        {
          $msgString = "Error changing asset location: ".mysql_error();
        }
      }
      if($empHolder != $emp_id)
      {
        $sql = changeAssetEmployee($empHolder, $emp_id, $asset_id);
        $result = mysql_query($sql);
        if(!$result)
        {
          $msgString = "Error changing user: ".mysql_error();
        }
      }
      $msgString = "Asset successfully edited.";
    }
  }
  else
  {
    $successCounter = 0;
    for($counter = 0; $counter < 3; $counter++)
    {
      if($counter == 0)
      {
        $sql = addAsset($asset_num, $cat_id, $manu_id, $vendor_id, $model_id, $date_purchased, $serial_num, $serv_code, $model_num, $serv_tag, $ex_serv_tag, str_replace(",","", $price), $invoice_num, mysql_real_escape_string($warranty), mysql_real_escape_string($serv_info), mysql_real_escape_string($notes));
        $result = mysql_query($sql);
        if($result)
        {
          $sql = getNewAssetID();
          $result = mysql_fetch_assoc(mysql_query($sql));
          if($result)
          {
            $asset_id = $result['asset_id'];
          }
        }
      }
      if($counter == 1 && $emp_id != 'NULL')
      {
        $sql = addNewEmpAsset($emp_id, $asset_id);
        $result = mysql_query($sql);
      }
      if($counter == 2 && $loc_id != 'NULL')
      {
        $sql = addNewLocAsset($loc_id, $asset_id);
        $result = mysql_query($sql);
      }
      if(!$result)
      {
        $msgString = "Error adding asset: ".mysql_error();
        $counter = 3;  
      }
      if($counter == 2)
      {
        $msgString = "Asset successfully added.";
        $successCounter = 1;  
      }
    }
    if($successCounter == 1)
    {
      header("location: edit_asset.php?id=$asset_id");
    }
  }
}

if(isset($_POST['addModel']))
{
  $model_type= $_POST['model_type'];
  $sql = addModelType($model_type);
  $result = mysql_query($sql);
  if(!$result)
  {
    $msgString = "Error adding model: ".mysql_error();
  }
  else
  {
    $msgString = "Model successfully added.";
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
    if($asset_id == 0)
    {
      $headerString = "Add New Asset";
      $asset_num = "";
      $emp_id = "";
      $loc_id = "";
      $cat_id = "";
      $manu_id = "";
      $vendor_id = "";
      $model_id = "";
      $date_purchased = "";
      $serial_num = "";
      $serv_code = "";
      $model_num = "";
      $serv_tag = "";
      $ex_serv_tag = "";
      $price = "";
      $invoice_num = "";
      $warranty = "";
      $serv_info = "";
      $notes = "";
      $buttons = "<div id='formAddButtons'  class='editButtonDiv'><input type='submit' value='Add Asset' name='submitChanges'/></div>";
    }
    else
    {
      $sql = getAsset($asset_id);
      $result = mysql_fetch_assoc(mysql_query($sql));
      $asset_num = $result['asset_number'];
      $emp_id = $result['employee_id'];
      $loc_id = $result['location_id'];
      $cat_id = $result['asset_cat_id'];
      $manu_id = $result['manufacturer_id'];
      $vendor_id = $result['vendor_id'];
      $model_id = $result['model_id'];
      $date_purchased = $result['date_purchased'];
      $serial_num = $result['serial_number'];
      $serv_code = $result['service_code'];
      $model_num = $result['model_number'];
      $serv_tag = $result['service_tag'];
      $ex_serv_tag = $result['express_service_tag'];
      $price = $result['price'];
      $invoice_num = $result['invoice_number'];
      $warranty = $result['warranty'];
      $serv_info = $result['service_info'];
      $notes = $result['notes'];
      
      $headerString = "Edit Asset Information for Asset Number ".$asset_num;
      $buttons = "<div id='assetEditButtons' class='editButtonDiv'><input type='submit' value='Save Changes' name='submitChanges'/><input type='submit' value='Delete Asset' id='delete_emp' name='delete' class='delete'/><div class='clear'></div></div>";     
    }
  ?>
    <div id='assetInfoWrapper' class='wrapper'>
      <div id='header'>
        <div id='indListHeader'><?php echo $headerString; ?><br /><?php if($is_deleted == 0 && $asset_id != 0){ ?><a href='info_asset.php?id=<?php echo $asset_id; ?>'>Back to Asset Info</a><?php } ?><a href='list_asset.php'>Back to Listing</a><a href='database_home.php'>Main Page</a></div>
        <div id='headerBody'></div>       
      </div>
      <div id='body'>
      <?php
        if ($is_deleted == 0)
        {
          $assetInfoArray = array(array("Asset Number:", "<input type='text' value='".$asset_num."' id='asset_num' name='asset_num' class='formInput'/>"), 
                                  array("Asset Category:"), array("User:"), array("Location:"), array("Manufacturer:"), array("Vendor:"), array("Model:"), 
                                  array("Date Purchased:", "<input type='text' value='".$date_purchased."' id='date_purchased' name='date_purchased' class='formInput'/>"), 
                                  array("Serial Number:", "<input type='text' value='".$serial_num."' id='serial_num' name='serial_num' class='formInput'/>"), 
                                  array("Service Code:", "<input type='text' value='".$serv_code."' id='serv_code' name='serv_code' class='formInput'/>"), 
                                  array("Model Number:", "<input type='text' value='".$model_num."' id='model_num' name='model_num' class='formInput'/>"), 
                                  array("Service Tag:", "<input type='text' value='".$serv_tag."' id='serv_tag' name='serv_tag' class='formInput'/>"), 
                                  array("Express Service Tag:", "<input type='text' value='".$ex_serv_tag."' id='ex_serv_tag' name='ex_serv_tag' class='formInput'/>"), 
                                  array("Price ($):", "<input type='text' value='".$price."' id='price' name='price' class='formInput'/>"), 
                                  array("Invoice Number:", "<input type='text' value='".$invoice_num."' id='invoice_num' name='invoice_num' class='formInput'/>"), 
                                  array("Warranty:", "<textarea id='warranty' name='warranty' rows='5' cols='40'>".$warranty."</textarea>"), 
                                  array("Service Information:", "<textarea id='serv_info' name='serv_info' rows='5' cols='40'>".$serv_info."</textarea>"), 
                                  array("Notes:", "<textarea id='notes' name='notes' rows='7' cols='40'>".$notes."</textarea>") 
                                 );
          echo "<form method='post' enctype='multipart/form-data' action='edit_asset.php?id=".$asset_id."'><div id='mainFormDiv' class='floatLeft'>";
          $counter = 0;
          foreach($assetInfoArray as $assetInfoRow)
          { 
            echo "<div class='formRow'><div class='assetRT rowTitle'>".$assetInfoRow[0]."</div><div class='formRowInput'>";
            switch($counter)
            {
              case 1:
                echo ""?><select name='cat_id' id='cat_id'><?php getDropDown(listAssetCat(), $cat_id); ?></select><?php ;
                break;
                
              case 2: 
                echo ""?><select name='emp_id' id='emp_id'><?php getDropDown(getEmployeeSimpleList(), $emp_id); ?></select><?php ;
                break;
              
              case 3:
                echo ""?><select name='location_id' id='location_id'><?php getDropDown(getLocList(), $loc_id); ?></select><?php ;
                break;
                
              case 4:
                echo ""?><select name='manufacturer_id' id='manufacturer_id'><?php getDropDown(listManufacturer(), $manu_id); ?></select><?php ;
                break;
                
              case 5:
                echo ""?><select name='vendor_id' id='vendor_id'><?php getDropDown(listSimpleVendor(), $vendor_id); ?></select><?php ; 
                break;
                
              case 6:
                echo ""?><select name='model_id' id='model_id'><?php getDropDown(getModelList(), $model_id); ?></select><?php ;
                break;  
                
              default:
                echo $assetInfoRow[1];
                break;
            }
            echo "</div></div>";
            $counter++;
          }                     
      ?>                                      
            <div id='miscInfo'>
              <input type='hidden' value='<?php echo $loc_id;?>' id='locHold' name='locHold' />
              <input type='hidden' value='<?php echo $emp_id;?>' id='empHold' name='empHold' />
            </div>
          </div>
          <div id='sideFormDiv' class='floatLeft'>
            <div class='sideFormRow'>
              <div class='sideFormRowTitle'>Add New Model:</div>          
              <div class='sideFormRowInput'>
                <textarea id='model_type' name='model_type' rows='5' cols='25'></textarea>
              </div>
              <div id='sideFormButtons' class='editButtonDiv'>
                <input type='submit' value='Add Model' id='addModel' name='addModel' />
              </div>
            </div>
          </div>
          <div class='clear'></div>
          <div id='formFooter'>
            <div id='formButtons'>
              <?php echo $buttons; ?>
            </div>
            <div class='clear'></div>
          </div>
        </form>
      <?php 
        }
      ?>
        <div id='successMsg'><?php echo $msgString; ?>&nbsp;</div>              
      </div>
      <div id='assetFooter'></div>
    </div>
  </body>
</html>