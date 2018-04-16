<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/configuration/configuration.php";
require_once DAO_CATEGORIE;
require_once DAO_CLIENT;

class CategorieDAO
{
  private static $baseDeDonnees;

  public static function rechercherNomsEtapes()
  {
    $listeBoite = array();
    $baseDeDonnees = Connexion::getConnection();
    $identifiant = ClientDAO::rechercherParNomExacte($_SESSION['clientModifier']);

    $requette = $baseDeDonnees->prepare('SELECT * from categorie WHERE id_client = :id_client ORDER by numero_categorie');
    $requette->bindParam(':id_client', $identifiant[0]['identifiant']);
    $requette->execute();

    foreach ($requette as $client) {
      array_push($listeBoite, $client['nom_categorie']);
    }
    return $listeBoite ;
  }

  public static function rechercherNombreEtape()
  {
    $baseDeDonnees = Connexion::getConnection();
    $identifiant = ClientDAO::rechercherParNomExacte($_SESSION['clientModifier']);

    $requette = $baseDeDonnees->prepare('SELECT max(numero_categorie) from categorie WHERE id_client = :id_client');
    $requette->bindParam(':id_client', $identifiant[0]['identifiant']);
    $requette->execute();
    return $requette->fetch()[0];
  }

  public static function rechercherParNumeroEtape($numeroEtape)
  {
    $baseDeDonnees = Connexion::getConnection();
    $identifiant = ClientDAO::rechercherParNomExacte($_SESSION['clientModifier']);

    $requette = $baseDeDonnees->prepare('SELECT nom_categorie from categorie WHERE numero_categorie = :numero_categorie AND id_client = :id_client');
    $requette->bindParam(':id_client', $identifiant[0]['identifiant']);
    $requette->bindParam(':numero_categorie', $numeroEtape);
    $requette->execute();
    return $requette->fetch()[0];
  }
}
?>
