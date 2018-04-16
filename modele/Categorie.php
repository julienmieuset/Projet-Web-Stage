<?php
class Categorie
{
  private $identifiant_categorie;
  private $nom_categorie;
  private $numero_categorie;
  private $id_client;

  private $nom_categorieTemporaire;
  private $id_clientTemporaire;

  private $listeMessageErreur = [];
  private $listeMessageErreurActif = [];

  public function __construct(){

  }


  public function construireSecuritairement(
    $identifiant_categorie, $nom_categorie, $numero_categorie, $id_client) {
    $this->identifiant_categorie = $identifiant_categorie;
    $this->nom_categorie = $nom_categorie;
    $this->numero_categorie = $numero_categorie;
    $this->id_client = $id_client;
  }

  // Liste des getters
  public function getId()
  {
    return $this->identifiant_categorie;
  }

  public function getNomCategorie()
  {
    return $this->nom_categorie;
  }

  public function getNumeroCategorie()
  {
    return $this->numero_categorie;
  }

  public function getIdClient()
  {
    return $this->id_client;
  }

  // Liste des setters
  public function setId($identifiant)
  {
    if (filter_var($identifiant, FILTER_VALIDATE_INT)) {
      $this->identifiant_categorie = $identifiant;
    }
  }

  public function setNumeroCategorie($numero)
  {
    if (filter_var($numero, FILTER_VALIDATE_INT)) {
      $this->$numero_categorie = $numero;
    }
  }

  public function setNomCategorie($num)
  {
    $nom_categorieTemporaire = filter_var($num, FILTER_SANITIZE_STRING);
    if (empty($nom_categorieTemporaire)) {
      $this->listeMessageErreurActif['numC'][] = $this->listeMessageErreur['numC-vide'];
    }
    else {
      if (strlen($nom_categorieTemporaire) > 20) {
        $this->listeMessageErreurActif['numC'][] = $this->listeMessageErreur['numC-long'];
      }
      else {
        $this->nom_categorie = $nom_categorieTemporaire;
      }
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
