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

  public static function ajouter($categorie)
  {
    $baseDeDonnees = Connexion::getConnection();

    $requette = $baseDeDonnees->prepare('INSERT INTO categorie (identifiant_categorie, nom_categorie, numero_categorie, id_client) VALUES (NULL, :nom, :numero, :id)');

    $requette->bindValue(':nom', $categorie->getNomCategorie());
    $requette->bindValue(':numero', $categorie->getNumeroCategorie());
    $requette->bindValue(':id', $categorie->getIdClient());

    if ($requette->execute()) {
      return true;
    }
    return false;
  }

  public static function supprimerCategorie($id)
  {
    $baseDeDonnees = Connexion::getConnection();

    $requette = $baseDeDonnees->prepare('DELETE FROM categorie WHERE id_client = :id_client');
    $requette->bindValue(':id_client', $id);
    if ($requette->execute()) {
      return true;
    }
    return false;
  }

  public static function modifier($id, $nom, $num)
  {
    $baseDeDonnees = Connexion::getConnection();

    $requette = $baseDeDonnees->prepare('UPDATE categorie SET nom_categorie = :nom_categorie WHERE numero_categorie = :numero_categorie AND id_client = :id_client');
    $requette->bindValue(':id_client', $id);
    $requette->bindValue(':numero_categorie', $num);
    $requette->bindValue(':nom_categorie', $nom);
    $requette->execute();
    return $requette->fetch()[0];
  }
}
?>
