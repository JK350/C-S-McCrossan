<?php
if (isset($_SESSION['Username']))
{
  if ($_SESSION['Username'] != "admin")
  {
    header("Location: /surplus.mccrossan.com/rebuild/admin_login_csm.php?page=" . $_SERVER['PHP_SELF']);
  }
}
else
{
    header("Location: /surplus.mccrossan.com/rebuild/admin_login_csm.php?page=" . $_SERVER['PHP_SELF']);
}
?>