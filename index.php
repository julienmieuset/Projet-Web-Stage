<?php
if (!isset($_SESSION['identifiant']))
{
  session_start();
}
require_once $_SERVER["DOCUMENT_ROOT"] . "/configuration/configuration.php";
require_once DAO_CLIENT;
require_once MODELE_CLIENT;
require_once CONTROLEUR_AUTHENTIFICATION;
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Idnum suivi - <?php echo _("Authentification") ?></title>
	  <?php include('header.php');?>
	<body>
		<div class="loginboxconnexion">
			<p><img src="illustrations/avatar-2024924_1280.png" class="avatarconnexion"></p>
			<h1><?php echo _("Authentification") ?></h1>
			<form method="POST">
				<p><?php echo _("Identifiant") ?></p>
				<p><input type="text" name="identifiant"></p>
				<p><?php echo _("Mot de passe") ?></p>
			  <p><input type="password" name="motDePasse"></p>
        <?php if (isset($_SESSION['operationCourante'])) { ?>
          <p class="pform" style="color : red; margin: -1vh 0;"><?php echo $_SESSION['operationCourante'] ?><p>
        <?php
        }
        unset($_SESSION['operationCourante']);
        ?>
        <p><input type="submit" name="actionFormulaire" id="submitconnexion" value="<?php echo _("Connexion")?>"></p>
			</form>
	  </div>
  </body>
  <?php include('footer.php'); ?>
</html>

<?php
function pretPourConnexion ()
{
  $client = new Client() ;
  $client->setId($_POST["identifiant"]);
  $client->setMotDePasse($_POST["motDePasse"]);

  $_SESSION['etapeClientAfficher'] = 1;
	$_SESSION["identifiant"] = $client->getId();
	$_SESSION["motDePasse"] = $client->getMotDePasse();
  $_SESSION["nom"] = ClientDAO::rechercherNomParId($_SESSION["identifiant"]);
  $_SESSION['clientModifier'] = ClientDAO::rechercherNomParId($_SESSION["identifiant"]);

  if ($_POST["identifiant"] == "administrateur")
  {
    echo "<script type='text/javascript'>document.location.replace('prive/');</script>";
  }
  echo "<script type='text/javascript'>document.location.replace('public/');</script>";
}
?>
