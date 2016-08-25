<?php
session_start();
include('includes/secureadmin.inc');
require('includes/db_config.php');

if (isset($_POST['delete']))
{
  $equip_sales_id = $_POST['equip_sales_id'];
  $sql = deleteListing($equip_sales_id);
  if (!$result = mysql_query($sql))
  {
    echo "Error Deleting Equipment: ".mysql_error();
    echo $sql;
    die;   	
  }
  
}
elseif (isset($_POST['submit']))
{
  $type_flag = $_POST['type_flag'];
  $category_id = $_POST['category_id'];
  $item = $_POST['item'];
  $equip_make = $_POST['equip_make'];
  $equip_model = $_POST['equip_model'];
  $equip_year = $_POST['equip_year'];
  $location = $_POST['location'];
  $hours_use = $_POST['hours_use'];
  $description = $_POST['description'];
  $price = str_replace(',', '', $_POST['price']);
  $internal_nbr = $_POST['internal_nbr'];
  $contact_info = $_POST['contact_info'];
  $contact_name = $_POST['contact_name'];
  $contact_phone = $_POST['contact_phone'];
  $contact_email = $_POST['contact_email'];
  $sold_ind = $_POST['sold_ind'];
  $active_status_flag = $_POST['active_status_flag'];
  
  if ($_POST['equip_sales_id'] > 0)
  {
    $equip_sales_id = $_POST['equip_sales_id'];
    $sql = updateListing($item, $type_flag, $category_id, $equip_make, $equip_model, $equip_year, $location, $hours_use, $description, $price, $internal_nbr, $contact_name, $contact_phone, $contact_email, $sold_ind, $active_status_flag, $equip_sales_id);
  }
  else
  {
    $sql = insertListing($item, $type_flag, $category_id, $equip_make, $equip_model, $equip_year, $location, $hours_use, $description, $price, $internal_nbr, $contact_name, $contact_phone, $contact_email, $sold_ind, $active_status_flag);
  }
  
  if(!$return = mysql_query($sql))
  {
    echo "Error Saving Equipment: ".mysql_error();
    echo $sql;
    die;
  }
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
<?php include "includes/html_header_info.html" ?>
  </head>	
  <body>
    <div id='wrapper'>
  		<div id='mainDiv'>
<?php include "includes/adminHeader.html" ?>  			
  			<div class='clear'></div>
  			<div id='mainBody'>
          <div id='mainContent'>
          <?php 
          if (isset($_GET['equip_sales_id']) || isset($_GET['action']))
          {
            if (isset($_GET['equip_sales_id']))
            {
              $equip_sales_id = $_GET['equip_sales_id'];
              $sql = getAdminEquip($equip_sales_id);
              $result = mysql_query($sql);
              if (!$result)
              {
                echo "Error getting equipment record:".mysql_error();
                die;  
              }
              
              $myRow = mysql_fetch_array($result);
              $item = $myRow['item'];
              $type_flag = $myRow['type_flag'];
              $category_id = $myRow['category_id'];
              $equip_make = $myRow['equip_make'];
              $equip_model = $myRow['equip_model'];
              $equip_year = $myRow['equip_year'];
              $location = $myRow['location'];
              $hours_use = $myRow['hours_use'];
              $description = $myRow['description'];
              $price = $myRow['price'];
              $internal_nbr = $myRow['internal_nbr'];
              $contact_name = $myRow['contact_name'];
              $contact_phone = $myRow['contact_phone'];
              $contact_email = $myRow['contact_email'];
              $sold_ind = $myRow['sold_ind'];
              $active_status_flag = $myRow['active_status_flag'];
            }
            else
            {
              $equip_sales_id = "";
              $item = "";
              $type_flag = "";
              $category_id = "10";
              $equip_make = "";
              $equip_model = "";
              $equip_year = "";
              $location = "";
              $hours_use = "";
              $description = "";
              $price = "";
              $internal_nbr = "";
              $contact_name = "";
              $contact_phone = "";
              $contact_email = "";
              $sold_ind = "0";
              $active_status_flag = "2";
            }
            ?>
            <div id='adminListingReturn'>
              <a href='admin_equip.php'>Return to Listing</a>
            </div>
            <form method='post' enctype='multipart/form-data' action='admin_equip.php' >
              <div id='adminEquipHeaderTitle'>
                <input type='hidden' name='equip_sales_id' id='equip_sales_id' value='<?php echo $equip_sales_id; ?>' />
                <?php if($equip_sales_id > ""){echo "Update ";} else{echo "Add ";} ?>Surplus Equipment
              </div>
              <div class='adminUpdateRow'>
                <div class='adminUpdateTitle'>Published Status:</div>
                <div class='adminUpdateField'>
                  <select name='active_status_flag'>
                    <option value='0' <?php if($active_status_flag == '0'){echo "selected='selected'";}?>>Inactive</option>
                    <option value='1' <?php if($active_status_flag == '1'){echo "selected='selected'";} ?>>Published on Website</option>
                    <option value='2' <?php if($active_status_flag == '2'){echo "selected='selected'";} ?>>Draft</option>
                  </select>
                </div>
              </div>
              <div class='adminUpdateRow'>
                <div class='adminUpdateTitle'>Type:</div>
                <div class='adminUpdateField'>
                  <select name='type_flag'>
                  <?php 
                    $sqlType = getTypeList();
                    $resultType = mysql_query($sqlType);
                    for ($typeRowCount = 0; $typeRowCount < mysql_num_rows($resultType); $typeRowCount++)
                    {
                      $myRow = mysql_fetch_array($resultType);
                      $flag = $myRow['type_flag'];
                      $type = $myRow['type_description'];
                      $selected = "";
                      if ($flag == $type_flag)
                      {
                        $selected = "selected='selected'";
                      }
                      echo "<option value='".$flag."' ".$selected.">".$type."</option>";
                    }
                  ?> 
                  </select>
                </div>
              </div>
              <div class='adminUpdateRow'>
                <div class='adminUpdateTitle'>Category:</div>
                <div class='adminUpdateField'>
                  <select name='category_id'>
                  <?php
                    $sql = getCatList();
                    $result = mysql_query($sql);
                    for ($typeRowCount = 0; $typeRowCount < mysql_num_rows($result); $typeRowCount++)
                    {
                      $selected = "";
                      $myRow =  mysql_fetch_array($result);
                      $id = $myRow['category_id'];
                      $typeDesc = $myRow['cat_desc'];
                      if ($id == $category_id)
                      {
                        $selected = "selected='selected'";
                      }
                      echo "<option value='".$id."' ".$selected.">".$typeDesc."</option>";
                    }
                  ?>
                  </select>
                </div>
              </div>
              <?php 
              $inputArray = array(array("Make:","equip_make", $equip_make, "40", "onblur='javascript:updateItem();'"), array("Model:", "equip_model", $equip_model, "40", "onblur='javascript:updateItem();'"), array("Item:","item", $item, "40", ""), array("Year:","equip_year", $equip_year, "5", ""));
              foreach ($inputArray as $inputLine)
              {
                echo "<div class='adminUpdateRow'><div class='adminUpdateTitle'>".$inputLine[0]."</div><div class='adminUpdateField'><input type='text' name='".$inputLine[1]."' id='".$inputLine[1]."' value='".$inputLine[2]."' size='".$inputLine[3]."' ".$inputLine[4]."></input></div></div>";
              }
              ?>
              <div class='adminUpdateRow'>
                <div class='adminUpdateTitle'>Location:</div>
                <div class='adminUpdateField'>
                  <select name='location'>
                    <option value='Maple Grove (Minneapolis), MN' <?php if($location == 'Maple Grove (Minneapolis), MN'){echo "selected='selected'";}?>>Maple Grove (Minneapolis), MN</option>
                    <option value='Tolleson (Phoenix), AZ' <?php if($location == 'Tolleson (Phoenix), AZ'){echo "selected='selected'";} ?>>Tolleson (Phoenix), AZ</option>
                  </select>
                </div>
              </div>
              <div class='adminUpdateRow'>
                <div class='adminUpdateTitle'>Description:</div>
                <div class='adminUpdateField'>
                  <input type='text' name='description' value="<?php echo $description ?>" size='50' />
                </div>
              </div>              
              <?php 
              $inputArray = array(array("Hours at Posting:","", "hours_use", $hours_use, "10"), array("Price:","$", "price", $price, "10"), array("Internal Number:","", "internal_nbr", $internal_nbr, "10"));
              foreach ($inputArray as $inputLine)
              {
                echo "<div class='adminUpdateRow'><div class='adminUpdateTitle'>".$inputLine[0]."</div><div class='adminUpdateField'>".$inputLine[1]."<input type='text' name='".$inputLine[2]."' value='".$inputLine[3]."' size='".$inputLine[4]."' /></div></div>";
              }
              ?>
              <div class='adminUpdateRow'>
                <div class='adminUpdateTitle'>Contact Info:</div>
                <div class='adminUpdateField'>
                  <select name='contact_info' id='contact_info' onchange='javascript:updateContact();'>
                    <option value='' <?php if($contact_name == ''){echo "selected='selected'";}?>>[Select Contact]</option>
                    <option value='Bruce Jonason' <?php if($contact_name == 'Bruce Jonason'){echo "selected='selected'";} ?>>Bruce Jonason</option>
                    <option value='Equipment Sales' <?php if($contact_name == 'Equipment Sales'){echo "selected='selected'";} ?>>Equipment Sales</option>
                    <option value='Joe McCrossan' <?php if($contact_name == 'Joe McCrossan'){echo "selected='selected'";} ?>>Joe McCrossan</option>
                  </select>
                </div>
              </div>
              <?php 
              $inputArray = array(array("Contact Name:","contact_name", $contact_name, "40"), array("Contact Phone:", "contact_phone", $contact_phone, "11"), array("Contant Email:","contact_email", $contact_email, "40"));
              foreach ($inputArray as $inputLine)
              {
                echo "<div class='adminUpdateRow'><div class='adminUpdateTitle'>".$inputLine[0]."</div><div class='adminUpdateField'><input type='text' name='".$inputLine[1]."' id='".$inputLine[1]."' value='".$inputLine[2]."' size='".$inputLine[3]."' ></input></div></div>";
              }
              ?>
              <div class='adminUpdateRow'>
                <div class='adminUpdateTitle'>Sold Status:</div>
                <div class='adminUpdateField' id='adminSoldField'>
                  <input type='radio' name='sold_ind' value='0' <?php if($sold_ind == "0"){echo "checked='checked'";} ?> /> <div>Available</div>
                  <input type='radio' name='sold_ind' value='1' <?php if($sold_ind == "1"){echo "checked='checked'";} ?> /> <div>Sold</div>
                </div>
              </div>
              <div class='clear'></div>
              <div id='formFooter'>
                <input type='submit' value='Save Equipment' name='submit' />
                <?php 
                  if(isset($_GET['equip_sales_id']))
                  {
                    echo "<input type='submit' value='Delete Equipment' name='delete' onclick='return checkDelete();' />";
                  }
                ?>
              </div>
            </form>
          <?php                                      
          }
          else
          {
            $sql = getEquipListAdmin();
            $result = mysql_query($sql);
            if ($result)
            {
          ?>
            <div id='adminEquipHeader'>
              <div id='adminEquipHeaderTitle'>Maintain Surplus Equipment</div>
              <div id='adminEquipHeaderLink'><a href='admin_equip.php?action=new'>Add Surplus Equipment</a></div>
            </div>
            <div id='adminEquipBanner'>
              <div class='adminCategory equipHeader'>Category</div>
              <div class='adminMake equipHeader'>Make</div>
              <div class='adminModel equipHeader'>Model</div>
              <div class='adminYear equipHeader'>Year</div>
              <div class='adminLocation equipHeader'>Location</div>
              <div class='adminStatus equipHeader'>Status</div>
              <div class='adminSold equipHeader'>Sold</div>
              <div class='adminEdit equipHeader'></div>
              <div class='adminImages equipHeader'></div>
              <div class='clear'></div>            
            </div>
            <?php 
              for ($myRowCounter = 0; $myRowCounter < mysql_num_rows($result); $myRowCounter++)
              {
                $myRow = mysql_fetch_array($result);
                $sqlImage = getPictureCount($myRow['equip_sales_id']);
                $resultImage = mysql_query($sqlImage);
                if (mysql_num_rows($resultImage) >= 0)
                {
                  $imageCount = "<span class='sold'>(".mysql_num_rows($resultImage).")</span>";
                }
                switch ($myRow['active_status_flag'])
                {
                  case 0:
                    $statusFlag = "<div class='adminStatus equipBody'>Inactive</div>";
                    break;
                  case 1:
                    $statusFlag = "<div class='adminStatus equipBody'>Published</div>";
                    break;
                  case 2:
                    $statusFlag = "<div class='adminStatus equipBody'>Draft</div>";
                    break;
                }
                if($myRow['sold_ind']==1)
                {
                  $soldInd = "<div class='adminSold equipBody'><span class='sold'>SOLD</span></div>";
                }
                else
                {
                  $soldInd = "<div class='adminSold equipBody'></div>";
                }
                echo "<div class='adminRowList'><div class='adminCategory equipBody'>".$myRow['cat_desc']."</div><div class='adminMake equipBody'>".$myRow['equip_make']."</div><div class='adminModel equipBody'>".$myRow['equip_model']."</div><div class='adminYear equipBody'>".$myRow['equip_year']."</div><div class='adminLocation equipBody'>".$myRow['location']."</div>".$statusFlag.$soldInd."<div class='adminEdit equipBody'><a href='admin_equip.php?equip_sales_id=".$myRow['equip_sales_id']."'>Edit</a></div><div class='adminImages equipBody'><a href='admin_equip_images.php?equip_sales_id=".$myRow['equip_sales_id']."'>Images</a> ".$imageCount."</div><div class='clear'></div></div>";
              }
            }  
          }          
          ?>
  			 </div>
        </div>
        <div id='footer'>
        </div>
  		</div>
    </div>
  </body>
</html>