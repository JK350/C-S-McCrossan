<?php 

// modify these constants to fit your environment

if (!defined("DB_SERVER")) define("DB_SERVER", "localhost");
if (!defined("DB_NAME")) define("DB_NAME", "surplusequip");
if (!defined("DB_USER")) define ("DB_USER", "root");
if (!defined("DB_PASSWORD")) define ("DB_PASSWORD", "");

$connStr = mysql_connect(DB_SERVER, DB_USER, DB_PASSWORD);
mysql_select_db(DB_NAME, $connStr);

/*     surplus_equip.php SQL queries     */
function getEquipDetails($equip_sales_id)
{
    return "SELECT es.*, ec.cat_desc FROM equip_sales AS es, equip_category AS ec WHERE es.equip_sales_id=$equip_sales_id AND ec.category_id = es.category_id;";
}

function getEquipImage($equip_sales_id)
{
    return "SELECT * FROM equip_image WHERE equip_sales_id=$equip_sales_id ORDER BY sort_order;";
}

function getEquipList()
{
    return "SELECT * FROM equip_sales, equip_category WHERE equip_sales.active_status_flag = 1 AND equip_category.category_id = equip_sales.category_id ORDER BY cat_desc, item;";
}

function getTypeList()
{
    return "SELECT * FROM equip_type ORDER BY type_flag;";
}

/*     admin_login.php SQL queries     */
function getUsernamePassword()
{
  return "SELECT * FROM equip_pw;";
}

/*     admin_equip.php SQL queries     */
function getEquipListAdmin()
{
  return "SELECT * FROM equip_sales, equip_category WHERE equip_category.category_id = equip_sales.category_id ORDER BY cat_desc;";
}

function getPictureCount($equip_sales_id)
{
  return "SELECT * FROM equip_image WHERE equip_sales_id=$equip_sales_id;";
}

function getAdminEquip($equip_sales_id)
{
  return "SELECT * FROM equip_sales WHERE equip_sales_id=$equip_sales_id;";
}

function getCatList()
{
  return "SELECT category_id, cat_desc FROM equip_category ORDER BY cat_desc;";
}

function deleteListing($equip_sales_id)
{
  return "DELETE FROM equip_sales WHERE equip_sales_id='$equip_sales_id';";
}

function updateListing($item, $type_flag, $category_id, $equip_make, $equip_model, $equip_year, $location, $hours_use, $description, $price, $internal_nbr, $contact_name, $contact_phone, $contact_email, $sold_ind, $active_status_flag, $equip_sales_id)
{
  $description = mysql_real_escape_string($description);
  return "UPDATE equip_sales SET item = '$item', type_flag = '$type_flag', category_id='$category_id', equip_make = '$equip_make', equip_model='$equip_model', equip_year=$equip_year, location='$location', hours_use='$hours_use', description='$description', price='$price', internal_nbr='$internal_nbr', contact_name='$contact_name', contact_phone='$contact_phone', contact_email='$contact_email', sold_ind='$sold_ind', active_status_flag='$active_status_flag', update_dt_tm=NOW() WHERE equip_sales_id='$equip_sales_id';";
}

function insertListing($item, $type_flag, $category_id, $equip_make, $equip_model, $equip_year, $location, $hours_use, $description, $price, $internal_nbr, $contact_name, $contact_phone, $contact_email, $sold_ind, $active_status_flag)
{
  $description = mysql_real_escape_string($description);
  return "INSERT INTO equip_sales SET item = '$item', type_flag = '$type_flag', category_id='$category_id', equip_make = '$equip_make', equip_model='$equip_model', equip_year='$equip_year', location='$location', hours_use='$hours_use', description='$description', price='$price', internal_nbr='$internal_nbr', contact_name='$contact_name', contact_phone='$contact_phone', contact_email='$contact_email', sold_ind='$sold_ind', active_status_flag='$active_status_flag', update_dt_tm=NOW(), create_dt_tm=NOW();";
}

/*     admin_categories.php SQL queries     */

function getEquipment()
{
  return "SELECT t1.category_id, t1.cat_desc, t2.type_description FROM equip_category AS t1 JOIN equip_type AS t2 ON t1.equip_type_flag = t2.type_flag ORDER BY type_description, cat_desc";
}

function getOneEquipment($category_id)
{
  return "SELECT * FROM equip_category WHERE category_id = $category_id;";
}

function deleteEquipment($category_id)
{
  return "DELETE FROM equip_category WHERE category_id=$category_id;";
}

function updateCategory($equip_type_flag, $cat_desc, $category_id)
{
  return "UPDATE equip_category SET equip_type_flag = $equip_type_flag, cat_desc = '$cat_desc', cat_short_desc = '$cat_desc' WHERE category_id = $category_id;";
}

function insertCategory($equip_type_flag, $cat_desc)
{
  return "INSERT INTO equip_category SET equip_type_flag = $equip_type_flag, cat_desc = '$cat_desc', cat_short_desc = '$cat_desc';";
}

/*     admin_equip_images.php SQL queries     */

function getEquipImages($equip_sales_id)
{
  return "SELECT * FROM equip_image WHERE equip_sales_id='$equip_sales_id' ORDER BY sort_order;";
}

function getSingleImage($equip_image_id)
{
  return "SELECT * FROM equip_image WHERE equip_image_id=$equip_image_id;";
}

function insertImage($equip_sales_id, $image_name, $sort_order)
{
  return "INSERT INTO equip_image SET equip_sales_id='$equip_sales_id', image_name='$image_name', sort_order='$sort_order';";
}

function updateImage($sort_order, $equip_image_id)
{
  return "UPDATE equip_image SET sort_order=$sort_order WHERE equip_image_id = $equip_image_id;";
}

function deleteImage($equip_image_id)
{
  return "DELETE FROM equip_image WHERE equip_image_id =$equip_image_id;";
}

?>