<?php
if (!isset($_SESSION['identifiant']))
{
  session_start();
}
if (!isset($_SESSION['identifiant']))
{
  echo "<script type='text/javascript'>document.location.replace('../index.php');</script>";
}
require_once $_SERVER["DOCUMENT_ROOT"] . "/configuration/configuration.php";
require_once DAO_CATEGORIE;
require_once DAO_BOITE;

$nombreEtape = CategorieDAO::rechercherNombreEtape();
$nombreBoite = BoiteDAO::rechercherNombreBoite();
$nombrePage = BoiteDAO::rechercherNombrePage();
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Idnum suivi - <?php echo _("Details") ?></title>
    <?php include('header.php');?>
	<body>
		<div class="boxdetailsclient">
      <h1><?php echo _("Quelques chiffres vous concernant") ?></h1>
      <p>Total d'étapes : <?php echo $nombreEtape ?></p>
      <p>Total de boîtes du client : <?php echo $nombreBoite ?></p>
      <p>Total d'images traitées : <?php echo $nombrePage ?></p>
      <p><a href="listeBoites.php"><input type="button" id="boutonsuivi" value="<?php echo _("suivi") ?>"/></a></p>
      <p><a href="index.php"><input type="button" id="boutonretourindex" value="<?php echo _("retour") ?>"/></a></p>
	  </div>
  </body>
  <?php include('footer.php'); ?>
</html>
