<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/configuration/configuration.php";
require_once DAO_CLIENT;

if (isset($_POST['clientChoisi'])) {
  essaiMoficication($_POST['clientChoisi']);
}
?>
