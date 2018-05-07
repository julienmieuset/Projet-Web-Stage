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
require_once CONTROLEUR_SUPPRESSION_BOITE;
require_once DAO_BOITE;
$listeBoite = BoiteDAO::rechercherParNom();
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Idnum suivi - <?php echo _("Supprimer boîtes") ?></title>
	  <?php include('header.php');?>
  <body class="bodysupprimerboite">
    <div class="boxsupprimerboite">
      <h1><?php echo _("Suppression de boîtes") ?></h1>
      <h1><?php echo $_SESSION['clientModifier'] ?></h1>
      <form class="formsupprimerboite" method="post">
        <p class="pform"><?php echo _("Boite") ?> :</p>
        <select name="boiteclient" class="barre">
          <?php for ($compteur = 1; $compteur < count($listeBoite); $compteur++) { ?>
            <option value="<?php echo $listeBoite[$compteur]['numero'] ?>"><?php echo ($listeBoite[$compteur]['numero']) ?></option>';
          <?php
          }
          ?>
        </select>
        <p><input type="submit" class="button" value="<?php echo _("Supprimer") ?>" id="boutonsupprimer" name="boutonsupprimer"/></p>
      </form>
      <p><a href="detailsClient.php"><input type="button" id="boutonquittersupprimerboite" value="<?php echo _("Retour") ?>"/></a></p>
    </div>
  </body>
  <?php include('footer.php'); ?>
</html>
