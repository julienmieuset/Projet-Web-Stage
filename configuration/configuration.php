<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
define('SGBD', 'mysql');
define('NOM_BD', 'idnum');
define('NOM_HOTE_BD', 'localhost');
define('NOM_USAGER_BD', 'root');
define('MDP_USAGER_BD', '');

require_once $_SERVER["DOCUMENT_ROOT"] . "/DAO/Connexion.php";

define("MODELE_CLIENT", $_SERVER["DOCUMENT_ROOT"] . "/modele/Client.php");
define("MODELE_BOITE", $_SERVER["DOCUMENT_ROOT"] . "/modele/Boite.php");
define("MODELE_CATEGORIE", $_SERVER["DOCUMENT_ROOT"] . "/modele/Categorie.php");
define("DAO_CLIENT", $_SERVER["DOCUMENT_ROOT"] . "/DAO/ClientDAO.php");
define("DAO_BOITE", $_SERVER["DOCUMENT_ROOT"] . "/DAO/BoiteDAO.php");
define("DAO_CATEGORIE", $_SERVER["DOCUMENT_ROOT"] . "/DAO/CategorieDAO.php");
define("CONTROLEUR_AUTHENTIFICATION", $_SERVER["DOCUMENT_ROOT"] . "/controleur/utilisateur.inc.php");
define("CONTROLEUR_CREATION_CLIENT", $_SERVER["DOCUMENT_ROOT"] . "/controleur/creerClient.php");
define("CONTROLEUR_DETAILS_CLIENT", $_SERVER["DOCUMENT_ROOT"] . "/controleur/detailsClient.php");
define("CONTROLEUR_MODIFICATION_CLIENT", $_SERVER["DOCUMENT_ROOT"] . "/controleur/modifierClient.php");
define("CONTROLEUR_MODIFICATION_DETAILS", $_SERVER["DOCUMENT_ROOT"] . "/controleur/modifierDetails.php");
define("CONTROLEUR_AFFICHER_DETAILS", $_SERVER["DOCUMENT_ROOT"] . "/controleur/afficherDetails.php");
?>
