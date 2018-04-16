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
}
?>
