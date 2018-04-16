<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/configuration/configuration.php";
require_once DAO_CLIENT;

if (isset($_POST['identifiant']) and isset($_POST['motDePasse'])){
	$essaiConnection = true;
}
else {
	$essaiConnection = false;
}

if ($essaiConnection) {
  $actionRetroaction = 'Connexion-echec';
  if (connexion()) {
    $actionRetroaction = 'Connexion-succes';
		pretPourConnexion();
  }
}

function connexion(){
	if (!empty($_POST['motDePasse'])) {
		if (ClientDAO::existe($_POST['identifiant'], $_POST['motDePasse'])) {
			return true;
		}
	}
	return false;
}
?>
