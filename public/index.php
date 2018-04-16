<?php
if (!isset($_SESSION['identifiant']))
{
  session_start();
}
echo "YES";
?>
