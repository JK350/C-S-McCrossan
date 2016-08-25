<?php
session_start();
include('includes/secureadmin.inc');
require('includes/db_config.php');
$msgString = "";
$is_deleted = 0;
$model_id = $_GET['id'];
if(isset($_POST['delete']))
{
  $sql = deleteModel($model_id);
  $result = mysql_query($sql);
  if(!$result)
  {
    $msgString = "Error deleting model: ".mysql_error();
  }
  else
  {
    $msgString = "Model successfully deleted.";
    $is_deleted = 1;
  }
}

if(isset($_POST['submitChanges']))
{
  $model_name = $_POST['model_name'];
  if($_GET['id'] > 0)   
  {
    $sql = editModel(mysql_real_escape_string($model_name), $model_id);
    $result = mysql_query($sql);
    if(!$result)
    {
      $msgString = "Error editing model: ".mysql_error();
    }
    else
    {
      $msgString = "Model successfully edited.";
    }
  }
  else
  {
    $sql = addModel(mysql_real_escape_string($model_name));
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
}
    
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
<?php include "includes/html_header_info.html" ?>
  </head>	
  <body>
  <?php     
    if($model_id == 0)
    {
      $headerString = "Add a New Model";
      $model_name = "";
      $buttons = "<div id='formAddButtons' class='editButtonDiv'><input type='submit' value='Add Model' name='submitChanges'/></div>";
    }
    else
    {
      $sql = getModel($model_id);
      $result = mysql_fetch_assoc(mysql_query($sql));
      $model_name = $result['model_description'];
      $headerString = "Edit Model Information";
      $buttons = "<div id='modelEditButtons' class='editButtonDiv'><input type='submit' value='Save Changes' name='submitChanges'/><input type='submit' value='Delete Model' id='delete_model' name='delete' class='delete'/><div class='clear'></div></div>";     
    }
  ?>
    <div id='wrapper'>
      <div id='header'>
        <div id='indListHeader'><?php echo $headerString; ?><br /><a href='list_model.php'>Back to Listing</a><a href='database_home.php'>Main Page</a></div>
        <div id='headerBody'></div>       
      </div>
      <div id='body'>
      <?php
        if ($is_deleted == 0)
        {
      ?>
        <div id='modelAddForm' class='centeredDiv'>
          <form method='post' enctype='multipart/form-data' action='edit_model.php?id=<?php echo $model_id; ?>'>
            <div class='formRow'>
              <div id='modelRT' class='rowTitle'>Model Name:</div>          
              <div class='formRowInput'>
                <input type='text' value='<?php echo str_replace("'", "&apos;", $model_name); ?>' id='model_name' name='model_name' class='formInput'/>
              </div>
            </div>
            <div id='formFooter'>
              <div id='formButtons'>
                <?php echo $buttons; ?>
              </div>
              <div class='clear'></div>
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
