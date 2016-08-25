<?php
if (isset($_SESSION['Username']))
{
  if ($_SESSION['Username'] != "admin")
  {
    header("Location: /it_inventory/inventory_login_csm.php?page=" . $_SERVER['PHP_SELF']);
  }
}
else
{
    header("Location: /it_inventory/inventory_login_csm.php?page=" . $_SERVER['PHP_SELF']);
}
?>