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
require_once CONTROLEUR_CREATION_CLIENT;
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Idnum suivi - <?php echo _("Création Client") ?></title>
	  <?php include('header.php');?>
	<body class="bodycreationclient">
		<div class="boxcreationclient">
			<h1><?php echo _("Formulaire de creation de client") ?></h1>
      <form method="post" class="formcreerclient">
        <p class="pform"><?php echo _("Identifiant") ?> :</p>
        <p><input type="text" class="barre" id="textid" name="textid" placeholder="<?php echo _("Entrez l'identifiant du client...") ?>"></p>
        <p class="pform"><?php echo _("Nom") ?> :</p>
        <p><input type="text" class="barre" id="textnom" name="textnom" placeholder="<?php echo _("Entrez le nom du client...") ?>"></p>
        <p class="pform"><?php echo _("Mot de passe") ?> :</p>
        <p><input type="text" class="barre" id="textmdp" name="textmdp" placeholder="<?php echo _("Entrez le mot de passe du client...") ?>"></p>
        <p class="pform"><?php echo _("Confirmer Mot de passe") ?> :</p>
        <p><input type="text" class="barre" id="textmdp2" name="textmdp2" placeholder="<?php echo _("Entrez le mot de passe du client...") ?>"></p>
        <p class="pform"><?php echo _("Etapes (E1,E2,...)") ?> :</p>
        <p><input type="text" class="barre" id="textmdp" name="textetape" placeholder="<?php echo _("Entrez les étapes du client...") ?>"></p>
        <p class="pform"><?php echo _("Préfixe pour les boîtes") ?> :</p>
        <p><input type="text" class="barre" id="textpre" name="textpre" placeholder="<?php echo _("Entrez le prefixe pour le nom des boites...") ?>"></p>
        <p><input type="submit" class="bouton" id="submitcreationclient" value="<?php echo _("Créer") ?>"></p>
      </form>
      <p><a href="index.php"><input type="button" id="boutonquittercreerclient" value="<?php echo _("Retour") ?>"/></a></p>
    </div>
  </body>
  <?php include('footer.php'); ?>
</html>

<?php
function erreurCreationClient ($actionRetroaction)
{
  if ($actionRetroaction == "bdd-echec")
  {
    echo "<p class='error'> Erreur : Insertion dans la base de données</p>";
  }
  elseif ($actionRetroaction == "client-echec")
  {
    echo "<p class='error'> Erreur  : Identifiant déjà utilisé par un autre client</p>";
  }
  elseif ($actionRetroaction == "mdp-echec")
  {
    echo "<p class='error'> Erreur : Vérification des mots de passes (taille >= 8)</p>";
  }
}
?>
