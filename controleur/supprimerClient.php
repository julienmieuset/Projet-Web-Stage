<?php
if (!isset($_SESSION['identifiant']))
{
  session_start();
}
require_once $_SERVER["DOCUMENT_ROOT"] . "/configuration/configuration.php";
require_once DAO_CLIENT;

ClientDAO::supprimerClient($_SESSION['clientModifier']);
echo "<script type='text/javascript'>document.location.replace('../prive/index.php');</script>";
?>
