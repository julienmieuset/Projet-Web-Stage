<?php
if (!isset($_SESSION['identifiant']))
{
  session_start();
}
require_once $_SERVER["DOCUMENT_ROOT"] . "/configuration/configuration.php";
$_SESSION['clientModifier'] = $_SESSION['nom'];
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Idnum suivi - <?php echo _("Tableau de bord") ?></title>
    <?php include('header.php');?>
	<body>
		<div class="boxtableaudebord">
      <h1><?php echo _("Tableau de bord") ?></h1>
      <p><a href="listeBoites.php"><input type="button" id="boutonlistedesboites" value="<?php echo _("Liste des boites") ?>"/></a></p>
      <p><a href="imprimer.php"><input type="button" id="boutonimprimerdesbarrecodes" value="<?php echo _("Imprimer des barrecodes") ?>"/></a></p>
      <p><a href="detailsClient.php"><input type="button" id="boutonquelqueschiffres" value="<?php echo _("quelques chiffres") ?>"/></a></p>
	  </div>
  </body>
  <?php include('footer.php'); ?>
</html>
