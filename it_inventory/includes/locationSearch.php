<?php

require("db_config.php");

$userPart = mysql_real_escape_string(addslashes($_POST['userPart']));
$result = mysql_query(locationSearch($userPart)) or die(mysql_error());

while ($row = mysql_fetch_assoc($result))
{
  echo "<div class='locationSearchResult'><a href='info_location.php?id=".$row['location_id']."'>".$row['location']."</a></div>";
}

?>
