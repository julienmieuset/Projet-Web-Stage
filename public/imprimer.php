<?php
if (!isset($_SESSION['identifiant']))
{
  session_start();
}
require_once $_SERVER["DOCUMENT_ROOT"] . "/configuration/configuration.php";
require_once CONTROLEUR_IMPRESSION_CLIENT;
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Idnum suivi - <?php echo _("Imprimer") ?></title>
    <?php include('header.php');?>
	<body>
		<div class="boximprimer">
      <h1><?php echo _("Aide pour imprimer ses Barrecodes") ?></h1>
      <p><b><?php echo _("Grâce à cette page vous pourrez imprimer un Barrecode pour chaque boîte") ?></b></p>
      <form class="formimprimer" method="post">
        <p><?php echo _("Combien de pages souhaitez-vous imprimer") ?> ?</p>
        <p><input type="text" class="barre" id="textnombreimprimer" name="textnombreimprimer" placeholder="<?php echo _("Nombre de page...") ?>"></p>
        <p><input type="submit" class="button" id="formboutontelecharger" value="Télécharger le PDF"/></p>
      </form>
      <p><a href="index.php"><input type="button" id="boutonretourindex" value="<?php echo _("retour") ?>"/></a></p>
	  </div>
  </body>
  <?php include('footer.php'); ?>
</html>
