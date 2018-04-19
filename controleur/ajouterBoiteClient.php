<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/configuration/configuration.php";
require_once DAO_CATEGORIE;
require_once DAO_CLIENT;
require_once DAO_BOITE;
require_once MODELE_BOITE;

$essaiAjout = false;
$succes = true;

if (isset($_POST['textnombre']) && isset($_POST['textchiffre']) && isset($_POST['textlettre']) && strlen($_POST['textchiffre']) > 0  && strlen($_POST['textlettre']) > 0) {
  $_SESSION['nombre'] = $_POST['textnombre'];
  $_SESSION['chiffre'] = $_POST['textchiffre'];
  $_SESSION['lettre'] = $_POST['textlettre'];
}
elseif (isset($_POST['textnumero1'])) {
  $essaiAjout = true;
}
else {
  unset($_SESSION['nombre']);
  unset($_SESSION['chiffre']);
  unset($_SESSION['lettre']);
}

if ($essaiAjout) {
  for ($compteur = 1; $compteur <= $_POST['texthiddennombre']; $compteur++) {
    if (isset($_POST['textnumero'.$compteur]) && strlen($_POST['textnumero'.$compteur]) > 0) {
      if (!numPresent($_POST['textnumero'.$compteur])) {
        if(!$succes || !ajouterBoite($_POST['textnumero'.$compteur])) {
          $succes = false;
        }
      }
    }
  }
  if ($succes) {
    echo "<script type='text/javascript'>document.location.replace('detailsClient.php');</script>";
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
