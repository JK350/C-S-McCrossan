<?php 

// modify these constants to fit your environment

if (!defined("DB_SERVER")) define("DB_SERVER", "localhost");
if (!defined("DB_NAME")) define("DB_NAME", "it_inventory");
if (!defined("DB_USER")) define ("DB_USER", "root");
if (!defined("DB_PASSWORD")) define ("DB_PASSWORD", "test");

$connStr = mysql_connect(DB_SERVER, DB_USER, DB_PASSWORD);
mysql_select_db(DB_NAME, $connStr);

function getDropDown($sql, $id)
{
  $result = mysql_query($sql);
  echo "<option value='NULL'>&nbsp;</option>";
  for ($rowCount = 0; $rowCount < mysql_num_rows($result); $rowCount++)
  {
    $row = mysql_fetch_array($result);
    if($row[0] == $id)
    {
      echo "<option value='".$row[0]."' selected='selected'>".$row[1]."</option>";
    }
    else
    {
      echo "<option value='".$row[0]."'>".$row[1]."</option>";
    }
  };
}


/*     inventory_login_csm.php SQL queries     */

function getUsernamePassword()
{
  return "SELECT * FROM access;";
}

function getSpecificUsernamePassword($user)
{
  return "SELECT username, userPW FROM access WHERE username = '".$user."';";
}

function updateUserPassword($user, $newPassword, $oldPassword)
{
  return "UPDATE access SET userPW = '".$newPassword."' WHERE username = '".$user."' AND userPW = '".$oldPassword."' LIMIT 1;";
}

/*     database_home.php SQL queries     */

function personSearch($userPart)
{
  return "SELECT employee_full_name, employee_id FROM employees WHERE employee_full_name LIKE '%".$userPart."%' AND is_deleted = 0 ORDER BY employee_full_name ASC;";
}

function personList()
{
  return "SELECT employee_full_name, employee_id FROM employees WHERE is_deleted = 0 ORDER BY employee_full_name ASC;";
}

function assetSearch($userPart)
{
  return "SELECT t1.Asset_Number, t2.Asset_Cat_Desc, t1.Model, t1.Asset_ID 
          FROM assets AS t1
            JOIN asset_categories AS t2 ON t1.Asset_Cat_ID = t2.Asset_Cat_ID
          WHERE t1.Asset_Number LIKE '%".$userPart."%' AND t1.Is_Deleted = 0 
          ORDER BY t1.Asset_Number ASC;";
}

function assetList()
{
  return "SELECT t1.Asset_Number, t2.Asset_Cat_Desc, t1.Model, t1.Asset_ID 
          FROM assets as t1 
            JOIN asset_categories AS t2 ON t1.Asset_Cat_ID = t2.Asset_Cat_ID 
          WHERE t1.Asset_Number > 0 AND t1.Is_Deleted = 0 
          ORDER BY t1.Asset_Number ASC;";
}

function locationSearch($userPart)
{
  return "SELECT location, location_id FROM locations WHERE location LIKE '%".$userPart."%' AND is_deleted = 0 ORDER BY location ASC;";
}

function locationList()
{
  return "SELECT location, location_id FROM locations WHERE is_deleted = 0 ORDER BY location ASC;";
}

/*     list_asset.php SQL queries     */

function listAssets()
{
  return "SELECT t1.Asset_Number AS Asset_Num, t2.Asset_Cat_Desc AS Cat_Desc, t3.Manufacturer_Name AS Manufacturer, t4.Vendor_Name AS Vendor, t1.Model AS Model, t6.Employee_Full_Name AS Emp_Name, t8.Location AS Location, t1.Asset_ID AS Asset_ID

          FROM assets as t1
            LEFT JOIN asset_categories as t2 ON t1.Asset_Cat_ID = t2.Asset_Cat_ID
            LEFT JOIN manufacturers as t3 ON t1.Manufacturer_ID = t3.Manufacturer_ID
            LEFT JOIN vendors as t4 ON t1.Vendor_ID =  t4.Vendor_ID
            LEFT JOIN employee_assets as t5 ON t1.Asset_ID = t5.Asset_ID
            	LEFT JOIN employees as t6 ON t5.Employee_ID = t6.Employee_ID
            LEFT JOIN location_assets as t7 ON t1.Asset_ID = t7.Asset_ID
            	LEFT JOIN locations as t8 ON t7.Location_ID = t8.Location_ID

          WHERE t1.Is_Deleted = 0
          
          ORDER BY Asset_Num ASC;";
}

/*     list_asset_cat.php SQL queries     */

