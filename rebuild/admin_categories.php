<?php
session_start();
include('includes/secureadmin.inc');
require("includes/db_config.php");

if (isset($_POST['delete']))
{
  $category_id = $_POST['category_id'];
  $sql = deleteEquipment($category_id);
  $result = mysql_query($sql);
  if (!$result)
  {
    echo "Error Deleting Category: ".mysql_error();
    die;
  }
}
elseif (isset($_POST['submit']))
{
  $type_flag = $_POST['type_flag'];
  $cat_desc = $_POST['cat_desc'];
  if ($_POST['category_id'] > 0)
  {
    $sql = updateCategory($type_flag, $cat_desc, $_POST['category_id']); 
  }
  else
  {
    $sql = insertCategory($type_flag, $cat_desc);
  }
  
  $result = mysql_query($sql);
  if (!$result)
  {
    echo "Error Saving Category: ".mysql_error();
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
              if (isset($_GET['id']) || isset($_GET['add']))
              {
                $category_id = "";
                $cat_desc = "";
                if (isset($_GET['id']))
                {
                  $sql = getOneEquipment($_GET['id']);
                  $result = mysql_query($sql);
                  if (!$result)
                  {
                    echo "Error getting equipment record: ".mysql_error();
                    die;
                  }
                  $myRow = mysql_fetch_array($result);
                  $category_id = $myRow['category_id'];
                  $type_flag = $myRow['equip_type_flag'];
                  $cat_desc = $myRow['cat_desc'];
                }
            ?>
              <form method='post' enctype='multipart/form-data' action='admin_categories.php'>
                <div id='adminEquipHeaderTitle'>
                  <input type='hidden' name='category_id' id='category_id' value='<?php echo $category_id; ?>' />
                  <?php if($category_id > ""){echo "Update ";} else{echo "Add ";} ?>Category
                </div>
                <div id='adminCatBody'>
                  <div class='adminUpdateRow'>
                    <div class='adminUpdateTitle'>Category:</div>
                    <div class='adminCatField'>
                      <input type='text' name='cat_desc' value='<?php echo $cat_desc; ?>' size='29' />
                    </div>
                  </div>
                  <div class='adminUpdateRow'>
                    <div class='adminUpdateTitle'>Equipment Type:</div>
                    <div class='adminCatField'>
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
              </div>
              <div id='formFooter'>
                <input type='submit' value='Save Equipment' name='submit' />
                <?php 
                  if(isset($_GET['id']))
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
                $sql = getEquipment();
                $result = mysql_query($sql);
                if ($result)
                {
            ?>
            <div id='adminEquipHeader'>
              <div id='adminEquipHeaderTitle'>Maintain Equipment</div>
              <div id='adminEquipHeaderLink'><a href='admin_categories.php?add=true'>Add New Category</a></div>
            </div>
            <div id='adminEquipBanner'>
              <div class='adminCategory equipHeader'>Category</div>
              <div class='adminEquipType equipHeader'>Equipment Type</div>
              <div class='adminEdit equipHeader'></div>
            </div>
            <div class='clear'></div>  
            <?php
                  for ($myRowCounter = 0; $myRowCounter < mysql_num_rows($result); $myRowCounter++)
                  {
                    $myRow = mysql_fetch_array($result);
                    echo "<div class='adminCategory equipBody'>".$myRow['cat_desc']."</div><div class='adminEquipType equipBody'>".$myRow['type_description']."</div><div class='adminEdit equipBody'><a href='admin_categories.php?id=".$myRow['category_id']."'>Edit</a></div><div class='clear'></div>";
                  }
                }    
              }
            ?>
          </div>
          <div class='clear'></div>
        </div>
        <div id='footer'>
        </div>
  		</div>
    </div>
  </body>
</html>