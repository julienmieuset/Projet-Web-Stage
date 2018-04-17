<?php
if (!isset($_SESSION['identifiant']))
{
  session_start();
}
require_once $_SERVER["DOCUMENT_ROOT"] . "/configuration/configuration.php";
require_once DAO_BOITE;
require_once DAO_CATEGORIE;
require_once CONTROLEUR_AFFICHER_DETAILS;

$_SESSION['clientModifier'] = $_SESSION['nom'];
$nombreEtape = CategorieDAO::rechercherNomsEtapes();
$listeboiteCategorie = BoiteDAO::rechercherBoitesParEtape($_SESSION["etapeClientAfficher"]);
$pourcentages = BoiteDAO::rechercherPourcentage();
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Idnum suivi - <?php echo _("Accueil") ?></title>
    <?php include('header.php');?>
	<body>
		<div class="boxaccueil">
      <h1><?php echo _("Suivi en temps reel") ?></h1>
      <div id="afficherbarre" class="barreprogression">
        <?php for ($compteur = 1; $compteur <= count($nombreEtape); $compteur++)
          {
          ?>
          <div id="afficherjauge" class="jauge<?php echo $compteur?>" style="width:<?php echo $pourcentages[$compteur - 1]?>%">
            <?php echo (int)$pourcentages[$compteur - 1]?>%
          </div>
          <?php
        }
        ?>
      </div>
      <div class="commentaireprogression">
        <?php for ($compteur = 1; $compteur <= count($nombreEtape); $compteur++)
          {
          ?>
          <p class="commentairejauge<?php echo $compteur?>"><?php echo _($nombreEtape[$compteur - 1]) ?></p>
          <?php
        }
        ?>
      </div>
      <div class="menuaccueil">
        <?php for ($compteur = 1; $compteur <= count($nombreEtape); $compteur++) {
          if ($_SESSION["etapeClientAfficher"] == $compteur) {
        ?>
            <form method="post">
              <input type="hidden" id="formboutonetape" name="formboutonetape" value="<?php echo $compteur ?>">
              <p><input type="submit" class="button" id="formboutonetapechecked" value="<?php echo _($nombreEtape[$compteur - 1]) ?>"/></p>
            </form>
        <?php
          }
          else {
        ?>
          <form method="post">
            <input type="hidden" id="formboutonetape" name="formboutonetape" value="<?php echo $compteur ?>">
            <p><input type="submit" class="button" id="formboutonetape" value="<?php echo _($nombreEtape[$compteur - 1]) ?>"/></p>
          </form>
        <?php
          }
        }
        ?>
      </div>
      <?php foreach ($listeboiteCategorie as $boite) { ?>
        <p><?php echo $boite['numero_client'] ?></p>
      <?php
      }
      ?>
	  </div>
  </body>
  <?php include('footer.php'); ?>
</html>
