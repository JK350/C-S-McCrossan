<?php

require("db_config.php");

$result = mysql_query(assetList()) or die(mysql_error());

while ($row = mysql_fetch_assoc($result))
{
  echo "<div class='assetList'><a href='info_asset.php?id=".$row['Asset_ID']."'>".$row['Asset_Number']." : ".$row['Asset_Cat_Desc']." - ".$row['Model']."</a></div>";
}

?>
