<?php
session_start();
include('includes/secureadmin.inc');
require('includes/db_config.php');

$target_path = 'images/equip/';

if (isset($_GET['process'])){
	$equip_sales_id = $_POST['equip_sales_id'];
  $uploads_dir = $target_path.$equip_sales_id."/";
  if(!is_dir($uploads_dir))
  {
    mkdir($uploads_dir);
  }
  
	$sort_order = $_POST['sort_order'];
	$tmp_name = $_FILES['Filedata']['tmp_name'];
	$file_name = $_FILES['Filedata']['name'];
	$ext = substr(strrchr($file_name, '.'), 1);
	$image_name= substr($file_name, 0, strpos($file_name, '.'));
	$filename_lg = $uploads_dir."/" .$image_name."_lg.jpg";

	if (strtolower($ext) == 'jpg' || strtolower($ext) == 'jpeg')
  {
			move_uploaded_file($tmp_name, $filename_lg);
  }
	else
  {
	  echo "The image must be a jpg file";
  }
  
  // Create Medium and Thumbnail versions of image
	$im=ImageCreateFromJPEG($filename_lg); 
	$width=ImageSx($im);              // Original picture width is stored
	$height=ImageSy($im);             // Original picture height is stored
  // Create Medium _med version
	$med_width = 252;
	$med_height = 189;
	$med_image=imagecreatetruecolor($med_width,$med_height);      
	imagecopyResampled($med_image,$im,0,0,0,0,$med_width,$med_height,$width,$height);
	//imageCopyResized($med_image,$im,0,0,0,0,$med_width,$med_height,$width,$height);
	$filename_med = $uploads_dir."/".$image_name."_med.jpg";
	ImageJpeg($med_image,$filename_med);
	chmod("$filename_med",0777);
  // Create Small _sm version
	$im_sm=ImageCreateFromJPEG($filename_lg); 
	$sm_width = 80;
	$sm_height = 54;
	$sm_image=imagecreatetruecolor($sm_width,$sm_height);                 
	imageCopyResampled($sm_image,$im_sm,0,0,0,0,$sm_width,$sm_height,$width,$height);
	$filename_sm = $uploads_dir."/".$image_name."_sm.jpg";
	ImageJpeg($sm_image,$filename_sm);
	chmod("$filename_sm",0777);
  
  $sql = insertImage($equip_sales_id, $image_name, $sort_order);
  if (!$result = mysql_query($sql)) 
  {
		echo "Error Saving Images: " . mysql_error();
		echo $sql;
		die;
	}
  
}
elseif (isset($_POST["processEdit"]))
{
  $equip_image_id = $_GET['equip_image_id'];
  $sql = updateImage($_POST['sort_order'], $equip_image_id);
  if (!$result = mysql_query($sql))
  {
    echo "Error Saving Images: " . mysql_error();
  	echo $sql;
  	die;
  }
}
elseif (isset($_GET["delete"]))
{
  $equip_image_id = $_GET['equip_image_id'];
  $sql = getSingleImage($equip_image_id);
  $result = mysql_query($sql);
	$myrow = mysql_fetch_array($result);
	$equip_sales_id = $myrow["equip_sales_id"];
	$filename_ = $myrow["image_name"].".jpg";
  $uploads_dir = $target_path.$equip_sales_id;
	$filename_lg = $uploads_dir."/".$myrow["image_name"]."_lg.jpg";
  unlink($filename_lg);
	$filename_med = $uploads_dir."/".$myrow["image_name"]."_med.jpg";
  unlink($filename_med);
	$filename_sm = $uploads_dir."/".$myrow["image_name"]."_sm.jpg";
  unlink($filename_sm);
  
  $sql = deleteImage($equip_image_id);
  if (!$result = mysql_query($sql))
  {
    echo "Error Deleting Image: " . mysql_error();
  	echo $sql;
	 die;
  }
  
  $host  = $_SERVER['HTTP_HOST'];
	$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	$extra = 'admin_equip_images.php?equip_sales_id='.$equip_sales_id;
	header("Location: http://$host$uri/$extra");  
}
  
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
<?php include "includes/html_header_info.html" ?>
  <link type='text/css' rel='stylesheet' href='css/agile-uploader.css' />
  <script type='text/javascript' src='js/jquery.flash.min.js'></script>
  <script type='text/javascript' src='js/agile-uploader-2.0.min.js'></script>
  </head>	
  <body>
    <div id='wrapper'>
  		<div id='mainDiv'>