function listAssetCat()
{
  return "SELECT Asset_Cat_ID, Asset_Cat_Desc FROM Asset_Categories WHERE is_deleted = 0 ORDER BY Asset_Cat_Desc ASC;";
}

/*     list_employee.php SQL queries     */

function listEmployee()
{
  return "SELECT t1.Employee_Full_Name AS Emp_Name, t2.Role_Description AS Role, t3.Location AS Location, t1.Extension AS Extension, t1.Nextel_Number AS Nextel_Num, t1.Office AS Office, t1.Nextel_Speed AS Nextel_Speed, t1.Nextel_ID AS Nextel_ID, t1.Employee_ID as Emp_ID

          FROM employees as t1
          	LEFT JOIN roles as t2 ON t1.Role_ID = t2.Role_ID
          	LEFT JOIN locations as t3 ON t1.Location_ID = t3.Location_ID
	     
          WHERE t1.is_deleted = 0
  
          ORDER BY
          	Emp_Name ASC;";
}

/*     list_manufacturer.php SQL queries     */

function listManufacturer()
{
  return "SELECT manufacturer_ID, manufacturer_name FROM manufacturers WHERE is_deleted = 0 ORDER BY manufacturer_name ASC;";
}

/*     list_department.php SQL queries     */

function listDepartment()
{
  return "SELECT dept_ID, dept_name FROM departments WHERE is_deleted = 0 ORDER BY dept_name ASC;";
}

/*     list_model.php SQL queries     */

function listModel()
{
  return "SELECT model_id, model_description FROM models WHERE is_deleted = 0 ORDER BY model_description ASC;";
}

/*     list_role.php SQL queries     */

function listRole()
{
  return "SELECT role_ID, role_description FROM roles WHERE is_deleted = 0 ORDER BY role_description ASC;";
}

/*     list_vendor.php SQL queries    */

function listVendor()
{
  return "SELECT vendor_name, vendor_phone, vendor_email, vendor_ID FROM vendors WHERE is_deleted = 0 ORDER BY vendor_name ASC;";
}

function listSimpleVendor()
{
  return "SELECT vendor_ID, vendor_name FROM vendors WHERE is_deleted = 0 ORDER BY vendor_name ASC;";
}

/*     list_location.php SQL queries     */

function listLocation()
{
  return "SELECT location, location_address, location_main_phone, location_ID FROM locations WHERE is_deleted = 0 ORDER BY location ASC;";
}

/*     list_software.php SQL queries     */

function listSoftware()
{
  return "SELECT t1.Software_Name AS software_name, t1.Version AS version, t1.Number_Licences AS num_license, t1.License_Number AS license_num, t1.price, t1.Software_Asset_ID AS software_ID  FROM software as t1 WHERE is_deleted = 0 ORDER BY t1.software_name ASC;";
}

function getAssetID($asset_ID)
{
  return "SELECT asset_number FROM assets WHERE asset_ID=".$asset_ID.";";
}

/*     list_toner.php SQL queries     */

function listToner()
{
  return "SELECT t1.toner_description, t1.toner_model, t1.num_in_stock, t1.price, t1.toner_asset_id FROM toners AS t1 WHERE t1.is_deleted = 0 ORDER BY t1.toner_description ASC;";
}

/*     asset_info.php SQL queries     */

function getAssetInformation($asset_ID)
{
  return "SELECT t2.Asset_Cat_Desc AS Cat_Desc, t3.Manufacturer_Name AS Manufacturer, t4.Vendor_Name AS Vendor, t1.Model AS Model, t6.Employee_Full_Name AS Emp_Name, t8.Location AS Location, t1.Date_Purchased AS Date_Purchased, t1.Serial_Number AS Serial_Num, t1.Service_Code AS Serv_Code, t1.Model_Number as Model_Num, t1.Service_Tag AS Serv_Tag, t1.Express_Service_Tag AS Ex_Serv_Tag, t1.Price AS Price, t1.Invoice_Number AS Invoice_Num, t1.Warranty AS Warranty, t1.Service_Info AS Serv_Info, t1.Notes AS Notes, t1.Asset_Number AS Asset_Num

          FROM assets as t1
            LEFT JOIN asset_categories as t2 ON t1.Asset_Cat_ID = t2.Asset_Cat_ID
            LEFT JOIN manufacturers as t3 ON t1.Manufacturer_ID = t3.Manufacturer_ID
            LEFT JOIN vendors as t4 ON t1.Vendor_ID =  t4.Vendor_ID
            LEFT JOIN employee_assets as t5 ON t1.Asset_ID = t5.Asset_ID
            	LEFT JOIN employees as t6 ON t5.Employee_ID = t6.Employee_ID
            LEFT JOIN location_assets as t7 ON t1.Asset_ID = t7.Asset_ID
            	LEFT JOIN locations as t8 ON t7.Location_ID = t8.Location_ID

         	WHERE t1.Asset_Id = ".$asset_ID.";";
}

