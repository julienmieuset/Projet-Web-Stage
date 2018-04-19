<?php
class Boite
{
  private $identifiant_boite;
  private $numero;
  private $etape;
  private $numero_etape;
  private $pages;
  private $id_client;

  private $numeroTemporaire;
  private $id_clientTemporaire;
  private $etapeTemporaire;

  private $listeMessageErreur = [];
  private $listeMessageErreurActif = [];

  public function __construct(){

  }


  public function construireSecuritairement(
    $identifiant_boite, $numero, $etape, $numero_etape, $pages, $id_client) {
    $this->identifiant_boite = $identifiant_boite;
    $this->numero = $numero;
    $this->etape = $etape;
    $this->numero_etape = $numero_etape;
    $this->pages = $pages;
    $this->id_client = $id_client;
  }

  // Liste des getters
  public function getId()
  {
    return $this->identifiant_boite;
  }

  public function getNumero()
  {
    return $this->numero;
  }

  public function getEtape()
  {
    return $this->etape;
  }

  public function getNumeroEtape()
  {
    return $this->numero_etape;
  }

  public function getPages()
  {
    return $this->pages;
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

  public function setPages($pages)
  {
    if (filter_var($pages, FILTER_VALIDATE_INT)) {
      $this->pages = $pages;
    }
  }

  public function setNumero($num)
  {
    $numeroTemporaire = filter_var($num, FILTER_SANITIZE_STRING);
    if (empty($numeroTemporaire)) {
      $this->listeMessageErreurActif['num'][] = $this->listeMessageErreur['num-vide'];
    }
    else {
      if (strlen($numeroTemporaire) > 20) {
        $this->listeMessageErreurActif['num'][] = $this->listeMessageErreur['num-long'];
      }
      else {
        $this->numero = $numeroTemporaire;
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
