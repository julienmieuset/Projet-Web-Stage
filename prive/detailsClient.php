<?php
if (!isset($_SESSION['identifiant']))
{
  session_start();
}
require_once $_SERVER["DOCUMENT_ROOT"] . "/configuration/configuration.php";
require_once DAO_BOITE;
require_once DAO_CATEGORIE;
require_once CONTROLEUR_MODIFICATION_DETAILS;
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
      <p>
        <a href="modifierClient.php"><input type="button" id="boutonmodifierclient" value="<?php echo _("Modifier le client") ?>"/></a>
        <a href="ajouterBoiteClient.php"><input type="button" id="boutonajouterboiteclient" value="<?php echo _("Ajouter des boîtes") ?>"/></a>
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
            foreach ($listeEtape as $etape) {
              if ($boite['numero_etape'] == $compteurEtape) {?>
                  <p><input type="radio" name="etapeboite<?php echo $compteur?>" value="<?php echo $compteurEtape?>" checked></p>
              <?php }
              else { ?>
                <p><input type="radio" name="etapeboite<?php echo $compteur?>" value="<?php echo $compteurEtape?>"></p>
              <?php }
              $compteurEtape++;
            }
            while ($compteurEtape < $nombreEtape + 1) {?>
              <p><input type="radio" name="etapeboite<?php echo $compteur?>" value="<?php echo $compteurEtape?>"></p>
            <?php
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