function getEmpID($emp_name)
{
  return "SELECT employee_id FROM employees WHERE employee_full_name = '".$emp_name."';";
}

function getLocID($loc_name)
{
  return "SELECT location_id FROM locations WHERE location = '".$loc_name."';";
}

/*     employee_info.php SQL queries     */

function getEmpInfo($emp_id)
{
  return "SELECT t1.employee_full_name, t2.location

          FROM employees as t1
          	LEFT JOIN locations as t2 ON t1.Location_ID = t2.Location_ID
          	
          WHERE t1.Employee_ID = ".$emp_id."";
}


function getEmpAssets($emp_id)
{
  return "SELECT t2.Asset_Number, t5.Asset_Cat_Desc, t4.Manufacturer_Name, t6.Vendor_Name, t2.Model, t2.Date_Purchased, t2.Asset_ID

          FROM employee_assets as t1
          	JOIN assets as t2 ON t1.Asset_ID = t2.Asset_ID
          		LEFT JOIN manufacturers as t4 ON t2.Manufacturer_ID = t4.Manufacturer_ID
          		LEFT JOIN asset_categories as t5 ON t2.Asset_Cat_ID = t5.Asset_Cat_ID
          		LEFT JOIN vendors as t6 ON t2.Vendor_ID = t6.Vendor_ID
          	JOIN employees as t3 ON t1.Employee_ID = t3.Employee_ID
          
          WHERE	t1.Employee_ID = ".$emp_id."
          
          ORDER BY t2.Asset_Number;";
}

/*     location_info.php SQL queries     */

function getLocInfo($loc_id)
{
  return "SELECT location, location_address, location_main_phone FROM locations WHERE location_id =".$loc_id.";";
}

function getLocAssets($loc_id)
{
  return "SELECT t6.Employee_ID, t6.Employee_Full_Name, t3.Asset_ID, t3.Asset_Number, t7.Asset_Cat_Desc, t4.Manufacturer_Name, t3.Model

          FROM locations AS t1
          	LEFT JOIN location_assets AS t2 ON t1.Location_ID = t2.Location_ID
          		LEFT JOIN assets AS t3 ON t2.Asset_ID = t3.Asset_ID
          			LEFT JOIN manufacturers AS t4 ON t3.Manufacturer_ID = t4.Manufacturer_ID
          			LEFT JOIN asset_categories AS t7 ON t3.Asset_Cat_ID = t7.Asset_Cat_ID
          			LEFT JOIN employee_assets AS t5 ON t3.Asset_ID = t5.Asset_ID
          				LEFT JOIN employees AS t6 ON t5.Employee_ID = t6.Employee_ID
          
          WHERE t1.Is_Deleted = 0 AND t3.Is_Deleted = 0 AND t1.Location_ID = ".$loc_id."
          
          ORDER BY t6.Employee_Full_Name, t3.Asset_Number;";
}

function addLocAsset($loc_id, $asset_id)
{
  return "INSERT INTO location_assets(location_id, asset_id) VALUES (".$loc_id.", ".$asset_id.");";
}

function deleteLocAsset($loc_id, $asset_id)
{
  return "DELETE FROM location_assets WHERE location_id = ".$loc_id." AND asset_id = ".$asset_id.";";
}

function getLocAssetList()
{
  return "SELECT t1.Asset_ID, t1.Asset_Number, t4.Employee_Full_Name, t2.Asset_Cat_Desc

          FROM assets AS t1
          	LEFT JOIN asset_categories AS t2 ON t1.Asset_Cat_ID = t2.Asset_Cat_ID
          	LEFT JOIN employee_assets AS t3 ON t1.Asset_ID = t3.Asset_ID
          		LEFT JOIN employees AS t4 ON t3.Employee_ID = t4.Employee_ID
          
          WHERE t1.Asset_Number IS NOT NULL AND t1.Is_Deleted = 0
          
          ORDER BY t2.Asset_Cat_Desc ASC, t1.Asset_Number ASC;";
}

function getLocName($loc_name)
{
  return "SELECT location FROM locations WHERE location_id = ".$loc_name.";";
}

/*     edit_vendor.php SQL queries     */

function getVendor($vendor_id)
{
  return "SELECT vendor_name, vendor_phone, vendor_email FROM vendors WHERE vendor_id = ".$vendor_id.";";
}

