<?php
if (!isset($_SESSION['identifiant']))
{
  session_start();
}
require_once $_SERVER["DOCUMENT_ROOT"] . "/configuration/configuration.php";
require_once CONTROLEUR_MODIFICATION_IMAGES;
require_once DAO_BOITE;
$listeBoite = BoiteDAO::rechercherParNom();
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Idnum suivi - <?php echo _("Modification du nombre d'images") ?></title>
	  <?php include('header.php');?>
  <body class="bodymodificationimages">
    <div class="boxajouterimage">
      <h1><?php echo _("Ajout et suppression d'images") ?></h1>
      <h1><?php echo $_SESSION['clientModifier'] ?></h1>
      <form class="formajouterimage" method="post">
        <p class="pform"><?php echo _("Boite | Image") ?> :</p>
        <select name="boiteclient" class="barre">
          <?php for ($compteur = 1; $compteur < count($listeBoite); $compteur++) { ?>
            <option value="<?php echo $listeBoite[$compteur]['numero'] ?>"><?php echo ($listeBoite[$compteur]['numero'].'  |  '.$listeBoite[$compteur]['pages']) ?></option>';
          <?php
          }
          ?>
        </select>
        <div class="boutonoperationimage">
          <p><input type="radio" name="operationimage" value="Ajouter" Checked>Ajouter</p>
          <p><input type="radio" name="operationimage" value="Supprimer">Supprimer</p>
        </div>
        <p class="pform"><?php echo _("Nombre d'images") ?> :</p>
        <p><input type="text" class="barre" name="nombreimages" placeholder="<?php echo _("Nombre d'images...") ?>"></p>
        <?php if (isset($_SESSION['operationCourante'])) { ?>
          <p class="pform" style="color : red;"><?php echo $_SESSION['operationCourante'] ?><p>
        <?php
        }
        unset($_SESSION['operationCourante']);
        ?>
        <p><input type="submit" class="button" value="<?php echo _("Effectuer le changement") ?>" id="boutonenregistrer" name="boutonenregistrer"/></p>
      </form>
      <p><a href="detailsClient.php"><input type="button" id="boutonquitterajouterimages" value="<?php echo _("Retour") ?>"/></a></p>
    </div>
  </body>
  <?php include('footer.php'); ?>
</html>
