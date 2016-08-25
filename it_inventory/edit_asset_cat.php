<?php
session_start();
include('includes/secureadmin.inc');
require('includes/db_config.php');
$msgString = "";
$is_deleted = 0;
$asset_cat_id = $_GET['id'];
if(isset($_POST['delete']))
{ 
  $sql = deleteAssetCat($asset_cat_id);
  $result = mysql_query($sql);
  if(!$result)
  {
    $msgString = "Error deleting asset category: ".mysql_error();
  }
  else
  {
    $msgString = "Asset category successfully deleted.";
    $is_deleted = 1;
  }
}

if(isset($_POST['submitChanges']))
{
  $asset_cat_desc = $_POST['asset_cat_desc'];
  $asset_class_id = $_POST['asset_class'];
  if($_GET['id'] > 0)
  {
    $sql = editAssetCat(mysql_real_escape_string($asset_cat_desc),$asset_class_id ,$asset_cat_id);
    $result = mysql_query($sql);                                               
    if(!$result)
    {
      $msgString = "Error editing asset category: ".mysql_error();
    }
    else
    {
      $msgString = "Asset category successfully edited.";
    }
  }
  else
  {
    $sql = addAssetCat(mysql_real_escape_string($asset_cat_desc), $asset_class_id);
    $result = mysql_query($sql);
    if(!$result)
    {
      $msgString = "Error adding asset category: ".mysql_error();  
    }
    else
    {
      $msgString = "Asset category successfully added.";  
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
    if($asset_cat_id == 0)
    {
      $headerString = "Add a New Asset Category";
      $asset_cat_desc = "";
      $asset_class_id = "";
      $buttons = "<div id='formAddButtons' class='editButtonDiv'><input type='submit' value='Add Asset Category' name='submitChanges'/></div>";
    }
    else
    {
      $sql = getAssetCat($asset_cat_id);
      $result = mysql_fetch_assoc(mysql_query($sql));
      $asset_cat_desc = $result['asset_cat_desc'];
      $asset_class_id = $result['asset_class_id'];
      $headerString = "Edit The Asset Category Information For ".$asset_cat_desc;
      $buttons = "<div id='assetCatEditButtons' class='editButtonDiv'><input type='submit' value='Save Changes' name='submitChanges'/><input type='submit' value='Delete Asset Category' id='delete_manu' name='delete' class='delete'/><div class='clear'></div></div>";     
    }
  ?>
    <div id='wrapper'>
      <div id='header'>
        <div id='indListHeader'><?php echo $headerString; ?><br /><a href='list_asset_cat.php'>Back to Listing</a><a href='database_home.php'>Main Page</a></div>
        <div id='headerBody'></div>       
      </div>
      <div id='body'>
      <?php
        if ($is_deleted == 0)
        {
          $assetCatInfoRow = array(array("Asset Category Name:", "<input type='text' value='".str_replace("'", "&apos;", $asset_cat_desc)."' id='asset_cat_desc' name='asset_cat_desc' class='formInput'/>"), 
                                   array("Asset Category Class:"));
          echo "<div id='assetCatForm' class='centeredDiv'><form method='post' enctype='multipart/form-data' action='edit_asset_cat.php?id=".$asset_cat_id."'>";
          $counter = 0;
          foreach($assetCatInfoRow as $catInfo)
          {
            echo "<div class='formRow'><div class='formRowTitle'>".$catInfo[0]."</div><div class='formRowInput'>";
            switch($counter)
            {
              case 1:
                echo ""?><select name='asset_class' id='asset_class'><?php getDropDown(getAssetClass(), $asset_class_id); ?></select><?php ;
                break;
                
              default:
                echo $catInfo[1];
                break;
            }
            echo "</div></div>";
            $counter++;  
          }                                   
      ?>
            <div id='formFooter'>
              <div id='formButtons'>
                <?php echo $buttons; ?>
              </div>
            </div>          
          </form>
        </div>
      <?php 
        }
      ?>              
      </div>
      <div id='successMsg'><?php echo $msgString; ?>&nbsp;</div>
      <div id='footer'></div>
    </div>
  </body>
</html>
