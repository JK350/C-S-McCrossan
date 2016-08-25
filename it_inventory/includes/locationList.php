<?php

require("db_config.php");

$result = mysql_query(locationList()) or die(mysql_error());

while ($row = mysql_fetch_assoc($result))
{
  echo "<div class='list'><a href='info_location.php?id=".$row['location_id']."'>".$row['location']."</a></div>";
}

?>
