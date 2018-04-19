<?php
class Client
{
  private $identifiant;
  private $nom;
  private $motDePasse;
  private $prefixe;
  private $depart;

  private $identifiantTemporaire;
  private $nomTemporaire;
  private $motDePasseTemporaire;
  private $prefixeTemporaire;

  private $listeMessageErreur = [
    'id-long' => 'L\'identifiant ne doit pas excéder 30 caractères.',
    'id-vide' => 'L\'identifiant ne doit pas être vide.',
    'nom-vide' => 'Le nom ne doit pas être vide.',
    'nom-long' => 'Le nom ne doit pas excéder 50 caractères.',
  ];
  private $listeMessageErreurActif = [];

  public function __construct(){

  }

  public function construireSecuritairement($identifiant, $nom, $motDePasse, $prefixe, $depart) {
    $this->identifiant = $identifiant ;
    $this->nom = $nom ;
    $this->motDePasse = $motDePasse ;
    $this->prefixe = $prefixe;
    $this->depart = $depart;
  }

  // Liste des getters
  public function getId()
  {
    return $this->identifiant;
  }

  public function getNom()
  {
    return $this->nom;
  }

  public function getMotDePasse()
  {
    return $this->motDePasse;
  }

  public function getPrefixe()
  {
    return $this->prefixe;
  }

  public function getDepart()
  {
    return $this->depart;
  }

  // Liste des setters
  public function setId($identifiant)
  {
    $identifiantTemporaire = filter_var($identifiant, FILTER_SANITIZE_STRING);
    if (empty($identifiantTemporaire)) {
      $this->listeMessageErreurActif['id'][] = $this->listeMessageErreur['id-vide'];
    }
    else {
      if (strlen($identifiantTemporaire) > 30) {
        $this->listeMessageErreurActif['id'][] = $this->listeMessageErreur['id-long'];
      }
      else {
        $this->identifiant = $identifiant;
      }
    }
  }

  public function setNom($nom)
  {
    $nomTemporaire = filter_var($nom, FILTER_SANITIZE_STRING);
    if (empty($nomTemporaire)) {
      $this->listeMessageErreurActif['nom'][] = $this->listeMessageErreur['nom-vide'];
    }
    else {
      if (strlen($nomTemporaire) > 50) {
        $this->listeMessageErreurActif['nom'][] = $this->listeMessageErreur['nom-long'];
      }
      else {
        $this->nom = $nomTemporaire;
      }
    }
  }

  public function setDepart($depart)
  {
    if (filter_var($depart, FILTER_VALIDATE_INT)) {
      $this->depart = $depart;
    }
  }

  public function setMotDePasse($motdepasse)
  {
    $motdepasseTemporaire = filter_var($motdepasse, FILTER_SANITIZE_STRING);
    if (empty($motdepasseTemporaire)) {
    }
    $this->motDePasse = $motdepasseTemporaire;
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

  public function setPrefixe($prefixe)
  {
    $prefixeTemporaire = filter_var($prefixe, FILTER_SANITIZE_STRING);
    if (empty($prefixeTemporaire)) {
      $this->listeMessageErreurActif['pre'][] = $this->listeMessageErreur['pre-vide'];
    }
    else {
      if (strlen($prefixeTemporaire) > 20) {
        $this->listeMessageErreurActif['pre'][] = $this->listeMessageErreur['pre-long'];
      }
      else {
        $this->prefixe = $prefixeTemporaire;
      }
    }
  }
}
?>
