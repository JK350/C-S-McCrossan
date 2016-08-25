<?php

require("db_config.php");

$userPart = mysql_real_escape_string(addslashes($_POST['userPart']));
$result = mysql_query(personSearch($userPart)) or die(mysql_error());

while ($row = mysql_fetch_assoc($result))
{
  echo "<div class='personSearchResult'><a href='info_employee.php?id=".$row['employee_id']."'>".$row['employee_full_name']."</a></div>";
}

?>