function addVendor($vendor_name, $vendor_phone, $vendor_email)
{
  return "INSERT INTO vendors (vendor_name, vendor_phone, vendor_email, is_deleted) VALUES ('".$vendor_name."', '".$vendor_phone."', '".$vendor_email."', 0);";
}

function deleteVendor($vendor_id)
{
  return "UPDATE vendors SET is_deleted = 1 WHERE vendor_id = ".$vendor_id.";";
}

function editVendor($vendor_name, $vendor_phone, $vendor_email , $vendor_id)
{
  return "UPDATE vendors SET vendor_name = '".$vendor_name."', vendor_phone = '".$vendor_phone."', vendor_email = '".$vendor_email."' WHERE vendor_id = ".$vendor_id.";";
}

/*     edit_role.php SQL queries     */

function getRole($role_id)
{
  return "SELECT role_description FROM roles WHERE role_id = ".$role_id.";";
}

function addRole($role_desc)
{
  return "INSERT INTO roles (role_description, is_deleted) VALUES ('".$role_desc."', 0);";
}

function deleteRole($role_id)
{
  return "UPDATE roles SET is_deleted = 1 WHERE role_id = ".$role_id.";";
}

function editRole($role_desc, $role_id)
{
  return "UPDATE roles SET role_description = '".$role_desc."' WHERE role_id = ".$role_id.";";
}

/*     edit_manufacturer.php SQL queries     */

function getManu($manu_id)
{
  return "SELECT manufacturer_name FROM manufacturers WHERE manufacturer_id = ".$manu_id.";";
}

function addManu($manu_name)
{
  return "INSERT INTO manufacturers (manufacturer_name, is_deleted) VALUES ('".$manu_name."', 0);";
}

function deleteManu($manu_id)
{
  return "UPDATE manufacturers SET is_deleted = 1 WHERE manufacturer_id = ".$manu_id.";";
}

function editManu($manu_name, $manu_id)
{
  return "UPDATE manufacturers SET manufacturer_name = '".$manu_name."' WHERE manufacturer_id = ".$manu_id.";";
}

/*     edit_department.php SQL queries     */

function getDept($dept_id)
{
  return "SELECT dept_name FROM departments WHERE dept_id = ".$dept_id.";";
}

function addDept($dept_name)
{
  return "INSERT INTO departments (dept_name, is_deleted) VALUES ('".$dept_name."', 0);";
}

function deleteDept($dept_id)
{
  return "UPDATE departments SET is_deleted = 1 WHERE dept_id = ".$dept_id.";";
}

function editDept($dept_name, $dept_id)
{
  return "UPDATE departments SET dept_name = '".$dept_name."' WHERE dept_id = ".$dept_id.";";
}

/*     edit_model.php SQL queries    */

function getModel($model_id)
{
  return "SELECT model_description FROM models WHERE model_id = ".$model_id.";";
}

function addModel($model_name)
{
  return "INSERT INTO models (model_description, is_deleted) VALUES ('".$model_name."', 0);";
}

function deleteModel($model_id)
{
  return "UPDATE models SET is_deleted = 1 WHERE model_id = ".$model_id.";";
}

function editModel($model_name, $model_id)
{
  return "UPDATE models SET model_description = '".$model_name."' WHERE model_id = ".$model_id.";";
}

/*     edit_asset_cat.php SQL queries     */

function getAssetCat($asset_cat_id)
{
  return "SELECT asset_cat_desc, asset_class_id FROM asset_categories WHERE asset_cat_id = ".$asset_cat_id.";";
}

function addAssetCat($asset_cat_desc, $asset_class_id)
{
  return "INSERT INTO asset_categories (asset_cat_desc, asset_class_id, is_deleted) VALUES ('".$asset_cat_desc."','".$asset_class_id."', 0);";
}

function deleteAssetCat($asset_cat_id)
{
  return "UPDATE asset_categories SET is_deleted = 1 WHERE asset_cat_id = ".$asset_cat_id.";";
}

function editAssetCat($asset_cat_desc, $asset_class_id, $asset_cat_id)
{
  return "UPDATE asset_categories SET asset_cat_desc = '".$asset_cat_desc."', asset_class_id = '".$asset_class_id."' WHERE asset_cat_id = ".$asset_cat_id.";";
}

function getAssetClass()
{
  return "SELECT * FROM asset_class;";
}

/*     edit_location.php SQL queries     */

function getLocation($location_id)
{
  return "SELECT location, location_address, location_main_phone FROM locations WHERE location_id = ".$location_id.";";
}

