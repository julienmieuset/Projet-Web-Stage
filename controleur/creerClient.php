<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/configuration/configuration.php";
require_once DAO_CLIENT;
require_once DAO_CATEGORIE;
require_once MODELE_CLIENT;
require_once MODELE_CATEGORIE;

$essaiCreation = false;
if (isset($_POST['textid']) and isset($_POST['textnom']) and isset($_POST['textmdp']) and isset($_POST['textmdp2']) and isset($_POST["textetape"])){
	$essaiCreation = true;
}
else {
	$essaiCreation = false;
}

$actionRetroaction = "";
if ($essaiCreation) {
  $actionRetroaction = 'Creation-echec';
  if (!mdpEgaux()) {
		$actionRetroaction = 'mdp-echec';
	}
	elseif (existe()) {
		$actionRetroaction = 'client-echec';
	}
	elseif (!ajouteClient()) {
		$actionRetroaction = 'bdd-echec';
	}
  else {
		$actionRetroaction = 'Creation-succes';
  }
}
erreurCreationClient($actionRetroaction);

function mdpEgaux(){
	if ($_POST['textmdp'] == $_POST['textmdp2']) {
		return true;
	}
	return false;
}

function existe(){
	if (!empty($_POST['textmdp'])) {
		if (ClientDAO::existe($_POST['textid'])) {
			return true;
		}
	}
	return false;
}

function ajouteClient(){
  $client = new Client();
  $client->setId($_POST["textid"]);
  $client->setNom($_POST["textnom"]);
  $client->setMotDePasse($_POST["textmdp"]);
  if (!ClientDAO::ajouter($client)) {
		return false;
  }
	$array = preg_split('/,/', $_POST["textetape"]);
	for ($compteur = 0; $compteur <= count($array); $compteur++) {
		$categorie = new Categorie();
		$categorie->setNomCategorie($array[$compteur]);
		$categorie->setNumeroCategorie($compteur + 1);
		$categorie->setIdClient($_POST["textid"]);
		// CategorieDAO::ajouter($etape);
	}
	return true;
}
?>
