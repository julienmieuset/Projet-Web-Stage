<?php
if (!isset($_SESSION['identifiant']))
{
  session_start();
}
require_once $_SERVER["DOCUMENT_ROOT"] . "/configuration/configuration.php";
require_once MODELE_CLIENT;
require_once DAO_CLIENT;
require_once CONTROLEUR_MODIFICATION_CLIENT;
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Idnum suivi - <?php echo _("Accueil") ?></title>
	  <?php include('header.php');?>
	<body>
		<div class="boxaccueil">
			<h1><?php echo _("Bienvenue") ?></h1>
      <p><a href="creationClient.php"><input type="button" id="boutoncreerclient" value="<?php echo _("Créer un Client") ?>"/></a></p>
      <form method="post" action="" class="barre-recherche">
        <input type="text" class="barre" id="textrecherche" name="recherche" placeholder="<?php echo _("Entrez le nom du client recherché...") ?>">
        <input type="submit" class="bouton" id="submitrecherche" value="<?php echo _("rechercher") ?>">
      </form>
      <?php
        if(isset($_POST['recherche']))
        {
          $listeOffres = ClientDAO::rechercherParNom($_POST['recherche']);
          $_SESSION['listeClientsRecherches'] = $listeOffres;
          ?>
          <div class="recherche">
            <form method="post" class="formclientrecherche">
              <?php foreach ($listeOffres as $client) { ?>
              <p><input type="radio" name="clientChoisi" value="<?php echo $client['nom'] ?>"><?php echo $client['nom'] ?></p>
              <?php
              }
              ?>
              <p><input type="submit" class="button" value="<?php echo _("modifier") ?>" name="boutonpresse"/></p>
            </form>
   			  </div>
        </section>
        <?php
        }
      ?>
	  </div>
  </body>
  <?php include('footer.php'); ?>
</html>

<?php
function essaiMoficication ($boutonPresse)
{
  $_SESSION['clientModifier'] = $boutonPresse;
  echo "<script type='text/javascript'>document.location.replace('clientPage.php');</script>";
}
?>
