<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/configuration/configuration.php";
require_once DAO_BOITE;

$essaiSuppression = false;
if (isset($_POST['boiteclient'])) {
	$essaiSuppression = true;
}

if ($essaiSuppression) {
  if (BoiteDAO::supprimer($_POST['boiteclient'])) {
    $_SESSION['operationCourante'] = "Vous avez supprime la boite numero ".$_POST['boiteclient'];
  }
  else {
    $_SESSION['operationCourante'] = "La modification n'a pas aboutie";
  }
}
?>
