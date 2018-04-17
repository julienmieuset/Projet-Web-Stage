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
elseif (isset($_POST['textnumeroclient1']) && isset($_POST['textnumeroidnum1'])) {
  $essaiAjout = true;
}
else {
  unset($_SESSION['nombre']);
  unset($_SESSION['chiffre']);
  unset($_SESSION['lettre']);
}

if ($essaiAjout) {
  for ($compteur = 1; $compteur <= $_POST['texthiddennombre']; $compteur++) {
    if (isset($_POST['textnumeroclient'.$compteur]) && isset($_POST['textnumeroidnum'.$compteur]) && strlen($_POST['textnumeroclient'.$compteur]) > 0 && strlen($_POST['textnumeroidnum'.$compteur]) > 0) {
      if (!numClientPresent($_POST['textnumeroclient'.$compteur]) && !numIdnumPresent($_POST['textnumeroidnum'.$compteur])) {
        if(!$succes || !ajouterBoite($_POST['textnumeroclient'.$compteur], $_POST['textnumeroidnum'.$compteur])) {
          $succes = false;
        }
      }
    }
  }
  if ($succes) {
    echo "<script type='text/javascript'>document.location.replace('index.php');</script>";
  }
}

function numClientPresent($num) {
  $value = BoiteDAO::rechercherParNumeroClient($num);
  if ($value == 0) {
    return false;
  }
  return true;
}

function numIdnumPresent($num) {
  $value = BoiteDAO::rechercherParNumeroIdnum($num);
  if ($value == 0) {
    return false;
  }
  return true;
}

function ajouterBoite($numClient, $numIdnum) {
  $boite = new Boite();
  $boite->setNumeroEtape(1);
  $boite->setEtape(CategorieDAO::rechercherParNumeroEtape(1));
  $boite->setIdClient(ClientDAO::rechercherParNomExacte($_SESSION['clientModifier'])[0]['identifiant']);
  $boite->setNumeroClient($numClient);
  $boite->setNumeroIdnum($numIdnum);
  if (BoiteDAO::ajouter($boite)) {
    return true;
  }
  return false;
}
?>
