<?php
if (!isset($_SESSION['identifiant']))
{
  session_start();
}
require_once $_SERVER["DOCUMENT_ROOT"] . "/configuration/configuration.php";
require_once DAO_CLIENT;
require_once MODELE_CLIENT;
require_once CONTROLEUR_MODIFICATION_CLIENT;
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Idnum suivi - <?php echo _("Accueil") ?></title>
	  <?php include('header.php');?>
  <body>
    <div class="boxmodifierclient">
      <h1>Modification de <?php echo $_SESSION['clientModifier'] ?></h1>
      <?php $listeOffres = ClientDAO::rechercherParNomExacte($_SESSION['clientModifier']); ?>
      <div class="recherche">
        <form method="post" class="formclientrecherche">
          <?php
          foreach ($listeOffres as $client) { ?>
            <p class="pform"><?php echo _("Identifiant") ?> :</p>
            <p><input type="text" class="barre" id="textidmod" name="textidmod" value="<?php echo $client['identifiant'] ?>"></p>
            <p class="pform"><?php echo _("Nom") ?> :</p>
            <p><input type="text" class="barre" id="textnommod" name="textnommod" value="<?php echo $client['nom'] ?>"></p>
            <p class="pform"><?php echo _("Mot de passe") ?> :</p>
            <p><input type="text" class="barre" id="textmdpmod" name="textmdpmod" value="identique"></p>
            <input type="hidden" class="barre" id="texthiddenid" name="texthiddenid" value="<?php echo $client['identifiant'] ?>">
            <input type="hidden" class="barre" id="texthiddennom" name="texthiddennom" value="<?php echo $client['nom'] ?>">
            <input type="hidden" class="barre" id="texthiddenmdp" name="texthiddenmdp" value="<?php echo $client['motDePasse'] ?>">
          <?php
          }
          ?>
          <p><input type="submit" class="button" value="<?php echo _("Enregistrer") ?>" id="boutonEnregistrer" name="boutonEnregistrer"/></p>
        </form>
        <p><a href="detailsClient.php"><input type="button" id="boutonquitterdetailclient" value="<?php echo _("Retour") ?>"/></a></p>
      </div>
    </div>
  </body>
  <?php include('footer.php'); ?>
</html>

<?php
function modificationClientRetroaction ($actionRetroaction)
{
  if ($actionRetroaction = "succes")
  {
    echo "<script type='text/javascript'>document.location.replace('index.php');</script>";
  }
  elseif ($actionRetroaction = "error-id")
  {
    echo "<p class='error'> Erreur : Nouvel identifiant déjà utilisé ou incorrect</p>";
  }
  elseif ($actionRetroaction = "error-nom")
  {
    echo "<p class='error'> Erreur : Nouveau nom déjà utilisé ou incorrect</p>";
  }
  elseif ($actionRetroaction = "error-bd")
  {
    echo "<p class='error'> Erreur  : Modification de la base de données</p>";
  }
}
?>
