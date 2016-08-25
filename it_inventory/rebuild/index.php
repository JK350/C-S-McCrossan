<?php
require("includes/db_config.php");

if(isset($_GET["id"]))
{
  $equip_sales_id=$_GET["id"];
  $sql = getEquipDetails($equip_sales_id);
  $result = mysql_query($sql);
  if (!$result)
  {
    echo "Error getting equipment record: ".mysql_error();
    die;
  }
  $typeArray = array();
  $sqlType = getTypeList();
  $resultType = mysql_query($sqlType);
  if (!$resultType)
  {
    echo "Error getting type list: ".mysql_error();
    die;
  }
  
  for ($typeRowCount = 0; $typeRowCount < mysql_num_rows($resultType); $typeRowCount++) 
  {
    $myRowType = mysql_fetch_array($resultType);
    $typeArray[$myRowType["type_flag"]] = $myRowType["type_description"];  	
  }
  
  $myRow = mysql_fetch_array($result);
  $item = $myRow["item"];
  $type_desc = $typeArray[$myRow["type_flag"]];
  $cat_desc = $myRow["cat_desc"];
  $equip_make = $myRow["equip_make"];
  $equip_model = $myRow["equip_model"];
	$equip_year = $myRow["equip_year"];
	$location = $myRow["location"];
	$hours_use = $myRow["hours_use"];
	$description = $myRow["description"];
	$price = number_format($myRow["price"], 2);
	$internal_nbr = $myRow["internal_nbr"];
	$contact_name = $myRow["contact_name"];
	$contact_phone = $myRow["contact_phone"];
	$contact_email = $myRow["contact_email"];
	$sold_ind = $myRow["sold_ind"];
	$active_status_flag = $myRow["active_status_flag"];
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
<?php include "includes/html_header_info.html" ?>
<script type="text/javascript">
  $(document).ready(function(){
  	var options = {
  	    zoomWidth: 525,
  	    zoomHeight: 325,
        xOffset: 18,
        yOffset: 0,
        position: "left" //and MORE OPTIONS
  };
  	$('.jqzoom').jqzoom(options);
  });
</script>
  </head>	
  <body>
    <script type="text/javascript">
	   $.swapImage(".swapImageDisjoint", true, true, "click");
    </script>
    <div id='wrapper'>
  		<div id='mainDiv'>
  			<div id='header'>
          <div id='headerImage'>
            <img src='images/company_name.png' alt='C. S. McCrossan' width='350' height='40' />
          </div>
        </div>
  			<div class='clear'></div>
  			<div id='mainBody'>
          <div id='mainContent'>
          <div id='contentTitle'>Surplus Equipment</div>
          <?php
            if(isset($_GET['id']))
            {         
          ?>
          <div id='itemHeader'>
              <?php echo $item; ?>&nbsp;&nbsp;-&nbsp;&nbsp;<?php if ($sold_ind == 1){echo "SOLD";} else{echo "$".$price;} ?>
          </div>
          <div id='saleItem'>
            <div id='itemBody'>
              <?php 
                $itemInfo = array(array("Type:", $type_desc), array("Category:", $cat_desc), array("Make:", $equip_make), array("Model:", $equip_model), array("Year:", $equip_year), array("Location:", $location), array("Hours at Posting:", $hours_use), array("Description:", $description), array("Internal Number:", $internal_nbr));
                foreach ($itemInfo as $itemRow)
                {
                  echo "<div class='itemRow'><div class='rowTitle'>".$itemRow[0]."</div><div class='rowInfo'>".$itemRow[1]."</div><div class='clear'></div></div>";
                }
              ?>
            </div>
            <div id='itemContact'>
              <?php
                $contactInfo = array(array("Contact Name:", $contact_name), array("Contact Phone:", $contact_phone), array("Contact Email", $contact_email));
                foreach ($contactInfo as $contactRow)
                {
                  echo "<div class='contactRow'><div class='rowTitle'>".$contactRow[0]."</div><div class='contactInfo'>".$contactRow[1]."</div></div>";                	
                }
              
              ?>
              <div id='requestInfo'>
                <a href='mailto:<?php echo $contact_email?>?subject=Website Inquiry: <?php echo $internal_nbr." ".$item?>'><img src='images/request_more_info.gif' alt='Request More Information' width='126' height='29' /></a>
              </div>
            </div>
            <div id='return'>
              <a href='index.php' id='eListBack'>Back to Equipment List</a>
             </div>            
          </div>
          <div id='photoGallery'>
            <?php 
              $sql = getEquipImage($equip_sales_id);
              $image_path = "images/equip/".$equip_sales_id."/";
              $result = mysql_query($sql);
              if (!$result)
              {
                echo "Error getting images: ".mysql_error();
                die;
              }
              echo "<div id='preload'>";
              for ($myRowCounter = 0; $myRowCounter < mysql_num_rows($result); $myRowCounter++)
              {
                $row = mysql_fetch_array($result);
                $image_name = $row["image_name"];
                echo "<img src='".$image_path.$image_name."_lg.jpg' width='1' height='1' alt='Equipment Pictures'/>";
              }
              echo "</div>";
              
              $sql = getEquipImage($equip_sales_id);
              $result = mysql_query($sql);
              $first_image=1;
              for ($myRowCounter = 0; $myRowCounter < mysql_num_rows($result); $myRowCounter++)
              {
                $row = mysql_fetch_array($result);
                $image_name = $row["image_name"];
                if ($first_image == 1)
                {
                  $first_image = 0;
                  ?>
                  <div id='hoverPicture'>
                    <a href='<?php echo $image_path.$image_name;?>_lg.jpg' id='lrgImage' name='lrgImage' class='jqzoom' >
                      <img src='<?php echo $image_path.$image_name;?>_med.jpg' id='main' title='zoom image' alt='Equipment Image'/>
                    </a>
                    <p id='hoverText'>Hover over image to zoom</p>
                  </div>
                  <p id='thumbText'>Click thumbnails below for additional images</p>
                <?php
                }
                ?>
                <a href='#' onclick="document.getElementById('lrgImage').href='<?php echo $image_path.$image_name?>_lg.jpg'"><img class="swapImageDisjoint { sin: ['#main:<?php echo $image_path.$image_name?>_med.jpg'], sout: ['#main:<?php echo $image_path.$image_name?>_med.jpg'] }" src="<?php echo $image_path.$image_name?>_sm.jpg" width="80" alt="" /></a>
              <?php
              }
            ?> 
          </div>
          <div class='clear'></div>
          <?php 
            }
            else
            {
              $sql = getEquipList();
              $result = mysql_query($sql);
          ?>
          <div id='equipListHeader'>
            <div class='category equipHeader'>Category</div>
            <div class='make equipHeader'>Make</div>
            <div class='model equipHeader'>Model</div>
            <div class='year equipHeader'>Year</div>
            <div class='location equipHeader'>Location</div>
            <div class='status equipHeader'>Status</div>
            <div class='detail equipHeader'></div>
            <div class='clear'></div>
          </div>
          <div id='equipListBody'>
            <?php
              for ($myRowCounter = 0; $myRowCounter < mysql_num_rows($result); $myRowCounter++)
              {
                //http://us3.php.net/manual/en/function.mysql-fetch-array.php
                /*Following line automatically increments after it has read the current row of the SQL query.  
                The for loop as many times as there are records in the SQL query.  This ensures that the following
                line of code will run through every row of result from the SQL query.*/
                $myRow = mysql_fetch_array($result);  
                
                //Switch to catch whether or not a piece of equipment has been sold or not
                switch ($myRow['sold_ind'])
                {
                  case 0:
                    $soldInd = "<div class='status equipBody'>Available</div>";
                    break;
                  case 1:
                    $soldInd = "<div class='status equipBody'><span class='sold'>SOLD</span></div>";
                    break;
                }
                echo "<div class='equipListRow'><div class='category equipBody'>".$myRow['cat_desc']."</div><div class='make equipBody'>".$myRow['equip_make']."</div><div class='model equipBody'>".$myRow['equip_model']."</div><div class='year equipBody'>".$myRow['equip_year']."</div><div class='location equipBody'>".$myRow['location']."</div>".$soldInd."<div class='detail equipBody'><a href='index.php?id=".$myRow['equip_sales_id']."'>Details</a></div></div>";
              }            
            ?>
            <div class='clear'></div>
          </div>
          <?php
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