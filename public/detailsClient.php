<?php
if (!isset($_SESSION['identifiant']))
{
  session_start();
}
require_once $_SERVER["DOCUMENT_ROOT"] . "/configuration/configuration.php";
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Idnum suivi - <?php echo _("Details") ?></title>
    <?php include('header.php');?>
	<body>
		<div class="boxdetailsclient">
      <h1><?php echo _("Quelques chiffres vous concernant") ?></h1>
      <p>nombre etapes</p>
      <p>nombre boites</p>
      <p>nombre pages</p>
      <p><a href="index.php"><input type="button" id="boutonretourindex" value="<?php echo _("retour") ?>"/></a></p>
	  </div>
  </body>
  <?php include('footer.php'); ?>
</html>
