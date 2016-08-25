<?php
session_start();
include('includes/secureadmin.inc');
require('includes/db_config.php');

$sql = listEmployee();
$result = mysql_query($sql);

if (!$result)
{
  echo "Error getting assets: ".mysql_error();
  die;
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
<?php include "includes/html_header_info.html" ?>
  </head>	
  <body>
    <div id='employeeWrapper' class='wrapper'>
      <div id='listHeader'>C. S. McCrossan Employee Listing<br /><a href='database_home.php'>Return To Main Page</a>
      </div>
      <div class='clear'></div>
      <div id='body'>
        <div id='listBanner'>
          <div class='floatLeft empName'>Employee Name</div>
          <div class='floatLeft role'>Role</div>
          <div class='floatLeft location'>Location</div>
          <div class='floatLeft extension'>Extension</div>
          <div class='floatLeft nexNum'>Nextel Number</div>
          <div class='floatLeft office'>Office</div>
          <div class='floatLeft nexSpeed'>Speed</div>
          <div class='floatLeft nexID'>ID</div>
          <div class='floatLeft editEmp'><a href='edit_employee.php?id=0'>Add</a></div>
          <div class='clear'></div>
        </div>
        <div id='listMain'>
          <?php
            $classList = array("empName", "role", "location", "extension", "nexNum", "office", "nexSpeed", "nexID", "editEmp");        
            while($row = mysql_fetch_row($result))
            {
              $intI = 0;
              echo "<div class='listRow employeeRow'>";
              foreach($row as $rowData)
              {
                if($rowData == '')
                {
                  $rowData = "&nbsp;";
                }
                if($intI < 8)
                {
                  echo "<div class='floatLeft ".$classList[$intI]."'>".$rowData."</div>";
                }
                else
                {
                  echo "<div class='floatLeft ".$classList[$intI]."'><input type='hidden' class='emp_id_hidden' value='".$rowData."' /><a href='edit_employee.php?id=".$rowData."'>Edit</a></div>";
                }
                $intI++;                
              }
              echo "<div class='clear'></div>";
              echo "</div>";           
            }           
          ?>
        </div>
      </div>
      <div class='clear'></div>
      <div id='footer'>
        <script type='text/javascript'>
          $('.employeeRow').click(function()
          {
            var employee_id = $(this).children('.editEmp').children('.emp_id_hidden').val();
            window.location.href = 'info_employee.php?id='+employee_id;
          });
        </script>
      </div>
    </div>
  </body>
</html>