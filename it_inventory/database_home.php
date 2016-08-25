<?php
session_start();
include('includes/secureadmin.inc');
require('includes/db_config.php');

if(isset($_POST['submitArea']))
{
  $add_flag = $_POST['add_flag'];
  if ($add_flag != 'blank')
  {
    header("Location: edit_".$add_flag.".".php."?id=0");
  }
}

if(isset($_POST['submitList']))
{
  $list_flag=$_POST['list_flag'];
  if ($list_flag != 'blank')
  {
    header("Location: list_".$list_flag.".".php);
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
      <div id='header'>
        <div id='headerTitle'>Welcome To C. S. McCrossan's IT Inventory Database Home Page</div>
        <div id='headerBody'></div>       
      </div>
      <div id='body'>
        <div id='optionFormArea' class='centeredDiv'>
          <form method='post' enctype='multipart/form-data' action='database_home.php'>    
            <div id='addAreaText' class='rowTitle'>Add:</div>
            <div id='addAreaField' class='floatLeft'>
              <select name='add_flag'>
                <option value='blank'>&nbsp;</option>
                <option value='asset'>Asset</option>
                <option value='asset_cat'>Asset Category</option>
                <option value='department'>Department</option>
                <option value='employee'>Employee</option>
                <option value='location'>Location</option>
                <option value='manufacturer'>Manufacturer</option>
                <option value='model'>Model</option>
                <option value='role'>Role</option>
                <option value='software'>Software</option>
                <option value='toner'>Toner</option>
                <option value='vendor'>Vendor</option>              
              </select>
            </div>
            <div id='addAreaFormSubmit' class='floatLeft'>
              <input type='submit' value='Proceed' name='submitArea' />
            </div> 
          </form>
          <form method='post' enctype='multipart/form-data' action='database_home.php'>
            <div id='listArea' class='floatLeft'>
              <div id='listAreaText' class='rowTitle'>List:</div>
              <div id='listAreaField' class='floatLeft'>
                <select name='list_flag'>
                  <option value='blank'>&nbsp;</option>
                  <option value='asset'>Asset</option>
                  <option value='asset_cat'>Asset Category</option>
                  <option value='department'>Department</option>
                  <option value='employee'>Employee</option>
                  <option value='location'>Location</option>
                  <option value='manufacturer'>Manufacturer</option>
                  <option value='model'>Model</option>
                  <option value='role'>Role</option>
                  <option value='software'>Software</option>
                  <option value='toner'>Toner</option>
                  <option value='vendor'>Vendor</option>              
                </select>
              </div>
              <div id='listAreaFormSubmit' class='floatLeft'>
                <input type='submit' value='List' name='submitList' />
              </div>
            <div class='clear'></div>            
            </div>
            <div class='clear'></div>
          </form>
        </div>
        <div id='searchFormArea'>
          <form id='searchForm' method='post' enctype='multipart/form-data' action='/'>
            <div id='clearButtonDiv' class='centeredDiv'> 
              <input type='button' value='Clear List' id='clearList' onclick='listClear()'/>
            </div>
            <div id='searchFields' class='centeredDiv'>
              <div id='personField' class='floatLeft'>
          			<div id='personSearchField'>
          				Search for a person:
          				<br />
          				<input type='text' size='30' name='personSearch' id='personSearch' onkeyup='getPersonSuggestions(this.value);' onblur='setTimeout("removePersonSuggestions()", 200)' onfocus='listClear()'/>
          			</div>
                <input type='button' id='listPeople' value='List People' />
              </div>
              <div id='assetField' class='floatLeft'>
          			<div id='assetSearchField'>
          				Search for an asset number:
          				<br />
          				<input type='text' size='30' name='assetSearch' id='assetSearch' onkeyup='getAssetSuggestions(this.value);' onblur='setTimeout("removeAssetSuggestions()", 200)' onfocus='listClear()'/>
          			</div>
                <input type='button' id='listAssetNumber' value='List Asset Numbers' />
              </div>
              <div id='locationField' class='floatLeft'>
          			<div id='locationSearchField'>
          				Search for a location:
          				<br />
          				<input type='text' size='30' name='locationSearch' id='locationSearch' onkeyup='getLocationSuggestions(this.value);' onblur='setTimeout("removeLocationSuggestions()", 200)' onfocus='listClear()'/>
          			</div>
                <input type='button' id='listLocation' value='List Locations' />
              </div>
              <div class='clear'></div>
            </div>
      		</form>
        </div>
        <div class='clear'></div>            
        <div id='pageContent'></div>
      </div>
      <div id='footer'></div>
    </div>
  </body>
</html>
