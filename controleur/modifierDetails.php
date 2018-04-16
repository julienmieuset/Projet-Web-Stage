<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/configuration/configuration.php";
require_once DAO_CLIENT;
require_once MODELE_BOITE;

if (isset($_POST['etapeboite1'])){
	$essaiModification = true;
}
else {
	$essaiModification = false;
}

if ($essaiModification) {
	modifierDetails();
	// modificationDetailsRetroaction("succes");
}

function modifierDetails(){
	$listeBoite = BoiteDAO::rechercherParNom();
	for ($compteur = 1; $compteur <= count($listeBoite); $compteur++ ) {
  	$boite = new Boite() ;
  	$boite->setNumeroEtape($_POST['etapeboite'.$compteur]);
  	$boite->setEtape(CategorieDAO::rechercherParNumeroEtape($_POST['etapeboite'.$compteur]));
		$boite->setIdClient(ClientDAO::rechercherParNomExacte($_SESSION['clientModifier'])[0]['identifiant']);
		$boite->setNumeroClient($_POST['texthiddenidnumclient'.$compteur]);
		$boite->setNumeroIdnum($_POST['texthiddenidnumidnum'.$compteur]);
		if (!BoiteDAO::modifier($boite)) {
    	return false;
  	}
	}
  return true;
}
?>
