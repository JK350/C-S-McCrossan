<?php

require("db_config.php");

$userPart = mysql_real_escape_string(addslashes($_POST['userPart']));
$result = mysql_query(assetSearch($userPart)) or die(mysql_error());

while ($row = mysql_fetch_assoc($result))
{
  echo "<div class='assetSearchResult'><a href='info_asset.php?id=".$row['Asset_ID']."'>".$row['Asset_Number']." : ".$row['Asset_Cat_Desc']." - ".$row['Model']."</a></div>";
}

?>
