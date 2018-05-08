<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/configuration/configuration.php";
require_once DAO_CATEGORIE;
require_once DAO_CLIENT;
require_once DAO_BOITE;
require_once MODELE_BOITE;

$essaiAjout = false;
$succes = true;
$prefixe = ClientDAO::rechercherPrefixe(ClientDAO::rechercherParNomExacte($_SESSION['clientModifier'])[0]['identifiant']);

if (isset($_POST['textchiffre']) && strlen($_POST['textchiffre']) > 0) {
  $essaiAjout = true;
}

if ($essaiAjout) {
  if (!numPresent($prefixe.$_POST['textchiffre'])) {
    if (ajouterBoite($prefixe.$_POST['textchiffre'])) {
      $_SESSION['operationCourante'] = "Vous avez cree la boite ".$prefixe.$_POST['textchiffre'];
    }
    else {
      $_SESSION['operationCourante'] = "Erreur lors de l'ajout dans la base de donnees";
    }
  }
  else {
    $_SESSION['operationCourante'] = "Erreur car ce numero de boite est deja attribue";
  }
}

function numPresent($num) {
  $value = BoiteDAO::rechercherParNumero($num);
  if ($value == 0) {
    return false;
  }
  return true;
}

function ajouterBoite($num) {
  $boite = new Boite();
  $boite->setNumeroEtape(1);
  $boite->setEtape(CategorieDAO::rechercherParNumeroEtape(1));
  $boite->setIdClient(ClientDAO::rechercherParNomExacte($_SESSION['clientModifier'])[0]['identifiant']);
  $boite->setNumero($num);
  if (BoiteDAO::ajouter($boite)) {
    return true;
  }
  return false;
}
?>