function addLocation($location, $location_address, $location_phone)
{
  return "INSERT INTO locations (location, location_address, location_main_phone, is_deleted) VALUES ('".$location."', '".$location_address."', '".$location_phone."', 0);";
}

function deleteLocation($location_id, $counter)
{
  if($counter == 0)
  {
    return "UPDATE locations SET is_deleted = 1 WHERE location_id = ".$location_id.";";
  }
  else
  {
    return "DELETE FROM location_assets WHERE location_id = ".$location_id.";";
  }
}

function editLocation($location, $location_address, $location_phone, $location_id)
{
  return "UPDATE locations SET location = '".$location."', location_address = '".$location_address."', location_main_phone = '".$location_phone."'  WHERE location_id = ".$location_id.";";
}

/*     edit_software.php SQL queries     */

function getSoftware($software_id)
{
  return "SELECT t1.software_name, t1.software_cat_id AS software_type, t1.version, t1.number_licences AS num_licenses, t1.License_Number AS license_num, t1.price, t1.notes FROM software as t1 WHERE t1.Software_Asset_ID = ".$software_id.";";
}

function addSoftware($software_name, $software_type, $version, $num_licenses, $license_num, $software_price, $software_notes)
{
  return "INSERT INTO software (software_name, software_cat_id, version, number_licences, license_number, price, notes, is_deleted) VALUES ('".$software_name."', '".$software_type."', '".$version."', '".$num_licenses."', '".$license_num."', ".$software_price.", '".$software_notes."', 0);";
}

function deleteSoftware($software_id, $counter)
{
  if($counter == 0)
  {
    return "UPDATE software SET is_deleted = 1 WHERE software_asset_id = ".$software_id.";";
  }
  else
  {
    return "DELETE FROM computer_software WHERE software_asset_id = ".$software_id.";";
  }
}

function editSoftware($software_name, $software_type, $version, $num_licenses, $license_num, $price, $software_notes, $software_id)
{
  return "UPDATE software SET software_name = '".$software_name."', software_cat_id = $software_type, version='".$version."', Number_Licences  = '".$num_licenses."', license_number = '".$license_num."', price = ".$price.", notes = '".$software_notes."'  WHERE software_asset_id = ".$software_id.";";
}

function getSoftwareCatID($software_name)
{
  return "SELECT software_cat_id FROM software WHERE software_name = '".$software_name."' AND is_deleted = 0;";
}

function getSoftwareType()
{
  return "SELECT asset_cat_id, asset_cat_desc FROM asset_categories WHERE asset_class_id = 2 AND is_deleted = 0;";
}

function getSoftwareInformation($software_id)
{
  return "SELECT DISTINCT t5.asset_number, t2.Computer_Asset_ID,  t4.Location, t5.Model, t7.Employee_ID, t7.Employee_Full_Name

          FROM software AS t1
          	LEFT JOIN computer_software AS t2 ON t1.Software_Asset_ID = t2.Software_Asset_ID
          		LEFT JOIN location_assets AS t3 ON t2.Computer_Asset_ID = t3.Asset_ID
          			LEFT JOIN locations AS t4 ON t3.Location_ID = t4.Location_ID
          	JOIN assets AS t5 ON t2.Computer_Asset_ID = t5.Asset_ID
          		LEFT JOIN employee_assets AS t6 ON t5.Asset_ID = t6.Asset_ID
          			LEFT JOIN employees AS t7 ON t7.Employee_ID = t6.Employee_ID
          
          WHERE t1.Software_Asset_ID = ".$software_id." 
          
          ORDER BY t4.Location ASC;";
}

function getCompList()
{
  return "SELECT DISTINCT t1.asset_number, t3.Employee_Full_Name, t1.asset_id

          FROM Assets AS t1
          	LEFT JOIN employee_assets AS t2 ON t1.asset_id = t2.Asset_ID
          		LEFT JOIN employees AS t3 ON t2.Employee_ID = t3.Employee_ID
          
          WHERE t1.asset_number LIKE \"2%\" OR t1.asset_number LIKE \"4%\" OR t1.asset_number LIKE \"5%\" AND t1.is_deleted = 0 AND t3.is_deleted = 0
          
          ORDER BY t1.asset_number ASC;";
}


function updateCompSoftware($machine_id, $software_id)
{
  return "INSERT INTO computer_software (computer_asset_id, software_asset_id) VALUES (".$machine_id.", ".$software_id.");";
}

function deleteCompSoftware($machine_id, $software_id)
{
  return "DELETE FROM computer_software WHERE computer_asset_id = ".$machine_id." AND software_asset_id = ".$software_id.";";
}

