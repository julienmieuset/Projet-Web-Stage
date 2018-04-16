<?php
class Boite
{
  private $identifiant_boite;
  private $numero_client;
  private $numero_idnum;
  private $etape;
  private $numero_etape;
  private $id_client;

  private $numero_clientTemporaire;
  private $numero_idnumTemporaire;
  private $id_clientTemporaire;
  private $etapeTemporaire;

  private $listeMessageErreur = [];
  private $listeMessageErreurActif = [];

  public function __construct(){

  }


  public function construireSecuritairement(
    $identifiant_boite, $numero_client, $numero_idnum, $etape, $numero_etape, $id_client) {
    $this->identifiant_boite = $identifiant_boite;
    $this->numero_client = $numero_client;
    $this->numero_idnum = $numero_idnum;
    $this->etape = $etape;
    $this->numero_etape = $numero_etape;
    $this->id_client = $id_client;
  }

  // Liste des getters
  public function getId()
  {
    return $this->identifiant_boite;
  }

  public function getNumeroClient()
  {
    return $this->numero_client;
  }

  public function getNumeroIdnum()
  {
    return $this->numero_idnum;
  }

  public function getEtape()
  {
    return $this->etape;
  }

  public function getNumeroEtape()
  {
    return $this->numero_etape;
  }

  public function getIdClient()
  {
    return $this->id_client;
  }

  // Liste des setters
  public function setId($identifiant)
  {
    if (filter_var($identifiant, FILTER_VALIDATE_INT)) {
      $this->identifiant_boite = $identifiant;
    }
  }

  public function setNumeroClient($num)
  {
    $numero_clientTemporaire = filter_var($num, FILTER_SANITIZE_STRING);
    if (empty($numero_clientTemporaire)) {
      $this->listeMessageErreurActif['numC'][] = $this->listeMessageErreur['numC-vide'];
    }
    else {
      if (strlen($numero_clientTemporaire) > 20) {
        $this->listeMessageErreurActif['numC'][] = $this->listeMessageErreur['numC-long'];
      }
      else {
        $this->numero_client = $numero_clientTemporaire;
      }
    }
  }

  public function setNumeroIdnum($num)
  {
    $numero_idnumTemporaire = filter_var($num, FILTER_SANITIZE_STRING);
    if (empty($numero_idnumTemporaire)) {
      $this->listeMessageErreurActif['numI'][] = $this->listeMessageErreur['numI-vide'];
    }
    else {
      if (strlen($numero_idnumTemporaire) > 20) {
        $this->listeMessageErreurActif['numI'][] = $this->listeMessageErreur['numI-long'];
      }
      else {
        $this->numero_idnum = $numero_idnumTemporaire;
      }
    }
  }

  public function setEtape($etape)
  {
    $etapeTemporaire = filter_var($etape, FILTER_SANITIZE_STRING);
    if (empty($etapeTemporaire)) {
      $this->listeMessageErreurActif['numE'][] = $this->listeMessageErreur['numE-vide'];
    }
    else {
      if (strlen($etapeTemporaire) > 20) {
        $this->listeMessageErreurActif['numE'][] = $this->listeMessageErreur['numE-long'];
      }
      else {
        $this->etape = $etapeTemporaire;
      }
    }
  }

  public function setNumeroEtape($numero_etape)
  {
    if (filter_var($numero_etape, FILTER_VALIDATE_INT)) {
      $this->numero_etape = $numero_etape;
    }
  }

  public function setIdClient($num)
  {
    $id_clientTemporaire = filter_var($num, FILTER_SANITIZE_STRING);
    if (empty($id_clientTemporaire)) {
      $this->listeMessageErreurActif['idC'][] = $this->listeMessageErreur['idC-vide'];
    }
    else {
      if (strlen($id_clientTemporaire) > 30) {
        $this->listeMessageErreurActif['idC'][] = $this->listeMessageErreur['idC-long'];
      }
      else {
        $this->id_client = $id_clientTemporaire;
      }
    }
  }

  public function getListeErreurActivePourChamp($champ){
    $listeErreurActivePourChamp = array();
    foreach ($this->listeMessageErreurActif as $nomChamp=>$messageErreur) {
      if ($nomChamp==$champ) {
        $listeErreurActivePourChamp [] = $messageErreur;
      }
    }
    return $listeErreurActivePourChamp;
  }
}
?>
