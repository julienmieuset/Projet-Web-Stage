<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/configuration/configuration.php";
require('../fpdf/fpdf.php');
require('../phpqrcode/qrlib.php');
require_once DAO_CLIENT;
require_once DAO_BOITE;
require_once DAO_CATEGORIE;
require_once MODELE_BOITE;

$essaiGenerer = false;

if (isset($_POST['textnombreimprimer']) && strlen($_POST['textnombreimprimer']) > 0) {
  if (filter_var($_POST['textnombreimprimer'], FILTER_VALIDATE_INT)) {
    $essaiGenerer = true;
  }
}

if ($essaiGenerer) {
  $prefixe = ClientDAO::rechercherPrefixe($_SESSION['identifiant']);
  $depart = ClientDAO::rechercherDepart($_SESSION['identifiant']);
  $numero = 0;
  $pdf = new FPDF();
  $pdf->SetFont('Arial','B',16);
  for ($compteur = 1; $compteur <= $_POST['textnombreimprimer']; $compteur++) {
    $numero = $depart+$compteur;
    $nombrezero = "";
    if (!($numero > 100)) {
      $nombrezero = "0";
      if ($numero < 10) {
        $nombrezero = "00";
      }
    }
    $boite = new Boite();
    $boite->setNumeroEtape(1);
    $boite->setEtape(CategorieDAO::rechercherParNumeroEtape(1));
    $boite->setIdClient($_SESSION["identifiant"]);
    $boite->setNumero($prefixe.$nombrezero.$numero);
    BoiteDAO::ajouter($boite);
    QRcode::png(''.$prefixe.$nombrezero.$numero, '../barrecode/'.$prefixe.$nombrezero.$numero.'.png', QR_ECLEVEL_L, 10);
    $pdf->AddPage();
    $pdf->Image('../barrecode/'.$prefixe.$nombrezero.$numero.'.png', 86, 55, 40);
    unlink('../barrecode/'.$prefixe.$nombrezero.$numero.'.png');
    $pdf->Text(100, 120, ''.$prefixe.$nombrezero.$numero);
  }
  $pdf->output('D', 'ImprimerBarrecode.pdf');
  ClientDAO::modifierDepart($_SESSION['identifiant'], $numero);
}
?>