<?php include "includes/adminHeader.html" ?>  			
  			<div class='clear'></div>
  			<div id='mainBody'>
          <div id='mainContent'>
          <?php
            if (!isset($_GET['edit']))
            {
              $equip_sales_id = $_GET['equip_sales_id'];
          ?>
            <div id='adminListingReturn'>
              <a href='admin_equip.php'>Return to Equipment Listing</a>
            </div>
            <div id='adminEquipHeader'>
              <div id='adminEquipHeaderTitle'>Update Equipment Image</div>
              <div class='adminImageHeaderId'>Equipment ID: <?php echo $equip_sales_id ?></div>
              <div id='adminEquipImageTitle'>Current Image Files:</div>
            </div>
          <?php
              $sql = getEquipImages($equip_sales_id);
              $result = mysql_query($sql);
              if (!$result)
              {
                echo "Error Loading Equipment Images: ".mysql_error();
                echo $sql;
                die;
              }
              if (mysql_num_rows($result) > 0)
              {
          ?>    <div id='imageTable'>
                  <div class='imageRow'>
                    <div class='image imageBodyHeader'>Image</div>
                    <div class='imageFile imageBodyHeader'>Filename</div>
                    <div class='imageOrder imageBodyHeader'>Order</div>
                    <div class='imageEdit imageBodyHeader'>&nbsp;</div>
                    <div class='imageDelete imageBodyHeader'>&nbsp;</div>
                  </div>
                </div>
          <?php
                for ($typeRowCount = 0; $typeRowCount < mysql_num_rows($result); $typeRowCount++)
                {
                  $myRow = mysql_fetch_array($result);
                  $image_full = "images/equip/".$myRow['equip_sales_id']."/".$myRow['image_name']."_sm.jpg";
                  $max_width = 80;
                  $max_height = 54;
                  list($width, $height) = getimagesize($image_full);
                  $ratioH = $max_height/$height;
                  $ratioW = $max_width/$width;
                  $ratio = min($ratioH, $ratioW);
                  $width = intval($ratio*$width);
                  $height = intval($ratio*$height);
                  echo "<div class='imageRow'><div class='image imageBody'><img src='".$image_full."' width='".$width."' height='".$height."' alt='".$image_full."' /></div><div class='imageFile imageBody'>".$myRow['image_name']."</div><div class='imageOrder imageBody'>".$myRow['sort_order']."</div><div class='imageEdit imageBody'><a href='admin_equip_images.php?edit=true&amp;equip_sales_id=".$equip_sales_id."&amp;equip_image_id=".$myRow['equip_image_id']."'>Edit</a></div><div class='imageDelete imageBody'><a href='admin_equip_images.php?delete=true&amp;equip_sales_id=".$equip_sales_id."&amp;equip_image_id=".$myRow['equip_image_id']."' onclick='return confirm(&quot;Are you sure that you want to delete?&quot;)'>Delete</a></div></div>";
                }
              }
              else
              {
                echo "<div id='noPics'>There are no images currently assigned to this equipment.</div>";
              }
          ?>
              <div class='clear'></div>
              <div id='photoFooter'>
                <form id='singularDemo' enctype='multipart/form-data' action=''>
                  <div id='adminEquipFooterTitle'>Add a New Image</div>
                  <div class='footerRow'>
                    <div class='footerRowTitle'>Image File:</div>
                    <div class='footerRowField'>
                      <div id='single'>
                      </div>
                    </div>
                  </div>
                  <div class='clear'></div>
                  <div class='footerRow'>
                    <div class='footerRowTitle'>Sort Order: </div>
                    <div class='footerRowField'>
                      <input type='text' id='sort_order' name='sort_order' size='5' />
                    </div>
                  </div>
                  <div class='clear'></div>
                  <div id='submitButton'>
                    <a href='#' onclick='document.getElementById(&apos;agileUploaderSWF&apos;).sendForm();'> <img src='images/search_submit.jpg' alt='Submit Photo' width='72' height='19' /></a>
                    <input type='hidden' name='equip_sales_id' value='<?php echo $equip_sales_id; ?>' />
                  </div>
                </form>
              </div>
              <script type='text/javascript'>
    	           $('#single').agileUploaderSingle(
                 {
    		          submitRedirect: 'admin_equip_images.php?equip_sales_id=<?php echo $equip_sales_id?>',
    		          formId: 'singularDemo',
    		          flashVars:
                  {
							     max_width: '1024',
							     max_height: '768',
    			         form_action: 'admin_equip_images.php?process=true&amp;equip_sales_id=<?php echo $equip_sales_id; ?>'
    		          }	
    	           });    	
              </script>
          <?php  
            }
            else
            {
              $equip_sales_id = $_GET['equip_sales_id'];
              $equip_image_id = $_GET['equip_image_id'];
              $sql = getSingleImage($equip_image_id);
              $result = mysql_query($sql);
              if ($result)
              {
                $myRow = mysql_fetch_array($result);
          ?>
                <div id='adminListingReturn'>
                  <a href='admin_equip.php'>Return to Equipment Listing</a>
                </div>
                <div id='adminEquipHeader'>
                  <div id='adminEquipHeaderTitle'>Edit Equipment Image Sort Order</div>
                  <div class='adminImageHeaderId'>Equipment ID: <?php echo $equip_sales_id; ?></div>
                  <div class='adminImageHeaderId'>Image Name: <?php echo $myRow['image_name']; ?></div>
                </div>
                <form method='post' action='admin_equip_images.php?equip_sales_id=<?php echo $equip_sales_id ?>&amp;equip_image_id=<?php echo $equip_image_id?>'>
                  <div id='adminEditFormImg'><img src='images/equip/<?php echo $equip_sales_id."/".$myRow['image_name']."_med.jpg"; ?>' alt='The Image' width='125' /></div>
                  <div class='footerRow'>  
                    <div class='footerRowTitle'>Sort Order:</div>
                    <div id='footerRowField'>
                      <input type='text' name='sort_order' value='<?php echo $myRow['sort_order']; ?>' />
                    </div>
                  </div>
                  <div id='submitButton'>
                    <input type='submit' name='processEdit' value='Submit' />
                  </div>
                </form>
          <?php
              }
              else
              {
                echo "<div id='noPics'>Image Not Found.</div>"; 
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