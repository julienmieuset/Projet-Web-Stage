<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/configuration/configuration.php";
require_once DAO_BOITE;

$essaiCreation = false;
$operation = "ajouté";
if (isset($_POST['boiteclient']) && isset($_POST['nombreimages']) && strlen($_POST['nombreimages']) > 0) {
	$essaiCreation = true;
}
else {
	$essaiCreation = false;
}

if ($essaiCreation) {
  if ($_POST['operationimage'] == "Supprimer") {
    $_POST['nombreimages'] = -$_POST['nombreimages'];
    $operation = "supprimé";
  }
  BoiteDAO::modifierNombrePages($_POST['boiteclient'], $_POST['nombreimages']);
  if ($_POST['operationimage'] == "Supprimer") {
    $_POST['nombreimages'] = -$_POST['nombreimages'];
  }
  $_SESSION['operationCourante'] = "Vous avez ".$operation." ".$_POST['nombreimages']." images dans la boîte ".$_POST['boiteclient'];
}
?>