/*     edit_employee.php SQL queries     */

function getEmployee($emp_id)
{
  return "SELECT employee_full_name, role_id, location_id, dept_id, extension, nextel_number, office, nextel_speed, nextel_id, notes FROM employees WHERE Employee_ID = ".$emp_id.";"; 
}

function deleteEmp($emp_id, $counter)
{
  if($counter == 0)
  {
    return "UPDATE employees SET is_deleted = 1 WHERE employee_id = ".$emp_id.";";
  }
  else
  {
    return "DELETE FROM employee_assets WHERE employee_id = ".$emp_id.";";
  }
}

function editEmp($emp_name, $role_id, $location_id, $extension, $nxt_num, $office_num, $nxt_speed, $nxt_id, $notes, $emp_id)
{
  return "UPDATE employees SET employee_full_name = '".$emp_name."', role_id = ".$role_id.", location_id = ".$location_id.", extension = '".$extension."', nextel_number = '".$nxt_num."', office = '".$office_num."', nextel_speed = '".$nxt_speed."', nextel_id = '".$nxt_id."', notes = '".$notes."' WHERE employee_id = ".$emp_id.";";
}

function addEmp($emp_name, $role_id, $location_id, $extension, $nxt_num, $office_num, $nxt_speed, $nxt_id, $notes)
{
  return "INSERT INTO employees (employee_full_name, role_id, location_id, extension, nextel_number, office, nextel_speed, nextel_id, notes, is_deleted) VALUES ('".$emp_name."', ".$role_id.", ".$location_id.", '".$extension."', '".$nxt_num."', '".$office_num."', '".$nxt_speed."', '".$nxt_id."', '".$notes."', 0);";
}

function getLocList()
{
  return "SELECT location_id, location FROM locations WHERE is_deleted = 0 ORDER BY location ASC;";
}

function getDeptList()
{
  return "SELECT dept_id, dept_name FROM dept WHERE is_deleted = 0 ORDER BY dept_name ASC;";
}

function getAssetList()
{
  return "SELECT t1.Asset_ID, t1.Asset_Number, t2.Asset_Cat_Desc

          FROM assets AS t1
          	LEFT JOIN asset_categories AS t2 ON t1.Asset_Cat_ID = t2.Asset_Cat_ID
          
          WHERE t1.Asset_Number IS NOT NULL AND t1.Is_Deleted = 0
          
          ORDER BY t2.Asset_Cat_Desc ASC, t1.Asset_Number ASC;";
}

function getAssetInformationList($emp_id)
{
  return "SELECT t2.Asset_Cat_Desc, t1.Asset_ID, t1.Asset_Number, t3.Manufacturer_Name, t1.Model

          FROM assets AS t1
          	LEFT JOIN asset_categories AS t2 ON t1.Asset_Cat_ID = t2.Asset_Cat_ID
          	LEFT JOIN manufacturers AS t3 ON t1.Manufacturer_ID = t3.Manufacturer_ID
          	LEFT JOIN employee_assets AS t4 ON t1.Asset_ID = t4.Asset_ID
          
          WHERE t4.Employee_ID = ".$emp_id." AND t1.Asset_Number IS NOT NULL AND t1.Is_Deleted = 0
          
          ORDER BY t2.Asset_Cat_Desc ASC, t1.Asset_Number ASC;";
}

function updateEmpAsset($emp_id, $asset_id)
{
  return "INSERT INTO employee_assets (employee_id, asset_id) VALUES (".$emp_id.", ".$asset_id.");";
}

function deleteEmpAsset($emp_id, $asset_id)
{
  return "DELETE FROM employee_assets WHERE employee_id = ".$emp_id." AND asset_id = ".$asset_id.";";
}
/*     edit_asset.php SQL queries     */

function changeAssetLocation($locHolder, $loc_id, $asset_id)
{
  return "UPDATE location_assets SET location_id = ".$loc_id." WHERE location_id = ".$locHolder." AND asset_id = ".$asset_id.";";
}

function changeAssetEmployee($empHolder, $emp_id, $asset_id)
{
  return "UPDATE employee_assets SET employee_id = ".$emp_id." WHERE employee_id = ".$empHolder." AND asset_id = ".$asset_id.";";
}

