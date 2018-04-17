<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/configuration/configuration.php";
require_once DAO_CLIENT;

class BoiteDAO
{
  private static $baseDeDonnees;

  public static function rechercherParNom()
  {
    $listeBoite = array();
    $baseDeDonnees = Connexion::getConnection();
    $identifiant = ClientDAO::rechercherParNomExacte($_SESSION['clientModifier']);

    $requette = $baseDeDonnees->prepare('SELECT * from boite WHERE id_client = :id_client ORDER by numero_idnum');
    $requette->bindParam(':id_client', $identifiant[0]['identifiant']);
    $requette->execute();

    foreach ($requette as $client) {
      array_push($listeBoite, $client);
    }
    return $listeBoite ;
  }

  public static function rechercherEtapes()
  {
    $listeEtape = array();
    $baseDeDonnees = Connexion::getConnection();
    $identifiant = ClientDAO::rechercherParNomExacte($_SESSION['clientModifier']);

    $requette = $baseDeDonnees->prepare('SELECT DISTINCT etape from boite WHERE id_client = :id_client ORDER BY numero_etape');
    $requette->bindParam(':id_client', $identifiant[0]['identifiant']);
    $requette->execute();

    foreach ($requette as $etape) {
      array_push($listeEtape, $etape);
    }
    return $listeEtape ;
  }

  public static function rechercherMaxEtape()
  {
    $baseDeDonnees = Connexion::getConnection();
    $identifiant = ClientDAO::rechercherParNomExacte($_SESSION['clientModifier']);

    $requette = $baseDeDonnees->prepare('SELECT max(numero_etape) from boite WHERE id_client = :id_client');
    $requette->bindParam(':id_client', $identifiant[0]['identifiant']);
    $requette->execute();
    return $requette->fetch()[0];
  }

  public static function modifier($boite)
  {
    $baseDeDonnees = Connexion::getConnection();

    $requette = $baseDeDonnees->prepare('UPDATE boite SET identifiant_boite = identifiant_boite, numero_client = :numero_client, numero_idnum = :numero_idnum, etape = :etape, numero_etape = :numero_etape, id_client = :id_client  WHERE numero_client = :numero_client AND numero_idnum = :numero_idnum');
    $requette->bindValue(':numero_client', $boite->getNumeroClient());
    $requette->bindValue(':numero_idnum', $boite->getNumeroIdnum());
    $requette->bindValue(':etape', $boite->getEtape());
    $requette->bindValue(':numero_etape', $boite->getNumeroEtape());
    $requette->bindValue(':id_client', $boite->getIdClient());

    if ($requette->execute()) {
      return true;
    }
    return false;
  }

  public static function rechercherBoitesParEtape($numero_etape)
  {
    $listeBoite = array();
    $baseDeDonnees = Connexion::getConnection();
    $identifiant = ClientDAO::rechercherParNomExacte($_SESSION['clientModifier']);

    $requette = $baseDeDonnees->prepare('SELECT * from boite WHERE id_client = :id_client AND numero_etape = :numero_etape');
    $requette->bindValue(':id_client', $identifiant[0]['identifiant']);
    $requette->bindValue(':numero_etape', $numero_etape);
    $requette->execute();

    foreach ($requette as $boite) {
      array_push($listeBoite, $boite);
    }
    return $listeBoite ;
  }

  public static function rechercherPourcentage()
  {
    $listePourcentage = array();
    $baseDeDonnees = Connexion::getConnection();
    $identifiant = ClientDAO::rechercherParNomExacte($_SESSION['clientModifier']);

    $requette = $baseDeDonnees->prepare('SELECT count(*) from boite WHERE id_client = :id_client');
    $requette->bindValue(':id_client', $identifiant[0]['identifiant']);
    // $requette->bindValue(':numero_etape', $numero_etape);
    $requette->execute();
    $nombreBoite = $requette->fetch()[0];

    for ($compteur = 1; $compteur <= BoiteDAO::rechercherMaxEtape(); $compteur++) {
      $requetteSpecifique = $baseDeDonnees->prepare('SELECT count(*) from boite WHERE id_client = :id_client AND numero_etape = :numero_etape');
      $requetteSpecifique->bindValue(':id_client', $identifiant[0]['identifiant']);
      $requetteSpecifique->bindValue(':numero_etape', $compteur);
      $requetteSpecifique->execute();
      array_push($listePourcentage, (($requetteSpecifique->fetch()[0])/$nombreBoite)*100);
    }
    return $listePourcentage;
  }

  public static function ajouter($boite)
  {
    $baseDeDonnees = Connexion::getConnection();

    $requette = $baseDeDonnees->prepare('INSERT INTO boite (identifiant_boite, numero_client, numero_idnum, etape, numero_etape, id_client) VALUES (NULL, :numero_client, :numero_idnum, :etape, :numero_etape, :id_client)');

    $requette->bindValue(':numero_client', $boite->getNumeroClient());
    $requette->bindValue(':numero_idnum', $boite->getNumeroIdnum());
    $requette->bindValue(':etape', $boite->getEtape());
    $requette->bindValue(':numero_etape', $boite->getNumeroEtape());
    $requette->bindValue(':id_client', $boite->getIdClient());

    if ($requette->execute()) {
      return true;
    }
    return false;
  }

  public static function rechercherParNumeroClient($num) {
    $baseDeDonnees = Connexion::getConnection();
    $identifiant = ClientDAO::rechercherParNomExacte($_SESSION['clientModifier']);

    $requette = $baseDeDonnees->prepare('SELECT count(*) from boite WHERE id_client = :id_client AND numero_client = :numero_client');
    $requette->bindValue(':id_client', $identifiant[0]['identifiant']);
    $requette->bindValue(':numero_client', $num);
    $requette->execute();

    return $requette->fetch()[0];
  }

  public static function rechercherParNumeroIdnum($num) {
    $baseDeDonnees = Connexion::getConnection();
    $identifiant = ClientDAO::rechercherParNomExacte($_SESSION['clientModifier']);

    $requette = $baseDeDonnees->prepare('SELECT count(*) from boite WHERE id_client = :id_client AND numero_idnum = :numero_idnum');
    $requette->bindValue(':id_client', $identifiant[0]['identifiant']);
    $requette->bindValue(':numero_idnum', $num);
    $requette->execute();

    return $requette->fetch()[0];
  }
}
?>
