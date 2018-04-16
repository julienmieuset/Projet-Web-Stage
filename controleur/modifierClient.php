<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/configuration/configuration.php";
require_once DAO_CLIENT;

if (isset($_POST['textidmod']) and isset($_POST['textnommod']) and isset($_POST['textmdpmod'])){
	$essaiModification = true;
}
else {
	$essaiModification = false;
}

if ($essaiModification) {
	$valueRetroaction = "";
	$actionRetroaction = true;
  if ($_POST['textidmod'] != $_POST['texthiddenid']) {
		if (ClientDAO::rechercherParId($_POST['textidmod'])) {
			$valueRetroaction = "error-id";
		 	$actionRetroaction = false;
		}
	}
	if ($_POST['textnommod'] != $_POST['texthiddennom'] && $actionRetroaction) {
		if (ClientDAO::rechercherNom($_POST['textnommod'])) {
			$valueRetroaction = "error-nom";
		 	$actionRetroaction = false;
		}
	}
	if ($actionRetroaction) {
		$valueRetroaction = "error-bd";
		if (modifierClient()) {
			$valueRetroaction = "succes";
		}
	}
	modificationClientRetroaction($valueRetroaction);
}

function modifierClient(){
  $client = new Client() ;
  $client->setId($_POST['textidmod']);
  $client->setNom($_POST["textnommod"]);
  $client->setMotDePasse($_POST["textmdpmod"]);
  if (ClientDAO::modifier($client, $_POST['texthiddenid'])) {
		$_SESSION['clientModifier'] = $_POST['textnommod'];
    return true;
  }
  return false;
}
?>
