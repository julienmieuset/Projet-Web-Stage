<meta charset="utf-8">
<link rel="stylesheet" href="decorations/idnum.css">
</head>
<header class="global-header">
<a href="/index.php">
<img src="../illustrations/LogoIdnum.png" class="logo" width="200">
</a>
<?php
if (!empty($_SESSION['identifiant'])) { ?>
<p>
<a href="../fonctions/deconnexion.php"><?php echo _("Deconnexion") ?></a> | <a href="../aide/aideAdmin.pdf" target="_blank">Aide</a>
</p>
<?php
}
else { ?>
<p>
<a href="../index.php"><?php echo _("Connexion") ?></a> | <a href="../aide/aideAdmin.pdf" target="_blank">Aide</a>
</p>
<?php  }
?>
</header>
</head>
