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
require_once CONTROLEUR_AFFICHER_DETAILS;

$nombreEtape = CategorieDAO::rechercherNomsEtapes();
$listeboiteCategorie = BoiteDAO::rechercherBoitesParEtape($_SESSION["etapeClientAfficher"]);
$pourcentages = BoiteDAO::rechercherPourcentage();
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Idnum suivi - <?php echo _("Liste Boites") ?></title>
    <?php include('header.php');?>
	<body class="bodyListeBoites">
		<div class="boxlisteboite">
      <h1><?php echo _("Suivi en temps reel") ?></h1>
      <div id="afficherbarre" class="barreprogression">
        <?php for ($compteur = 1; $compteur <= count($nombreEtape); $compteur++)
          {
            if ($compteur <= sizeof($pourcentages)) {
          ?>
          <div id="afficherjauge" class="jauge<?php echo $compteur?>" style="width:<?php echo $pourcentages[$compteur - 1]?>%">
            <?php echo (int)$pourcentages[$compteur - 1]?>%
          </div>
          <?php
          }
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
      <div class="menulisteboite">
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
      <div class="boitetrouve">
        <?php foreach ($listeboiteCategorie as $boite) {
          if ($boite['pages'] > 0) { ?>
            <p id="nomboite"><?php echo $boite['numero']." (images ".$boite['pages'].")" ?></p>
          <?php
          }
          else { ?>
          <p id="nomboite"><?php echo $boite['numero'] ?></p>
          <?php
          }
        }
        ?>
      </div>
      <p><a href="index.php"><input type="button" id="boutonretourindex" value="<?php echo _("retour") ?>"/></a></p>
	  </div>
  </body>
  <?php include('footer.php'); ?>
</html>
