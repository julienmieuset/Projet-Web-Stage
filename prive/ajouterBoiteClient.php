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
require_once CONTROLEUR_CREATION_BOITE_CLIENT;
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Idnum suivi - <?php echo _("Ajouter Boites") ?></title>
	  <?php include('header.php');?>
  <body class="bodycreationboiteclient">
    <div class="divcreationboiteclient">
      <h1><?php echo _("Ajout de boîtes") ?></h1>
      <h1><?php echo $_SESSION['clientModifier'] ?></h1>
      <form method="post" class="formulaireclient">
        <p class="pform"><?php echo _("Quel numéro de boîte souhaitez-vous créer") ?> :</p>
        <p><input type="text" id="textchiffre" name="textchiffre" placeholder="<?php echo _("Entrez le numéro...") ?>"></p>
        <?php if (isset($_SESSION['operationCourante'])) { ?>
          <p class="pform" style="color : red;"><?php echo $_SESSION['operationCourante'] ?><p>
        <?php
        }
        unset($_SESSION['operationCourante']);
        ?>
        <p><input type="submit" class="button" value="<?php echo _("Créer") ?>" id="boutongenerer" name="boutongenerer"/></p>
      </form>
      <p><a href="detailsClient.php"><input type="button" id="boutonquitterajoutboiteclient" value="<?php echo _("Retour") ?>"/></a></p>
    </div>
  </body>
  <?php include('footer.php'); ?>
</html>
