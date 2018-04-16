<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/configuration/configuration.php";

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

    $requette = $baseDeDonnees->prepare('SELECT * from client WHERE nom == :nom');
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

    $requette = $baseDeDonnees->prepare('SELECT * from client WHERE identifiant == :identifiant');
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

    $requette = $baseDeDonnees->prepare('INSERT INTO client (identifiant, nom, motDePasse) VALUES (:identifiant, :nom, :motDePasse)');
    $identifiant = $client->getId();
    $nom = $client->getNom();
    $salt = "JusTEUNeChaineDECARaTErePourRendRELEmdpPlusLONg";
    $motDePasse = hash('sha256', $salt.$client->getMotDePasse());

    $requette->bindParam(':identifiant', $identifiant);
    $requette->bindParam(':nom', $nom);
    $requette->bindParam(':motDePasse', $motDePasse);

    if ($requette->execute()) {
      return true;
    }
    return false;
  }

  public static function modifier($client, $ancien)
  {
    $baseDeDonnees = Connexion::getConnection();
    $requette = $baseDeDonnees->prepare('UPDATE client SET identifiant = :identifiant, nom = :nom, motDePasse = motDePasse  WHERE identifiant = :ancien');
    if ($client->getMotDePasse() != 'identique') {
      $requette = $baseDeDonnees->prepare('UPDATE client SET identifiant = :identifiant, nom = :nom, motDePasse = :motDePasse  WHERE identifiant = :ancien');
      $salt = "JusTEUNeChaineDECARaTErePourRendRELEmdpPlusLONg";
      $motDePasse = hash('sha256', $salt.$client->getMotDePasse());
      $requette->bindValue(':motDePasse', $motDePasse);
    }
    $requette->bindValue(':ancien', $ancien);
    $requette->bindValue(':identifiant', $client->getId());
    $requette->bindValue(':nom', $client->getNom());

    if ($requette->execute()) {
      return true;
    }
    return false;
  }
}
?>
