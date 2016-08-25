<?php

require("db_config.php");

$result = mysql_query(personList()) or die(mysql_error());

while ($row = mysql_fetch_assoc($result))
{
  echo "<div class='list'><a href='info_employee.php?id=".$row['employee_id']."'>".$row['employee_full_name']."</a></div>";
}

?>
