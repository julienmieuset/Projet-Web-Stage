<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/configuration/configuration.php";
require_once DAO_CATEGORIE;

$nombreEtape = CategorieDAO::rechercherNomsEtapes();
$essaiAffichage = false;
$numero_etape = 0;

if (isset($_POST['formboutonetape'])) {
  $essaiAffichage = true;
  $_SESSION['etapeClientAfficher'] = $_POST['formboutonetape'];
}
?>
