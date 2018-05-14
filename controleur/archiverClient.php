<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/configuration/configuration.php";
require('../fpdf/fpdf.php');
require_once DAO_CLIENT;
require_once DAO_BOITE;

$essaiArchiver = false;

if (isset($_POST['texthiddenarchive'])) {
  $essaiArchiver = true;
}

if ($essaiArchiver) {
  $client = ClientDAO::rechercherParId($_SESSION['identifiant']);
  $nombreBoite = BoiteDAO::rechercherNombreBoite();
  $nombrePage = BoiteDAO::rechercherNombrePage();
  $boite = BoiteDAO::rechercherParNom();
  $hauteur = 250;
  $compteur = 1;
  $pdf = new FPDF();
  $pdf->SetFont('Arial','B',20);
  $pdf->SetFillColor(224, 128, 128);
  $pdf->AddPage();
  $pdf->Image('../illustrations/LogoIdnum.png', 55, 35, 100);
  $pdf->Text(80, 90, date("d-m-Y"));
  $pdf->Text(80, 110, $_SESSION['clientModifier']);
  $pdf->Text(80, 140, 'Total de boites : '.$nombreBoite);
  $pdf->Text(80, 160, 'Total d\'images : '.$nombrePage);
  $pdf->Rect(160, 270, 20, 10, 'F');
  $pdf->SetFont('Helvetica','B',12);
  $pdf->SetTextColor(128, 128, 128);
  $pdf->Text(110, 277, 'IDNUM TECHNOLOGIES');
  $pdf->SetFont('Arial','B',16);
  foreach ($boite as $donnees) {
    if ($hauteur == 250 || $hauteur == 40) {
      $pdf->Rect(160, 270, 20, 10, 'F');
      $pdf->SetFont('Helvetica','B',12);
      $pdf->SetTextColor(128, 128, 128);
      $pdf->Text(110, 277, 'IDNUM TECHNOLOGIES');
      $pdf->SetTextColor(255, 255, 255);
      $pdf->Text(175, 277, $compteur);
      $pdf->SetTextColor(0, 0, 0);
      $pdf->SetFont('Arial','B',16);
      $pdf->AddPage();
      if ($hauteur == 250) {
        $compteur++;
        $hauteur = 40;
      }
    }
    $pdf->Text(65, $hauteur, 'Boite : '.$donnees['numero']);
    $pdf->Text(115, $hauteur, 'Images : '.$donnees['pages']);
    $hauteur += 10;
  }
  $pdf->Rect(160, 270, 20, 10, 'F');
  $pdf->SetFont('Helvetica','B',12);
  $pdf->SetTextColor(128, 128, 128);
  $pdf->Text(110, 277, 'IDNUM TECHNOLOGIES');
  $pdf->SetTextColor(255, 255, 255);
  $pdf->Text(175, 277, $compteur);
  $pdf->output('D', $_SESSION['clientModifier'].'.pdf');
}
?>
