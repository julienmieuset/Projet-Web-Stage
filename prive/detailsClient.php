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
require_once DAO_BOITE;
require_once DAO_CATEGORIE;
require_once CONTROLEUR_MODIFICATION_DETAILS;
require_once CONTROLEUR_ARCHIVAGE_CLIENT;

if (isset($_SESSION['suppression'])) {
  $_SESSION['validationSuppression'] = 1;
  unset($_SESSION['suppression']);
}
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Idnum suivi - <?php echo _("Details Client") ?></title>
	  <?php include('header.php');?>
  <body class="bodydetailsclient">
    <div class="boxdetailsclient">
      <h1>Suivi en temps réel</h1>
      <h1><?php echo $_SESSION['clientModifier'] ?></h1>
      <div class="listeboutonclient">
        <p>
          <a href="modifierClient.php"><input type="button" id="boutonmodifierclient" value="<?php echo _("Modifier le client") ?>"/></a>
          <a href="../controleur/supprimerClient.php"><input type="button" id="boutonsupprimerclient" value="<?php echo _("Supprimer le client") ?>"/></a>
        </p>
        <form method="post">
          <input type="hidden" class="barre" id="texthiddenarchive" name="texthiddenarchive" value="archive">
          <p><a href="detailsClient.php"><input type="submit" id="boutonarchiverclient" value="<?php echo _("Archiver le client") ?>"/></a></p>
        </form>
      </div>
      <p>
        <a href="ajouterBoiteClient.php"><input type="button" id="boutonajouterboiteclient" value="<?php echo _("Ajouter des boîtes") ?>"/></a>
        <a href="supprimerBoiteClient.php"><input type="button" id="boutonsupprimerboiteclient" value="<?php echo _("Supprimer des boîtes") ?>"/></a>
        <a href="modifierImage.php"><input type="button" id="boutonajouterimages" value="<?php echo _("Ajouter des images") ?>"/></a>
      </p>
      <form class="formdetailsclient" method="post">
        <div class="divdetailsduclient">
          <p>Numéro Boîte</p>
          <?php
          $listeEtape = BoiteDAO::rechercherEtapes();
          $listeBoite = BoiteDAO::rechercherParNom();
          $nombreEtape = CategorieDAO::rechercherNombreEtape();
          $listeNomsEtapes = CategorieDAO::rechercherNomsEtapes();
          foreach ($listeNomsEtapes as $etape) { ?>
            <p><?php echo $etape ?></p>
            <?php
          }
        ?>
        </div>
        <?php $compteur = 0;
        foreach ($listeBoite as $boite) {
          $compteur = $compteur + 1;
          ?>
          <div class="divdetailsduclient<?php echo ($compteur % 2 + 1) ?>">
            <p><?php echo $boite['numero'] ?></p>
            <input type="hidden" class="barre" id="texthiddenidnum" name="texthiddennumero<?php echo $compteur?>" value="<?php echo $boite['numero'] ?>">
            <?php $compteurEtape = 1;
            foreach ($listeNomsEtapes as $etape) {
              if ($boite['etape'] == $etape) {
                ?>
                  <p><input type="radio" name="etapeboite<?php echo $compteur?>" value="<?php echo $compteurEtape?>" checked></p>
              <?php }
              else { ?>
                <p><input type="radio" name="etapeboite<?php echo $compteur?>" value="<?php echo $compteurEtape?>"></p>
              <?php }
              $compteurEtape++;
            }
          ?>
          </div>
          <?php
          }
        ?>
        <p><input type="submit" class="button" value="<?php echo _("sauvegarder les modifications") ?>" id="boutonenregistrer" name="boutonenregistrer"/></p>
      </form>
      <p><a href="index.php"><input type="button" id="boutonquitterdetailclient" value="<?php echo _("Retour") ?>"/></a></p>
    </div>
  </body>
  <?php include('footer.php'); ?>
</html>