function getAsset($asset_id)
{
  return "SELECT t1.asset_number, t2.employee_id, t3.location_id, t1.asset_cat_id, t1.manufacturer_id, t1.vendor_id, t1.model_id, t1.date_purchased, t1.serial_number, t1.service_code, t1.model_number, t1.service_tag, t1.express_service_tag, t1.price, t1.invoice_number, t1.warranty, t1.service_info, t1.notes

          FROM assets as t1
          	LEFT JOIN employee_assets AS t2 ON t1.Asset_ID = t2.Asset_ID
          	LEFT JOIN location_assets AS t3 ON t1.Asset_ID = t3.Asset_ID
          
          WHERE t1.asset_id = ".$asset_id.";";
}

function getEmployeeSimpleList()
{
  return "SELECT employee_id, employee_full_name FROM employees WHERE is_deleted = 0 ORDER BY employee_full_name ASC;";
}

function getModelList()
{
  return "SELECT model_id, model_description FROM models ORDER BY model_description ASC;";
}

function editAsset($asset_num, $cat_id, $manu_id, $vendor_id, $model_id, $date_purchased, $serial_num, $serv_code, $model_num, $serv_tag, $ex_serv_tag, $price, $invoice_num, $warranty, $serv_info, $notes, $asset_id)
{
  return "UPDATE assets
  
          SET
            asset_number = ".$asset_num.",
            asset_cat_id = ".$cat_id.",
            manufacturer_id = ".$manu_id.",
            vendor_id = ".$vendor_id.",
            model_id = ".$model_id.",
            date_purchased = '".$date_purchased."',
            serial_number = '".$serial_num."',
            service_code = '".$serv_code."',
            model_number = '".$model_num."',
            service_tag = '".$serv_tag."',
            express_service_tag = '".$ex_serv_tag."',
            price = ".$price.",
            invoice_number = '".$invoice_num."',
            warranty = '".$warranty."',
            service_info = '".$serv_info."',
            notes = '".$notes."'
            
          WHERE
            asset_id = ".$asset_id."            
            ;";
}

function addAsset($asset_num, $cat_id, $manu_id, $vendor_id, $model_id, $date_purchased, $serial_num, $serv_code, $model_num, $serv_tag, $ex_serv_tag, $price, $invoice_num, $warranty, $serv_info, $notes)
{
  return "INSERT INTO assets
            ( asset_number,
              asset_cat_id,
              manufacturer_id,
              vendor_id,
              model_id,
              model,
              date_purchased,
              serial_number,
              service_code,
              model_number,
              service_tag,
              express_service_tag,
              price,
              invoice_number,
              warranty,
              service_info,
              notes,
              is_deleted
            )
          
          VALUES
            ( ".$asset_num.",
              ".$cat_id.",
              ".$manu_id.",
              ".$vendor_id.",
              ".$model_id.",
              (SELECT model_description FROM models WHERE model_id = ".$model_id."),
              '".$date_purchased."',
              '".$serial_num."',
              '".$serv_code."',
              '".$model_num."',
              '".$serv_tag."',
              '".$ex_serv_tag."',
              ".$price.",
              '".$invoice_num."',
              '".$warranty."',
              '".$serv_info."',
              '".$notes."',
              0            
            )";
}

function getNewAssetID()
{
  return "SELECT asset_id FROM assets ORDER BY asset_id DESC LIMIT 1;";
}

function addNewEmpAsset($emp_id, $asset_id)
{
  return "INSERT INTO employee_assets (Employee_id, asset_id) VALUES (".$emp_id.", ".$asset_id.");";
}

function addNewLocAsset($loc_id, $asset_id)
{
  return "INSERT INTO location_assets (location_id, asset_id) VALUES (".$loc_id.", ".$asset_id.");";
}

function deleteAsset($asset_id, $counter)
{
  switch($counter)
  {
    case 0:
      return "UPDATE assets SET is_deleted = 1 WHERE asset_id = ".$asset_id.";";
      break;
    case 1:
      return "DELETE FROM employee_assets WHERE asset_id = ".$asset_id.";";
      break;
    case 2:
      return "DELETE FROM location_assets WHERE asset_id = ".$asset_id.";";
      break;
    case 3:
      return "DELETE FROM printer_toner WHERE printer_asset_id = ".$asset_id.";";
      break;
    case 4:
      return "DELETE FROM computer_software WHERE computer_asset_id = ".$asset_id.";";
      break;
  }
}

function addModelType($model_type)
{
  return "INSERT INTO models (model_description) VALUES ('".$model_type."');";
}

/*     tonerList.php SQL queries     */

function getPrinterToner($asset_id)
{
  return "SELECT t1.Toner_Description, t1.Toner_Model, t1.Num_In_Stock, t1.Price, t1.toner_asset_id

          FROM toners AS t1 
          	JOIN printer_toner AS t2 ON t1.Toner_Asset_ID = t2.Toner_Asset_ID
          	
          WHERE t2.Printer_Asset_ID = ".$asset_id.";";
}

