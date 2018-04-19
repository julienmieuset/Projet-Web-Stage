<?php
if (!isset($_SESSION['identifiant']))
{
  session_start();
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
        <p class="pform"><?php echo _("Combien de boîtes souhaitez vous créer") ?> :</p>
        <p><input type="range" value="10" min="1" max="100" step="1" id="textnombre" name="textnombre" placeholder="<?php echo _("Choisissez le nombre de boîtes...") ?>"></p>
        <p class="pform"><?php echo _("Par quelle lettre commencent les boîtes") ?> :</p>
        <p><input type="text" id="textlettre" name="textlettre" placeholder="<?php echo _("Entrez la lettre...") ?>"></p>
        <p class="pform"><?php echo _("Par quel chiffre commencent les boîtes") ?> :</p>
        <p><input type="text" id="textchiffre" name="textchiffre" placeholder="<?php echo _("Entrez le chiffre...") ?>"></p>
        <p><input type="submit" class="button" value="<?php echo _("Générer") ?>" id="boutongenerer" name="boutongenerer"/></p>
      </form>
      <?php if (isset($_SESSION['nombre'])) { ?>
        <form method="post" class="formulaireprerempli">
          <p>
            <input type="button" class="buttonmenu" value="<?php echo _("Numéro") ?>"/>
          </p>
            <input type="hidden" id="texthiddennombre" name="texthiddennombre" value="<?php echo $_SESSION['nombre'] ?>">
          <?php for ($compteur = 1; $compteur <= $_SESSION['nombre']; $compteur ++) { ?>
            <p>
              <input type="text" class="textcli" style="text-transform: uppercase;" id="textnumero<?php echo $compteur ?>" name="textnumero<?php echo $compteur ?>" value="<?php echo $_SESSION['lettre'].($_SESSION['chiffre'] + $compteur - 1) ?>">
            </p>
          <?php
          }
          ?>
          <p><input type="submit" class="button" value="<?php echo _("Ajouter") ?>" id="boutonajouter" name="boutonajouter"/></p>
        <?php
        }
        ?>
      </form>
      <p><a href="detailsClient.php"><input type="button" id="boutonquitterajoutboiteclient" value="<?php echo _("Retour") ?>"/></a></p>
    </div>
  </body>
  <?php include('footer.php'); ?>
</html>

<?php
unset($_SESSION['nombre']);
unset($_SESSION['chiffre']);
unset($_SESSION['lettre']);
?>
