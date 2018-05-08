<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/configuration/configuration.php";
require_once DAO_BOITE;
require_once DAO_CATEGORIE;

class ClientDAO
{
  private static $baseDeDonnees;

  public static function existe($id,$mdp="")
  {
    $baseDeDonnees = Connexion::getConnection();

    $salt = "JusTEUNeChaineDECARaTErePourRendRELEmdpPlusLONg";
    $password = hash('sha256', $salt.$mdp);

    if ($mdp != "")
    {
    $requette = $baseDeDonnees->prepare('SELECT nom from client WHERE identifiant = :identifiant AND motDePasse = :motDePasse');
    $requette->bindParam(':motDePasse', $password);
    }
    else
    {
      $requette = $baseDeDonnees->prepare('SELECT nom from client WHERE identifiant = :identifiant');
    }
    $requette->bindParam(':identifiant', $id);
    $requette->execute();

    $resultat = $requette->fetchAll();
    if(count($resultat) > 0)
    {
      return true ;
    }
    return false ;
  }

  public static function rechercherParNom($recherche)
  {
    $listeNom = array();
    $baseDeDonnees = Connexion::getConnection();

    $requette = $baseDeDonnees->prepare('SELECT * from client WHERE nom LIKE :nom');
    if (empty($recherche)) {
      $requette->bindParam(':nom', $recherche);
      $requette->execute();
    }
    else {
      $requette->execute(array(':nom' => '%' . $recherche . '%'));
    }
    foreach ($requette as $client) {
      array_push($listeNom, $client);
    }
    return $listeNom ;
  }

  public static function rechercherParNomExacte($recherche)
  {
    $listeNom = array();
    $baseDeDonnees = Connexion::getConnection();

    $requette = $baseDeDonnees->prepare('SELECT * from client WHERE nom = :nom');
    $requette->bindParam(':nom', $recherche);
    $requette->execute();

    foreach ($requette as $client) {
      array_push($listeNom, $client);
    }
    return $listeNom ;
  }

  public static function rechercherNom($recherche)
  {
    $listeNom = array();
    $baseDeDonnees = Connexion::getConnection();

    $requette = $baseDeDonnees->prepare('SELECT * from client WHERE nom = :nom');
    $requette->bindParam(':nom', $recherche);
    $requette->execute();

    $resultat = $requette->fetchAll();
    if(count($resultat) > 0)
    {
      return true ;
    }
    return false ;
  }

  public static function rechercherParId($recherche)
  {
    $listeNom = array();
    $baseDeDonnees = Connexion::getConnection();

    $requette = $baseDeDonnees->prepare('SELECT * from client WHERE identifiant = :identifiant');
    $requette->bindParam(':identifiant', $recherche);
    $requette->execute();
    $resultat = $requette->fetchAll();
    if(count($resultat) > 0)
    {
      return true ;
    }
    return false ;
  }

  public static function ajouter($client)
  {
    $baseDeDonnees = Connexion::getConnection();

    $requette = $baseDeDonnees->prepare('INSERT INTO client (identifiant, nom, motDePasse, prefixe, depart) VALUES (:identifiant, :nom, :motDePasse, :prefixe, :depart)');
    $salt = "JusTEUNeChaineDECARaTErePourRendRELEmdpPlusLONg";
    $motDePasse = hash('sha256', $salt.$client->getMotDePasse());

    $requette->bindValue(':identifiant', $client->getId());
    $requette->bindValue(':nom', $client->getNom());
    $requette->bindValue(':motDePasse', $motDePasse);
    $requette->bindValue(':prefixe', $client->getPrefixe());
    $requette->bindValue(':depart', 0);
    if ($requette->execute()) {
      return true;
    }
    return false;
  }

  public static function modifier($client, $ancien)
  {
    $baseDeDonnees = Connexion::getConnection();
    $requette = $baseDeDonnees->prepare('UPDATE client SET identifiant = :identifiant, nom = :nom, motDePasse = motDePasse, prefixe = :prefixe, depart = :depart  WHERE identifiant = :ancien');
    if ($client->getMotDePasse() != 'identique') {
      $requette = $baseDeDonnees->prepare('UPDATE client SET identifiant = :identifiant, nom = :nom, motDePasse = :motDePasse, prefixe = :prefixe, depart = :depart  WHERE identifiant = :ancien');
      $salt = "JusTEUNeChaineDECARaTErePourRendRELEmdpPlusLONg";
      $motDePasse = hash('sha256', $salt.$client->getMotDePasse());
      $requette->bindValue(':motDePasse', $motDePasse);
    }
    $requette->bindValue(':ancien', $ancien);
    $requette->bindValue(':identifiant', $client->getId());
    $requette->bindValue(':nom', $client->getNom());
    $requette->bindValue(':prefixe', $client->getPrefixe());
    $requette->bindValue(':depart', $client->getDepart());

    if ($requette->execute()) {
      return true;
    }
    return false;
  }

  public static function rechercherNomParId($id)
  {
    $baseDeDonnees = Connexion::getConnection();

    $requette = $baseDeDonnees->prepare('SELECT nom from client WHERE identifiant = :identifiant');
    $requette->bindValue(':identifiant', $id);
    $requette->execute();

    return $requette->fetch()[0];
  }

  public static function rechercherPrefixe($id)
  {
    $baseDeDonnees = Connexion::getConnection();

    $requette = $baseDeDonnees->prepare('SELECT prefixe from client WHERE identifiant = :identifiant');
    $requette->bindValue(':identifiant', $id);
    $requette->execute();

    return $requette->fetch()[0];
  }

  public static function rechercherDepart($id)
  {
    $baseDeDonnees = Connexion::getConnection();

    $requette = $baseDeDonnees->prepare('SELECT depart from client WHERE identifiant = :identifiant');
    $requette->bindValue(':identifiant', $id);
    $requette->execute();

    return $requette->fetch()[0];
  }

  public static function modifierDepart($id, $numero)
  {
    $baseDeDonnees = Connexion::getConnection();
    $requette = $baseDeDonnees->prepare('UPDATE client SET identifiant = identifiant, nom = nom, motDePasse = motDePasse, prefixe = prefixe, depart = :depart  WHERE identifiant = :identifiant');
    $requette->bindValue(':identifiant', $id);
    $requette->bindValue(':depart', $numero);

    if ($requette->execute()) {
      return true;
    }
    return false;
  }

  public static function supprimerClient($nom)
  {
    $baseDeDonnees = Connexion::getConnection();
    $id = ClientDAO::rechercherParNomExacte($nom);
    $id = $id[0]['identifiant'];
    if (BoiteDAO::supprimerBoite($id)) {
      if (CategorieDAO::supprimerCategorie($id)) {

        $requette = $baseDeDonnees->prepare('DELETE FROM client WHERE identifiant = :id_client');
        $requette->bindValue(':id_client', $id);
        $requette->execute();
      }
    }
  }
}
?>
