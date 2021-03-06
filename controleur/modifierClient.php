<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/configuration/configuration.php";
require_once DAO_CLIENT;
require_once DAO_CATEGORIE;

if (isset($_POST['textidmod']) && isset($_POST['textnommod']) && isset($_POST['textmdpmod']) && isset($_POST['textpremod']) && isset($_POST['textdepmod']) && strlen($_POST['textdepmod'])){
	$essaiModification = true;
}
else {
	$essaiModification = false;
}

if ($essaiModification) {
	$actionRetroaction = true;
  if ($_POST['textidmod'] != $_POST['texthiddenid']) {
		if (ClientDAO::rechercherParId($_POST['textidmod'])) {
			$_SESSION['operationCourante'] = "Erreur car nouvel identifiant déjà utilisé ou incorrect";
		 	$actionRetroaction = false;
		}
	}
	if ($_POST['textnommod'] != $_POST['texthiddennom'] && $actionRetroaction) {
		if (ClientDAO::rechercherNom($_POST['textnommod'])) {
			$_SESSION['operationCourante'] = "Erreur car nouveau nom déjà utilisé ou incorrect";
		 	$actionRetroaction = false;
		}
	}
	if ($actionRetroaction) {
		$_SESSION['operationCourante'] = "Erreur lors de la modification de la base de données";
		if (modifierClient()) {
			$_SESSION['operationCourante'] = "Modification reussies avec succes";
		}
	}
}

function modifierClient(){
	$listeCategorie = CategorieDAO::rechercherNomsEtapes();
	for ($compteur = 1; $compteur <= count($listeCategorie); $compteur++) {
		CategorieDAO::modifier($_POST['texthiddenid'], $_POST['textcatmod'.$compteur], $compteur);
		BoiteDAO::modifierNomEtape($_POST['texthiddenid'], $_POST['textcatmod'.$compteur], $compteur);
	}
  $client = new Client() ;
  $client->setId($_POST['texthiddenid']);
  $client->setNom($_POST["textnommod"]);
  $client->setMotDePasse($_POST["textmdpmod"]);
	$client->setPrefixe($_POST["textpremod"]);
	$client->setDepart($_POST['textdepmod'] - 1);
  if (ClientDAO::modifier($client, $_POST['texthiddenid'])) {
		$_SESSION['clientModifier'] = $_POST['textnommod'];
    return true;
  }
  return false;
}
?>