/*     tonerAddNew.php SQL queries     */

function addNewToner($toner_desc, $toner_model, $num_stock, $price)
{
  return "INSERT INTO toners (toner_description, toner_model, num_in_stock, price) VALUES ('".$toner_desc."', '".$toner_model."', ".$num_stock.", ".$price.");";
}

function getNewTonerID()
{
  return "SELECT toner_asset_id FROM toners ORDER BY toner_asset_id DESC LIMIT 1;";
}

function addPrinterToner($printer_id, $toner_id)
{
  return "INSERT INTO printer_toner (printer_asset_id, toner_asset_id) VALUES (".$printer_id.", ".$toner_id.");";
}

/*    edit_toner.php SQL queries     */

function deleteToner($toner_id, $count)
{
  if($count == 0)
  {
    return "UPDATE toners SET is_deleted = 1 WHERE toner_asset_id = ".$toner_id.";";
  }
  else
  {
    return "DELETE FROM printer_toner WHERE toner_asset_id = ".$toner_id.";";
  }
}

function editToner($toner_desc, $toner_model, $stock_num, $price, $toner_id)
{
  return "UPDATE toners SET toner_description = '".$toner_desc."', toner_model = '".$toner_model."', num_in_stock = ".$stock_num.", price = ".$price." WHERE toner_asset_id = ".$toner_id.";";
}

function addToner($toner_desc, $toner_model, $stock_num, $price)
{
  return "INSERT INTO toners (toner_description, toner_model, num_in_stock, price, is_deleted) VALUES ('".$toner_desc."', '".$toner_model."', ".$stock_num.", ".$price.", 0);";
}

function getToner($toner_id)
{
  return "SELECT toner_description, toner_model, num_in_stock, price FROM toners WHERE toner_asset_id = ".$toner_id.";";
}

function getTonerPrinter($toner_id)
{
  return "SELECT t2.Asset_Number, t4.Employee_Full_Name, t6.Location, t2.Asset_ID

          FROM printer_toner AS t1
          	JOIN assets AS t2 ON t1.Printer_Asset_ID = t2.Asset_ID
          		LEFT JOIN employee_assets AS t3 ON t2.Asset_ID = t3.Asset_ID
          			LEFT JOIN employees AS t4 ON t3.Employee_ID = t4.Employee_ID
          		LEFT JOIN location_assets AS t5 ON t2.Asset_ID = t5.Asset_ID
          			LEFT JOIN locations AS t6 ON t5.Location_ID = t6.Location_ID
          
          WHERE t1.toner_asset_id = ".$toner_id.";";
}

function getPrinterList()
{
  return "SELECT DISTINCT t2.Asset_Number, t4.Employee_Full_Name, t6.Location, t2.Asset_ID

          FROM printer_toner AS t1
          	JOIN assets AS t2 ON t1.Printer_Asset_ID = t2.Asset_ID
          		LEFT JOIN employee_assets AS t3 ON t2.Asset_ID = t3.Asset_ID
          			LEFT JOIN employees AS t4 ON t3.Employee_ID = t4.Employee_ID
          		LEFT JOIN location_assets AS t5 ON t2.Asset_ID = t5.Asset_ID
          			LEFT JOIN locations AS t6 ON t5.Location_ID = t6.Location_ID
                
          ORDER BY t2.Asset_Number ASC;";
}

function deleteTonerPrinter($printer_id, $toner_id)
{
  return "DELETE FROM printer_toner WHERE printer_asset_id = ".$printer_id." AND toner_asset_id = ".$toner_id." LIMIT 1;";
}

function getTonerFullList()
{
  return "SELECT toner_asset_id, toner_description, toner_model FROM toners WHERE num_in_stock > 0 ORDER BY toner_description ASC;";
}

/*     softwareList.php SQL Queries     */

function getComputerSoftware($comp_id)
{
  return "SELECT t2.Software_Name, t2.Version, t2.License_Number, t2.Software_Asset_ID

          FROM computer_software AS t1
          	JOIN software AS t2 ON t1.Software_Asset_ID = t2.Software_Asset_ID
          
          WHERE t1.Computer_Asset_ID = ".$comp_id." AND is_deleted = 0;";
}

function getNewSoftwareID()
{
  return "SELECT software_asset_id FROM software ORDER BY software_asset_id DESC LIMIT 1;";
}

function getSoftwareFullList()
{
  return "SELECT software_asset_id, license_number, software_name, version FROM software ORDER BY software_name ASC, version ASC, license_number ASC;";
}                                 
?>